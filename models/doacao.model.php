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

    public static function buscarDoacoesPorUsuario($idUsuario) {
        $conn = self::conectar();
    
        $stmt = $conn->prepare("SELECT * FROM doacoes WHERE id_doador = ? OR id_recebedor = ?");
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
