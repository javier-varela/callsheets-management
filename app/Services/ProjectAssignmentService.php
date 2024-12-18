<?php

namespace App\Services;

use App\Repositories\ProjectAssignmentRepository;

class ProjectAssignmentService
{
    protected $repository;

    public function __construct(ProjectAssignmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Obtener todas las asignaciones.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllAssignments()
    {
        return $this->repository->getAllAssignments();
    }

    /**
     * Obtener una asignación específica.
     *
     * @param int $id
     * @return object|null
     */
    public function getAssignmentById($id)
    {
        return $this->repository->getAssignmentById($id);
    }

    /**
     * Crear una nueva asignación.
     *
     * @param array $data
     * @return int
     */
    public function createAssignment(array $data)
    {
        return $this->repository->createAssignment($data);
    }

    /**
     * Actualizar una asignación.
     *
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateAssignment($id, array $data)
    {
        return $this->repository->updateAssignment($id, $data);
    }

    /**
     * Eliminar una asignación.
     *
     * @param int $id
     * @return int
     */
    public function deleteAssignment($id)
    {
        return $this->repository->deleteAssignment($id);
    }


    public function getAssignmentsByProjectId($project_id)
    {
        return $this->repository->getAssignmentsByProjectId($project_id);
    }

    public function getAssignmentsWithRoleByProjectId($project_id)
    {
        return $this->repository->getAssignmentsWithRoleByProjectId($project_id);
    }
    public function getAssignmentsByProjectIdUserId($project_id, $user_id)
    {
        return $this->repository->getAssignmentsByProjectIdUserId($project_id, $user_id);
    }

    public function deleteAssigmentsByUserId($user_id, $project_id)
    {
        return $this->repository->deleteAssigmentsByUserId($user_id, $project_id);
    }
}
