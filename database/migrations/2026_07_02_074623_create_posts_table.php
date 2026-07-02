<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->foreignId('topic_id')->constrained('topics', 'topic_id')->cascadeOnDelete();
            $table->foreignId('author_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('parent_post_id')->nullable()->constrained('posts', 'post_id')->nullOnDelete();
            $table->text('body');
            $table->boolean('is_question')->default(false);
            $table->boolean('is_answer')->default(false);
            $table->float('relevance_score')->default(1);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};