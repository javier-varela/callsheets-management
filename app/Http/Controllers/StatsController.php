<?php

namespace App\Http\Controllers;

use App\Services\CallsheetEventService;
use App\Services\StatsService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatsController extends Controller
{
    protected $statsService;
    protected $callsheetEventService;
    public function __construct(StatsService $statsService, CallsheetEventService $callsheetEventService)
    {
        $this->statsService = $statsService;
        $this->callsheetEventService = $callsheetEventService;
    }
    public function stats($project_id, Request $request)
    {
        $data = $request->all();
        $user_id = null;
        $request_roles = [];
        $project_efectivity = 100; // Default value in case no event has effectiveness

        if (!empty($data)) {
            $user_id = $data['user_id'];
            $request_roles = json_decode($data['request_roles']);
        }

        // Obtener roles del proyecto, participantes y eventos
        $project_roles = $this->statsService->getProjectRoles($project_id, $user_id);
        $participants = $this->statsService->getParticipants($project_id, $user_id);
        $events =  $this->statsService->getCallsheetsEvents($project_id, $user_id, $request_roles);

        // Obtener los ids de los callsheets asociados a los eventos
        $callsheets_ids = array_unique($events->pluck('callsheet_id')->toArray());
        $callsheets = $this->statsService->getCallsheets($callsheets_ids);

        // Variable para acumular las efectividades
        $total_efectivity = 0;
        $valid_events_count = 0;

        // Agrupar eventos por callsheet
        foreach ($callsheets as $callsheet) {
            $callsheet->events = [];

            // Filtrar eventos para el callsheet actual
            $filteredEvents = array_filter($events->toArray(), function ($event) use ($callsheet) {
                return $event->callsheet_id === $callsheet->id;
            });

            // Calcular la efectividad de cada evento y asignar al callsheet
            $callsheet->events = array_map(function ($event) use (&$total_efectivity, &$valid_events_count) {
                if ($event->status === 'resolved' && !is_null($event->taked_time)) {
                    $stimated_hours = $event->stimated_hours;
                    $taked_time = $event->taked_time;

                    // Calcular la efectividad
                    $efectivity = 100 + (($stimated_hours - $taked_time) * 100 / $stimated_hours);

                    // Asegurarse de que la efectividad no sea mayor a 100%
                    $efectivity = min($efectivity, 100);
                    $event->efectivity = $efectivity;

                    // Sumar la efectividad para el cálculo del promedio
                    $total_efectivity += $efectivity;
                    $valid_events_count++;
                } else {
                    $event->efectivity = null;
                }

                return $event;
            }, array_values($filteredEvents)); // array_values asegura un array indexado correctamente
        }

        // Calcular el promedio de efectividad, asegurándose de que no supere 100%
        if ($valid_events_count > 0) {
            $project_efectivity = min($total_efectivity / $valid_events_count, 100);
        }

        return Inertia::render(
            'Dashboard/Projects/Admin/Stats/Show',
            [
                'project_roles' => $project_roles,
                'participants' => $participants,
                'callsheets' => $callsheets,
                'project_efectivity' => $project_efectivity, // Pasar la efectividad del proyecto
                'project_id' => $project_id
            ]
        );
    }


    public function resolveEvent(Request $request)
    {
        $event_id = $request->input('event_id');
        $taked_time = $request->input('taked_time');
        $this->callsheetEventService->resolveEvent($event_id, $taked_time);
        return redirect()->to($request->header('referer'))->with('success', 'evento resuelto con exito');
    }
}
