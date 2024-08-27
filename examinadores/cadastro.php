<?php 

?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../tipo_nen/persistencia/PDOTipoNenDAO.php";
 ?>
<!DOCTYPE html>
<html lang="pt-BR">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Cadastro</title>
<?php
include "examinador_acao.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<body>
    <?php include 'menu.php'; ?>
    <div class="d-flex justify-content-center">
        <form action="examinador_acao.php" method="post">
            <fieldset>
                <legend>Cadastro de Examinador</legend>

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
                    <label for="peso">Peso</label>
                    <input type="number" name="peso" id="peso" class="form-control" value="<?php if ($id != 0)
                    echo $dados['peso']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="altura">Altura</label>
                    <input type="text" name="altura" id="altura" class="form-control" value="<?php if ($id != 0)
                    echo $dados['altura']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="dataNascimento">Data de Nascimento</label>
                    <input type="date" name="dataNascimento" id="dataNascimento" class="form-control" value="<?php if ($id != 0)
                    echo $dados['dataNascimento']; ?>" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="tipoNen_id">Tipo de Nen</label>
                    <select name="tipoNen_id[]" id="tipoNen_id">
                        <option value="">Escolha um tipo de Nen</option>
                        <?php
                            $tipoNenDAO = PDOTipoNenDAO::getInstance();
                            $dadosTipoNen = array();
                            $dadosTipoNen = $tipoNenDAO->listar();
                            foreach ($dadosTipoNen as $tipo){
                                echo "<option value=\"{$tipo['id']}\">{$tipo['descricao']}</option>";
                            } ?>
                    </select>
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

    <?php 
        $tiposNenAssociados = PDOExaminador_TipoNenDAO::getInstance()->listarPorExaminador($id);
        $tipoNenDAO = PDOTipoNenDAO::getInstance();
        $dadosTipoNen = array();
        $dadosTipoNen = $tipoNenDAO->listar();
        $dadosTipoDeNen = array();

        $tipoDeNen = PDOTipoNenDAO::getInstance();
        foreach ($tiposNenAssociados as $tiposNen){
            foreach ($dadosTipoNen as $nen){
                if ($tiposNen->tipoNen_id == $nen['id']){
                    array_push($dadosTipoDeNen, $nen);
                }
            }
        }

        
        //$dadosTipoDeNen = $tipoDeNen->listar();
    ?>
    <h3>Tipos de Nen Associados</h3>
    <table class="table table-hover" border="1">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dadosTipoDeNen as $tipoNen): ?>
                <tr>
                    <td><?= htmlspecialchars($tipoNen['descricao']) ?></td>
                    <td><a role='button' href='javascript:excluirRegistro("examinador_acao.php?acao=ExcluirNen&examinador_id=<?= $id ?>&tipoNen_id=<?= $tipoNen['id'] ?>");'>
                        <button class='btn btn-danger'>Excluir</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>

    <footer class="container"></footer>
</body>

</html>