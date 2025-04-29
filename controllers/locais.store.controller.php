<?php

require_once('../models/local.model.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $rua = $_POST['rua'] ?? '';
    $numero = $_POST['numero'] ?? '';

    // Verificação: nenhum campo pode estar vazio
    if (empty($nome) || empty($bairro) || empty($rua) || empty($numero)) {
        echo "<script>
                alert('Todos os campos são obrigatórios.');
                window.location.href = '../views/painel-administrador.view.php?page=locais&crud=';
              </script>";
        exit;
    }

    $resultado = LocalModel::cadastrarLocal($nome, $bairro, $rua, $numero);

    if ($resultado === true) {
        session_start();
        $_SESSION['cadastro_sucesso'] = true;
        echo "<script>
                alert('Cadastro de local efetuado com sucesso!');
                window.location.href = '../views/painel-administrador.view.php?page=locais&crud=';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao cadastrar local: $resultado');
                window.location.href = '../views/painel-administrador.view.php?page=locais&crud=';
              </script>";
    }
}
?>