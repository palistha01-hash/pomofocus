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
        Schema::create('task_progress', function (Blueprint $table) {
            $table->id()->unsigned();  // BIGINT UNSIGNED AUTO_INCREMENT
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');  // Foreign Key to tasks table
            $table->integer('completed_pomodoros')->default(0);
            $table->integer('estimated_time_minutes')->default(0);
            $table->timestamps(0);  // TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_progress');
    }
};
