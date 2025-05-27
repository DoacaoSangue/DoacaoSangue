<?php
namespace App\Controller;

use App\Model\UsuarioModel;
use App\Model\LocalModel;
use App\Model\DoacaoModel;

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
        $doacoes = \App\Model\DoacaoModel::buscarTodasDoacoes();

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
                        // Busca o local pelo id e passa para a view
                        $id = $_GET['id'] ?? null;
                        $local = null;
                        if ($id) {
                            $local = LocalModel::buscarLocalPorId($id);
                        }
                        $view = 'locais.update.view.php';
                        break;
                    case 'r':
                        $view = 'locais.lista.view.php';
                        break;
                    case 'd':
                        $id = $_GET['id'] ?? null;
                        if ($id) {
                            header('Location: /DoacaoSangue/excluirLocal?id=' . urlencode($id));
                            exit;
                        } else {
                            header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=r');
                            exit;
                        }
                        break;
                    default:
                        $view = 'locais.lista.view.php';
                    }
                break;
            case 'doacoes':
                switch ($crud) {
                    case 'c':
                        $doadores = \App\Model\UsuarioModel::listarDoadores();
                        $recebedores = \App\Model\UsuarioModel::listarRecebedores();
                        $locais = LocalModel::buscarTodosLocais();
                        $view = 'doacoes.store.view.php';
                        break;
                    case 'u':
                        $id = $_GET['id'] ?? null;
                        $doacao = null;
                        if ($id) {
                            $doacao = \App\Model\DoacaoModel::buscarDoacaoPorId($id);
                        }
                        $doadores = \App\Model\UsuarioModel::listarDoadores();
                        $recebedores = \App\Model\UsuarioModel::listarRecebedores();
                        $locais = \App\Model\LocalModel::buscarTodosLocais();
                        $view = 'doacoes.update.view.php';
                        break;
                    case 'r':
                        
                        $view = 'doacoes.lista.view.php';
                        break;
                    case 'd':
                        $id = $_GET['id'] ?? null;
                        if ($id) {
                            header('Location: /DoacaoSangue/excluirDoacao?id=' . urlencode($id));
                            exit;
                        } else {
                            header('Location: /DoacaoSangue/painel-administrador?page=doacoes&crud=r');
                            exit;
                        }
                        break;
                    default:
                        $view = 'doacoes.lista.view.php';
                }
                break;
            default:
                echo "<p>Página não encontrada.</p>";
        }

        require __DIR__ . '/../View/painel-administrador.view.php';
    }
}