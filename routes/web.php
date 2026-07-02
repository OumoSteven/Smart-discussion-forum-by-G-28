<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController; // Imported your QuizController
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Authenticated Routes Group
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ============================================
    // QUIZ ROUTES - Everyone can view and take quizzes
    // ============================================
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/history', [QuizController::class, 'history'])->name('quizzes.history');
    Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    
    // ============================================
    // QUIZ MANAGEMENT - Only lecturers and admins
    // ============================================
  Route::middleware([\App\Http\Middleware\IsLecturer::class])->group(function () {
    Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
    Route::delete('/quizzes/{id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
});
});

// Admin Routes Group - Update to use is.lecturer middleware
Route::prefix('admin')
    ->middleware(['auth', 'is.lecturer'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });

// Messages
Route::get('/messages', function () {
    return view('messages.index');
})->name('messages.index');

// Topics
Route::get('/topics', function () {
    return view('topics.index');
})->name('topics.index');

// Announcements
Route::get('/announcements', function () {
    return view('announcements.index');
})->name('announcements.index');

require __DIR__.'/auth.php';



// TEMPORARY DEBUG ROUTE - Remove after fixing
Route::get('/fix-quiz', function() {
    $currentDb = config('database.connections.mysql.database');
    
    // Check if quizzes table exists
    try {
        DB::select('SELECT 1 FROM quizzes LIMIT 1');
        $tableExists = true;
    } catch (\Exception $e) {
        $tableExists = false;
        $error = $e->getMessage();
    }
    
    // Get quizzes if table exists
    if ($tableExists) {
        $quizzes = DB::select('SELECT * FROM quizzes');
        $count = count($quizzes);
    } else {
        $quizzes = [];
        $count = 0;
    }
    
    // If no quizzes, create one
    if ($count == 0 && $tableExists) {
        try {
            // Get first user
            $user = DB::select('SELECT id FROM users LIMIT 1');
            $userId = $user ? $user[0]->id : 1;
            
            DB::insert('INSERT INTO quizzes (title, description, time_limit, user_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [
                'Sample Quiz',
                'Test quiz description',
                10,
                $userId,
                now(),
                now()
            ]);
            
            $quizzes = DB::select('SELECT * FROM quizzes');
            $count = count($quizzes);
            $message = "✅ Quiz created successfully!";
        } catch (\Exception $e) {
            $message = "❌ Error creating quiz: " . $e->getMessage();
        }
    } else {
        $message = $tableExists ? "✅ Found " . $count . " quiz(es)" : "❌ Quizzes table doesn't exist!";
    }
    
    // Check both databases
    $dbInfo = [
        'current_database' => $currentDb,
        'table_exists' => $tableExists,
        'quizzes_count' => $count,
        'quizzes' => $quizzes,
        'message' => $message,
        'database_config' => [
            'host' => config('database.connections.mysql.host'),
            'port' => config('database.connections.mysql.port'),
            'database' => config('database.connections.mysql.database'),
        ]
    ];
    
    return response()->json($dbInfo);
});


Route::get('/test-quiz/{id}', function($id) {
    try {
        $quiz = \App\Models\Quiz::find($id);
        if (!$quiz) {
            return "No quiz found with ID: " . $id;
        }
        return [
            'id' => $quiz->id,
            'title' => $quiz->title,
            'description' => $quiz->description,
            'exists' => true
        ];
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

//add quiz route
Route::get('/add-questions-to-quiz/{id}', function($id) {
    try {
        // Check if quiz exists
        $quiz = DB::select('SELECT * FROM quizzes WHERE id = ?', [$id]);
        if (empty($quiz)) {
            return "❌ Quiz with ID {$id} not found!";
        }
        
        // Check if questions table exists
        try {
            DB::select('SELECT 1 FROM questions LIMIT 1');
        } catch (\Exception $e) {
            return "❌ Questions table doesn't exist! Please create the questions table first.";
        }
        
        // Check if questions already exist for this quiz
        $existing = DB::select('SELECT COUNT(*) as count FROM questions WHERE quiz_id = ?', [$id]);
        if ($existing[0]->count > 0) {
            return "⚠️ This quiz already has " . $existing[0]->count . " questions!<br><br>
                    <a href='/quizzes/{$id}' style='color: blue; text-decoration: underline; font-size: 18px;'>Take the quiz now</a>";
        }
        
        // Add questions
        $questions = [
            [
                'question_text' => 'What is the capital of France?',
                'option_a' => 'London',
                'option_b' => 'Paris',
                'option_c' => 'Berlin',
                'option_d' => 'Madrid',
                'correct_option' => 'b'
            ],
            [
                'question_text' => 'What is 2+2?',
                'option_a' => '3',
                'option_b' => '4',
                'option_c' => '5',
                'option_d' => '6',
                'correct_option' => 'b'
            ],
            [
                'question_text' => 'Which planet is known as the Red Planet?',
                'option_a' => 'Venus',
                'option_b' => 'Mars',
                'option_c' => 'Jupiter',
                'option_d' => 'Saturn',
                'correct_option' => 'b'
            ]
        ];
        
        $added = 0;
        foreach ($questions as $q) {
            DB::insert(
                'INSERT INTO questions (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option, created_at, updated_at) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $id,
                    $q['question_text'],
                    $q['option_a'],
                    $q['option_b'],
                    $q['option_c'],
                    $q['option_d'],
                    $q['correct_option'],
                    now(),
                    now()
                ]
            );
            $added++;
        }
        
        return "✅ Added {$added} questions to quiz ID: {$id}!<br><br>
                <a href='/quizzes/{$id}' style='color: blue; text-decoration: underline; font-size: 18px;'>👉 Click here to take the quiz</a>";
        
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage() . "<br><br>File: " . $e->getFile() . "<br>Line: " . $e->getLine();
    }
});

// Test the Quiz Model
Route::get('/test-model', function() {
    try {
        $quizzes = \App\Models\Quiz::all();
        return [
            'count' => $quizzes->count(),
            'quizzes' => $quizzes->map(function($q) {
                return [
                    'id' => $q->id,
                    'title' => $q->title,
                    'description' => $q->description,
                ];
            })
        ];
    } catch (\Exception $e) {
        return [
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ];
    }
});