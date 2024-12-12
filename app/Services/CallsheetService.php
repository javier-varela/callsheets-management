<?php

namespace App\Services;

use App\Repositories\CallsheetRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CallsheetService
{
    protected $repository;
    public function __construct(CallsheetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByProjectId($project_id)
    {
        return $this->repository->getByProjectId($project_id);
    }

    public function store($data)
    {
        return $this->repository->store($data);
    }
}
