<h2>Alterar Doação</h2>
<form action="/DoacaoSangue/atualizarDoacao" method="POST">
    <input type="hidden" name="id_doacao" value="<?= htmlspecialchars($doacao['id_doacao']) ?>">
    <div class="container">
        <label for="id_doador">Doador:</label>
        <select name="id_doador" id="id_doador" required>
            <?php foreach ($doadores as $doador): ?>
                <option value="<?= htmlspecialchars($doador['id_usuario']) ?>"
                    <?= ($doador['id_usuario'] == $doacao['id_doador'] ?? '') ? 'selected' : '' ?>>
                    <?= htmlspecialchars($doador['nome']) . " - " .  htmlspecialchars($doador['tipo_sanguineo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_recebedor">Recebedor:</label>
        <select name="id_recebedor" id="id_recebedor" required>
            <?php foreach ($recebedores as $recebedor): ?>
                <option value="<?= htmlspecialchars($recebedor['id_usuario']) ?>"
                    <?= ($recebedor['id_usuario'] == $doacao['id_recebedor'] ?? '') ? 'selected' : '' ?>>
                    <?= htmlspecialchars($recebedor['nome']) . " - " .  htmlspecialchars($recebedor['tipo_sanguineo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_local">Local:</label>
        <select name="id_local" id="id_local" required>
            <?php foreach ($locais as $local): ?>
                <option value="<?= htmlspecialchars($local['id_local'] ?? '') ?>"
                    <?= ($local['id_local'] == $doacao['id_local']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($local['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="data">Data da Doação:</label>
        <input type="date" name="data" id="data" value="<?= htmlspecialchars($doacao['data']) ?>" required>
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

    .container>input, .container>select {
        margin-bottom: 1rem;
    }

    button {
        margin-top: 1rem;
    }

    h2 {
        margin-bottom: 10px;
    }
</style>
