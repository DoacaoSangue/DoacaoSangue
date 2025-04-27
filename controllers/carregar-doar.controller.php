<?php

require_once('../models/doacao.model.php');

$id_usuario = $_SESSION["id_usuario"];
$doacao = DoacaoModel::temDoacaoFutura($id_usuario);

if ($doacao !== false) {
    $_SESSION['doacao'] = $doacao;
} else {
    $_SESSION['doacao'] = '';
}

header("Location: ../views/painel.view.php?page=home");
exit;