<h3>Minhas Doações</h3>

<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['erro']) || isset($_SESSION['erro_cadastro'])): ?>
    <div style="color: red; margin-bottom: 1rem;">
        <?= htmlspecialchars($_SESSION['erro'] ?? $_SESSION['erro_cadastro']) ?>
    </div>
    <?php unset($_SESSION['erro'], $_SESSION['erro_cadastro']); ?>
<?php endif; ?>

<?php if (isset($doacoes) && !empty($doacoes)): ?>
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
            <?php foreach ($doacoes as $doacao): ?>
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
