<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getProjectById($id)
    {
        return $this->projectRepository->getProjectById($id);
    }

    public function createProject(Request $request)

    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['created_at'] = now()->toDateTimeString();
        $data['updated_at'] = now()->toDateTimeString();
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
}
