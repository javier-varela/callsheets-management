<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllProjects()
    {
        return $this->projectRepository->getAllProjects();
    }


    public function getAllUserProjects()
    {
        return $this->projectRepository->getAllUserProjects(Auth::id());
    }

    public function getProjectById($id)
    {
        $project = $this->projectRepository->getProjectById($id);

        return $project;
    }


    public function createProject(Request $request)
    {
        // Validar que el título no esté vacío
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', // Validación del título
        ]);

        // Preparar los datos para el proyecto
        $data = $validatedData;
        $data['user_id'] = Auth::id();
        $data['created_at'] = now()->toDateTimeString();
        $data['updated_at'] = now()->toDateTimeString();

        // Crear el proyecto
        $response = $this->projectRepository->createProject($data);

        return $response;
    }


    public function updateProject($id, array $data)
    {
        return $this->projectRepository->updateProject($id, $data);
    }

    public function deleteProject($id)
    {
        return $this->projectRepository->deleteProject($id);
    }


    public function getAllParticipateProjects()
    {
        return $this->projectRepository->getAllParticipateProjects(Auth::id());
    }
}
