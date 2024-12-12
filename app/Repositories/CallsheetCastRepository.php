<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class CallsheetCastRepository
{
    public function addCast($data)
    {
        return DB::table('callsheets_cast')
            ->insert($data);
    }

    public function getCastByCallsheetId($callsheet_id)
    {
        return DB::table('callsheets_cast as cc')
            ->join('projects_roles_assignments as pra', 'cc.project_role_assignment_id', '=', 'pra.id')
            ->join('projects_roles as pr', 'pra.project_role_id', '=', 'pr.id')
            ->join('projects_assignments as pa', 'pra.project_assignment_id', '=', 'pa.id')
            ->join('users', 'pa.user_id', '=', 'users.id')
            ->where('cc.callsheet_id', '=', $callsheet_id)  // Cambiar 'cc.id' a 'cc.callsheet_id'
            ->select('cc.*', 'pr.name as project_role_name', 'users.name as user_name')  // Seleccionar las columnas adecuadas
            ->get();
    }
}
