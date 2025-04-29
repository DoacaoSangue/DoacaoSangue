<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../controllers/campos-doacao.controller.php';
require_once '../models/doacao.model.php';

$controller = new CamposDoacaoController();
$doadores = $controller->listarDoadores();
$recebedores = $controller->listarRecebedores();
$locais = $controller->listarLocais();
$id = $_GET['id'] ?? '';  
$doacao = DoacaoModel::buscarDoacaoPorId($id); 
?>
<h2>Alterar Doação</h2>
<form action="../controllers/doacoes.update.controller.php" method="POST">
    <input type="hidden" name="id_doacao" value="<?= htmlspecialchars($doacao['id_doacao']) ?>">
    
    <div class="container">
        <label for="id_doador">Doador:</label>
        <select name="id_doador" id="id_doador">
            <?php foreach ($doadores as $doador): ?>
                <option value="<?= htmlspecialchars($doador['id_usuario']) ?>"
                    <?= ($doador['nome'] === $doacao['nome_doador']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($doador['nome']) . "      " .  htmlspecialchars($doador['tipo_sanguineo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_recebedor">Recebedor:</label>
        <select name="id_recebedor" id="id_recebedor">
            <?php foreach ($recebedores as $recebedor): ?>
                <option value="<?= htmlspecialchars($recebedor['id_usuario']) ?>"
                    <?= ($recebedor['nome'] === $doacao['nome_recebedor']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($recebedor['nome']) . "      " .  htmlspecialchars($recebedor['tipo_sanguineo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_local">Local:</label>
        <select name="id_local" id="id_local">
            <?php foreach ($locais as $local): ?>
                <option value="<?= htmlspecialchars($local['id_local']) ?>"
                    <?= ($local['nome'] === $doacao['nome_local']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($local['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="data">Data da Doação:</label>
        <input type="date" name="data" id="data" value="<?= htmlspecialchars($doacao['data']) ?>">
    </div>
    <button type="submit">Salvar Alterações</button>
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
