<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modulo_config', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->unique()->constrained('empresas')->cascadeOnDelete();
            $table->boolean('modulo_arquitetura')->default(true);
            $table->boolean('modulo_interiores')->default(true);
            $table->boolean('permite_upload_arquivos')->default(true);
            $table->integer('limite_arquivos_mb')->default(100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modulo_config');
    }
};
