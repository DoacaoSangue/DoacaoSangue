<?php

require_once('../models/local.model.php');

$id = $_GET['id'] ?? '';  

if ($id !== '') {
    LocalModel::excluirLocal($id);
    echo "<script>
        alert('Local excluído com sucesso!');
        window.location.href = '../views/painel-administrador.view.php?page=locais&crud=';
      </script>";
      exit();
} else{
    echo "<script>alert('Erro ao excluir local!');
     window.location.href = '../views/painel-administrador.view.php?page=locais&crud=';</script>";
}
