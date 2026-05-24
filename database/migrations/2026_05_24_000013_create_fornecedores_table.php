<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->cascadeOnDelete();
            $table->string('nome', 150);
            $table->enum('categoria', ['marcenaria', 'marmoraria', 'iluminacao', 'moveis', 'decoracao', 'obra', 'pintura', 'eletrica', 'hidraulica', 'revestimentos', 'outro'])->default('outro');
            $table->string('contato', 150)->nullable();
            $table->string('telefone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('endereco')->nullable();
            $table->text('observacoes')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->index('empresa_id');
            $table->index('categoria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
