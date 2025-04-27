<?php

session_start();
require_once('../models/usuario.model.php');

// Garante que veio pelo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idUsuario = $_SESSION['id_usuario']; 
    $acao = $_POST['acao']; 

    if ($acao === 'doar') {
        UsuarioModel::atualizarStatusDoacao($idUsuario, 'doar');
    } elseif ($acao === 'receber') {
        UsuarioModel::atualizarStatusDoacao($idUsuario, 'receber');
    }

    echo "<script>alert('Solicitação enviada com sucesso!');
        window.location.href = '../views/painel.view.php?page=carregar-home';</script>";
} else {
    echo "Método inválido.";
}
