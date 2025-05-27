
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        header {
            background-color: #2c3e50 !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: fixed;
            top: 0; left: 0; width: 100%; z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        header ul {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        header li a {
            color: #fff !important;
            font-weight: bold;
            font-size: 1.1rem;
            text-decoration: none;
            transition: color 0.3s;
        }
        header li a:hover {
            color: #1abc9c !important;
        }
        .sair {
            margin-left: auto;
        }
        main {
            margin: 7rem auto 2rem auto;
            width: 80%;
            min-height: 60vh;
        }
        body {
            margin: 0;
            padding: 0;
            background: #f8f9fa;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <ul>
            <li><a href="/DoacaoSangue/painel-administrador?page=locais">Locais</a></li>
            <li><a href="/DoacaoSangue/painel-administrador?page=doacoes">Doações</a></li>
        </ul>
        <ul class="sair">
            <li><a href="/DoacaoSangue/painel-administrador?acao=sair">Sair</a></li>
        </ul>
    </header>
    <main>
        <?php
        if (isset($view) && $view && file_exists(__DIR__ . '/' . $view)) {
            require __DIR__ . '/' . $view;
        } else {
            echo "<p>Página não encontrada.</p>";
        }
        ?>
    </main>
</body>
</html>
