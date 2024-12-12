<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;


class ProjectRoleAssignmentRepository
{
    function getByProjectAssignmentId($project_assignment_id)
    {
        return DB::table('projects_roles_assignments as pra')
            ->join('projects_roles as pr', 'pra.project_role_id', '=', 'pr.id')
            ->where('pra.project_assignment_id', '=', $project_assignment_id)
            ->select(['pr.id', 'pr.name'])
            ->get();
    }

    function getAvaliablesRoles($project_assignment_id)
    {
        return DB::table('projects_roles as pr')
            ->leftJoin('projects_roles_assignments as pra', 'pr.id', '=', 'pra.project_role_id')
            ->whereNull('pra.project_role_id') // Verifica que no haya asignaciones para ese rol
            // ->orWhere('pra.project_assignment_id', '<>', $project_assignment_id) // Verifica que el project_assignment_id no esté en la asignación
            ->get(['pr.id', 'pr.name as name']);
    }

    function assignRoles($data)
    {
        return DB::table('projects_roles_assignments')
            ->insert($data);
    }
}
