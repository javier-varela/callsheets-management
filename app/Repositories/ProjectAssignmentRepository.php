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
        return DB::table('projects_assignments')
            ->join('users', 'projects_assignments.user_id', '=', 'users.id')
            ->join('projects', 'projects_assignments.project_id', '=', 'projects.id')
            ->where('projects_assignments.id', $id)
            ->select()
            ->first();
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

    public function getAssignmentByUserId($id)
    {
        return DB::table('projects_assignments as pa')
            ->leftJoin('projects_roles as pr', 'pa.project_role_id', '=', 'pr.id')
            ->where('user_id', $id)
            ->get();
    }
    public function getAssignmentsByProjectId($project_id)
    {
        return DB::table('projects_assignments as pa')
            ->join('users', 'pa.user_id', '=', 'users.id')
            ->leftJoin('projects_roles_assignments as pra', 'pa.id', '=', 'pra.project_assignment_id')
            ->leftJoin('projects_roles as pr', 'pra.project_role_id', '=', 'pr.id') // Corrige la unión para roles
            ->select(
                'pa.id as project_assigment_id',
                'users.name as user_name',
                'users.id as user_id',
                DB::raw('GROUP_CONCAT(pr.name) as roles') // Compatible con SQLite
            )
            ->where('pa.project_id', $project_id)
            ->groupBy('users.id', 'users.name') // Agrupa por usuario
            ->get();
    }

    public function getAssignmentsWithRoleByProjectId($project_id)
    {

        return DB::table('projects_assignments')
            ->join('users', 'projects_assignments.user_id', '=', 'users.id')
            ->join('projects_roles_assignments as pra', 'projects_assignments.id', '=', 'pra.project_assignment_id')
            ->join('projects_roles as pr', 'pra.project_role_id', '=', 'pr.id')
            ->select(
                'pra.id as pra_id',
                'users.id as user_id',
                'users.name as user_name',
                'pr.name as role_name',
                'pr.id as role_id'
            )
            ->where('projects_assignments.project_id', $project_id)
            ->distinct()
            ->get();
    }



    public function deleteAssigmentsByUserId($user_id, $project_id)
    {
        return DB::table('projects_assignments')
            ->where('projects_assignments.user_id', '=', $user_id)
            ->where('projects_assignments.project_id', '=', $project_id)
            ->delete();
    }

    public function getAssignmentsByProjectIdUserId($project_id, $user_id)
    {
        return DB::table('projects_assignments')
            ->where('projects_assignments.user_id', '=', $user_id)
            ->where('projects_assignments.project_id', '=', $project_id)
            ->get();
    }
}
