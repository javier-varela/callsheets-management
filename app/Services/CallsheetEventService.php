<?php

namespace App\Services;

use App\Repositories\CallsheetEventRepository;
use Illuminate\Support\Facades\DB;

class CallsheetEventService
{
    protected $repository;
    public function __construct(CallsheetEventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getEventsByCallsheetId($callsheet_id)
    {
        return $this->repository->getEventsByCallsheetId($callsheet_id);
    }

    public function addEvent($data)
    {
        $eventData = [
            'start_hour' => $data['start_hour'],
            'stimated_hours' => $data['stimated_hours'],
            'description' => $data['description'],
            'status' => 'pending', // Estado inicial
            'callsheet_id' => $data['callsheet_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        return $this->repository->addEvent($eventData);
    }

    public function resolveEvent($event_id, $taked_time)
    {
        return $this->repository->resolveEvent($event_id, $taked_time);
    }
}
