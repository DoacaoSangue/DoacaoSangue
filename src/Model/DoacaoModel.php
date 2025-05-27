<?php

namespace App\Model;

use App\Database\Connection;
use PDO;
use PDOException;

class DoacaoModel
{
    public static function cadastrarDoacao($idDoador, $idRecebedor, $idLocal, $data)
    {
        $conn = Connection::getInstance();

        $sql = "INSERT INTO doacoes (id_doador, id_recebedor, id_local, data) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return 'Erro na preparação da consulta.';
        }

        $resultado = $stmt->execute([$idDoador, $idRecebedor, $idLocal, $data]);

        return $resultado ? true : 'Erro ao cadastrar a doação.';
    }

    public static function buscarTodasDoacoes()
    {
        $conn = Connection::getInstance();

        $sql = "
            SELECT 
                d.id_doacao,
                d.data,
                ld.nome AS nome_local,
                u1.nome AS nome_doador,
                ts1.tipo AS tipo_sanguineo_doador,
                u2.nome AS nome_recebedor,
                ts2.tipo AS tipo_sanguineo_recebedor
            FROM doacoes d
            JOIN locais ld ON d.id_local = ld.id_local
            JOIN usuarios u1 ON d.id_doador = u1.id_usuario
            JOIN tipos_sanguineos ts1 ON u1.id_tipo_sanguineo = ts1.id_tipo
            JOIN usuarios u2 ON d.id_recebedor = u2.id_usuario
            JOIN tipos_sanguineos ts2 ON u2.id_tipo_sanguineo = ts2.id_tipo
            ORDER BY d.data DESC
        ";

        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function excluirDoacao($id)
    {
        if (empty($id)) {
            return "ID inválido.";
        }

        $conn = Connection::getInstance();
        $stmt = $conn->prepare("DELETE FROM doacoes WHERE id_doacao = ?");
        $resultado = $stmt->execute([$id]);

        return $resultado ? true : "Erro ao excluir doação.";
    }

    public static function buscarDoacaoPorId($id)
    {
        $conn = Connection::getInstance();

        $sql = "
            SELECT 
                d.id_doacao,
                d.id_doador,
                d.id_recebedor,
                d.id_local,
                d.data,
                ld.nome AS nome_local,
                u1.nome AS nome_doador,
                ts1.tipo AS tipo_sanguineo_doador,
                u2.nome AS nome_recebedor,
                ts2.tipo AS tipo_sanguineo_recebedor
            FROM doacoes d
            JOIN locais ld ON d.id_local = ld.id_local
            JOIN usuarios u1 ON d.id_doador = u1.id_usuario
            JOIN tipos_sanguineos ts1 ON u1.id_tipo_sanguineo = ts1.id_tipo
            JOIN usuarios u2 ON d.id_recebedor = u2.id_usuario
            JOIN tipos_sanguineos ts2 ON u2.id_tipo_sanguineo = ts2.id_tipo
            WHERE d.id_doacao = ?
            LIMIT 1
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    public static function atualizarDoacao($id, $idDoador, $idRecebedor, $idLocal, $data)
    {
        $conn = Connection::getInstance();

        $sql = "
            UPDATE doacoes 
            SET id_doador = ?, 
                id_recebedor = ?, 
                id_local = ?, 
                data = ?
            WHERE id_doacao = ?
        ";

        $stmt = $conn->prepare($sql);
        return $stmt->execute([$idDoador, $idRecebedor, $idLocal, $data, $id]);
    }

    public static function buscarDoacaoPorDoador($nomeDoador)
    {
        $conn = Connection::getInstance();

        $sql = "
            SELECT
                d.id_doacao, 
                d.data,
                ld.nome AS nome_local,
                u1.nome AS nome_doador,
                ts1.tipo AS tipo_sanguineo_doador,
                u2.nome AS nome_recebedor,
                ts2.tipo AS tipo_sanguineo_recebedor
            FROM doacoes d
            JOIN locais ld ON d.id_local = ld.id_local
            JOIN usuarios u1 ON d.id_doador = u1.id_usuario
            JOIN tipos_sanguineos ts1 ON u1.id_tipo_sanguineo = ts1.id_tipo
            JOIN usuarios u2 ON d.id_recebedor = u2.id_usuario
            JOIN tipos_sanguineos ts2 ON u2.id_tipo_sanguineo = ts2.id_tipo
            WHERE u1.nome LIKE ?
            ORDER BY d.data DESC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['%' . $nomeDoador . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
    }

    public static function buscarDoacoesPorUsuario($idUsuario)
    {
        $conn = Connection::getInstance();

        $sql = "
            SELECT 
                d.data,
                u_doador.nome AS nome_doador,
                ts_doador.tipo AS tipo_sanguineo_doador,
                u_recebedor.nome AS nome_recebedor,
                ts_recebedor.tipo AS tipo_sanguineo_recebedor,
                l.nome AS nome_local
            FROM doacoes d
            INNER JOIN usuarios u_doador ON d.id_doador = u_doador.id_usuario
            INNER JOIN tipos_sanguineos ts_doador ON u_doador.id_tipo_sanguineo = ts_doador.id_tipo
            INNER JOIN usuarios u_recebedor ON d.id_recebedor = u_recebedor.id_usuario
            INNER JOIN tipos_sanguineos ts_recebedor ON u_recebedor.id_tipo_sanguineo = ts_recebedor.id_tipo
            INNER JOIN locais l ON d.id_local = l.id_local
            WHERE d.id_doador = ? OR d.id_recebedor = ?
            ORDER BY d.data DESC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$idUsuario, $idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
