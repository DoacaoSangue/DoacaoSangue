<!DOCTYPE html>
<html>
<head>
    <title>Editar Doação</title>
</head>
<body>
    <h1>Editar Doação</h1>
    <form method="POST">
        <label>Data:</label>
        <input type="date" name="data" value="<?= $doacao['data'] ?>" required><br>

        <label>Tipo Sanguíneo:</label>
        <input type="text" name="tipo_sangue" value="<?= $doacao['tipo_sangue'] ?>" required><br>

        <label>Local:</label>
        <input type="text" name="local" value="<?= $doacao['local'] ?>" required><br>

        <button type="submit">Salvar</button>
    </form>
    <a href="doacoes.lista.view.php">Cancelar</a>
</body>
</html>
