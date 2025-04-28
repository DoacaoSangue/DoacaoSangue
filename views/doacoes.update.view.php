<!DOCTYPE html>
<html>
<head>
    <title>Editar Doação</title>
</head>
<style>
    body {
        background-color: #222;
        color: #fff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .navbar {
        background-color: #111;
        padding: 15px;
        display: flex;
        gap: 20px;
    }

    .navbar a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
    }

    .navbar a:hover {
        color: #f1c40f;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #333;
    }

    th, td {
        border: 1px solid #444;
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #111;
        color: #f1c40f;
    }

    tr:nth-child(even) {
        background-color: #2c2c2c;
    }

    .btn {
        padding: 8px 15px;
        margin: 2px;
        text-decoration: none;
        background-color: #f1c40f;
        color: #000;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #d4ac0d;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }
</style>

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
