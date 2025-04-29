<?php

require_once('../models/doacao.model.php');

session_start();

$buscar = $_GET['buscar'] ?? '';

if (!empty($buscar)) {
    $doacoes = DoacaoModel::buscarDoacaoPorDoador($buscar);
} else {
    $doacoes = DoacaoModel::buscarTodasDoacoes();
}

if ($doacoes !== false) {
    $_SESSION['doacoes'] = $doacoes;
} else {
    $_SESSION['doacoes'] = []; 
}

header("Location: ../views/painel-administrador.view.php?page=doacoes&crud=r");
exit;