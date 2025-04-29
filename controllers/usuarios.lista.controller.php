<?php
require_once __DIR__ . '/../models/Usuario.php';

$usuarios = Usuario::listarTodos();

// Se houver busca por nome
if (!empty($_GET['busca'])) {
    $busca = trim($_GET['busca']);
    $usuarios = Usuario::buscarPorNome($busca);
}

require_once __DIR__ . '/../views/usuarios.lista.view.php';
