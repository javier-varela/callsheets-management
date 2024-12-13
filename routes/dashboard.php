
<?php

use App\Http\Controllers\CallsheetsController;
use App\Http\Controllers\ProjectAssignmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectInvitationController;
use App\Http\Controllers\StatsController;
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
        Route::get('/guest/{id}', [ProjectController::class, 'showGuest'])->name('guest.show'); //metodo pendiente


        // Rutas con validación de propietario
        Route::middleware(VerifyProjectOwnership::class)->prefix('admin')->group(function () {
            Route::get('/{project_id}', [ProjectController::class, 'showAdmin'])->name('admin.show');
            Route::get('/{project_id}/edit', [ProjectController::class, 'edit'])->name('admin.edit');
            Route::put('/{id}', [ProjectController::class, 'update'])->name('admin.update');
            Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('admin.destroy');

            //participants
            Route::get('/participant/{assignment_id}', [ProjectAssignmentController::class, 'editParticipant'])->name('admin.editParticipant');

            Route::post('/participant/assign_role', [ProjectAssignmentController::class, 'assignRole'])->name('admin.assignRole');

            //callsheets

            Route::get('/{project_id}/callsheets', [CallsheetsController::class, 'index'])->name('admin.callsheets');
            Route::post('/{project_id}/callsheets/store', [CallsheetsController::class, 'store'])->name('admin.callsheets.store');

            Route::get('{project_id}/callsheets/{callsheet_id}', [CallsheetsController::class, 'show'])->name('admin.callsheets.show');

            //callsheetCast
            Route::post('callsheets/addCast', [CallsheetsController::class, 'addCast'])->name('admin.callsheets.cast.add');


            //events
            Route::post('callsheets/addEvent', [CallsheetsController::class, 'addEvent'])->name('admin.callsheets.event.add');


            //
            Route::get('/report/{project_id}', [StatsController::class, 'report'])->name('admin.report');


            //core

            Route::get('/stats/{project_id}', [StatsController::class, 'stats'])->name('admin.stats');

            Route::post('/stats/resolveEvent', [StatsController::class, 'resolveEvent'])->name('admin.stats.event.resolve');
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
