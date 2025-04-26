<?php

class UsuarioModel
{
    public static function conectar()
    {
        $conn = new mysqli('localhost', 'root', '', 'doacao_sangue');
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function existeEmail($email)
    {
        $conn = self::conectar();
        $stmt = $conn->prepare("SELECT email FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $existe = $stmt->num_rows > 0;
        $stmt->close();
        $conn->close();
        return $existe;
    }

    public static function cadastrarUsuario($nome, $email, $senha, $telefone, $endereco, $tipo, $alergias)
    {
        if (self::existeEmail($email)) {
            return 'Erro: O email já está em uso.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Erro: O formato do email é inválido.';
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $conn = self::conectar();

        $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senha, telefone, endereco, tipo_sanguineo, alergias) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssss', $nome, $email, $senhaHash, $telefone, $endereco, $tipo, $alergias);
        $resultado = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $resultado ? true : 'Erro ao cadastrar o usuário. Tente novamente.';
    }
}
