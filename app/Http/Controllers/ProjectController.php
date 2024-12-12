<?php

namespace App\Http\Controllers;

use App\Services\ProjectAssignmentService;
use App\Services\ProjectService;
use App\Services\ProjectInvitationService;
use App\Services\ProjectRoleAssignmentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function Ramsey\Uuid\v1;

class ProjectController extends Controller
{
    protected $projectService;
    protected $projectInvitationService;
    protected $userService;
    protected $projectAssignmentService;

    public function __construct(
        ProjectService $projectService,
        ProjectInvitationService $projectInvitationService,
        UserService $userService,
        ProjectAssignmentService $projectAssignmentService
    ) {
        $this->projectService = $projectService;
        $this->projectInvitationService = $projectInvitationService;
        $this->userService = $userService;
        $this->projectAssignmentService = $projectAssignmentService;
    }

    // Mostrar todos los proyectos
    public function index()
    {
        $data = $this->projectService->getAllUserProjects();
        return Inertia::render('Dashboard/Projects/Index', ['data' => $data]);
    }

    public function otherProjects()
    {

        $data = $this->projectService->getAllParticipateProjects();
        return Inertia::render('Dashboard/Projects/OtherProjects', ['data' => $data]);
    }

    public function showAdmin($project_id)
    {

        $project = $this->projectService->getProjectById($project_id);
        $invitations = $this->projectInvitationService->getInvitationsByProjectId($project_id);
        $participants = $this->projectAssignmentService->getAssignmentsByProjectId($project_id);


        return Inertia::render('Dashboard/Projects/Admin/Show', [
            'project' => $project,
            'invitations' => $invitations,
            'participants' => $participants
        ]);
    }

    public function showGuest($id)
    {
        $project = $this->projectService->getProjectById($id);
        $users_to_invite = $this->userService->getUsersByRole("user");
        $invitations = $this->projectInvitationService->getInvitationsByProjectId($id);
        $assignments = $this->projectAssignmentService->getAssignmentsByProjectId($id);
        return Inertia::render('Dashboard/Projects/Guest/Show', [
            'project' => $project,
            'users' => $users_to_invite,
            'invitations' => $invitations,
            'participants' => $assignments
        ]);
    }

    // Mostrar el formulario para crear un proyecto
    public function create()
    {
        return Inertia::render('Dashboard/Projects/Create');
    }

    // Almacenar un nuevo proyecto
    public function store(Request $request)
    {

        $this->projectService->createProject($request);

        return redirect()->route('dashboard.projects.index');
    }

    // Mostrar el formulario para editar un proyecto
    public function edit($id)
    {
        $project = $this->projectService->getProjectById($id);
        $users = $this->userService->getUsersByRole("user");
        return Inertia::render('Dashboard/Projects/Edit', ['project' => $project, 'users' => $users]);
    }

    // Actualizar un proyecto existente
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            // Otros campos según el modelo
        ]);

        $this->projectService->updateProject($id, $data);

        return redirect()->route('dashboard.projects.index');
    }

    // Eliminar un proyecto
    public function destroy($id)
    {
        $this->projectService->deleteProject($id);
        return redirect()->route('dashboard.projects.index');
    }

    public function deleteAssigmentsByUserId($user_id, $project_id)
    {
        $this->projectAssignmentService->deleteAssigmentsByUserId($user_id, $project_id);
        return redirect()->route('dashboard.projects.admin.show')->with('project_id', $project_id);
    }
}
