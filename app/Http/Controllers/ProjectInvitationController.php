<?php

namespace App\Http\Controllers;

use App\Services\ProjectAssignmentService;
use App\Services\ProjectInvitationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectInvitationController extends Controller
{
    protected $projectInvitationService;
    protected $projectAssignmentsService;
    public function __construct(ProjectInvitationService $projectInvitationService, ProjectAssignmentService $projectAssignmentsService)
    {
        $this->projectInvitationService = $projectInvitationService;
        $this->projectAssignmentsService = $projectAssignmentsService;
    }
    public function getMyInvitations()
    {
        $invitations = $this->projectInvitationService->getMyInvitations();
        return Inertia::render('Dashboard/Invitations/Index', ['invitations' => $invitations]);
    }

    public function accept(Request $request)
    {

        $this->projectInvitationService->updateInvitation(
            $request->input('invitation_id'),
            ['status' => 'accepted']
        );

        $this->projectAssignmentsService->createAssignment([
            'project_id' => $request->input('project_id'),
            'role_name' => 'None',
            'user_id' => $request->input('invited_id'),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);
        return redirect()->route('dashboard.invitations')->with('success', 'mensaje');
    }

    public function invite(Request $request)
    {
        $this->projectInvitationService->createInvitation($request);
        $project_id = $request->input('project_id');
        return redirect('/dashboard/projects/' . $project_id);
    }

    public function decline(int $invitation_id)
    {
        $this->projectInvitationService->updateInvitation($invitation_id, ['status' => 'declined']);
        return redirect()->route('dashboard.invitations')->with('success', 'Invitacion rechazada');
    }
}
