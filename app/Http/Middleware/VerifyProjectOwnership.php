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
        $projectId = $request->route('id');
        $userId = Auth::id();

        // Verifica si el proyecto pertenece al usuario autenticado
        if (!$this->projectService->isOwner($projectId, $userId)) {
            return redirect()
                ->route('dashboard.projects.index')
                ->with('warning', 'No tienes permiso para acceder a este proyecto.');
        }

        return $next($request);
    }
}
