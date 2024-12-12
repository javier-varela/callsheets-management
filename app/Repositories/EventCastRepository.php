<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventCastRepository
{
    public function addCast($data)
    {
        DB::table('event_cast')->insert($data);
    }
}
