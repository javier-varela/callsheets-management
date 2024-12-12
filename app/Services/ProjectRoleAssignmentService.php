<?php

namespace App\Services;

use App\Repositories\ProjectRoleAssignmentRepository;
use Illuminate\Support\Facades\DB;

class ProjectRoleAssignmentService
{
    protected $repository;
    public function __construct(ProjectRoleAssignmentRepository $repository)
    {
        $this->repository = $repository;
    }
    function getByProjectAssignmentId($project_assignment_id)
    {
        return $this->repository->getByProjectAssignmentId($project_assignment_id);
    }

    function getAvaliablesRoles($project_assigment_id)
    {
        return $this->repository->getAvaliablesRoles($project_assigment_id);
    }

    function assignRoles($assignment_id, $roles_ids)
    {
        $data = array_map(function ($role_id) use ($assignment_id) {
            return [
                'project_assignment_id' => $assignment_id,
                'project_role_id' => $role_id,
                'created_at' => now(), // Añadir marcas de tiempo
                'updated_at' => now()
            ];
        }, $roles_ids);

        return $this->repository->assignRoles($data);
    }
}
