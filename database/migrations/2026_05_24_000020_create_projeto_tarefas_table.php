<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projeto_tarefas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('projeto_id')->constrained('projetos')->cascadeOnDelete();
            $table->foreignId('etapa_id')->nullable()->constrained('projeto_etapas')->nullOnDelete();
            $table->string('titulo', 180);
            $table->text('descricao')->nullable();
            $table->enum('prioridade', ['baixa', 'media', 'alta', 'urgente'])->default('media');
            $table->enum('status', ['pendente', 'em_andamento', 'concluida', 'cancelada'])->default('pendente');
            $table->foreignId('responsavel_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->date('data_prazo')->nullable();
            $table->dateTime('data_conclusao')->nullable();
            $table->timestamps();

            $table->index('empresa_id');
            $table->index('projeto_id');
            $table->index('etapa_id');
            $table->index('status');
            $table->index('responsavel_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projeto_tarefas');
    }
};
