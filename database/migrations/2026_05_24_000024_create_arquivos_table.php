<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('projeto_id')->nullable()->constrained('projetos')->cascadeOnDelete();
            $table->foreignId('ambiente_id')->nullable()->constrained('projeto_ambientes')->nullOnDelete();
            $table->foreignId('visita_id')->nullable()->constrained('visitas_tecnicas')->nullOnDelete();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->nullOnDelete();
            $table->enum('tipo', ['foto', 'planta', 'pdf', 'contrato', 'referencia', 'orcamento', 'outro'])->default('outro');
            $table->string('nome_original')->nullable();
            $table->string('nome_arquivo');
            $table->string('caminho', 500);
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('tamanho_bytes')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('empresa_id');
            $table->index('projeto_id');
            $table->index('ambiente_id');
            $table->index('visita_id');
            $table->index('cliente_id');
            $table->index('tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};
