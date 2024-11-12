<?php

namespace App\Services;

use App\Repositories\ProjectInvitationRepository;

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

    public function createInvitation(array $data)
    {
        return $this->projectInvitationRepository->createInvitation($data);
    }

    public function updateInvitation($id, array $data)
    {
        return $this->projectInvitationRepository->updateInvitation($id, $data);
    }

    public function deleteInvitation($id)
    {
        return $this->projectInvitationRepository->deleteInvitation($id);
    }
}
