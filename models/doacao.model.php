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

    public static function buscarTodasDoacoes(){
        $conn = self::conectar();
        $sql = "SELECT * FROM doacoes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $doacoes = [];
            while ($row = $result->fetch_assoc()) {
                $doacoes[] = $row;
            }
            $conn->close();

            var_dump($doacoes); 
            return $doacoes;
        } else {
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
