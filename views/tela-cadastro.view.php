<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Novo Usuário</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const telefoneInput = document.getElementById('telefone');
            telefoneInput.addEventListener('input', function (e) {
                let valor = e.target.value.replace(/\D/g, '');
                if (valor.length <= 2) {
                    valor = valor.replace(/(\d{2})/, '($1) ');
                } else if (valor.length <= 7) {
                    valor = valor.replace(/(\d{2})(\d{5})/, '($1) $2-');
                } else {
                    valor = valor.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                }
                e.target.value = valor;
                if (e.target.value.length > 15) {
                    e.target.value = e.target.value.substring(0, 15);
                }
            });
        });
    </script>
</head>
<body>

<div class="form-card">
    <h2>Cadastro de Novo Usuário</h2>

    <form action="http://localhost/DoacaoSangue/controllers/tela-cadastro.controller.php" method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">Email (será seu login):</label>
        <input type="text" name="email" id="email" required>

        <label for="senha">Senha:</label>
        <input type="password" name="pass" id="senha" required>

        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" name="confirmar_senha" id="confirmar_senha" required>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required pattern="^\(\d{2}\) \d{5}-\d{4}$"
               placeholder="(xx) xxxxx-xxxx" maxlength="15">

        <label for="estado">Estado:</label>
        <input type="text" name="estado" id="estado" required>

        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" id="cidade" required>

        <label for="bairro">Bairro:</label>
        <input type="text" name="bairro" id="bairro" required>

        <label for="rua">Rua:</label>
        <input type="text" name="rua" id="rua" required>

        <label for="numero">Número:</label>
        <input type="text" name="numero" id="numero" required>

        <label for="complemento">Complemento:</label>
        <input type="text" name="complemento" id="complemento">

        <label for="tipo_sanguineo">Tipo Sanguíneo:</label>
        <select name="tipo_sanguineo" id="tipo_sanguineo" required>
            <option value="">Selecione...</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>

        <label for="alergias">Alergias:</label>
        <input type="text" name="alergias" id="alergias">

        <button type="submit" name="acao" value="cadastrar">Cadastrar</button>
    </form>
</div>

</body>
</html>
