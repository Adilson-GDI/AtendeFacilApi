<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projeto_fornecedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('projeto_id')->constrained('projetos')->cascadeOnDelete();
            $table->foreignId('fornecedor_id')->constrained('fornecedores')->cascadeOnDelete();
            $table->text('descricao_servico')->nullable();
            $table->decimal('valor_orcado', 10, 2)->default(0);
            $table->enum('status', ['orcado', 'aprovado', 'em_execucao', 'concluido', 'cancelado'])->default('orcado');
            $table->timestamps();

            $table->index('empresa_id');
            $table->index('projeto_id');
            $table->index('fornecedor_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projeto_fornecedores');
    }
};
