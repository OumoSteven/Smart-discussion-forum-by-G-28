<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_exclusions', function (Blueprint $table) {
            $table->id('exclusion_id');
            $table->foreignId('message_id')->constrained('messages', 'message_id')->cascadeOnDelete();
            $table->foreignId('excluded_user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->unique(['message_id', 'excluded_user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_exclusions');
    }
};