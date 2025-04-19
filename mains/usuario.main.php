<header>
    <ul>
        <li><a href="index.php?acao=">Página Inicial</a></li>
        <li><a href="index.php?acao=">Minhas Doações</a></li>
    </ul>
    <ul class="Sair">
        <li><a href="">Sair</a></li>
    </ul>
</header>
<?php
$acao = $_GET['acao'] ?? 'index';

if ($acao == 'erro-campos') {
    echo 'Preencha todos os campos!';
} else {
    require("./controllers/$acao.controller.php");
}

?>