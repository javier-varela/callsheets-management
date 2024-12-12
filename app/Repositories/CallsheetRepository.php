<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CallsheetRepository
{
    public function getByProjectId($project_id)
    {
        return DB::table('callsheets as c')
            ->where('c.project_id', '=', $project_id)
            ->get();
    }

    public function store($data)
    {
        return DB::table('callsheets as c')
            ->insert($data);
    }
}
