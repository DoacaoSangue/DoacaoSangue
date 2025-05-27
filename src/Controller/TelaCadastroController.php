<?php

namespace App\Controller;

use App\Model\Usuario;
use App\Database\Connection;
use PDO;

class UsuarioController
{
    public function listar()
    {
        $busca = $_GET['busca'] ?? '';
        $usuarios = $busca
            ? Usuario::buscarPorNome(trim($busca))
            : Usuario::listarTodos();

        require_once __DIR__ . '/../View/usuarios.lista.view.php';
    }

    public function criar()
    {
        $erros = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = trim($_POST['senha']);

            if (!$nome) $erros[] = 'Nome é obrigatório.';
            if (!$email) $erros[] = 'Email é obrigatório.';
            if (!$senha) $erros[] = 'Senha é obrigatória.';

            if (empty($erros)) {
                Usuario::criar($nome, $email, $senha);
                header('Location: /usuarios');
                exit;
            }
        }

        require_once __DIR__ . '/../View/usuarios.store.view.php';
    }

    public function editar($id)
    {
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = $_POST['nome'];
            $email = $_POST['email'];

            $update = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            $update->execute([$nome, $email, $id]);

            header("Location: /usuarios");
            exit();
        }

        require_once __DIR__ . '/../View/usuarios.update.view.php';
    }

    public function excluir($id)
    {
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: /usuarios");
        exit();
    }
}
