<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::resource('tasks', TaskController::class);
    Route::post('tasks/{task}/generate-public-link', [TaskController::class, 'generatePublicLink'])->name('tasks.generatePublicLink');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('public/tasks/{token}', [TaskController::class, 'showPublic'])->name('tasks.showPublic');

require __DIR__ . '/auth.php';
