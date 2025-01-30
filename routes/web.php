<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinciasController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CantonesController;
use App\Http\Controllers\ParroquiasController;
use Inertia\Inertia;


//api

Route::middleware(['auth', "verified"])->group(function () {
    Route::get('/api/users_to_invite/{project_id}', [UserController::class, 'getSelectUsersToInvite'])->name("api.users_to_invite.show");
    Route::get('/api/provincias/get-all', [ProvinciasController::class, 'getAll'])->name('api.provincias.getall');
    Route::get('/api/cantones/get-all/{idProvincia?}', [CantonesController::class, 'getAll'])->name('api.cantones.getall');
    Route::get('/api/parroquias/get-all/{idCanton?}', [ParroquiasController::class, 'getAll'])->name('api.parroquias.getall');
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
require __DIR__ . '/dashboard.php';
