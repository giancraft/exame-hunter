<?php

require_once "Administrador.php";
require_once "persistencia/PDOAdministradorDAO.php";
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
        'nome' => isset($_POST['nome']) ? $_POST['nome'] : "",
        'email' => isset($_POST['email']) ? $_POST['email'] : "",
        'senha' => isset($_POST['senha']) ? $_POST['senha'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Administrador();
    $elemento->id = $array_dados['id'];
    $elemento->nome = $array_dados['nome'];
    $elemento->email = $array_dados['email'];
    $elemento->senha = $array_dados['senha'];
    return $elemento;
}

function objeto2array($elemento)
{
    $dado = array(
        'id' => (string) $elemento->id,
        'nome' => (string) $elemento->nome,
        'email' => (string) $elemento->email,
        'senha' => (string) $elemento->senha
    );
    return $dado;
}

function carregar($id)
{
    $dao = PDOAdministradorDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();

    $dao = PDOAdministradorDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
    exit();
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOAdministradorDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
    exit();
}

function salvar()
{
    $novo = tela2array();

    $dao = PDOAdministradorDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->insert($objeto->nome, $objeto->email, $objeto->senha); 

    header("Location: " . DESTINO);
    exit();
}
?>
