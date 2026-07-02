<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->foreignId('quiz_id')->constrained('quizzes', 'quiz_id')->cascadeOnDelete();
            $table->text('text');
            $table->json('options');
            $table->string('correct_option', 10);
            $table->unsignedInteger('marks')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};