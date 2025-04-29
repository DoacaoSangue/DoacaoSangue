<?php

require_once('../models/doacao.model.php');

$buscar_doacoes = $_GET['buscar_doacoes'] ?? '';

if (!empty($buscar_doacoes)) {
    $doacoes = DoacaoModel::buscarDoacaoPorDoador($buscar_doacoes);
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