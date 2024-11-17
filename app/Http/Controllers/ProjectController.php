<?php

namespace App\Http\Controllers;


use App\Services\ProjectService;
use App\Services\ProjectInvitationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    protected $projectService;
    protected $projectInvitationService;
    protected $userService;


    public function __construct(ProjectService $projectService, ProjectInvitationService $projectInvitationService, UserService $userService)
    {
        $this->projectService = $projectService;
        $this->projectInvitationService = $projectInvitationService;
        $this->userService = $userService;
    }

    // Mostrar todos los proyectos
    public function index()
    {
        $projects = $this->projectService->getAllUserProjects();
        return Inertia::render('Dashboard/Projects/Index', ['projects' => $projects]);
    }

    // Mostrar un proyecto específico
    public function show($id)
    {
        $project = $this->projectService->getProjectById($id);
        $users_to_invite = $this->userService->getUsersByRole("user");
        $invitations = $this->projectInvitationService->getInvitationsByProjectId($id);
        return Inertia::render('Dashboard/Projects/Show', ['project' => $project, 'users' => $users_to_invite, 'invitations' => $invitations]);
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

        return redirect()->route('dashboard.projects');
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

        return redirect()->route('dashboard.projects');
    }

    // Eliminar un proyecto
    public function destroy($id)
    {
        $this->projectService->deleteProject($id);
        return redirect()->route('dashboard.projects');
    }

    public function invite(Request $request)
    {
        $this->projectInvitationService->createInvitation($request);
        $project_id = $request->input('project_id');
        return redirect('/dashboard/projects/' . $project_id);
    }
}
