<?php

namespace App\Http\Controllers;

use App\Services\ProjectRoleAssignmentService;
use App\Services\ProjectAssignmentService;
use App\Services\ProjectRoleService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectAssignmentController extends Controller
{
    protected $projectAssignmentService;
    protected $projectRoleService;
    protected $projectRoleAssignmentService;
    public function __construct(
        ProjectAssignmentService $projectAssignmentService,
        ProjectRoleService $projectRoleService,
        ProjectRoleAssignmentService $projectRoleAssignmentService
    ) {
        $this->projectAssignmentService = $projectAssignmentService;
        $this->projectRoleService = $projectRoleService;
        $this->projectRoleAssignmentService = $projectRoleAssignmentService;
    }

    public function editParticipant($assignment_id) //assignment_id`
    {
        $roles_assignments = $this->projectRoleAssignmentService->getByProjectAssignmentId($assignment_id);
        $avaliables_roles = $this->projectRoleAssignmentService->getAvaliablesRoles($assignment_id);

        return Inertia::render(
            'Dashboard/Projects/Admin/EditParticipant',
            [
                'roles_assignments' => $roles_assignments,
                'avaliables_roles' => $avaliables_roles,
                'assignment_id' => $assignment_id
                // 'participant_roles' => $participant_roles
            ]
        );
    }

    public function assignRole(Request $request)
    {
        $roles_ids = json_decode($request->input('roles_ids'));
        $assignment_id = $request->input('assignment_id');
        $this->projectRoleAssignmentService->assignRoles($assignment_id, $roles_ids);
        return redirect()->route('dashboard.projects.admin.editParticipant', ['assignment_id' => $assignment_id])
            ->with('success', 'Roles asignados correctamente');
    }
}
