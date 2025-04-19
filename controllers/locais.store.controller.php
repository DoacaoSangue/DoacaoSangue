<?php
session_start();

if (!isset($_SESSION["locais"])) {
    $_SESSION["locais"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validação
    if (empty($_POST["nomeLocal"]) || empty($_POST["bairro"]) || empty($_POST["rua"]) || empty($_POST["numero"])) {
        header("Location: index.php?acao=erro-campos");
        exit;
    }

    $_SESSION["locais"][] = [
        "nomeLocal" => $_POST["nomeLocal"],
        "bairro" => $_POST["bairro"],
        "rua" => $_POST["rua"],
        "numero" => $_POST["numero"],
    ];

    header("Location: index.php?acao=locais.lista");
    exit;
}