<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projeto_briefing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('projeto_id')->unique()->constrained('projetos')->cascadeOnDelete();
            $table->string('estilo_desejado', 150)->nullable();
            $table->string('cores_preferidas')->nullable();
            $table->string('cores_evitar')->nullable();
            $table->text('referencias')->nullable();
            $table->text('necessidades')->nullable();
            $table->text('prioridades')->nullable();
            $table->text('restricoes')->nullable();
            $table->decimal('orcamento_cliente', 10, 2)->nullable();
            $table->date('prazo_desejado')->nullable();
            $table->boolean('possui_pets')->default(false);
            $table->boolean('possui_criancas')->default(false);
            $table->text('observacoes')->nullable();
            $table->timestamps();

            $table->index('empresa_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projeto_briefing');
    }
};
