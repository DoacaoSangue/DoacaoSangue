<?php
namespace App\Controller;

use App\Model\LocalModel;
use App\Database\Connection;
use PDO;

class LocalController
{
    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=r');
            exit;
        }

        $id = $_POST['id'] ?? '';
        $nome = $_POST['nome'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $rua = $_POST['rua'] ?? '';
        $numero = $_POST['numero'] ?? '';

        if (empty($id) || empty($nome) || empty($bairro) || empty($rua) || empty($numero)) {
            $_SESSION['erro'] = "Todos os campos são obrigatórios.";
            header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=u&id=' . urlencode($id));
            exit;
        }

        $resultado = LocalModel::atualizarLocal($id, $nome, $bairro, $rua, $numero);

        if ($resultado === true) {
            $_SESSION['cadastro_sucesso'] = true;
            header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=r');
            exit;
        }

        $_SESSION['erro'] = "Erro ao atualizar local: $resultado";
        header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=u&id=' . urlencode($id));
        exit;
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=r');
            exit;
        }

        $nome = $_POST['nome'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $rua = $_POST['rua'] ?? '';
        $numero = $_POST['numero'] ?? '';

        if (empty($nome) || empty($bairro) || empty($rua) || empty($numero)) {
            $_SESSION['erro'] = "Todos os campos são obrigatórios.";
            header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=c');
            exit;
        }

        $resultado = LocalModel::cadastrarLocal($nome, $bairro, $rua, $numero);

        if ($resultado === true) {
            $_SESSION['cadastro_sucesso'] = true;
            header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=r');
            exit;
        }

        $_SESSION['erro'] = "Erro ao cadastrar local: $resultado";
        header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=c');
        exit;
    }

    public function listar()
    {
        session_start();

        $buscar = $_GET['buscar'] ?? '';

        if (!empty($buscar)) {
            $locais = LocalModel::buscarLocalPorNome($buscar);
        } else {
            $locais = LocalModel::buscarTodosLocais();
        }

        $_SESSION['locais'] = $locais !== false ? $locais : [];

        header("Location: /DoacaoSangue/painel-administrador.view.php?page=locais&crud=r");
        exit;
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? '';

        if (empty($id)) {
            $_SESSION['erro'] = "Erro ao excluir local!";
            header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=r');
            exit;
        }

        $resultado = LocalModel::excluirLocal($id);

        if ($resultado === true) {
            $_SESSION['cadastro_sucesso'] = "Local excluído com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir local!";
        }

        header('Location: /DoacaoSangue/painel-administrador?page=locais&crud=r');
        exit;
    }
}

