<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .header-container {
            position: absolute;
            top: 0;
            right: 0;
            margin: 1rem;
        }
        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .user-info img {
            width: 40px;
            height: 40px;
            margin-bottom: 0.5rem;
        }
        .nav-tabs {
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Candidatos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../administradores/index.php">Administradores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../examinadores/index.php">Examinadores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../tipo_nen/index.php">Tipo de Nen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cadastro.php">Cadastro de Candidato</a>
        </li>
    </ul>
</body>
</html>