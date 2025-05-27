<?php

namespace App\Controller;

class PainelAdministradorController
{
    public function handleRequest()
    {
        session_start();
        if (!isset($_SESSION['usuario_email']) || $_SESSION['tipo_usuario'] != 1) {
            header('Location: /DoacaoSangue/');
            exit;
        }

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
            case 'usuarios':
                switch ($crud) {
                    case 'c':
                        $view = 'usuarios.store.view.php';
                        break;
                    case 'u':
                        $view = 'usuarios.update.view.php';
                        break;
                    default:
                        $view = 'usuarios.lista.view.php';
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