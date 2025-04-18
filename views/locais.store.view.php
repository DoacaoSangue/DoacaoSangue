<h2>Cadastrar local</h2>
<form action="index.php?acao=locais.lista" method="POST">
    <div class="container">
        <label for="nomeLocal">
            Nome do Local   
        </label>
        <input type="text" name="nomeLocal">
        <label for="bairro">
            Bairro
        </label>
        <input type="text" name="bairro">
        <label for="rua">
            Rua
        </label>
        <input type="text" name="rua">
        <label for="numero">
            Número
        </label>
        <input type="number" name="numero" step="1" min="1">
    </div>
    <button type="submit">Salvar</button>
</form>
<style>
    .container{
        margin-top: 5rem;
        display: flex;
        flex-direction: column;
        width: 60%;
    }
    .container>input{
        margin-bottom: 1rem;
    }
    button{
        margin-top: 1rem;
    }

</style>