<?php

namespace App\Models;

use App\Database\Connection;
use PDO;
use PDOException;

class TipoSanguineoModel
{
    public function listarTipos(): array
    {
        try {
            $conn = Connection::getInstance();

            $sql = "SELECT id_tipo, tipo FROM tipos_sanguineos";
            $stmt = $conn->query($sql);

            $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $tipos ?: [];

        } catch (PDOException $e) {
            return [];
        }
    }
}