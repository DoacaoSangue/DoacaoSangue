<?php
session_start();

// Proteção de login
if (!isset($_SESSION['usuario_email']) || $_SESSION['tipo_usuario'] != 0) {
    header('Location: ../index.php');
    exit;
}

// Verifica qual página o usuário quer
$page = $_GET['page'] ?? 'home'; // Se não passar nada, vai pra 'home' por padrão
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Painel</title>

    <style>
        header {
            background-color: #2c3e50 !important;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        header ul {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 2rem;
            list-style-type: none;
            margin: 2rem 0 0 -2rem;
            padding: 0;
        }

        header li a {
            text-decoration: none;
            color: white !important;
            font-weight: bold;
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        header li a:hover {
            color: #1abc9c !important;
        }

        .sair {
            justify-content: right;
        }

        main {
            margin-top: 100px;
            padding: 2rem;
        }
    </style>
</head>

<body>
    <header>
        <ul>
            <li><a href="?page=carregar-home">Página Inicial</a></li>
            <li><a href="?page=doacoes">Minhas Doações</a></li>
        </ul>
        <ul class="sair">
            <li><a href="../index.php?acao=sair">Sair</a></li>
        </ul>
    </header>

    <main>
        <?php
        // Aqui ele inclui dinamicamente o conteúdo!
        switch ($page) {
            case 'carregar-home':
                require('../controllers/carregar-doar.controller.php');
                break;
            case 'home':
                require('doar.view.php');
                break;
            case 'doacoes':
                require('minhas-doacoes.view.php');
                break;
            default:
                echo "<p>Página não encontrada.</p>";
        }
        ?>
    </main>
</body>

</html>