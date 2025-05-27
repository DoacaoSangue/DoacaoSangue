<?php

namespace App\Controller;

use App\Model\UsuarioModel;
use App\Database\Connection;
use PDO;

class TelaCadastroController
{
    public function listar()
    {
        $busca = $_GET['busca'] ?? '';
        $usuarios = $busca
            ? UsuarioModel::buscarPorNome(trim($busca))
            : UsuarioModel::listarTodos();

        require_once __DIR__ . '/../View/usuarios.lista.view.php';
    }

    public function criar()
    {
        $erros = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome      = trim($_POST['nome']);
            $email     = trim($_POST['email']);
            $senha     = trim($_POST['pass']);
            $telefone  = trim($_POST['telefone']);
            $estado    = trim($_POST['estado']);
            $cidade    = trim($_POST['cidade']);
            $bairro    = trim($_POST['bairro']);
            $rua       = trim($_POST['rua']);
            $numero    = trim($_POST['numero']);
            $complemento = trim($_POST['complemento']);
            $tipo      = intval($_POST['id_tipo_sanguineo']);
            $alergias  = trim($_POST['alergias']);

            // Monta o endereço completo
            $endereco = "{$estado}, {$cidade}, {$bairro}, {$rua}, {$numero}";
            if (!empty($complemento)) {
                $endereco .= " - {$complemento}";
            }

            // Validação básica
            if (!$nome) $erros[] = 'Nome é obrigatório.';
            if (!$email) $erros[] = 'Email é obrigatório.';
            if (!$senha) $erros[] = 'Senha é obrigatória.';
            if (!$telefone) $erros[] = 'Telefone é obrigatório.';
            if (!$estado || !$cidade || !$bairro || !$rua || !$numero) $erros[] = 'Endereço completo é obrigatório.';
            if (!$tipo) $erros[] = 'Tipo sanguíneo é obrigatório.';

            if (empty($erros)) {
                $resultado = \App\Model\UsuarioModel::cadastrarUsuario(
                    $nome,
                    $email,
                    $senha,
                    $telefone,
                    $endereco,
                    $tipo,
                    $alergias
                );

                if ($resultado === true) {
                    // Cadastro OK, redireciona para login
                    header('Location: /DoacaoSangue/');
                    exit;
                } else {
                    // Mensagem de erro do model
                    $erros[] = $resultado;
                }
            }
        }

        // Exibe a view de cadastro novamente, passando erros se houver
        require __DIR__ . '/../View/tela-cadastro.view.php';
    }

    public function editar($id)
    {
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = $_POST['nome'];
            $email = $_POST['email'];

            $update = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            $update->execute([$nome, $email, $id]);

            header("Location: /usuarios");
            exit();
        }

        require_once __DIR__ . '/../View/usuarios.update.view.php';
    }

    public function excluir($id)
    {
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: /usuarios");
        exit();
    }
}
