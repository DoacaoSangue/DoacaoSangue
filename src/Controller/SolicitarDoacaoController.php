<?php

namespace App\Controller;

use App\Model\UsuarioModel;

class SolicitarDoacaoController
{
    public static function atualizarStatus()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Método inválido.";
            return;
        }

        $idUsuario = $_SESSION['id_usuario'] ?? null;
        $acao = $_POST['acao'] ?? null;

        if (!$idUsuario || !$acao) {
            echo "Dados inválidos.";
            return;
        }

        if ($acao === 'doar') {
            UsuarioModel::atualizarStatusDoacao($idUsuario, 'doar');
        } elseif ($acao === 'receber') {
            UsuarioModel::atualizarStatusDoacao($idUsuario, 'receber');
        }

        self::verificarStatus();

        echo "<script>alert('Solicitação enviada com sucesso!');
            window.location.href = '/DoacaoSangue/painel?page=carregar-home';</script>";
        exit;
    }

    public static function verificarStatus()
    {
        $id_usuario = $_SESSION["id_usuario"] ?? null;
        if (!$id_usuario) {
            echo "Usuário não identificado.";
            exit;
        }

        $doacao = UsuarioModel::buscarStatusDoacao($id_usuario);
        $_SESSION['doacao'] = $doacao["doar"] || $doacao["receber"];

    }
}