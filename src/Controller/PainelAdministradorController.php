<?php

namespace App\Controller;

use App\Controller\LocalController;
use App\Database\Connection;
use PDO;

class PainelAdministradorController
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

        if (!isset($_SESSION['usuario_email']) || $_SESSION['tipo_usuario'] != 1) {
            header('Location: /DoacaoSangue/');
            exit;
        }

        $locais = \App\Controller\LocalController::listar();

        $page = $_GET['page'] ?? 'locais';
        $crud = $_GET['crud'] ?? '';

        $view = '';

        switch ($page) {
            case 'locais':
                
                switch ($crud) {
                    
                    case 'c':
                        $view = 'locais.store.view.php';
                        break;
                    case 'u':
                        $view = 'locais.update.view.php';
                        break;
                    case 'r':
                        $view = 'locais.lista.view.php';
                        break;
                    default:
                        $view = 'locais.lista.view.php';
                }
                break;
            case 'doacoes':
                switch ($crud) {
                    case 'c':
                        $view = 'doacoes.store.view.php';
                        break;
                    case 'u':
                        $view = 'doacoes.update.view.php';
                        break;
                    case 'r':
                        $view = 'doacoes.lista.view.php';
                        break;
                    default:
                        $view = 'doacoes.lista.view.php';
                }
                break;
            default:
                $view = null;
        }

        require __DIR__ . '/../View/painel-administrador.view.php';
    }
}