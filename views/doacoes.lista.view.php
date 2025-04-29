<h3>Doações</h3>

<form action="" method="GET">
    <input type="hidden" name="page" value="doacoes">
    <input type="hidden" name="crud" value="">
    <input type="text" name="buscar_doacoes" >
    <input type="submit" value="Buscar">
</form>

<form action="" method="GET">
    <input type="hidden" name="page" value="doacoes">
    <input type="hidden" name="crud" value="c">
    <input type="submit" value="Adicionar Doação">
</form>

<?php
if (!empty($_SESSION["doacoes"])): 
    $buscar_doacoes = isset($_GET['buscar_doacoes']) ? trim($_GET['buscar_doacoes']) : '';

    if ($buscar_doacoes) {
        $doacoesFiltrados = array_filter($_SESSION["doacoes"], function ($doacoes) use ($buscar_doacoes) {
            return stripos($doacoes["nome_doador"], $buscar_doacoes) !== false;
        });
    } else {
        $doacoesFiltrados = $_SESSION["doacoes"];
    }
?>

<!-- Exibindo os doacoes filtrados -->
<?php if (!empty($doacoesFiltrados)): ?>
    <table width="70%">
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
            <?php foreach ($doacoesFiltrados as $index => $doacoes): ?>
                <tr>
                    <td><?= htmlspecialchars($doacoes["nome_doador"]) ?></td>
                    <td><?= htmlspecialchars($doacoes["tipo_sanguineo_doador"]) ?></td>
                    <td><?= htmlspecialchars($doacoes["nome_recebedor"]) ?></td>
                    <td><?= htmlspecialchars($doacoes["tipo_sanguineo_recebedor"]) ?></td>
                    <td><?= htmlspecialchars($doacoes["data"]) ?></td>
                    <td><?= htmlspecialchars($doacoes["nome_local"]) ?></td>
                    <td>
                        <form action="" method="GET">
                            <input type="hidden" name="page" value="doacoes">
                            <input type="hidden" name="crud" value="u">
                            <input type="hidden" name="id" value="<?= $doacoes['id_doacao'] ?>"> 
                            <input type="submit" value="Alterar">
                        </form>
                        <form action="" method="GET">
                            <input type="hidden" name="page" value="doacoes">
                            <input type="hidden" name="crud" value="d">
                            <input type="hidden" name="id" value="<?= $doacoes['id_doacao'] ?>"> 
                            <input type="submit" value="Excluir">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhuma doação encontrada para a busca.</p>
<?php endif; ?>
<?php endif; ?>