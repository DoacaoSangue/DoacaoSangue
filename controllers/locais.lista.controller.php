<?php

require_once('../models/local.model.php');

session_start();

// Verifica se foi passada uma busca
$buscar = $_GET['buscar'] ?? '';

// Se houver um valor na busca, filtra os locais
if (!empty($buscar)) {
    // Filtra os locais com base no nome
    $locais = LocalModel::buscarLocalPorNome($buscar); // Implementar um método específico de busca por nome no seu model
} else {
    // Caso contrário, busca todos os locais
    $locais = LocalModel::buscarTodosLocais();
}

// Armazena os locais na variável de sessão
if ($locais !== false) {
    $_SESSION['locais'] = $locais;
} else {
    $_SESSION['locais'] = [];  // Se não encontrar locais, armazena um array vazio
}

// Redireciona de volta para a view de locais
header("Location: ../views/painel-administrador.view.php?page=locais&crud=r");
exit;