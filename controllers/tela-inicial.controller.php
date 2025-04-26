<?php

require_once('models/usuario.model.php');

class TelaInicialController
{
    public function handleRequest()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $page = $_GET['page'] ?? null;
        if ($page === 'cadastro') {
            require_once(__DIR__ . '/../views/tela-cadastro.view.php');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $acao = $_POST['acao'] ?? '';

            switch ($acao) {

                case 'cadastrar':
                    $this->cadastrar();
                    break;

                default:
                    break;
            }
        } else {
            require_once(__DIR__ . '/../views/tela-inicial.view.php');
        }
    }

    private function cadastrar()
    {
        require_once(__DIR__ . '/../views/tela-cadastro.view.php');
    }
}
