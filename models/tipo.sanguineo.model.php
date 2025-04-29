<?php

class TipoSanguineoModel
{
    public static function conectar()
    {
        $conn = new mysqli('localhost', 'root', '', 'doacao_sangue');
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }
        return $conn;
    }

    public function listarTipos()
    {
        $conn = self::conectar();

        $sql = "SELECT id_tipo, tipo FROM tipos_sanguineos";
        $result = $conn->query($sql);

        $tipos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tipos[] = $row;
            }
            $result->free();
        }

        $conn->close();
        return $tipos;
    }
}
?>