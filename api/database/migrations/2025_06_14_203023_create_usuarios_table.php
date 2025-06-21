<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('email', 100)->unique();
            $table->string('nome', 100);
            $table->string('senha', 255);
            $table->string('telefone', 20);
            $table->text('endereco');
            $table->foreignId('id_tipo_sanguineo')->nullable()->constrained('tipos_sanguineos', 'id_tipo')->onDelete('restrict');
            $table->string('alergias', 255)->nullable();
            $table->tinyInteger('tipo_usuario')->default(0); // 0 = comum, 1 = admin
            $table->timestamp('criado_em')->useCurrent();
            $table->boolean('doar')->default(false);
            $table->boolean('receber')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

