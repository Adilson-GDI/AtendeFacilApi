<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('push_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200)->nullable();
            $table->text('body')->nullable();
            $table->string('image', 500)->nullable();
            $table->string('page', 100)->nullable();
            $table->string('destino', 20)->nullable();
            $table->text('token_destino')->nullable();
            $table->string('topic', 100)->nullable();
            $table->string('user_id', 50)->nullable();
            $table->dateTime('send_at')->nullable();
            $table->boolean('sent')->default(false);
            $table->dateTime('created_at')->useCurrent();

            $table->index(['sent', 'send_at'], 'idx_push_schedule_sent_send_at');
            $table->index('destino', 'idx_push_schedule_destino');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('push_schedule');
    }
};
