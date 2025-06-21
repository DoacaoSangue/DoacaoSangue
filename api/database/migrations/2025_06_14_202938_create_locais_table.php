<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('locais', function (Blueprint $table) {
            $table->id('id_local');
            $table->string('nome', 100);
            $table->string('bairro', 100);
            $table->string('rua', 150);
            $table->integer('numero');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locais');
    }
};
