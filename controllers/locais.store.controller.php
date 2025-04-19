<?php
session_start();

if (!isset($_SESSION["locais"])) {
    $_SESSION["locais"] = [];
}

if (!isset($_SESSION["ultimo_id_local"])) {
    $_SESSION["ultimo_id_local"] = 0;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty($_POST["nomeLocal"]) || empty($_POST["bairro"]) || empty($_POST["rua"]) || empty($_POST["numero"])) {
        header("Location: index.php?acao=erro-campos");
        exit;
    }

    $_SESSION["ultimo_id_local"]++;

    $_SESSION["locais"][] = [
        "id" => $_SESSION["ultimo_id_local"],
        "nomeLocal" => $_POST["nomeLocal"],
        "bairro" => $_POST["bairro"],
        "rua" => $_POST["rua"],
        "numero" => $_POST["numero"],
    ];

    header("Location: index.php?acao=locais.lista");
    exit;
}