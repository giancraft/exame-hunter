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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Cadastro</title>
    <style>
        #bbb{
            background-color: #5dd55d;
            height: 400px;
            width: 500px;
            border-radius:20px;
            padding-top:20px;
            padding-left:10px;
            padding-right:10px;
            border: 5px solid;
        }

        #aaa{
            background-image: url("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/i/defab05d-48e2-49f8-9e6c-74b3434b61a2/d6se8de-d10f089b-5b9c-40fa-b919-42a2a37f4781.png");
            background-size: 200px;
            -webkit-backdrop-filter: blur(3px);
            backdrop-filter: blur(3px);
        }
    </style>
<?php
include "examinador_acao.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<body>
    <?php include 'menu.php'; ?>
    <div id="aa">
    <div class="d-flex justify-content-center">
        <form action="examinador_acao.php" method="post">
            <fieldset>
                <br><br>
                <div id="bb">
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
                </div>
            </fieldset>
        </form>
    </div>
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

<footer>
        <div id="footer_content" class="alien">
            <div id="footer_contacts">
                <h1>Logo</h1>
                <p>It's all about your dreams.</p>

                <div id="footer_social_media">
                    <a href="#" class="footer-link" id="instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="#" class="footer-link" id="facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="#" class="footer-link" id="whatsapp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <ul class="footer-list">
                <li>
                    <h3>Blog</h3>
                </li>
                <li>
                    <a href="#" class="footer-link">Tech</a>
                </li>
                <li>
                    <a href="#" class="footer-link">Adventures</a>
                </li>
                <li>
                    <a href="#" class="footer-link">Music</a>
                </li>
            </ul>

            <ul class="footer-list">
                <li>
                    <h3>Products</h3>
                </li>
                <li>
                    <a href="#" class="footer-link">App</a>
                </li>
                <li>
                    <a href="#" class="footer-link">Desktop</a>
                </li>
                <li>
                    <a href="#" class="footer-link">Cloud</a>
                </li>
            </ul>

            <div id="footer_subscribe">
                <h3>Subscribe</h3>

                <p>
                    Enter your e-mail to get notified about
                    our news solutions
                </p>

                <div id="input_group">
                    <input type="email" id="email">
                    <button>
                        <i class="fa-regular fa-envelope"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="footer_copyright">
            &#169
            2023 all rights reserved
        </div>
    </footer>
</body>

</html>