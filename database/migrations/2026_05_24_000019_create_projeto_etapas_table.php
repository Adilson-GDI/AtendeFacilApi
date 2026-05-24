<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projeto_etapas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('projeto_id')->constrained('projetos')->cascadeOnDelete();
            $table->string('titulo', 150);
            $table->text('descricao')->nullable();
            $table->integer('ordem')->default(0);
            $table->enum('status', ['pendente', 'em_andamento', 'concluida', 'cancelada'])->default('pendente');
            $table->date('data_inicio')->nullable();
            $table->date('data_previsao')->nullable();
            $table->date('data_conclusao')->nullable();
            $table->timestamps();

            $table->index('empresa_id');
            $table->index('projeto_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projeto_etapas');
    }
};
