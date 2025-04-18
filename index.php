<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
<?php 
        $acao = $_GET['acao'] ?? 'index';

        if($acao == 'erro-campos') {
            echo 'Preencha todos os campos!';
        }else{
            require("./controllers/$acao.controller.php");
        }
        
    ?>
</body>
</html>