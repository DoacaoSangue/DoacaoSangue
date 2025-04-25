<?php
session_start();
require_once 'conexao.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $update = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
    $update->execute([$nome, $email, $id]);

    header("Location: ../views/usuarios.lista.view.php");
    exit();
}

require_once '../views/usuarios.update.view.php';
