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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->unsigned();  // BIGINT UNSIGNED AUTO_INCREMENT
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign Key to users table
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('estimated_pomodoros')->default(1);
            $table->boolean('completed')->default(false);
            $table->timestamps(0);  // TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
