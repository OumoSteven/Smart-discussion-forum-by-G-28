<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Get first user
        $user = DB::table('users')->first();
        
        if (!$user) {
            // Create a user if none exists
            $userId = DB::table('users')->insertGetId([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $user->id;
        }
        
        // Insert quiz
        DB::table('quizzes')->insert([
            'title' => 'Sample Quiz',
            'description' => 'This is a sample quiz for testing',
            'time_limit' => 10,
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $this->command->info('Quiz created successfully!');
    }
}