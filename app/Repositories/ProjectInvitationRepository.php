<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProjectInvitationRepository
{
    public function getAllInvitations()
    {
        return DB::table('projects_invitations')->get();
    }

    public function getInvitationById($id)
    {
        return DB::table('projects_invitations')->where('id', $id)->first();
    }

    public function getInvitationsByProjectId($project_id)
    {
        return DB::table('projects_invitations')
            ->where('project_id', $project_id)
            ->join('users', 'projects_invitations.invited_id', '=', 'users.id')
            ->select('projects_invitations.*', 'users.name as invited_name', 'users.email as invited_email')
            ->get();
    }

    public function createInvitation(array $data)
    {
        return DB::table('projects_invitations')->insert($data);
    }

    public function updateInvitation($id, array $data)
    {
        return DB::table('projects_invitations')->where('id', $id)->update($data);
    }

    public function deleteInvitation($id)
    {
        return DB::table('projects_invitations')->where('id', $id)->delete();
    }
}
