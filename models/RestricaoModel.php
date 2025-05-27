<?php

namespace App\Models;

use App\Database\Connection;
use PDO;
use PDOException;

class RestricaoModel
{
    public static function verificarRestricao($idDoador, $idRecebedor)
    {
        try {
            $conn = Connection::getInstance();

            $stmt = $conn->prepare("SELECT id_usuario, id_tipo_sanguineo FROM usuarios WHERE id_usuario IN (:idDoador, :idRecebedor)");

            $stmt = $conn->prepare("SELECT id_usuario, id_tipo_sanguineo FROM usuarios WHERE id_usuario IN (?, ?)");
            $stmt->bindValue(1, $idDoador, PDO::PARAM_INT);
            $stmt->bindValue(2, $idRecebedor, PDO::PARAM_INT);
            $stmt->execute();

            $tipos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tipos[$row['id_usuario']] = $row['id_tipo_sanguineo'];
            }

            if (!isset($tipos[$idDoador]) || !isset($tipos[$idRecebedor])) {
                return ['erro' => 'Tipo sanguíneo não encontrado para um dos usuários.'];
            }

            $idTipoDoador = $tipos[$idDoador];
            $idTipoRecebedor = $tipos[$idRecebedor];

            $stmt2 = $conn->prepare("SELECT * FROM restricoes WHERE id_tipo_doador = :idTipoDoador AND id_tipo_recebedor = :idTipoRecebedor");
            $stmt2->bindParam(':idTipoDoador', $idTipoDoador, PDO::PARAM_INT);
            $stmt2->bindParam(':idTipoRecebedor', $idTipoRecebedor, PDO::PARAM_INT);
            $stmt2->execute();

            $restricao = $stmt2->fetch(PDO::FETCH_ASSOC);

            return $restricao ?: null;

        } catch (PDOException $e) {
            return ['erro' => 'Erro no banco de dados: ' . $e->getMessage()];
        }
    }
}