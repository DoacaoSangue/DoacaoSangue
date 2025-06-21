<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('doacoes', function (Blueprint $table) {
            $table->id('id_doacao');
            $table->foreignId('id_doador')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->foreignId('id_recebedor')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->foreignId('id_local')->constrained('locais', 'id_local')->onDelete('cascade');
            $table->date('data');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doacoes');
    }
};
