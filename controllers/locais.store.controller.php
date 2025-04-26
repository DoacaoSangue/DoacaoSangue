<?php

require_once('../models/locais.model.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $rua = $_POST['rua'] ?? '';
    $numero = $_POST['numero'] ?? '';

    $resultado = UsuarioModel::cadastrarUsuario($nome, $email, $senha, $telefone, $endereco, $tipo, $alergias);

    if ($resultado === true) {
        session_start();
        $_SESSION['cadastro_sucesso'] = true;
        echo "<script>alert('Cadastro efetuado com sucesso!'); window.history.back();</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar: $resultado'); window.history.back();</script>";
        exit;
    }
}