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

use App\Http\Controllers\Admin\AdminDashboardController;

Route::prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');
    });
// message
    Route::get('/messages', function () {
    return view('messages.index');
})->name('messages.index');

// topics
Route::get('/topics', function () {
    return view('topics.index');
})->name('topics.index');

// announcement

  Route::get('/announcements', function () {
    return view('announcements.index');
})->name('announcements.index');
