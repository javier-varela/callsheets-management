<?php

namespace App\Http\Controllers;

use App\Services\CallsheetCastService;
use App\Services\CallsheetEventService;
use App\Services\CallsheetService;
use App\Services\EventCastService;
use App\Services\ProjectAssignmentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CallsheetsController extends Controller
{
    protected $callsheetService;
    protected $callsheetEventService;
    protected $eventCastService;
    protected $projectAssignmentService;
    protected $callsheetCastService;

    public function __construct(
        CallsheetService $callsheetService,
        CallsheetEventService $callsheetEventService,
        EventCastService $eventCastService,
        ProjectAssignmentService $projectAssignmentService,
        CallsheetCastService $callsheetCastService
    ) {
        $this->callsheetService = $callsheetService;
        $this->callsheetEventService = $callsheetEventService;
        $this->eventCastService = $eventCastService;
        $this->projectAssignmentService = $projectAssignmentService;
        $this->callsheetCastService = $callsheetCastService;
    }
    public function index($project_id)
    {
        $callsheets = $this->callsheetService->getByProjectId($project_id);

        return Inertia::render(
            'Dashboard/Projects/Admin/Callsheets/Index',
            [
                'callsheets' => $callsheets,
                'project_id' => $project_id
            ]
        );
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->callsheetService->store($data);
        return redirect()->route('dashboard.projects.admin.callsheets', ['project_id' => $data['project_id']])
            ->with('success', 'Hoja de llamado creada correctamente');
    }

    public function show($project_id, $callsheet_id)
    {
        $events = $this->callsheetEventService->getEventsByCallsheetId($callsheet_id);
        $project_participants = $this->projectAssignmentService->getAssignmentsWithRoleByProjectId($project_id);
        $callsheet_cast = $this->callsheetCastService->getCastByCallsheetId($callsheet_id);
        $callsheet = $this->callsheetService->getByProjectId($project_id)[0];
        return Inertia::render(
            'Dashboard/Projects/Admin/Callsheets/Show',
            [
                'events' => $events,
                'project_participants' => $project_participants,
                'callsheet_id' => $callsheet_id,
                'project_id' => $project_id,
                'callsheet_cast' => $callsheet_cast,
                'callsheet' => $callsheet
            ]
        );
    }

    public function addCast(Request $request)
    {
        $cast = json_decode($request->input('callsheet_cast'));
        $callsheet_id = $request->input('callsheet_id');
        $project_id = $request->input('project_id');
        $this->callsheetCastService->addCast($cast, $callsheet_id);
        return redirect()->route(
            'dashboard.projects.admin.callsheets.show',
            [
                'project_id' => $project_id,
                'callsheet_id' => $callsheet_id
            ]
        )->with('success', 'Cast agregado correctamente');
    }

    public function addEvent(Request $request)
    {
        $data = $request->all();

        $eventId = $this->callsheetEventService->addEvent($data);

        if (!empty($data['event_cast'])) {
            $eventCastData = json_decode($data['event_cast'], true); // Convertir JSON a arra

            $this->eventCastService->addCast($eventCastData, $eventId);
        }

        return redirect()->route(
            'dashboard.projects.admin.callsheets.show',
            [
                'project_id' => $data['project_id'],
                'callsheet_id' => $data['callsheet_id']
            ]
        )->with('success', 'Cast agregado correctamente');
    }
}
