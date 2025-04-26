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

}