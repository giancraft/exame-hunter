<?php

require_once "Examinador.php";
require_once "persistencia/PDOExaminador_tipoNenDAO.php";
require_once "persistencia/PDOExaminadorDAO.php";
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
    case 'ExcluirNen':
        removerTipoNen();
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
    $elemento = new Examinador();
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
    $dao = PDOExaminadorDAO::getInstance();
    $dados = $dao->obter($id);
    return $dados;
}

function alterar()
{
    $novo = tela2array();

    $tipoNen_id = isset($_POST['tipoNen_id']) ? $_POST['tipoNen_id'] : "";
    var_dump($tipoNen_id);

    $dao = PDOExaminadorDAO::getInstance();
    $objeto = array2objeto($novo);

    $dao->alterar($objeto);

    if (!empty($tipoNen_id)){
        $daoExaminadorTipoNen = PDOExaminador_TipoNenDAO::getInstance();
        echo 'rodou aqui';
        foreach ($tipoNen_id as $tipoNenId) {
            if (!empty($tipoNenId)){
                $daoExaminadorTipoNen->insert($objeto->id, $tipoNenId);
            }
        }
    }

    header("Location: cadastro.php?id=" . $novo['id']);
    exit();
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";

    $dao = PDOExaminadorDAO::getInstance();
    $daoExaminadorTipoNen = PDOExaminador_TipoNenDAO::getInstance();

    $daoExaminadorTipoNen->excluirPorExaminador($id);

    $dao->excluir($id);

    header("Location: " . DESTINO);
    exit();
}

function removerTipoNen()
{
    $examinador_id = isset($_GET['examinador_id']) ? $_GET['examinador_id'] : null;
    $tipoNen_id = isset($_GET['tipoNen_id']) ? $_GET['tipoNen_id'] : null;

    $daoExaminadorTipoNen = PDOExaminador_TipoNenDAO::getInstance();
    $daoExaminadorTipoNen->excluir($examinador_id, $tipoNen_id);

    header("Location: cadastro.php?id=" . $examinador_id);
    exit();
}


function salvar()
{
    $novo = tela2array();

    $tipoNen_id = isset($_POST['tipoNen_id']) ? $_POST['tipoNen_id'] : "";

    $dao = PDOExaminadorDAO::getInstance();
    $objeto = array2objeto($novo);

    $examinadorId = $dao->insert($objeto->nome, $objeto->peso, $objeto->altura, $objeto->dataNascimento); 

    if (!empty($tipoNen_id)){
        $daoExaminadorTipoNen = PDOExaminador_TipoNenDAO::getInstance();

        foreach ($tipoNen_id as $tipoNenId) {
            if (!empty($tipoNenId)){
                $daoExaminadorTipoNen->insert($examinadorId, $tipoNenId);
            }
        }
    }

    header("Location: cadastro.php?id=" . $novo['id']);
    exit();
}
?>
