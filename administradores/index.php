<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "persistencia/PDOAdministradorDAO.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Administradores</title>
</head>
<body>
    <h1>Administradores</h1>
        <?php include 'menu.php'; ?>
        <?php


        $dao = PDOAdministradorDAO::getInstance();        
        $dados = array();
        $dados = $dao->listar();
        ?>
        <table class="table table-hover" border="1px">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Detalhes</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            foreach ($dados as $key) {
                $id = htmlspecialchars($key['id'], ENT_QUOTES, 'UTF-8');
                $nome = htmlspecialchars($key['nome'], ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($key['email'], ENT_QUOTES, 'UTF-8');
                
                echo "<tr>
                        <td>{$id}</td>
                        <td>{$nome}</td>
                        <td>{$email}</td>
                        <td><a role='button' href='show.php?id={$id}'><button class='btn btn-dark'>Detalhes</button></a></td>
                        <td><a role='button' href='cadastro.php?id={$id}'><button class='btn btn-dark'>Alterar</button></a></td>
                        <td><a role='button' href='javascript:excluirRegistro(\"admin_acao.php?acao=Excluir&id={$id}\");'><button class='btn btn-danger'>Excluir</button></a></td>
                      </tr>";
            }
            
            ?>
        </table>
    <!-- funcao de confirmacacao em javascript para a exclusao-->
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>
</html>