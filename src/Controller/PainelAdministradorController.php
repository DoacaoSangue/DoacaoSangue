<?php
namespace App\Controller;

use App\Model\LocalModel;

class PainelAdministradorController
{
    public function handleRequest()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_GET['acao']) && $_GET['acao'] === 'sair') {
            $_SESSION = [];
            session_destroy();
            header('Location: /DoacaoSangue/');
            exit;
        }

        if (!isset($_SESSION['usuario_email']) || $_SESSION['tipo_usuario'] != 1) {
            header('Location: /DoacaoSangue/');
            exit;
        }

        $locais = LocalModel::buscarTodosLocais();

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
            // ...restante do código...
        }

        require __DIR__ . '/../View/painel-administrador.view.php';
    }
}