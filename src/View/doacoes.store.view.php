<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../controllers/campos-doacao.controller.php';

$controller = new CamposDoacaoController();
$doadores = $controller->listarDoadores();
$recebedores = $controller->listarRecebedores();
$locais = $controller->listarLocais();
?>
<h2>Cadastrar Doação</h2>
<form action="../controllers/doacoes.store.controller.php" method="POST">
    <div class="container">
        <label for="id_doador">Doador:</label>
        <select name="id_doador" id="id_doador">
            <?php foreach ($doadores as $doador): ?>
                <option value="<?= htmlspecialchars($doador['id_usuario']) ?>">
                    <?= htmlspecialchars($doador['nome']) . "      " .  htmlspecialchars($doador['tipo_sanguineo']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="id_recebedor">Recebedor:</label>
        <select name="id_recebedor" id="id_recebedor">
            <?php foreach ($recebedores as $recebedor): ?>
                <option value="<?= htmlspecialchars($recebedor['id_usuario']) ?>">
                    <?= htmlspecialchars($recebedor['nome']) . "      " .  htmlspecialchars($recebedor['tipo_sanguineo']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="id_local">Local:</label>
        <select name="id_local" id="id_local">
            <?php foreach ($locais as $local): ?>
                <option value="<?= htmlspecialchars($local['id_local']) ?>">
                    <?= htmlspecialchars($local['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="data">
            Data da Doação
        </label>
        <input type="date" name="data" id="data">
    </div>
    <button type="submit">Salvar</button>
</form>
<style>
    .container {
        margin-top: 5rem;
        display: flex;
        flex-direction: column;
        width: 60%;
    }

    .container>input {
        margin-bottom: 1rem;
    }

    button {
        margin-top: 1rem;
    }

    h2 {
        margin-bottom: 10px;
    }
</style>
