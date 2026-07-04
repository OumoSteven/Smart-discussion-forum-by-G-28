<?php

use App\Http\Controllers\LecturerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TopicController;
use App\Http\Middleware\EnsureUserIsStudent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [StudentController::class, 'dashboard'])
    ->middleware(['auth', EnsureUserIsStudent::class, 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', EnsureUserIsStudent::class])->group(function () {
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::get('/student/topics', [TopicController::class, 'index'])->name('student.topics.index');
    Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::get('/student/forum', [TopicController::class, 'forum'])->name('student.forum');
    Route::get('/student/forum/topic/{topic}', [TopicController::class, 'show'])->name('student.forum.show');
    Route::post('/student/forum/topic/{topic}/reply', [TopicController::class, 'storeReply'])->name('student.forum.reply');
    Route::get('/student/messages', [MessageController::class, 'index'])->name('student.messages.index');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/student/quizzes', [QuizController::class, 'index'])->name('student.quizzes.index');
    Route::post('/student/quizzes/{quiz}/start', [QuizController::class, 'start'])->name('student.quizzes.start');
    Route::get('/student/quizzes/attempt/{attempt}', [QuizController::class, 'attempt'])->name('student.quizzes.attempt');
    Route::post('/student/quizzes/attempt/{attempt}/submit', [QuizController::class, 'submitAttempt'])->name('student.quizzes.submit');
    Route::get('/student/marks', [StudentController::class, 'marks'])->name('student.marks');
    Route::get('/student/notifications', [StudentController::class, 'notifications'])->name('student.notifications');
    Route::post('/student/notifications/{notification}/read', [StudentController::class, 'markAsRead'])->name('student.notifications.read');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/lecturer/dashboard', [LecturerController::class, 'dashboard'])->name('lecturer.dashboard');
    Route::get('/lecturer/participation-grading', [LecturerController::class, 'participationGrading'])->name('lecturer.participation-grading');
    Route::get('/lecturer/quiz-management', [LecturerController::class, 'quizManagement'])->name('lecturer.quiz-management');
    Route::post('/lecturer/quiz', [QuizController::class, 'store'])->name('lecturer.quiz.store');
    Route::post('/lecturer/quiz/{id}/publish', [QuizController::class, 'publish'])->name('lecturer.quiz.publish');
    Route::get('/lecturer/quiz/{id}/edit', [QuizController::class, 'edit'])->name('lecturer.quiz.edit');
    Route::get('/lecturer/notifications', [LecturerController::class, 'notifications'])->name('lecturer.notifications');
    Route::get('/lecturer/profile', [LecturerController::class, 'profile'])->name('lecturer.profile');
});
