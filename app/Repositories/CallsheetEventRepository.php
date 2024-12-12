<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CallsheetEventRepository
{
    public function getEventsByCallsheetId($callsheet_id)
    {
        return DB::table('callsheets_events')
            ->where('callsheets_events.callsheet_id', '=', $callsheet_id)
            ->get();
    }

    public function addEvent($data)
    {
        return DB::table('callsheets_events')->insertGetId($data);
    }

    public function resolveEvent($event_id, $taked_time)
    {
        DB::table('callsheets_events')
            ->where('id', $event_id)
            ->update([
                'status' => 'resolved',
                'updated_at' => now(),
            ]);

        DB::table('event_resolution')->insert([
            'event_id' => $event_id,
            'taked_time' => $taked_time,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return true;
    }
}
