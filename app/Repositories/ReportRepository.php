<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportRepository
{
    public function getEvents($project_id, $start_date = null, $end_date = null)
    {


        $query = DB::table('callsheets_events')
            ->join('callsheets', 'callsheets_events.callsheet_id', '=', 'callsheets.id')
            ->join('event_cast', 'callsheets_events.id', '=', 'event_cast.callsheet_event_id')
            ->join('callsheets_cast', 'event_cast.callsheet_cast_id', '=', 'callsheets_cast.id')
            ->join('projects_roles_assignments', 'callsheets_cast.project_role_assignment_id', '=', 'projects_roles_assignments.id')
            ->join('projects_assignments', 'projects_roles_assignments.project_assignment_id', '=', 'projects_assignments.id')
            ->join('users', 'projects_assignments.user_id', '=', 'users.id')
            ->join('projects_roles as pr', 'projects_roles_assignments.project_role_id', '=', 'pr.id')
            ->leftJoin('event_resolution as er', 'callsheets_events.id', '=', 'er.event_id')
            ->where('callsheets.project_id', $project_id);

        // Convertir fechas al formato de la base de datos
        if ($start_date) {
            $start_date = Carbon::parse($start_date)->toDateTimeString();
        }

        if ($end_date) {
            $end_date = Carbon::parse($end_date)->toDateTimeString();
        }

        // Condición para rango de fechas
        if ($start_date && $end_date) {
            $query->whereBetween('callsheets.start_date', [$start_date, $end_date]);
        } elseif ($start_date) {
            $query->where('callsheets.start_date', '>=', $start_date);
        } elseif ($end_date) {
            $query->where('callsheets.start_date', '<=', $end_date);
        }

        $result = $query->select()->get();

        return $result;
    }

    public function getCallsheetsEvents($projectId, $start_date = null, $end_date = null)
    {
        $query = DB::table('callsheets_events')
            ->join('event_cast', 'callsheets_events.id', '=', 'event_cast.callsheet_event_id')
            ->join('callsheets_cast', 'event_cast.callsheet_cast_id', '=', 'callsheets_cast.id')
            ->join('projects_roles_assignments', 'callsheets_cast.project_role_assignment_id', '=', 'projects_roles_assignments.id') // Correcto
            ->join('projects_assignments', 'projects_roles_assignments.project_assignment_id', '=', 'projects_assignments.id') // Correcto
            ->join('callsheets', 'callsheets_events.callsheet_id', '=', 'callsheets.id')
            ->leftJoin('event_resolution as er', 'callsheets_events.id', '=', 'er.event_id')
            ->where('callsheets.project_id', $projectId);

        // Condición para rango de fechas
        if ($start_date && $end_date) {
            $query->whereBetween('callsheets.start_date', [$start_date, $end_date]);
        } elseif ($start_date) {
            $query->where('callsheets.start_date', '>=', $start_date);
        } elseif ($end_date) {
            $query->where('callsheets.start_date', '<=', $end_date);
        }
        $result = $query->select(
            'callsheets_events.id as event_id',
            'callsheets_events.*',
            'callsheets.id as callsheet_id',
            'er.taked_time as taked_time',
            'projects_assignments.user_id as user_id', // Agrupar los user_id
            'callsheets.start_date as start_date'
        )
            ->get();

        return $result;
    }


    public function getCallsheetsMinDate()
    {
        return DB::table('callsheets')->min('start_date');
    }

    public function getCallsheetsMaxDate()
    {
        return DB::table('callsheets')->max('start_date');
    }
}
