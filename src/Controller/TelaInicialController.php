<?php

namespace App\Controller;

use App\Model\UsuarioModel;

class TelaInicialController
{
    public function handleRequest($acao = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Logout
        if (isset($_GET['acao']) && $_GET['acao'] === 'sair') {
            session_destroy();
            header('Location: /');
            exit();
        }

        // Cadastro via rota
        if ($acao === 'cadastro' || ($_GET['page'] ?? null) === 'cadastro') {
            require_once(__DIR__ . '/../View/tela-cadastro.view.php');
            return;
        }

        // Login via rota
        if ($acao === 'login' || ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'acessar')) {
            $this->acessar();
            return;
        }

        // Cadastro via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'cadastrar') {
            $this->cadastrar();
            return;
        }

        // Página inicial
        require_once(__DIR__ . '/../View/tela-inicial.view.php');
    }

    private function acessar()
{
    $email = $_POST['email'] ?? '';
    $senha = $_POST['pass'] ?? '';

    $usuarioEmail = \App\Model\UsuarioModel::validarLogin($email, $senha);

    if ($usuarioEmail) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Buscar id_usuario e tipo_usuario usando PDO
        $conn = \App\Database\Connection::getInstance();
        $stmt = $conn->prepare("SELECT id_usuario, tipo_usuario FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        $_SESSION['usuario_email'] = $email;
        $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
        $_SESSION['id_usuario'] = $usuario['id_usuario'];

        if ($usuario['tipo_usuario'] == 1) {
            header('Location: /DoacaoSangue/painel-administrador');
        } else {
            header('Location: /DoacaoSangue/painel');
        }
        exit;
    }

    $_SESSION['erro_login'] = 'E-mail ou senha inválidos!';
    require_once(__DIR__ . '/../View/tela-inicial.view.php');
    exit;
}

    private function cadastrar()
    {
        header('Location: /cadastro');
        exit;
    }
}
