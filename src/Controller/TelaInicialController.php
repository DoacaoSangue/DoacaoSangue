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

        $usuarioEmail = UsuarioModel::validarLogin($email, $senha);

        if ($usuarioEmail) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $conn = UsuarioModel::conectar();
            $stmt = $conn->prepare("SELECT id_usuario, tipo_usuario FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $stmt->bind_result($idUsuario, $tipoUsuario);
            $stmt->fetch();
            $stmt->close();
            $conn->close();

            $_SESSION['usuario_email'] = $email;
            $_SESSION['tipo_usuario'] = $tipoUsuario;
            $_SESSION['id_usuario'] = $idUsuario;

            if ($tipoUsuario == 1) {
                header('Location: /painel-administrador');
            } else {
                header('Location: /painel');
            }
            exit;
        }

        $_SESSION['erro_login'] = true;
        header('Location: /');
        exit;
    }

    private function cadastrar()
    {
        header('Location: /cadastro');
        exit;
    }
}
