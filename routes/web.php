<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\QuizController;
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