<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('restricoes', function (Blueprint $table) {
            $table->foreignId('id_tipo_doador')->constrained('tipos_sanguineos', 'id_tipo')->onDelete('cascade');
            $table->foreignId('id_tipo_recebedor')->constrained('tipos_sanguineos', 'id_tipo')->onDelete('cascade');
            $table->primary(['id_tipo_doador', 'id_tipo_recebedor']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restricoes');
    }
};
