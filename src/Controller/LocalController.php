<?php
require_once('../models/local.model.php');

class LocalController
{
    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirecionarComAlerta("Requisição inválida.");
        }

        $id = $_POST['id'] ?? '';
        $nome = $_POST['nome'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $rua = $_POST['rua'] ?? '';
        $numero = $_POST['numero'] ?? '';

        if (empty($id) || empty($nome) || empty($bairro) || empty($rua) || empty($numero)) {
            return $this->redirecionarComAlerta("Todos os campos são obrigatórios.");
        }

        $resultado = LocalModel::atualizarLocal($id, $nome, $bairro, $rua, $numero);

        if ($resultado === true) {
            session_start();
            $_SESSION['cadastro_sucesso'] = true;
            return $this->redirecionarComAlerta("Atualização de local efetuada com sucesso!");
        }

        return $this->redirecionarComAlerta("Erro ao atualizar local: $resultado");
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirecionarComAlerta("Requisição inválida.");
        }

        $nome = $_POST['nome'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $rua = $_POST['rua'] ?? '';
        $numero = $_POST['numero'] ?? '';

        if (empty($nome) || empty($bairro) || empty($rua) || empty($numero)) {
            return $this->redirecionarComAlerta("Todos os campos são obrigatórios.");
        }

        $resultado = LocalModel::cadastrarLocal($nome, $bairro, $rua, $numero);

        if ($resultado === true) {
            session_start();
            $_SESSION['cadastro_sucesso'] = true;
            return $this->redirecionarComAlerta("Cadastro de local efetuado com sucesso!");
        }

        return $this->redirecionarComAlerta("Erro ao cadastrar local: $resultado");
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

        header("Location: ../views/painel-administrador.view.php?page=locais&crud=r");
        exit;
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? '';

        if (empty($id)) {
            return $this->redirecionarComAlerta("Erro ao excluir local!");
        }

        LocalModel::excluirLocal($id);
        return $this->redirecionarComAlerta("Local excluído com sucesso!");
    }

    private function redirecionarComAlerta($mensagem)
    {
        echo "<script>
                alert('$mensagem');
                window.location.href = '../views/painel-administrador.view.php?page=locais&crud=';
              </script>";
        exit;
    }
}

