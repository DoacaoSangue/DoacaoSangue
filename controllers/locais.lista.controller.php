<?php
session_start();

if (!isset($_SESSION["locais"])) {
    $_SESSION["locais"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST["nomeLocal"], $_POST["bairro"], $_POST["rua"], $_POST["numero"])
        && $_POST["nomeLocal"] !== "" && $_POST["bairro"] !== "" && $_POST["rua"] !== "" && $_POST["numero"] !== ""
    ) {
        $_SESSION["locais"][] = [
            "nomeLocal" => $_POST["nomeLocal"],
            "bairro" => $_POST["bairro"],
            "rua" => $_POST["rua"],
            "numero" => $_POST["numero"],
        ];
    } else {
        header("Location: index.php?acao=erro-campos");
        exit;
    }
}

require("views/locais.lista.view.php");