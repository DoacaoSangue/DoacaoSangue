<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $usuario['nome'] ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $usuario['email'] ?>" required><br>

        <button type="submit">Salvar</button>
    </form>
    <a href="usuarios.lista.view.php">Cancelar</a>
</body>
</html>
