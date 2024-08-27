<?php

require_once "TipoNen.php";
require_once "persistencia/PDOTipoNenDAO.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("DESTINO", "index.php");

$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
        break;
    case 'POST':
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        break;
}

switch ($acao) {
    case 'Salvar':
        salvar();
        break;
    case 'Alterar':
        alterar();
        break;
    case 'Excluir':
        excluir();
        break;
}

function tela2array()
{
    $novo = array(
        'id' => isset($_POST['id']) ? $_POST['id'] : null,
        'descricao' => isset($_POST['descricao']) ? $_POST['descricao'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new TipoNen();
    $elemento->id = $array_dados['id'];
    $elemento->descricao = $array_dados['descricao'];
    return $elemento;
}

function objeto2array($elemento)
{
    $dado = array(
        'id' => (string) $elemento->id,
        'descricao' => (string) $elemento->descricao
    );
    return $dado;
}

function carregar($id)
{
    $dao = PDOTipoNenDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();

    $dao = PDOTipoNenDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
    exit();
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOTipoNenDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
    exit();
}

function salvar()
{
    $novo = tela2array();

    $dao = PDOTipoNenDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->insert($objeto->descricao); 

    header("Location: " . DESTINO);
    exit();
}
?>
