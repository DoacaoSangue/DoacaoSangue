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

    public static function temDoacaoFutura($id_usuario)
    {
        $conn = self::conectar();

        $sql = "SELECT 1 FROM doacoes WHERE (id_doador = ? OR id_recebedor = ?) AND data > CURDATE() LIMIT 1";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_usuario, $id_usuario); 
        $stmt->execute();

        $resultado = $stmt->get_result();
        $tem_doacao_futura = $resultado->num_rows > 0; 
        
        $stmt->close();
        $conn->close();

        return $tem_doacao_futura;
    }
}
