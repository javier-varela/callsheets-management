<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getSelectUsersToInvite(int $project_id)
    {
        return $this->userService->getSelectUsersToInvite($project_id);
    }
}
