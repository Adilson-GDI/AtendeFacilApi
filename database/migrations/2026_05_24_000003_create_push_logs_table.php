<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
   Schema::create('push_logs', function (Blueprint $table) {
    $table->increments('id');

    $table->unsignedInteger('empresa_id')->nullable();
    $table->integer('user_id')->default(0);

    $table->string('title', 255)->nullable();
    $table->text('body')->nullable();
    $table->string('image_url', 500)->nullable();

    $table->string('target_type', 50)->nullable(); 
    $table->text('target_value')->nullable();

    $table->string('action_type', 50)->nullable();
    $table->text('action_value')->nullable();
    $table->json('action_data')->nullable();

    $table->integer('total_targets')->default(0);
    $table->integer('total_success')->default(0);
    $table->integer('total_error')->default(0);

    $table->json('response_data')->nullable();

    $table->timestamp('sent_at')->nullable()->useCurrent();
    $table->timestamps();

    $table->index('empresa_id', 'idx_push_logs_empresa_id');
    $table->index('user_id', 'idx_push_logs_user_id');
    $table->index('target_type', 'idx_push_logs_target_type');

    $table->foreign('empresa_id')
        ->references('id')
        ->on('af_empresas')
        ->nullOnDelete();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('push_logs');
    }
};
