<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projeto_ambientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('projeto_id')->constrained('projetos')->cascadeOnDelete();
            $table->string('nome', 120);
            $table->enum('tipo_ambiente', ['sala', 'cozinha', 'quarto', 'banheiro', 'lavabo', 'area_gourmet', 'escritorio', 'fachada', 'area_externa', 'comercial', 'outro'])->default('outro');
            $table->decimal('metragem', 10, 2)->nullable();
            $table->text('descricao')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();

            $table->index('empresa_id');
            $table->index('projeto_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projeto_ambientes');
    }
};
