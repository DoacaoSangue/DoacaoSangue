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
        $stmt = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
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

        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone, endereco, id_tipo_sanguineo, alergias) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssis", $nome, $email, $senhaHash, $telefone, $endereco, $tipo, $alergias);

        $resultado = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $resultado ? true : 'Erro ao cadastrar o usuário. Tente novamente.';
    }

    public static function buscarStatusDoacao($idUsuario){
        $conn = self::conectar();

        $stmt = $conn->prepare("SELECT doar, receber FROM usuarios WHERE id_usuario = ?");
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->bind_result($doar, $receber);

        $resultado = null;
        if ($stmt->fetch()) {
            $resultado = [
                'doar' => $doar,
                'receber' => $receber
            ];
        }

        $stmt->close();
        $conn->close();

        return $resultado;
    }

    public static function validarLogin($email, $senha)
    {
        $conn = self::conectar();
        $stmt = $conn->prepare("SELECT email, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($usuario_email, $senhaHash);
            $stmt->fetch();

            if (password_verify($senha, $senhaHash)) {
                $stmt->close();
                $conn->close();
                return $usuario_email;
            }
        }

        $stmt->close();
        $conn->close();
        return false;
    }

    public static function atualizarStatusDoacao($idUsuario, $campo)
    {
        $conn = self::conectar();

        // Verifica se o campo é válido (para evitar SQL Injection)
        if (!in_array($campo, ['doar', 'receber'])) {
            die("Campo inválido para atualização.");
        }

        // Monta o SQL dinamicamente de forma segura
        $sql = "UPDATE usuarios SET $campo = 1 WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro na preparação da atualização: " . $conn->error);
        }

        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->close();

        // Agora busca o novo status do usuário
        $stmt = $conn->prepare("SELECT doar, receber FROM usuarios WHERE id_usuario = ?");
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $stmt->bind_result($doar, $receber);

        $resultado = null;
        if ($stmt->fetch()) {
            $resultado = [
                'doar' => $doar,
                'receber' => $receber
            ];
        }

        $stmt->close();
        $conn->close();

        return $resultado;
    }
}

