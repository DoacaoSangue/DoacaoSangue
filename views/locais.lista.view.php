<?php
    $nome = $_POST['nomeLocal'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

?>
<h3>
    Locais
</h3>
<form action="index.php" method="GET">
    <input type="hidden" name="acao" value="vendas">
    <input type="submit" value="Adicionar Local">
</form>
<table>
    
    <thead>
        <th>
            Nome do Local
        </th>
        <th>
            Bairro
        </th>
        <th>
            Rua
        </th>
        <th>
            Número
        </th>
        <th>
            Alterar/Excluir
        </th>
    </thead>
    <tbody>
        <?php
            foreach($_SESSION["locais"] as $local):
        ?>
      <tr>
        <td>
            <?= $local["nomeLocal"] ?>
        </td>
        <td>
            R$<?=$local["bairro"]?>
        </td>
        <td>
            R$<?=$local["rua"]?>
        </td>
        <td>
            R$<?=$local["numero"]?>
        </td>
      </tr>
        <?php
            endforeach;
        ?>
    </tbody>
</table>