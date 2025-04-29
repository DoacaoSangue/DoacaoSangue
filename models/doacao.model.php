<?php

class DoacaoModel
{
    public static function conectar()
    {
        $conn = new mysqli('localhost', 'root', '', 'doacao_sangue');
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function cadastrarDoacao($idDoador, $idRecebedor, $idLocal, $data)
    {
        $conn = self::conectar();

        $stmt = $conn->prepare("INSERT INTO doacoes (id_doador, id_recebedor, id_local, data) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            $conn->close();
            return 'Erro na preparação da consulta: ' . $conn->error;
        }

        $stmt->bind_param("iiis", $idDoador, $idRecebedor, $idLocal, $data);

        $resultado = $stmt->execute();

        if (!$resultado) {
            $erro = $stmt->error;
            $stmt->close();
            $conn->close();
            return "Erro ao cadastrar a doação: $erro";
        }

        $stmt->close();
        $conn->close();

        return true;
    }

    public static function buscarTodasDoacoes() {
        $conn = self::conectar();
    
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
    
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $doacoes = [];
            while ($row = $result->fetch_assoc()) {
                $doacoes[] = $row;
            }
            $conn->close();
            return $doacoes;
        } else {
            $conn->close();
            return false;
        }
    }

    public static function buscarDoacaoPorId($id) {
        $conn = self::conectar();
    
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
    
            WHERE d.id_doacao = ?
            LIMIT 1
        ";
    
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $conn->error);
        }
    
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $doacao = $result->fetch_assoc();
    
        $stmt->close();
        $conn->close();
    
        return $doacao ? $doacao : false;
    }

    public static function atualizarDoacao($id, $idDoador, $idRecebedor, $idLocal, $data) {
        $conn = self::conectar();
    
        $sql = "
            UPDATE doacoes 
            SET id_doador = ?, 
                id_recebedor = ?, 
                id_local = ?, 
                data = ?
            WHERE id_doacao = ?
        ";
    
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            $conn->close();
            return false; // Erro ao preparar a query
        }
    
        $stmt->bind_param('iiisi', $idDoador, $idRecebedor, $idLocal, $data, $id);
    
        $resultado = $stmt->execute();
    
        $stmt->close();
        $conn->close();
    
        return $resultado;
    }

    public static function buscarDoacaoPorDoador($nomeDoador) {
        $conn = self::conectar();
    
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
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $conn->error);
        }
    
        // Adiciona % para buscar nomes que contenham o que foi digitado
        $param = "%$nomeDoador%";
        $stmt->bind_param("s", $param);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $doacoes = [];
            while ($row = $result->fetch_assoc()) {
                $doacoes[] = $row;
            }
            $stmt->close();
            $conn->close();
            return $doacoes;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    

    public static function buscarDoacoesPorUsuario($idUsuario) {
        $conn = self::conectar();
    
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
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $conn->error);
        }
    
        $stmt->bind_param("ii", $idUsuario, $idUsuario);
        $stmt->execute();
    
        $resultado = $stmt->get_result();
        $doacoes = [];
    
        while ($row = $resultado->fetch_assoc()) {
            $doacoes[] = $row;
        }
    
        $stmt->close();
        $conn->close();
    
        return $doacoes;
    }
    
}
