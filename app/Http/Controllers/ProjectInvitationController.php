<?php

namespace App\Http\Controllers;

use App\Services\ProjectInvitationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectInvitationController extends Controller
{
    protected $projectInvitationService;
    public function __construct(ProjectInvitationService $projectInvitationService)
    {
        $this->projectInvitationService = $projectInvitationService;
    }
    public function getMyInvitations()
    {
        $invitations = $this->projectInvitationService->getMyInvitations();
        return Inertia::render('Dashboard/Invitations/Index', ['invitations' => $invitations]);
    }

    public function accept(int $invitation_id)
    {
        $this->projectInvitationService->updateInvitation($invitation_id, ['status' => 'accepted']);
        return redirect()->route('dashboard.invitations')->with('success', 'mensaje');
    }

    public function decline(int $invitation_id)
    {
        $this->projectInvitationService->updateInvitation($invitation_id, ['status' => 'declined']);
        return redirect()->route('dashboard.invitations')->with('success', 'Invitacion rechazada');
    }
}
