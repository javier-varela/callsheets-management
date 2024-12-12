<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Services\ProjectService; // Asegúrate de que el namespace sea correcto

class VerifyProjectOwnership
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function handle($request, Closure $next)
    {
        // $projectId = $request->route('id');
        // $userId = Auth::id();
        // $project = $this->projectService->getProjectById($projectId);


        // // Verifica si el proyecto pertenece al usuario autenticado
        // if (!($project && $project->user_id === $userId)) {
        //     return redirect()
        //         ->route('dashboard.projects.index')
        //         ->with('warning', 'No tienes los permisos necesarios'); //dashboard.projects.admin.index
        // }

        return $next($request);
    }
}
