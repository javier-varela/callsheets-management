<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StatsRepository
{

    public function getParticipants($project_id)
    {

        return DB::table('projects_assignments')
            ->join('users', 'projects_assignments.user_id', '=', 'users.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name'
            )
            ->where('projects_assignments.project_id', $project_id)
            ->groupBy('users.id') // Agrupa los resultados por assignments
            ->distinct()
            ->get();
    }

    public function getProjectRoles($project_id, $user_id)
    {
        $query = DB::table('projects_roles as pr')
            ->join('projects_roles_assignments as pra', 'pr.id', '=', 'pra.project_role_id')
            ->join('projects_assignments as pa', 'pra.project_assignment_id', '=', 'pa.id')
            ->where('pa.project_id', '=', $project_id);

        if ($user_id) {
            $query->where('pa.user_id', '=', $user_id);
        }

        return $query->select(['pr.id', 'pr.name'])
            ->distinct()
            ->get();
    }


    public function getCallsheets($callsheets_ids = [])
    {
        return DB::table('callsheets')
            ->whereIn('callsheets.id', $callsheets_ids)
            ->get();
    }

    public function getCallsheetsEvents($projectId, $userId = null, $roleIds = [])
    {
        $query = DB::table('callsheets_events')
            ->join('event_cast', 'callsheets_events.id', '=', 'event_cast.callsheet_event_id')
            ->join('callsheets_cast', 'event_cast.callsheet_cast_id', '=', 'callsheets_cast.id')
            ->join('projects_roles_assignments', 'callsheets_cast.project_role_assignment_id', '=', 'projects_roles_assignments.id') // Correcto
            ->join('projects_assignments', 'projects_roles_assignments.project_assignment_id', '=', 'projects_assignments.id') // Correcto
            ->join('callsheets', 'callsheets_events.callsheet_id', '=', 'callsheets.id')
            ->leftJoin('event_resolution as er', 'callsheets_events.id', '=', 'er.event_id')
            ->where('callsheets.project_id', $projectId);

        // Filtro opcional por usuario
        if ($userId) {
            $query->where('projects_assignments.user_id', $userId);
        }

        // Filtro opcional por roles
        if (!empty($roleIds)) {
            $query->whereIn('projects_roles_assignments.project_role_id', $roleIds);
        }

        $result = $query->select(
            'callsheets_events.id as event_id',
            'callsheets_events.*',
            'callsheets.id as callsheet_id',
            'er.taked_time as taked_time',
            DB::raw('GROUP_CONCAT(DISTINCT projects_assignments.user_id) as user_ids') // Agrupar los user_id
        )
            ->groupBy('callsheets_events.id', 'callsheets_events.start_hour', 'callsheets_events.stimated_hours', 'callsheets_events.status', 'callsheets_events.description') // Añadir las columnas necesarias para agrupar
            ->get();

        return $result;
    }
}
