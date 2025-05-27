<?php

require_once('../models/doacao.model.php');
require_once('../models/restricao.model.php');

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

        $resultado = DoacaoModel::cadastrarDoacao($idDoador, $idRecebedor, $idLocal, $data);

        if ($resultado === true) {
            $_SESSION['cadastro_sucesso'] = true;
            self::redirectComAlerta('Cadastro de doação efetuado com sucesso!');
        } else {
            self::redirectComAlerta("Erro ao cadastrar doação: $resultado");
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

    public static function atualizarStatus()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Método inválido.";
            return;
        }

        $idUsuario = $_SESSION['id_usuario'] ?? null;
        $acao = $_POST['acao'] ?? null;

        if (!$idUsuario || !$acao) {
            echo "Dados inválidos.";
            return;
        }

        if ($acao === 'doar') {
            UsuarioModel::atualizarStatusDoacao($idUsuario, 'doar');
        } elseif ($acao === 'receber') {
            UsuarioModel::atualizarStatusDoacao($idUsuario, 'receber');
        }

        echo "<script>alert('Solicitação enviada com sucesso!');
            window.location.href = '../views/painel.view.php?page=carregar-home';</script>";
    }

    public static function verificarStatus()
    {
        session_start();

        $id_usuario = $_SESSION["id_usuario"] ?? null;
        if (!$id_usuario) {
            echo "Usuário não identificado.";
            exit;
        }

        $doacao = UsuarioModel::buscarStatusDoacao($id_usuario);
        $_SESSION['doacao'] = $doacao["doar"] || $doacao["receber"];

        header("Location: ../views/painel.view.php?page=home");
        exit;
    }

    public static function listar()
    {
        session_start();

        $buscar = $_GET['buscar_doacoes'] ?? '';
        $doacoes = !empty($buscar) ?
            DoacaoModel::buscarDoacaoPorDoador($buscar) :
            DoacaoModel::buscarTodasDoacoes();

        $_SESSION['doacoes'] = $doacoes ?: [];
        header("Location: ../views/painel-administrador.view.php?page=doacoes&crud=r");
        exit;
    }

    public static function excluir()
    {
        $id = $_GET['id'] ?? '';

        if ($id !== '') {
            DoacaoModel::excluirDoacao($id);
            self::redirectComAlerta('Doação excluída com sucesso!');
        } else {
            self::redirectComAlerta('Erro ao excluir doação!');
        }
    }

    private static function redirectComAlerta(string $mensagem)
    {
        echo "<script>
                alert('$mensagem');
                window.location.href = '../views/painel-administrador.view.php?page=doacoes&crud=';
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

    public function listarDoadores()
    {
        return $this->model->listarDoadores();
    }

    public function listarRecebedores()
    {
        return $this->model->listarRecebedores();
    }

    public function listarLocais()
    {
        return $this->localModel->buscarTodosLocais();
    }
}
