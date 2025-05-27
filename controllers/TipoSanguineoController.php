<?php
require_once '../models/tipo.sanguineo.model.php';

class TipoSanguineoController
{
    private $model;

    public function __construct()
    {
        $this->model = new TipoSanguineoModel();
    }

    public function listarTipos()
    {
        return $this->model->listarTipos();
    }
}
?>