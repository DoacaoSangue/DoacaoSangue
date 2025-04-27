<h3>Locais</h3>

<form action="painel-administrador.view.php?page=locais&crud=r" method="GET">
    <input type="text" name="buscar" >
    <input type="submit" value="Buscar">
</form>

<form action="" method="GET">
    <input type="hidden" name="page" value="locais">
    <input type="hidden" name="crud" value="c">
    <input type="submit" value="Adicionar Local">
</form>

<?php
if (!empty($_SESSION["locais"])): 
    $buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

    if ($buscar) {
        $locaisFiltrados = array_filter($_SESSION["locais"], function ($local) use ($buscar) {
            return stripos($local["nome"], $buscar) !== false;
        });
    } else {
        $locaisFiltrados = $_SESSION["locais"];
    }
?>

<!-- Exibindo os locais filtrados -->
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
            <?php foreach ($locaisFiltrados as $index => $local): ?>
                <tr>
                    <td><?= htmlspecialchars($local["nome"]) ?></td>
                    <td><?= htmlspecialchars($local["bairro"]) ?></td>
                    <td><?= htmlspecialchars($local["rua"]) ?></td>
                    <td><?= htmlspecialchars($local["numero"]) ?></td>
                    <td>
                        <form action="" method="GET">
                            <input type="hidden" name="page" value="locais">
                            <input type="hidden" name="crud" value="u">
                            <input type="hidden" name="id" value="<?= $local['id_local'] ?>"> 
                            <input type="submit" value="Alterar">
                        </form>
                        <form action="" method="GET">
                            <input type="hidden" name="page" value="locais">
                            <input type="hidden" name="crud" value="d">
                            <input type="hidden" name="id" value="<?= $local['id_local'] ?>"> 
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