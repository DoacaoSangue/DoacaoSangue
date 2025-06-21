<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposSanguineosTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_sanguineos', function (Blueprint $table) {
            $table->bigIncrements('id_tipo');
            $table->string('tipo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipos_sanguineos');
    }
}
