<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pomodoro_sessions', function (Blueprint $table) {
            $table->id()->unsigned();  // BIGINT UNSIGNED AUTO_INCREMENT
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign Key to users table
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('set null');  // Foreign Key to tasks table
            $table->enum('session_type', ['work', 'short_break', 'long_break']);
            $table->timestamp('start_time')->useCurrent();  // TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('end_time')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'skipped'])->default('ongoing');
            $table->timestamps(0);  // TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pomodoro_sessions');
    }
};
