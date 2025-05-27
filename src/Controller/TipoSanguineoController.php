<?php
namespace App\Controller;

use App\Model\TipoSanguineoModel;

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