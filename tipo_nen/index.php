<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "persistencia/PDOTipoNenDAO.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Tipos de Nen</title>
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
</head>
<body>
    <h1>Tipos de Nen</h1>
        <?php include 'menu.php'; ?>
        <?php


        $dao = PDOTipoNenDAO::getInstance();        
        $dados = array();
        $dados = $dao->listar();
        ?>
        <table class="table table-hover" border="1px">
            <tr>
                <th>Id</th>
                <th>Descricao</th>
                <th>Detalhes</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            foreach ($dados as $key) {
                $id = htmlspecialchars($key['id'], ENT_QUOTES, 'UTF-8');
                $descricao = htmlspecialchars($key['descricao'], ENT_QUOTES, 'UTF-8');
                
                echo "<tr>
                        <td>{$id}</td>
                        <td>{$descricao}</td>
                        <td><a role='button' href='show.php?id={$id}'><button class='btn btn-dark'>Detalhes</button></a></td>
                        <td><a role='button' href='cadastro.php?id={$id}'><button class='btn btn-dark'>Alterar</button></a></td>
                        <td><a role='button' href='javascript:excluirRegistro(\"tipoNen_acao.php?acao=Excluir&id={$id}\");'><button class='btn btn-danger'>Excluir</button></a></td>
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