<?php
session_start();
require_once 'conexao.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../views/usuarios.lista.view.php");
exit();
