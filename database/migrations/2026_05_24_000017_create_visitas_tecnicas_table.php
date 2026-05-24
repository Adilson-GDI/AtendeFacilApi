<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitas_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->foreignId('projeto_id')->constrained('projetos')->cascadeOnDelete();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->string('titulo', 150)->default('Visita técnica');
            $table->date('data_visita');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fim')->nullable();
            $table->string('endereco')->nullable();
            $table->enum('status', ['agendada', 'realizada', 'cancelada', 'remarcada'])->default('agendada');
            $table->text('observacoes')->nullable();
            $table->text('pendencias')->nullable();
            $table->timestamps();

            $table->index('empresa_id');
            $table->index('projeto_id');
            $table->index('cliente_id');
            $table->index('data_visita');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitas_tecnicas');
    }
};
