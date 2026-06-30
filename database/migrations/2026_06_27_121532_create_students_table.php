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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        // // Your Student-ID FK pointing back to user_id
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('registration_id')->unique();
        $table->string('group_id')->nullable();
        $table->string('course');
        $table->string('college');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
//     public function down(): void
//     {
//         Schema::table('students', function (Blueprint $table) {
//             //
//         });
//     }
 };
