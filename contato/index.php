<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "contato_acao.php";
 ?>
<!DOCTYPE html>
<html lang="pt-BR">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Cadastro</title>
<body>
    <?php include 'menu.php'; ?>
    <div class="d-flex justify-content-center">
        <form action="contato_acao.php" method="post">
            <fieldset>
                <legend>Mensagem de Contato</legend>

                <div class="form-group">
                    <input type="hidden" name="id" id="id" class="form-control" value="<?= $id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" size="40" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descricao</label>
                    <input type="text" size="40" name="descricao" id="descricao" class="form-control" required>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <input type="submit" name="acao" id="acao" class="btn btn-dark" value="<?php echo "Enviar"; ?>">
                </div>
            </fieldset>
        </form>
    </div>