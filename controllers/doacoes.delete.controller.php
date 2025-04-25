<?php
session_start();
require_once 'conexao.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM doacoes WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../views/doacoes.lista.view.php");
exit();
