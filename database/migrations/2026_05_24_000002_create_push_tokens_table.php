<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('push_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('empresa_id')->nullable();
            $table->integer('user_id')->default(0);
            $table->string('push_token', 500);
            $table->string('device_name', 150)->nullable();
            $table->string('platform', 20)->nullable();
            $table->string('permission', 30)->nullable();
            $table->string('tipo_servico', 100)->default('GERAL');
            $table->string('app_version', 30)->nullable();
            $table->boolean('ativo')->default(true);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();

            $table->unique('push_token', 'uniq_push_token');
            $table->index('user_id', 'idx_push_user_id');
            $table->index('empresa_id', 'idx_push_empresa_id');

            $table->foreign('empresa_id')
                ->references('id')
                ->on('app_empresas')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('push_tokens');
    }
};
