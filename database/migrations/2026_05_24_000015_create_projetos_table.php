<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->string('titulo', 180);
            $table->enum('tipo_projeto', ['residencial', 'comercial', 'interiores', 'reforma', 'consultoria', 'execucao_obra', 'outro'])->default('interiores');
            $table->enum('status', ['orcamento', 'briefing', 'em_andamento', 'aguardando_cliente', 'aguardando_fornecedor', 'em_obra', 'finalizado', 'cancelado'])->default('orcamento');
            $table->text('descricao')->nullable();
            $table->string('endereco_obra')->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('estado', 2)->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_previsao_entrega')->nullable();
            $table->date('data_finalizacao')->nullable();
            $table->decimal('valor_projeto', 10, 2)->default(0);
            $table->decimal('custo_estimado', 10, 2)->default(0);
            $table->text('observacoes')->nullable();
            $table->timestamps();

            $table->index('empresa_id');
            $table->index('cliente_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projetos');
    }
};
