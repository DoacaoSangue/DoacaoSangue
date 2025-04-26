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
    // Captura o valor de busca e remove espaços em branco
    $buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

    // Se o valor de 'buscar' não for vazio, aplica o filtro
    if ($buscar) {
        // Filtra os locais com base no nome, utilizando stripos para busca sem diferenciar maiúsculas e minúsculas
        $locaisFiltrados = array_filter($_SESSION["locais"], function ($local) use ($buscar) {
            return stripos($local["nome"], $buscar) !== false;
        });
    } else {
        // Caso não haja busca, exibe todos os locais
        $locaisFiltrados = $_SESSION["locais"];
    }
?>

<!-- Exibindo os locais filtrados -->
<?php if (!empty($locaisFiltrados)): ?>
    <h1><?php echo "Valor de busca: " . htmlspecialchars($buscar); ?></h1>
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