<?php

namespace App\Services;

use App\Repositories\StatsRepository;
use Illuminate\Http\Request;

class StatsService
{
    protected $statsRepository;

    public function __construct(StatsRepository $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getParticipants($project_id)
    {
        return $this->statsRepository->getParticipants($project_id);
    }
    public function getCallsheets($callsheets_ids = [])
    {
        return $this->statsRepository->getCallsheets($callsheets_ids);
    }

    function getCallsheetsEvents($project_id, $user_id = null, $roleIds = [])
    {
        return $this->statsRepository->getCallsheetsEvents($project_id, $user_id, $roleIds);
    }

    public function getProjectRoles($project_id, $user_id)
    {
        return $this->statsRepository->getProjectRoles($project_id, $user_id);
    }
}
