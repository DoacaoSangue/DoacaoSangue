<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    public static function listar() {
        $usuarios = !empty($_GET['busca']) 
            ? Usuario::buscarPorNome(trim($_GET['busca']))
            : Usuario::listarTodos();

        require_once __DIR__ . '/../views/usuarios.lista.view.php';
    }

    public static function criar() {
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
                header('Location: painel-administrador.view.php?page=usuarios');
                exit;
            }
        }

        require_once __DIR__ . '/../views/usuarios.store.view.php';
    }

    public static function editar($id) {
        require_once __DIR__ . '/../db/conexao.php';
        $conn = getConexao(); // Ajuste se necessário

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = $_POST['nome'];
            $email = $_POST['email'];

            $update = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            $update->execute([$nome, $email, $id]);

            header("Location: ../views/usuarios.lista.view.php");
            exit();
        }

        require_once '../views/usuarios.update.view.php';
    }

    public static function excluir($id) {
        require_once __DIR__ . '/../db/conexao.php';
        $conn = getConexao(); // Ajuste se necessário

        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: ../views/usuarios.lista.view.php");
        exit();
    }
}
