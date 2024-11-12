<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/dashboard/projects', [ProjectController::class, 'index'])->name('dashboard.projects');

    Route::get('/dashboard/projects/create', [ProjectController::class, 'create'])->name('dashboard.projects.create');

    Route::get('/dashboard/projects/{id}', [ProjectController::class, 'show'])->name('dashboard.projects.show');

    Route::post('/dashboard/projects', [ProjectController::class, 'store'])->name('dashboard.projects.store');

    Route::get('/dashboard/projects/{id}/edit', [ProjectController::class, 'edit'])->name('dashboard.projects.edit');
    Route::put('/dashboard/projects/{id}', [ProjectController::class, 'update'])->name('dashboard.projects.update');

    Route::delete('/dashboard/projects/{id}', [ProjectController::class, 'destroy'])->name('dashboard.projects.destroy');
});

Route::get('/admin', function () {
    return Inertia::render('Admin');
})->middleware(['auth', CheckRole::class . ':admin']);


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Welcome');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
