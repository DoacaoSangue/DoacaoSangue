<h3>Minhas Doações</h3>

<?php if (isset($_SESSION["doacoes"]) && !empty($_SESSION["doacoes"])): ?>
    <table width="100%">
        <thead>
            <tr>
                <th>Doador</th>
                <th>Tipo Doador</th>
                <th>Recebedor</th>
                <th>Tipo Recebedor</th>
                <th>Data</th>
                <th>Local</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION["doacoes"] as $index => $doacao): ?>
                <tr>
                    <td><?= htmlspecialchars($doacao["nome_doador"]) ?></td>
                    <td><?= htmlspecialchars($doacao["tipo_sanguineo_doador"]) ?></td>
                    <td><?= htmlspecialchars($doacao["nome_recebedor"]) ?></td>
                    <td><?= htmlspecialchars($doacao["tipo_sanguineo_recebedor"]) ?></td>
                    <td><?= htmlspecialchars($doacao["data"]) ?></td>
                    <td><?= htmlspecialchars($doacao["nome_local"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhuma doação registrada.</p>
<?php endif; ?>
