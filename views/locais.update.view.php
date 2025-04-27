<?php
require_once('../models/local.model.php');

$id = $_GET['id'] ?? '';  
$local = LocalModel::buscarLocalPorId($id); 
?>

<h2>Alterar local</h2>
<form action="http://localhost/DoacaoSangue/controllers/locais.update.controller.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
    
    <div class="container">
        <label for="nome">Nome do Local</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($local['nome']) ?>"> 
        
        <label for="bairro">Bairro</label>
        <input type="text" name="bairro" id="bairro" value="<?= htmlspecialchars($local['bairro']) ?>">
        
        <label for="rua">Rua</label>
        <input type="text" name="rua" id="rua" value="<?= htmlspecialchars($local['rua']) ?>"> 
        
        <label for="numero">Número</label>
        <input type="number" name="numero" step="1" min="1" id="numero" value="<?= htmlspecialchars($local['numero']) ?>"> 
    </div>
    
    <button type="submit">Salvar Alterações</button>
</form>

<style>
    .container {
        margin-top: 5rem;
        display: flex;
        flex-direction: column;
        width: 60%;
    }

    .container>input {
        margin-bottom: 1rem;
    }

    button {
        margin-top: 1rem;
    }

    h2 {
        margin-bottom: 10px;
    }
</style>