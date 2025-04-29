<?php
require_once __DIR__ . '/../models/Usuario.php';

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (!$nome) $erros[] = 'Nome é obrigatório.';
    if (!$email) $erros[] = 'Email é obrigatório.';
    if (!$senha) $erros[] = 'Senha é obrigatória.';

    if (empty($erros)) {
        Usuario::criar($nome, $email, $senha);
        header('Location: painel-administrador.view.php?page=usuarios');
        exit;
    }
}

require_once __DIR__ . '/../views/usuarios.store.view.php';
