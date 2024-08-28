<?php

require_once "Contato.php";
require_once "persistencia/PDOContatoDAO.php";
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
    case 'Enviar':
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
        'email' => isset($_POST['email']) ? $_POST['email'] : "",
        'descricao' => isset($_POST['descricao']) ? $_POST['descricao'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Contato();
    $elemento->id = $array_dados['id'];
    $elemento->email = $array_dados['email'];
    $elemento->descricao = $array_dados['descricao'];
    return $elemento;
}

function objeto2array($elemento)
{
    $dado = array(
        'id' => (string) $elemento->id,
        'email' => (string) $elemento->email,
        'descricao' => (string) $elemento->descricao
    );
    return $dado;
}

function carregar($id)
{
    $dao = PDOContatoDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();

    $dao = PDOContatoDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
    exit();
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOContatoDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
    exit();
}

function salvar()
{
    $novo = tela2array();

    $dao = PDOContatoDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->insert($objeto->email, $objeto->descricao); 

    header("Location: ../examinadores/index.php");
    exit();
}
?>
