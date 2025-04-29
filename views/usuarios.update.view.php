<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Usuário</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input, select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }
        button {
            background-color: #004aad;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #003080;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Alterar Usuário</h1>

    <form method="POST" action="painel-administrador.view.php?page=usuarios&crud=atualizar&id=<?php echo $_GET['id']; ?>">
        <input type="text" name="nome" placeholder="Nome" value="<!-- Nome atual aqui -->" required>
        <input type="email" name="email" placeholder="Email" value="<!-- Email atual aqui -->" required>
        <select name="tipo" required>
            <option value="admin" >Administrador</option>
            <option value="comum" >Comum</option>
        </select>
        <button type="submit">Atualizar</button>
    </form>
</div>

</body>
</html>
