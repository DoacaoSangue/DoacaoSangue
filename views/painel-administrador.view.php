<?php
session_start();

// Se o usuário não estiver logado, volta para o login
if (!isset($_SESSION['usuario_email']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: ../index.php');
    exit;
}

$page = $_GET['page'] ?? 'locais';
$crud = $_GET['crud'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
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

        main{
            margin-top: 10rem;
            width: 70%!important;
        }
        body{
            width: 100%;
            grid-template-columns: 0;
            padding-left: 15%;
        }
        table{
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <ul>
            <li><a href="?page=locais">Locais</a></li>
            <li><a href="?page=doacoes">Doações</a></li>
        </ul>
        <ul class="sair">
            <li><a href="../index.php?acao=sair">Sair</a></li>
        </ul>
    </header>
    <main>
        <?php
        switch ($page) {
            case 'locais':
                switch($crud){
                    case 'c':
                        require("locais.store.view.php");
                        break;
                    case 'u':
                        require("locais.update.view.php");
                        break;
                    case 'r':
                        require("locais.lista.view.php");
                        break;
                    case 'd':
                        require_once('../controllers/locais.delete.controller.php');
                    default:
                        require_once('../controllers/locais.lista.controller.php');
                }
                break;
            case 'usuarios':
                switch($crud){
                    case 'c':
                        require("usuarios.store.view.php");
                        break;
                    case 'u':
                        require("usuarios.update.view.php");
                        break;
                    default:
                        require('usuarios.lista.view.php');
                }
                break;
            case 'doacoes':
                switch($crud){
                    case 'c':
                        require("doacoes.store.view.php");
                        break;
                    case 'u':
                        require("doacoes.update.view.php");
                        break;
                    case 'r':
                        require("doacoes.lista.view.php");
                        break;
                    case 'd':
                        require_once('../controllers/doacoes.delete.controller.php');
                    default:
                        require_once('../controllers/doacoes.lista.controller.php');
                }
                break;
            default:
                echo "<p>Página não encontrada.</p>";
        }
        ?>
    </main>
</body>
</html>
