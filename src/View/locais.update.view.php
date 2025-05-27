<h2>Alterar local</h2>
<form action="/DoacaoSangue/atualizarLocal" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($local['id_local']) ?>">
    
    <div class="container">
        <label for="nome">Nome do Local</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($local['nome']) ?>" required>
        
        <label for="bairro">Bairro</label>
        <input type="text" name="bairro" id="bairro" value="<?= htmlspecialchars($local['bairro']) ?>" required>
        
        <label for="rua">Rua</label>
        <input type="text" name="rua" id="rua" value="<?= htmlspecialchars($local['rua']) ?>" required>
        
        <label for="numero">Número</label>
        <input type="number" name="numero" step="1" min="1" id="numero" value="<?= htmlspecialchars($local['numero']) ?>" required>
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