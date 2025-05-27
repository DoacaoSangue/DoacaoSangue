<?php

class LocalModel
{
    public static function conectar()
    {
        $conn = new mysqli('localhost', 'root', '', 'doacao_sangue');
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }
        return $conn;
    }

    public static function cadastrarLocal($nome, $bairro, $rua, $numero){

        $conn = self::conectar();

        $stmt = $conn->prepare("INSERT INTO locais (nome, bairro, rua, numero) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nome, $bairro, $rua, $numero);

        $resultado = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $resultado ? true : 'Erro ao cadastrar o local. Tente novamente.';
    }

    public static function buscarTodosLocais(){
        $conn = self::conectar();
        $sql = "SELECT * FROM locais";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $locais = [];
            while ($row = $result->fetch_assoc()) {
                $locais[] = $row;
            }
            $conn->close();
            return $locais;
        } else {
            $conn->close();
            return false; // Nenhum local encontrado
        }
    }
    
    public static function buscarLocalPorId($id){
        $conn = self::conectar();

        $stmt = $conn->prepare("SELECT * FROM locais WHERE id_local = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $local = $resultado->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $local;
    }

    public static function buscarLocalPorNome($nome){
        $conn = self::conectar();
    
        // Usando LIKE para busca parcial
        $stmt = $conn->prepare("SELECT * FROM locais WHERE nome LIKE ?");
        $nomeBusca = "%" . $nome . "%"; // O % permite busca parcial antes e depois do nome
        $stmt->bind_param("s", $nomeBusca);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        $locais = [];
        while ($row = $resultado->fetch_assoc()) {
            $locais[] = $row;
        }
    
        $stmt->close();
        $conn->close();
    
        return $locais;
    }

    public static function atualizarLocal($id, $nome, $bairro, $rua, $numero){
        $conn = self::conectar();

        $stmt = $conn->prepare("UPDATE locais SET nome = ?, bairro = ?, rua = ?, numero = ? WHERE id_local = ?");
        $stmt->bind_param("sssii", $nome, $bairro, $rua, $numero, $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $resultado ? true : 'Erro ao atualizar o local. Tente novamente.';
    }

    public static function excluirLocal($id){
        $conn = self::conectar();

        $stmt = $conn->prepare("DELETE FROM locais WHERE id_local = ?");
        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $resultado ? true : 'Erro ao excluir o local. Tente novamente.';
    }
}
