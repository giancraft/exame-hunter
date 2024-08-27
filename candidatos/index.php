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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Candidatos</title>
</head>
<body>
    <h1>Candidatos</h1>
    <?php include 'menu.php'; ?>

    <!-- Formulário de filtro -->
    <br>
    <form method="GET" action="" class="mb-3">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($_GET['nome']) ? htmlspecialchars($_GET['nome'], ENT_QUOTES, 'UTF-8') : ''; ?>" placeholder="Pesquise por nome">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </div>
    </form>

    <?php
    $nomeFiltro = isset($_GET['nome']) ? $_GET['nome'] : '';

    $dao = PDOCandidatoDAO::getInstance();
    $dados = $dao->listarFiltro($nomeFiltro);
    ?>

    <table class="table table-hover" border="1px">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Altura</th>
            <th>Peso</th>
            <th>Data de Nascimento</th>
            <th>Detalhes</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
        <?php
        foreach ($dados as $key) {
            $id = htmlspecialchars($key['id'], ENT_QUOTES, 'UTF-8');
            $nome = htmlspecialchars($key['nome'], ENT_QUOTES, 'UTF-8');
            $altura = htmlspecialchars($key['altura'], ENT_QUOTES, 'UTF-8');
            $peso = htmlspecialchars($key['peso'], ENT_QUOTES, 'UTF-8');
            $dataNascimento = htmlspecialchars($key['dataNascimento'], ENT_QUOTES, 'UTF-8');

            echo "<tr>
                    <td>{$id}</td>
                    <td>{$nome}</td>
                    <td>{$altura}</td>
                    <td>{$peso}</td>
                    <td>{$dataNascimento}</td>
                    <td><a role='button' href='show.php?id={$id}'><button class='btn btn-dark'>Detalhes</button></a></td>
                    <td><a role='button' href='cadastro.php?id={$id}'><button class='btn btn-dark'>Alterar</button></a></td>
                    <td><a role='button' href='javascript:excluirRegistro(\"candidato_acao.php?acao=Excluir&id={$id}\");'><button class='btn btn-danger'>Excluir</button></a></td>
                  </tr>";
        }
        ?>
    </table>

    <!-- função de confirmação em JavaScript para a exclusão -->
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>
</html>
