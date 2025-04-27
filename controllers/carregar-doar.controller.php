<?php

require_once('../models/usuario.model.php');

$id_usuario = $_SESSION["id_usuario"];
$doacao = UsuarioModel::buscarStatusDoacao($id_usuario);

$_SESSION['doacao'] = $doacao["doar"] || $doacao["receber"];

header("Location: ../views/painel.view.php?page=home");
exit;