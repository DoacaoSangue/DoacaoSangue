<?php
session_start();
require_once 'conexao.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM doacoes WHERE id = ?");
$stmt->execute([$id]);
$doacao = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = $_POST['data'];
    $tipo_sangue = $_POST['tipo_sangue'];
    $local = $_POST['local'];

    $update = $conn->prepare("UPDATE doacoes SET data = ?, tipo_sangue = ?, local = ? WHERE id = ?");
    $update->execute([$data, $tipo_sangue, $local, $id]);

    header("Location: ../views/doacoes.lista.view.php");
    exit();
}

require_once '../views/doacoes.update.view.php';
