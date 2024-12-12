<?php

namespace App\Services;

use App\Repositories\EventCastRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventCastService
{
    protected $repository;

    public function __construct(EventCastRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addCast($data, $event_id)
    {
        $castsToInsert = array_map(function ($cast) use ($event_id) {
            return [
                'callsheet_cast_id' => $cast['id'], // ID de la tabla `callsheets_cast`
                'callsheet_event_id' => $event_id,  // ID del evento recién creado
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $data);
        return $this->repository->addCast($castsToInsert);
    }
}
