
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>
<body>

<div class="form-card">
    <h2>Login</h2>
    <?php
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_SESSION['cadastro_sucesso'])): ?>
            <div style="color: green; margin-bottom: 1rem;">
                <?= htmlspecialchars($_SESSION['cadastro_sucesso']) ?>
            </div>
            <?php unset($_SESSION['cadastro_sucesso']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['erro_login'])): ?>
            <div style="color: red;">
                <?= htmlspecialchars($_SESSION['erro_login']) ?>
            </div>
            <?php unset($_SESSION['erro_login']); ?>
        <?php endif; ?>
    <form method="POST" action="/DoacaoSangue/login">
        <label>Usuário (Email)</label>
        <input type="text" name="email" id="user">

        <label>Senha</label>
        <input type="password" name="pass" id="pass">

        <div class="form-buttons">
            <button type="submit" name="acao" value="acessar" onclick="setRequired()">Acessar</button>
        </div>

        <div class="form-cadastrar">
            <button type="button" onclick="window.location.href='/DoacaoSangue/cadastro'">Cadastrar</button>
        </div>
    </form>
</div>

<?php

if (isset($_SESSION['erro_login']) && $_SESSION['erro_login']) {
    echo "<script>
        alert('Usuário ou senha incorretos.');
        setTimeout(function(){
            window.location.href = '/DoacaoSangue/';
        }, 100);
    </script>";
    unset($_SESSION['erro_login']);
}
?>

<script>
    function setRequired() {
        document.getElementById('user').setAttribute('required', 'required');
        document.getElementById('pass').setAttribute('required', 'required');
    }

    function clearRequired() {
        document.getElementById('user').removeAttribute('required');
        document.getElementById('pass').removeAttribute('required');
    }
</script>

</body>
</html>
