<?php

namespace App\Controller;

class PainelUsuarioController
{
    public function handleRequest()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

       if (isset($_GET['acao']) && $_GET['acao'] === 'sair') {
            session_start();
            $_SESSION = [];
            session_destroy();
            header('Location: /DoacaoSangue/');
            exit;
        }

        if (!isset($_SESSION['usuario_email']) || $_SESSION['tipo_usuario'] != 0) {
            header('Location: /DoacaoSangue/');
            exit;
        }

        \App\Controller\SolicitarDoacaoController::verificarStatus();

        $page = $_GET['page'] ?? 'carregar-home';
        $view = null;

        switch ($page) {
            case 'carregar-home':
                $view = 'doar.view.php';
                break;
            case 'carregar-doacoes':
                $view = 'minhas-doacoes.view.php';
                break;
            default:
                $view = null;
        }

        require __DIR__ . '/../View/painel.view.php';
    }
}