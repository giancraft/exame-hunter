<?php

/*require_once "Examinador_TipoNen.php";
require_once "persistencia/PDOExaminador_tipoNenDAO.php";
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
        'examinador_id' => isset($_POST['examinador_id']) ? $_POST['examinador_id'] : null,
        'tipoNen_id' => isset($_POST['tipoNen_id']) ? $_POST['tipoNen_id'] : null
    );
    return $novo;
}

function array2objeto($array_dados)
{
    $elemento = new Examinador_TipoNen();
    $elemento->examinador_id = $array_dados['examinador_id'];
    $elemento->tipoNen_id = $array_dados['tipoNen_id'];
    return $elemento;
}

function objeto2array($elemento)
{
    $dado = array(
        'examinador_id' => (string) $elemento->examinador_id,
        'tipoNen_id' => (string) $elemento->tipoNen_id
    );
    return $dado;
}

function carregar($id)
{
    $dao = PDOExaminador_TipoNenDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function excluir()
{
    $id = isset($_GET['tipoNen_id']) ? $_GET['tipoNen_id'] : "";
    $dao = PDOExaminador_TipoNenDAO::getInstance();
    $dao->excluir($id);

    header("Location: " . DESTINO);
    exit();
}

function salvar()
{
    $novo = tela2array();

    $dao = PDOExaminador_TipoNenDAO::getInstance();
    $objeto = array2objeto($novo);
    $dao->insert($objeto->examinador_id, $objeto->tipoNen_id); 

    header("Location: " . DESTINO);
    exit();
}*/
?>
