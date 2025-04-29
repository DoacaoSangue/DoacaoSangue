<?php
require_once '../models/usuario.model.php';
require_once '../models/local.model.php';

class CamposDoacaoController
{
    private $model;
    private $localModel;

    public function __construct()
    {
        $this->model = new UsuarioModel();
        $this->localModel = new LocalModel();
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
?>