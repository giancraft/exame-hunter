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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Cadastro</title>
    <style>

        #aaa{
            background-image: url("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/i/defab05d-48e2-49f8-9e6c-74b3434b61a2/d6se8de-d10f089b-5b9c-40fa-b919-42a2a37f4781.png");
            background-size: 200px;
            -webkit-backdrop-filter: blur(3px);
             backdrop-filter: blur(3px);
        }

        #aaaa{
            opacity: 0.5;
        }

        #bbb{
            background-color: white;
            border: 10px solid;
        }

        #principal{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            height: 900px;
            width: 800px;
            background-color: #5dd55d;
            float: center;
            margin: 0 auto;
            border: 10px solid;
            text-indent: 4em;
            
        }

        #logo{
            display: block;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 90px;
            border-radius:200px;
        }

        p{
            padding-left:30px;
            padding-right: 30px;
            padding-top: 50px;
            color: black;
            font-weight: bold
        }
</style>
<?php
include "tipoNen_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<body>
    <?php include 'menu.php'; ?>
    <div id = "aaa">
    <div class="d-flex justify-content-center">
        <form action="tipoNen_acao.php" method="post">
            <fieldset>
                <br><br>
                <div id="bbb">
                <legend>Cadastro de Tipos de Nen</legend>

                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="text" name="id" id="id" class="form-control" value="<?= $id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="descricao">Descricao</label>
                    <input type="text" size="40" name="descricao" id="descricao" class="form-control" value="<?php if ($id != 0)
                    echo $dados['descricao']; ?>" required>
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
                    Entre para nos contatar sobre qualquer problema que teve em nosso site
                </p>

                <div id="input_group">
                    <a href="../contato/index.php"><button class="btn btn-dark">Contato</button></a>
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