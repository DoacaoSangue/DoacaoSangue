<td>
    <a href="../controllers/usuarios.update.controller.php?id=<?= $usuario['id'] ?>">Editar</a> |
    <a href="../controllers/usuarios.delete.controller.php?id=<?= $usuario['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
</td>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
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
        .actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .actions input[type="text"] {
            width: 200px;
            padding: 8px;
        }
        .actions button {
            background-color: #004aad;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #003080;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #cccccc;
        }
        th, td {
            text-align: center;
            padding: 10px;
        }
        th {
            background-color: #004aad;
            color: white;
        }
        td button {
            margin: 2px;
            background-color: #004aad;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        td button:hover {
            background-color: #003080;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Usuários</h1>

    <div class="actions">
        <form method="GET" action="">
            <input type="text" name="busca" placeholder="Buscar usuário">
            <button type="submit">Buscar</button>
        </form>

        <a href="painel-administrador.view.php?page=usuarios&crud=cadastrar">
            <button>Adicionar Usuário</button>
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aqui você faz o foreach dos usuários cadastrados -->
            <tr>
                <td>João Silva</td>
                <td>joao@email.com</td>
                <td>Administrador</td>
                <td>
                    <a href="painel-administrador.view.php?page=usuarios&crud=alterar&id=1">
                        <button>Alterar</button>
                    </a>
                    <a href="painel-administrador.view.php?page=usuarios&crud=excluir&id=1">
                        <button>Excluir</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Maria Souza</td>
                <td>maria@email.com</td>
                <td>Comum</td>
                <td>
                    <a href="painel-administrador.view.php?page=usuarios&crud=alterar&id=2">
                        <button>Alterar</button>
                    </a>
                    <a href="painel-administrador.view.php?page=usuarios&crud=excluir&id=2">
                        <button>Excluir</button>
                    </a>
                </td>
            </tr>
           
        </tbody>
    </table>
</div>

</body>
</html>
