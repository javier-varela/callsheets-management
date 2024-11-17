<?php

namespace App\Services;

use App\Repositories\ProjectInvitationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectInvitationService
{
    protected $projectInvitationRepository;

    public function __construct(ProjectInvitationRepository $projectInvitationRepository)
    {
        $this->projectInvitationRepository = $projectInvitationRepository;
    }

    public function getAllInvitations()
    {
        return $this->projectInvitationRepository->getAllInvitations();
    }

    public function getInvitationById($id)
    {
        return $this->projectInvitationRepository->getInvitationById($id);
    }
    public function getInvitationsByProjectId($project_id)
    {
        return $this->projectInvitationRepository->getInvitationsByProjectId($project_id);
    }

    public function createInvitation(Request $request)
    {

        $user_ids = $request->input('user_ids');
        $project_id = $request->input('project_id');
        $sender_id =  Auth::id();
        $invitations = [];
        $date = now()->toDateTimeString();

        foreach ($user_ids as $user_id) {
            $invitations[] = [
                'project_id' => $project_id,
                'sender_id' => $sender_id,
                'invited_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 'none',  // Establecer estado por defecto
            ];
        }

        return $this->projectInvitationRepository->createInvitation($invitations);
    }

    public function updateInvitation($id, array $data)
    {
        return $this->projectInvitationRepository->updateInvitation($id, $data);
    }

    public function deleteInvitation($id)
    {
        return $this->projectInvitationRepository->deleteInvitation($id);
    }
    public function getMyInvitations()
    {
        return $this->projectInvitationRepository->getMyInvitations();
    }
}
