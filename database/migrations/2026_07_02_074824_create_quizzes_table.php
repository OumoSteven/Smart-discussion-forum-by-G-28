<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id('quiz_id');
            $table->foreignId('group_id')->constrained('groups', 'group_id')->cascadeOnDelete();
            $table->foreignId('lecturer_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('title', 200);
            $table->timestamp('start_at');
            $table->unsignedInteger('duration_minutes');
            $table->string('target_category', 80)->nullable();
            $table->enum('status', ['draft', 'scheduled', 'open', 'closed'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};