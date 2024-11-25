<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProjectAssignmentRepository
{
    /**
     * Obtener todas las asignaciones de proyectos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllAssignments()
    {
        return DB::table('projects_assignments')->get();
    }

    /**
     * Obtener una asignación por su ID.
     *
     * @param int $id
     * @return object|null
     */
    public function getAssignmentById($id)
    {
        return DB::table('projects_assignments')->find($id);
    }

    /**
     * Crear una nueva asignación.
     *
     * @param array $data
     * @return int ID de la nueva asignación.
     */
    public function createAssignment(array $data)
    {
        return DB::table('projects_assignments')->insertGetId($data);
    }

    /**
     * Actualizar una asignación existente.
     *
     * @param int $id
     * @param array $data
     * @return int Afectadas las filas.
     */
    public function updateAssignment($id, array $data)
    {
        return DB::table('projects_assignments')
            ->where('id', $id)
            ->update($data);
    }

    /**
     * Eliminar una asignación.
     *
     * @param int $id
     * @return int Afectadas las filas.
     */
    public function deleteAssignment($id)
    {
        return DB::table('projects_assignments')
            ->where('id', $id)
            ->delete();
    }

    public function getAssingmentsByUserId($id)
    {
        return DB::table('projects_assignments')
            ->where('user_id', $id)
            ->get();
    }

    public function getAssignmentsByProjectId($project_id)
    {
        return DB::table('projects_assignments')
            ->join('users', 'projects_assignments.user_id', '=', 'users.id')
            ->select(
                'projects_assignments.*',
                'users.name as user_name'
            )
            ->where('projects_assignments.project_id', $project_id)
            ->get();
    }
}
