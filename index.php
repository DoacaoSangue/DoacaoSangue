<?php
session_start();
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
            background-color: #2c3e50;
            display: flex;
            flex-direction: row;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
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
            margin: 0;
            padding: 0;
        }

        header li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        header li a:hover {
            color: #1abc9c;
        }

        .sair {
            justify-content: right;
        }
    </style>
</head>

<body>

    <?php
    // Simulação de login (remova depois que implementar autenticação real)
    if (!isset($_SESSION["perfil"])) {
        // Pode ser "admin" ou "usuario" (troque para testar)
        $_SESSION["perfil"] = "admin"; // ou "usuario"
    }

    // Escolhe qual layout exibir com base no perfil
    if ($_SESSION["perfil"] === "admin") {
        require("./mains/admin.main.php");
    } else {
        require("./mains/usuario.main.php");
    }
    ?>

</body>

</html>