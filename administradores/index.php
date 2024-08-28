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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/style.css">    
    <title>Administradores</title>
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
</head>
<body id= "aaa">
    <div id = "principal"> 
            <div>
                <img src="https://yt3.googleusercontent.com/E0CZm2Cm34dEsiPlu5STIOvXE-NK5q09Cc2wz3VDvjdvnTAhahEAO51cF1O__X07tJw9huWL=s900-c-k-c0x00ffffff-no-rj" alt="Webu" id="logo">
            </div>
            <br>
            <p>Como administrador do site da Associação Hunter, você tem privilégios especiais que permitem gerenciar as informações dentro deste universo. Assim como um Hunter de alto nível pode acessar áreas restritas e tomar decisões críticas, você pode alterar ou excluir dados do site, garantindo que tudo esteja em ordem e atualizado. Esses poderes são concedidos apenas aos mais qualificados, refletindo a importância de manter o equilíbrio e a ordem na Associação. Mas lembre-se, com grande poder vem grande responsabilidade!</p>
    </div>


    <div id = "bbb">
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
    </div>
    <br>
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