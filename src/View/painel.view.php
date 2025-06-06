<?php
// Recebe $view do controller
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
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

        main {
            margin-top: 100px;
            padding: 2rem;
            width: 100%!important;
        }
    </style>
</head>

<body style="padding: 0">
    <header>
        <ul>
            <li><a href="/DoacaoSangue/painel?page=carregar-home">Página Inicial</a></li>
            <li><a href="/DoacaoSangue/painel?page=carregar-doacoes">Minhas Doações</a></li>
        </ul>
        <ul class="sair">
            <li><a href="/DoacaoSangue/painel?acao=sair">Sair</a></li>
        </ul>
    </header>
    <main>
        <?php
        if ($view && file_exists(__DIR__ . '/' . $view)) {
            require __DIR__ . '/' . $view;
        } else {
            echo "<p>Página não encontrada.</p>";
        }
        ?>
    </main>
</body>
</html>