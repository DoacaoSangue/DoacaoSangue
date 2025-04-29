<?php

require_once('../models/doacao.model.php');

$id = $_GET['id'] ?? '';  

if ($id !== '') {
    DoacaoModel::excluirDoacao($id);
    echo "<script>
        alert('Doação excluída com sucesso!');
        window.location.href = '../views/painel-administrador.view.php?page=doacoes&crud=';
      </script>";
      exit();
} else{
    echo "<script>alert('Erro ao excluir Doação!');
     window.location.href = '../views/painel-administrador.view.php?page=doacoes&crud=';</script>";
}