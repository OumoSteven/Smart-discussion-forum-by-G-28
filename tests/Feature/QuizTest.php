<?php

use App\Models\Quiz;
use App\Models\User;

test('authenticated users can create and submit a quiz', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/quizzes', [
            'title' => 'Sample Quiz',
            'description' => 'A sample quiz for testing',
            'time_limit' => 10,
            'questions' => [[
                'text' => 'What is 2 + 2?',
                'a' => '3',
                'b' => '4',
                'c' => '5',
                'd' => '6',
                'correct' => 'b',
            ]],
        ]);

    $response->assertRedirect('/quizzes');
    $this->assertDatabaseHas('quizzes', ['title' => 'Sample Quiz', 'user_id' => $user->id], 'quiz_db');

    $quiz = Quiz::where('title', 'Sample Quiz')->firstOrFail();

    $showResponse = $this->actingAs($user)->get('/quizzes/' . $quiz->id);
    $showResponse->assertOk();

    $submitResponse = $this->actingAs($user)->post('/quizzes/' . $quiz->id . '/submit', [
        'answers' => [
            $quiz->questions()->first()->id => 'b',
        ],
    ]);

    $submitResponse->assertRedirect('/quizzes');
    $this->assertDatabaseHas('student_quizzes', ['quiz_id' => $quiz->id, 'user_id' => $user->id, 'score' => 1], 'quiz_db');
});

test('authenticated users can view quiz history', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/quizzes/history');

    $response->assertOk();
});
