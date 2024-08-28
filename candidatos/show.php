<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "persistencia/PDOCandidatoDAO.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include "candidato_acao.php";
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $dados = array();
    if ($id != 0)
        $dados = carregar($id);
    ?>
</head>
<body>
    <?php include 'menu.php'; ?>

    <table class="table table-hover" border="1px">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Altura</th>
            <th>Peso</th>
            <th>Data de Nascimento</th>
        </tr>
    <?php 
        $id = htmlspecialchars($dados['id'], ENT_QUOTES, 'UTF-8');
        $nome = htmlspecialchars($dados['nome'], ENT_QUOTES, 'UTF-8');
        $altura = htmlspecialchars($dados['altura'], ENT_QUOTES, 'UTF-8');
        $peso = htmlspecialchars($dados['peso'], ENT_QUOTES, 'UTF-8');
        $dataNascimento = htmlspecialchars($dados['dataNascimento'], ENT_QUOTES, 'UTF-8');

        echo "<tr>
                <td>{$id}</td>
                <td>{$nome}</td>
                <td>{$altura}</td>
                <td>{$peso}</td>
                <td>{$dataNascimento}</td>
            </tr>"
    ?>
    </table>
</body>
</html>