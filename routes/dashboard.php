
<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectInvitationController;
use App\Http\Middleware\VerifyProjectOwnership;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    // Ruta principal del dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Agrupamos las rutas de proyectos
    Route::prefix('dashboard/projects')->name('dashboard.projects.')->group(function () {
        // Rutas sin validación de propietario
        Route::get('/my-projects', [ProjectController::class, 'index'])->name('index');
        Route::get('/other-projects', [ProjectController::class, 'otherProjects'])->name('otherprojects');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/', [ProjectController::class, 'store'])->name('store');

        // Rutas con validación de propietario
        Route::middleware(VerifyProjectOwnership::class)->group(function () {
            Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProjectController::class, 'update'])->name('update');
            Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('destroy');
        });

        // Rutas adicionales relacionadas con proyectos
        Route::post('/invite', [ProjectInvitationController::class, 'invite'])->name('invite');
    });

    // Otras rutas no relacionadas con proyectos
    Route::prefix('dashboard/invitations')->name('dashboard.invitations.')->group(function () {
        Route::get('/', [ProjectInvitationController::class, 'getMyInvitations'])->name('index');
        Route::post('/accept', [ProjectInvitationController::class, 'accept'])->name('accept');
        Route::post('/decline/{invitation_id}', [ProjectInvitationController::class, 'decline'])->name('decline');
    });
});
