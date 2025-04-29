<?php

class RestricaoModel
{
    public static function conectar()
    {
        $conn = new mysqli('localhost', 'root', '', 'doacao_sangue');
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function verificarRestricao($idDoador, $idRecebedor)
{
    $conn = self::conectar();

    // Primeiro, buscar o tipo sanguíneo do doador e do recebedor
    $stmt = $conn->prepare("SELECT id_usuario, id_tipo_sanguineo FROM usuarios WHERE id_usuario IN (?, ?)");
    if (!$stmt) {
        $conn->close();
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("ii", $idDoador, $idRecebedor);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $tipos = [];
    while ($row = $resultado->fetch_assoc()) {
        $tipos[$row['id_usuario']] = $row['id_tipo_sanguineo'];
    }
    $stmt->close();

    // Verificar se encontrou os dois usuários
    if (!isset($tipos[$idDoador]) || !isset($tipos[$idRecebedor])) {
        $conn->close();
        return ['erro' => 'Tipo sanguíneo não encontrado para um dos usuários.'];
    }

    $idTipoDoador = $tipos[$idDoador];
    $idTipoRecebedor = $tipos[$idRecebedor];

    // Agora, verificar se existe restrição entre os tipos sanguíneos
    $stmt2 = $conn->prepare("SELECT * FROM restricoes WHERE id_tipo_doador = ? AND id_tipo_recebedor = ?");
    if (!$stmt2) {
        $conn->close();
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt2->bind_param("ii", $idTipoDoador, $idTipoRecebedor);
    $stmt2->execute();
    $resultado2 = $stmt2->get_result();

    $restricao = $resultado2->fetch_assoc(); 
    $stmt2->close();
    $conn->close();

    return $restricao; 
}
}
?>