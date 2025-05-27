<h3>Doações</h3>

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

<?php if (isset($_SESSION['erro']) || isset($_SESSION['erro_cadastro'])): ?>
    <div style="color: red; margin-bottom: 1rem;">
        <?= htmlspecialchars($_SESSION['erro'] ?? $_SESSION['erro_cadastro']) ?>
    </div>
    <?php unset($_SESSION['erro'], $_SESSION['erro_cadastro']); ?>
<?php endif; ?>

<form action="/DoacaoSangue/painel-administrador" method="GET" style="margin-bottom: 1rem;">
    <input type="hidden" name="page" value="doacoes">
    <input type="hidden" name="crud" value="r">
    <input type="text" name="buscar_doacoes" placeholder="Buscar doador..." value="<?= isset($_GET['buscar_doacoes']) ? htmlspecialchars($_GET['buscar_doacoes']) : '' ?>">
    <input type="submit" value="Buscar">
</form>

<form action="/DoacaoSangue/painel-administrador" method="GET" style="margin-bottom: 2rem;">
    <input type="hidden" name="page" value="doacoes">
    <input type="hidden" name="crud" value="c">
    <input type="submit" value="Adicionar Doação">
</form>

<?php
// $doacoes deve ser passado pelo controller
$buscar_doacoes = isset($_GET['buscar_doacoes']) ? trim($_GET['buscar_doacoes']) : '';

if (!empty($doacoes)) {
    if ($buscar_doacoes) {
        $doacoesFiltradas = array_filter($doacoes, function ($doacao) use ($buscar_doacoes) {
            return stripos($doacao["nome_doador"], $buscar_doacoes) !== false;
        });
    } else {
        $doacoesFiltradas = $doacoes;
    }
?>

<?php if (!empty($doacoesFiltradas)): ?>
    <table width="70%">
        <thead>
            <tr>
                <th>Doador</th>
                <th>Tipo Doador</th>
                <th>Recebedor</th>
                <th>Tipo Recebedor</th>
                <th>Data</th>
                <th>Local</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($doacoesFiltradas as $doacao): ?>
                <tr>
                    <td><?= htmlspecialchars($doacao["nome_doador"]) ?></td>
                    <td><?= htmlspecialchars($doacao["tipo_sanguineo_doador"]) ?></td>
                    <td><?= htmlspecialchars($doacao["nome_recebedor"]) ?></td>
                    <td><?= htmlspecialchars($doacao["tipo_sanguineo_recebedor"]) ?></td>
                    <td><?= htmlspecialchars($doacao["data"]) ?></td>
                    <td><?= htmlspecialchars($doacao["nome_local"]) ?></td>
                    <td style="display: flex; gap: 0.5rem;">
                        <form action="/DoacaoSangue/painel-administrador" method="GET" style="display:inline;">
                            <input type="hidden" name="page" value="doacoes">
                            <input type="hidden" name="crud" value="u">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($doacao['id_doacao']) ?>">
                            <input type="submit" value="Alterar">
                        </form>
                        <form action="/DoacaoSangue/painel-administrador" method="GET" style="display:inline;">
                            <input type="hidden" name="page" value="doacoes">
                            <input type="hidden" name="crud" value="d">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($doacao['id_doacao']) ?>">
                            <input type="submit" value="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta doação?');">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhuma doação encontrada para a busca.</p>
<?php endif; ?>
<?php } else { ?>
    <p>Nenhuma doação cadastrada ainda.</p>
<?php } ?>