<?php

require_once('../models/local.model.php');

session_start();

$buscar = $_GET['buscar'] ?? '';

if (!empty($buscar)) {
    $locais = LocalModel::buscarLocalPorNome($buscar);
} else {
    $locais = LocalModel::buscarTodosLocais();
}

if ($locais !== false) {
    $_SESSION['locais'] = $locais;
} else {
    $_SESSION['locais'] = []; 
}

header("Location: ../views/painel-administrador.view.php?page=locais&crud=r");
exit;