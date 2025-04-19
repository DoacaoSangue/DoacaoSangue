<h3>Locais</h3>

<form action="index.php" method="GET">
    <input type="text" name="buscar" placeholder="Buscar Local">
    <input type="hidden" name="acao" value="locais.lista">
    <input type="submit" value="Buscar">
</form>

<form action="index.php" method="GET">
    <input type="hidden" name="acao" value="locais.store.view">
    <input type="submit" value="Adicionar Local">
</form>

<?php if (!empty($_SESSION["locais"])): ?>
    <?php

    $buscar = $_GET['buscar'] ?? '';

    $locaisFiltrados = array_filter($_SESSION["locais"], function ($local) use ($buscar) {
        return stripos($local["nomeLocal"], $buscar) !== false;
    });
    ?>
    <?php if (!empty($locaisFiltrados)): ?>
        <table>
            <thead>
                <tr>
                    <th>Nome do Local</th>
                    <th>Bairro</th>
                    <th>Rua</th>
                    <th>Número</th>
                    <th>Alterar/Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($locaisFiltrados as $local): ?>
                    <tr>
                        <td><?= htmlspecialchars($local["nomeLocal"]) ?></td>
                        <td><?= htmlspecialchars($local["bairro"]) ?></td>
                        <td><?= htmlspecialchars($local["rua"]) ?></td>
                        <td><?= htmlspecialchars($local["numero"]) ?></td>
                        <td>
                            <form action="index.php" method="GET">
                                <input type="hidden" name="acao" value="locais.editar">
                                <input type="hidden" name="id" value="<?= $index ?>">
                                <input type="submit" value="Alterar">
                            </form>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="acao" value="locais.excluir">
                                <input type="hidden" name="id" value="<?= $index ?>">
                                <input type="submit" value="Excluir">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum local encontrado para a busca.</p>
    <?php endif; ?>
<?php else: ?>
    <p>Nenhum local cadastrado ainda.</p>
<?php endif; ?>