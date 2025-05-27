<?php

namespace App\Models;

use App\Database\Connection;
use PDO;
use PDOException;

class LocalModel
{
    public static function cadastrarLocal($nome, $bairro, $rua, $numero)
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("INSERT INTO locais (nome, bairro, rua, numero) VALUES (:nome, :bairro, :rua, :numero)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':numero', $numero, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return 'Erro ao cadastrar o local: ' . $e->getMessage();
        }
    }

    public static function buscarTodosLocais()
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->query("SELECT * FROM locais");
            $locais = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $locais ?: false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function buscarLocalPorId($id)
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("SELECT * FROM locais WHERE id_local = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $local = $stmt->fetch(PDO::FETCH_ASSOC);

            return $local ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function buscarLocalPorNome($nome)
    {
        try {
            $conn = Connection::getInstance();

            $nomeBusca = "%" . $nome . "%";
            $stmt = $conn->prepare("SELECT * FROM locais WHERE nome LIKE :nome");
            $stmt->bindParam(':nome', $nomeBusca);
            $stmt->execute();

            $locais = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $locais;
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function atualizarLocal($id, $nome, $bairro, $rua, $numero)
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("UPDATE locais SET nome = :nome, bairro = :bairro, rua = :rua, numero = :numero WHERE id_local = :id");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':numero', $numero, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return 'Erro ao atualizar o local: ' . $e->getMessage();
        }
    }

    public static function excluirLocal($id)
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("DELETE FROM locais WHERE id_local = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return 'Erro ao excluir o local: ' . $e->getMessage();
        }
    }
}
