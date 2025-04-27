<?php

require_once('../models/doacao.model.php');

$id_usuario = $_SESSION["id_usuario"];
$doacoes = DoacaoModel::buscarDoacoesPorUsuario($id_usuario);

$_SESSION['doacoes'] = $doacoes;

header("Location: ../views/painel.view.php?page=doacoes");
exit;