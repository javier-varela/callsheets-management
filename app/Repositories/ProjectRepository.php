<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectRepository
{
    /**
     * Obtiene todos los proyectos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllProjects()
    {
        return DB::table('projects')
            ->join('projects_invitations', 'projects.id', '=', "projects_invitations.project_id")
            ->select('projects.*', 'projects_invitations.*')
            ->get();
    }

    public function getAllUserProjects($id)
    {
        return DB::table('projects')
            ->where('user_id', $id)
            ->join('projects_invitations', 'projects.id', '=', "projects_invitations.project_id")
            ->select('projects.*', 'projects_invitations.*')
            ->get();
    }

    /**
     * Obtiene un proyecto por su ID.
     *
     * @param int $id
     * @return \stdClass|null
     */
    public function getProjectById($id)
    {
        return DB::table('projects')->where('id', $id)->first();
    }

    /**
     * Crea un nuevo proyecto.
     *
     * @param array $data
     * @return bool
     */
    public function createProject($data)
    {
        return DB::table('projects')->insert($data);
    }

    /**
     * Actualiza un proyecto existente.
     *
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateProject($id, $data)
    {
        return DB::table('projects')->where('id', $id)->update($data);
    }

    /**
     * Elimina un proyecto.
     *
     * @param int $id
     * @return int
     */
    public function deleteProject($id)
    {
        return DB::table('projects')->where('id', $id)->delete();
    }

    /**
     * Obtiene las invitaciones de un proyecto específico.
     *
     * @param int $projectId
     * @return \Illuminate\Support\Collection
     */
    public function getInvitationsByProject($projectId)
    {
        return DB::table('projects_invitations')
            ->where('project_id', $projectId)
            ->get();
    }
}
