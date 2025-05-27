<?php

namespace App\Controller;

use App\Model\DoacaoModel;
use App\Model\RestricaoModel;
use App\Model\UsuarioModel;
use App\Model\LocalModel;

class DoacaoController
{

    private $model;
    private $localModel;

    public function __construct()
    {
        $this->model = new UsuarioModel();
        $this->localModel = new LocalModel();
    }

    public static function cadastrar()
    {
        session_start();

        $idDoador = $_POST['id_doador'] ?? '';
        $idRecebedor = $_POST['id_recebedor'] ?? '';
        $idLocal = $_POST['id_local'] ?? '';
        $data = $_POST['data'] ?? '';

        if (empty($idDoador) || empty($idRecebedor) || empty($idLocal) || empty($data)) {
            $_SESSION['erro_cadastro'] = 'Todos os campos são obrigatórios.';
            header('Location: /DoacaoSangue/painel-administrador?page=doacoes&crud=c');
            exit;
        }

        if ($data <= date('Y-m-d')) {
            $_SESSION['erro_cadastro'] = 'A data da doação deve ser maior que a data atual.';
            header('Location: /DoacaoSangue/painel-administrador?page=doacoes&crud=c');
            exit;
        }

        if (RestricaoModel::verificarRestricao($idDoador, $idRecebedor)) {
            $_SESSION['erro_cadastro'] = 'Existe uma restrição entre o doador e o recebedor.';
            header('Location: /DoacaoSangue/painel-administrador?page=doacoes&crud=c');
            exit;
        }

        $resultado = DoacaoModel::cadastrarDoacao($idDoador, $idRecebedor, $idLocal, $data);

        if ($resultado === true) {
            $_SESSION['cadastro_sucesso'] = 'Cadastro de doação efetuado com sucesso!';
            header('Location: /DoacaoSangue/painel-administrador?page=doacoes&crud=r');
            exit;
        } else {
            $_SESSION['erro_cadastro'] = "Erro ao cadastrar doação: $resultado";
            header('Location: /DoacaoSangue/painel-administrador?page=doacoes&crud=c');
            exit;
        }
    }

    public static function atualizar()
    {
        session_start();

        $id = $_POST['id_doacao'];
        $idDoador = $_POST['id_doador'] ?? '';
        $idRecebedor = $_POST['id_recebedor'] ?? '';
        $idLocal = $_POST['id_local'] ?? '';
        $data = $_POST['data'] ?? '';

        if (empty($idDoador) || empty($idRecebedor) || empty($idLocal) || empty($data)) {
            $_SESSION['erro_cadastro'] = 'Todos os campos são obrigatórios.';
            self::redirectComAlerta('Todos os campos são obrigatórios.');
        }

        if ($data <= date('Y-m-d')) {
            $_SESSION['erro_cadastro'] = 'A data da doação deve ser maior que a data atual.';
            self::redirectComAlerta('A data da doação deve ser maior que a data atual.');
        }

        if (RestricaoModel::verificarRestricao($idDoador, $idRecebedor)) {
            $_SESSION['erro_cadastro'] = 'Existe uma restrição entre o doador e o recebedor.';
            self::redirectComAlerta('Não é possível cadastrar a doação: existe uma restrição entre o doador e o recebedor.');
        }

        $resultado = DoacaoModel::atualizarDoacao($id, $idDoador, $idRecebedor, $idLocal, $data);

        if ($resultado === true) {
            $_SESSION['cadastro_sucesso'] = true;
            self::redirectComAlerta('Doação atualizada com sucesso!');
        } else {
            self::redirectComAlerta("Erro ao atualizar doação: $resultado");
        }
    }

    public static function listar()
    {
        session_start();

        $buscar = $_GET['buscar_doacoes'] ?? '';
        $doacoes = !empty($buscar) ?
            DoacaoModel::buscarDoacaoPorDoador($buscar) :
            DoacaoModel::buscarTodasDoacoes();

        $_SESSION['doacoes'] = $doacoes ?: [];
        header("Location: /DoacaoSangue/painel-administrador?page=doacoes&crud=r");
        exit;
    }

    public static function excluir()
    {
        session_start();

        $id = $_GET['id'] ?? '';

        if ($id !== '') {
            $resultado = DoacaoModel::excluirDoacao($id);
            if ($resultado === true) {
                $_SESSION['cadastro_sucesso'] = 'Doação excluída com sucesso!';
            } else {
                $_SESSION['erro_cadastro'] = 'Erro ao excluir doação!';
            }
        } else {
            $_SESSION['erro_cadastro'] = 'Erro ao excluir doação!';
        }

        header('Location: /DoacaoSangue/painel-administrador?page=doacoes&crud=r');
        exit;
    }

    private static function redirectComAlerta(string $mensagem)
    {
        echo "<script>
        alert('$mensagem');
        window.location.href = '/DoacaoSangue/painel-administrador?page=doacoes&crud=r';
      </script>";
        exit;
    }

     public static function buscarDoacoesPorUsuario()
    {
        session_start();

        if (!isset($_SESSION['id_usuario'])) {
            echo "<script>alert('Usuário não autenticado.');
            window.location.href = '../views/login.view.php';</script>";
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];
        $doacoes = DoacaoModel::buscarDoacoesPorUsuario($id_usuario);

        $_SESSION['doacoes'] = $doacoes;

        header("Location: ../views/painel.view.php?page=doacoes");
        exit;
    }
}
