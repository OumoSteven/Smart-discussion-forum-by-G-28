<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id('answer_id');
            $table->foreignId('attempt_id')->constrained('quiz_attempts', 'attempt_id')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions', 'question_id')->cascadeOnDelete();
            $table->string('selected', 10)->nullable();
            $table->boolean('is_correct')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};