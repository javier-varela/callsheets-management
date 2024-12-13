<?php

namespace App\Services;

use App\Repositories\ReportRepository;
use App\Repositories\StatsRepository;
use Illuminate\Http\Request;

class ReportService
{
    protected $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getReport($project_id, $start_date = null, $end_date = null)
    {
        $events = $this->reportRepository->getCallsheetsEvents($project_id, $start_date, $end_date);

        // Transformar los eventos en el formato deseado
        $groupedEvents = collect($events)->groupBy('user_id')->map(function ($events, $userId) {
            $transformedEvents = $events->map(function ($event) {
                // Calcular la efectividad
                $stimated_hours = $event->stimated_hours;
                $taked_time = $event->taked_time;
                $effectivity = $stimated_hours > 0
                    ? 100 + (($stimated_hours - $taked_time) * 100 / $stimated_hours)
                    : 0; // Manejar división por cero

                return [
                    'event_id' => $event->event_id,
                    'start_date' => $event->start_date,
                    'start_hour' => $event->start_hour,
                    'stimated_hours' => $stimated_hours,
                    'status' => $event->status,
                    'description' => $event->description,
                    'callsheet_id' => $event->callsheet_id,
                    'taked_time' => $taked_time,
                    'effectivity' => $effectivity, // Agregamos la efectividad
                ];
            });

            // Calcular el promedio de efectividad
            $averageEffectivity = $transformedEvents->avg('effectivity');

            return [
                'user_id' => $userId,
                'average_effectivity' => $averageEffectivity, // Promedio de efectividad
                'events' => $transformedEvents->toArray(),
            ];
        })->values();

        return $groupedEvents;
    }






    public function getCallsheetsMinDate()
    {
        return $this->reportRepository->getCallsheetsMinDate();
    }

    public function getCallsheetsMaxDate()
    {
        return $this->reportRepository->getCallsheetsMaxDate();
    }
}
