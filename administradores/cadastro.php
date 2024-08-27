<?php 

?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 ?>
<!DOCTYPE html>
<html lang="pt-BR">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Cadastro</title>
<?php
include "admin_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<body>
    <?php include 'menu.php'; ?>
    <div class="d-flex justify-content-center">
        <form action="admin_acao.php" method="post">
            <fieldset>
                <legend>Cadastro de Administrador</legend>

                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="text" name="id" id="id" class="form-control" value="<?= $id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" size="40" name="nome" id="nome" class="form-control" value="<?php if ($id != 0)
                    echo $dados['nome']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?php if ($id != 0)
                    echo $dados['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" value="<?php if ($id != 0)
                    echo $dados['senha']; ?>" required>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <input type="submit" name="acao" id="acao" class="btn btn-dark" value="<?php if ($id == 0)
                        echo "Salvar";
                    else
                        echo "Alterar";
                    ?>">
                </div>
            </fieldset>
        </form>
    </div>
    <footer class="container"></footer>
</body>

</html>