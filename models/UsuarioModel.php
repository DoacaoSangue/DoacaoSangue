<?php

namespace App\Models;

use App\Database\Connection;
use PDO;
use PDOException;

class UsuarioModel
{
    public static function existeEmail(string $email): bool
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);

            return $stmt->fetchColumn() !== false;
        } catch (PDOException $e) {

            return false;
        }
    }

    public static function cadastrarUsuario(
        string $nome,
        string $email,
        string $senha,
        string $telefone,
        string $endereco,
        int $tipo,
        string $alergias
    ): bool|string {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Erro: O formato do email é inválido.';
        }

        if (self::existeEmail($email)) {
            return 'Erro: O email já está em uso.';
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone, endereco, id_tipo_sanguineo, alergias) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $resultado = $stmt->execute([$nome, $email, $senhaHash, $telefone, $endereco, $tipo, $alergias]);

            return $resultado;
        } catch (PDOException $e) {

            return 'Erro ao cadastrar o usuário. Tente novamente.';
        }
    }

    public static function listarDoadores(): array
    {
        try {
            $conn = Connection::getInstance();

            $sql = "SELECT u.id_usuario, u.nome, t.tipo AS tipo_sanguineo 
                    FROM usuarios u
                    INNER JOIN tipos_sanguineos t ON u.id_tipo_sanguineo = t.id_tipo
                    WHERE u.doar = true";

            $stmt = $conn->query($sql);
            $doadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $doadores ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function listarRecebedores(): array
    {
        try {
            $conn = Connection::getInstance();

            $sql = "SELECT u.id_usuario, u.nome, t.tipo AS tipo_sanguineo 
                    FROM usuarios u
                    INNER JOIN tipos_sanguineos t ON u.id_tipo_sanguineo = t.id_tipo
                    WHERE u.receber = true";

            $stmt = $conn->query($sql);
            $recebedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $recebedores ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function buscarStatusDoacao(int $idUsuario): ?array
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("SELECT doar, receber FROM usuarios WHERE id_usuario = ?");
            $stmt->execute([$idUsuario]);

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function validarLogin(string $email, string $senha): bool|string
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("SELECT email, senha FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                return $usuario['email'];
            }

            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function atualizarStatusDoacao(int $idUsuario, string $campo): ?array
    {
        if (!in_array($campo, ['doar', 'receber'], true)) {
            throw new \InvalidArgumentException("Campo inválido para atualização.");
        }

        try {
            $conn = Connection::getInstance();

            $sql = "UPDATE usuarios SET $campo = 1 WHERE id_usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$idUsuario]);

            $stmt2 = $conn->prepare("SELECT doar, receber FROM usuarios WHERE id_usuario = ?");
            $stmt2->execute([$idUsuario]);

            $resultado = $stmt2->fetch(PDO::FETCH_ASSOC);

            return $resultado ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }
}

