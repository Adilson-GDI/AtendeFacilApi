<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projeto_financeiro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('projeto_id')->constrained('projetos')->cascadeOnDelete();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->enum('tipo', ['receita', 'despesa'])->default('receita');
            $table->string('descricao', 180);
            $table->decimal('valor', 10, 2)->default(0);
            $table->date('data_vencimento')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->enum('status', ['pendente', 'pago', 'atrasado', 'cancelado'])->default('pendente');
            $table->string('forma_pagamento', 80)->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();

            $table->index('empresa_id');
            $table->index('projeto_id');
            $table->index('cliente_id');
            $table->index('status');
            $table->index('data_vencimento');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projeto_financeiro');
    }
};
