
<h3>Locais</h3>

<!-- Formulário de busca -->
<form action="/DoacaoSangue/painel-administrador" method="GET" style="margin-bottom: 1rem;">
    <input type="hidden" name="page" value="locais">
    <input type="hidden" name="crud" value="r">
    <input type="text" name="buscar" placeholder="Buscar local..." value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
    <input type="submit" value="Buscar">
</form>

<!-- Botão para adicionar novo local -->
<form action="/DoacaoSangue/painel-administrador" method="GET" style="margin-bottom: 2rem;">
    <input type="hidden" name="page" value="locais">
    <input type="hidden" name="crud" value="c">
    <input type="submit" value="Adicionar Local">
</form>

<?php
// $locais deve ser passado pelo controller
$buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

if ($buscar) {
    $locaisFiltrados = array_filter($locais, function ($local) use ($buscar) {
        return stripos($local["nome"], $buscar) !== false;
    });
} else {
    $locaisFiltrados = $locais;
}
?>

<?php if (!empty($locaisFiltrados)): ?>
    <table width="70%">
        <thead>
            <tr>
                <th>Nome do Local</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($locaisFiltrados as $local): ?>
                <tr>
                    <td><?= htmlspecialchars($local["nome"]) ?></td>
                    <td><?= htmlspecialchars($local["bairro"]) ?></td>
                    <td><?= htmlspecialchars($local["rua"]) ?></td>
                    <td><?= htmlspecialchars($local["numero"]) ?></td>
                    <td style="display: flex; gap: 0.5rem;">
                        <form action="/DoacaoSangue/painel-administrador" method="GET" style="display:inline;">
                            <input type="hidden" name="page" value="locais">
                            <input type="hidden" name="crud" value="u">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($local['id_local']) ?>">
                            <input type="submit" value="Alterar">
                        </form>
                        <form action="/DoacaoSangue/painel-administrador" method="GET" style="display:inline;">
                            <input type="hidden" name="page" value="locais">
                            <input type="hidden" name="crud" value="d">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($local['id_local']) ?>">
                            <input type="submit" value="Excluir" onclick="return confirm('Tem certeza que deseja excluir este local?');">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($buscar): ?>
    <p>Nenhum local encontrado para a busca.</p>
<?php else: ?>
    <p>Nenhum local cadastrado ainda.</p>
<?php endif; ?>