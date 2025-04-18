<?php
    session_start();

    if(!isset($_SESSION["locais"])){
        $_SESSION["locais"] = [];
    }
    $_SESSION["locais"][] = [
        "nomeLocal" => $_POST["nomeLocal"],
        "bairro" => $_POST["bairro"],
        "rua" => $_POST["rua"],
        "numero" => $_POST["numero"],
    ];

    require("views/locais.lista.view.php");