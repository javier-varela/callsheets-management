<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return Inertia::render('Admin');
})->middleware(['auth', CheckRole::class . ':admin']);  // Aquí pasas el rol como parámetro


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
