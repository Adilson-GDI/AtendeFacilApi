<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_empresa', 150);
            $table->string('nome_responsavel', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('telefone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('documento', 30)->nullable();
            $table->enum('tipo_profissional', ['arquiteto', 'designer_interiores', 'ambos'])->default('ambos');
            $table->string('plano', 50)->default('free');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
