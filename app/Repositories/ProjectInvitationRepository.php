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

    public function createInvitation(array $data)
    {
        return DB::table('projects_invitations')->insertGetId($data);
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
