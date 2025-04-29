<?php

require_once('../models/restricao.model.php');
require_once('../models/doacao.model.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idDoador = $_POST['id_doador'] ?? '';
    $idRecebedor = $_POST['id_recebedor'] ?? '';
    $idLocal = $_POST['id_local'] ?? '';
    $data = $_POST['data'] ?? '';

    session_start();

    if (empty($idDoador) || empty($idRecebedor) || empty($idLocal) || empty($data)) {
        $_SESSION['erro_cadastro'] = 'Todos os campos são obrigatórios.';
        echo "<script>alert('Todos os campos são obrigatórios.');
        window.location.href = '../views/painel-administrador.view.php?page=doacoes&crud=';</script>";
        exit;
    }

    $dataAtual = date('Y-m-d');
    if ($data <= $dataAtual) {
        $_SESSION['erro_cadastro'] = 'A data da doação deve ser maior que a data atual.';
        echo "<script>alert('A data da doação deve ser maior que a data atual.');
        window.location.href = '../views/painel-administrador.view.php?page=doacoes&crud=';</script>";
        exit;
    }

    require_once('../models/restricao.model.php'); 
    $restricao = RestricaoModel::verificarRestricao($idDoador, $idRecebedor);

    if ($restricao) {
        $_SESSION['erro_cadastro'] = 'Não é possível cadastrar a doação: existe uma restrição entre o doador e o recebedor.';
        echo "<script>alert('Não é possível cadastrar a doação: existe uma restrição entre o doador e o recebedor.');
        window.location.href = '../views/painel-administrador.view.php?page=doacoes&crud=';</script>";
        exit;
    }

    $resultado = DoacaoModel::cadastrarDoacao($idDoador, $idRecebedor, $idLocal, $data);

    if ($resultado === true) {
        $_SESSION['cadastro_sucesso'] = true;
        echo "<script>alert('Cadastro de doação efetuado com sucesso!');
        window.location.href = '../views/painel-administrador.view.php?page=doacoes&crud=';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar doação: $resultado');
        window.location.href = '../views/painel-administrador.view.php?page=doacoes&crud=';</script>";
    }
}
?>