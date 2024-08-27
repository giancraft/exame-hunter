<?php

require_once "Candidato.php";
require_once "persistencia/PDOCandidatoDAO.php";
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
        'peso' => isset($_POST['peso']) ? $_POST['peso'] : "",
        'altura' => isset($_POST['altura']) ? $_POST['altura'] : "",
        'dataNascimento' => isset($_POST['dataNascimento']) ? $_POST['dataNascimento'] : ""
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Candidato();
    $elemento->id = $array_dados['id'];
    $elemento->nome = $array_dados['nome'];
    $elemento->peso = $array_dados['peso'];
    $elemento->altura = $array_dados['altura'];
    $elemento->dataNascimento = $array_dados['dataNascimento'];
    return $elemento;
}

function objeto2array($elemento)
{
    $dado = array(
        'id' => (string) $elemento->id,
        'nome' => (string) $elemento->nome,
        'peso' => (string) $elemento->peso,
        'altura' => (string) $elemento->altura,
        'dataNascimento' => (string) $elemento->dataNascimento
    );
    return $dado;
}

function carregar($id)
{
    $dao = PDOCandidatoDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();

    $dao = PDOCandidatoDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->alterar($objeto);

    header("Location: " . DESTINO);
    exit();
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dao = PDOCandidatoDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
    exit();
}

function salvar()
{
    $novo = tela2array();

    $dao = PDOCandidatoDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->insert($objeto->nome, $objeto->peso, $objeto->altura, $objeto->dataNascimento); 

    header("Location: " . DESTINO);
    exit();
}
?>
