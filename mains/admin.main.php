<header>
        <ul>
            <li><a href="index.php?acao=locais.lista">Locais</a></li>
            <li><a href="index.php?acao=usuarios.lista">Usuários</a></li>
            <li><a href="index.php?acao=doacoes.lista">Doações</a></li>
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