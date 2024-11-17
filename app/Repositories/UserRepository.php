<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    // Obtener todos los usuarios
    public function getAllUsers()
    {
        return User::all();
    }

    // Obtener usuarios por rol
    public function getUsersByRole($roleName)
    {
        return User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get();
    }

    // Asignar un rol a un usuario
    public function assignRole(User $user, $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $user->roles()->attach($role);
    }

    // Remover un rol de un usuario
    public function removeRole(User $user, $roleName)
    {
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $user->roles()->detach($role);
        }
    }

    // Verificar si un usuario tiene un rol específico
    public function hasRole(User $user, $roleName)
    {
        return $user->roles()->where('name', $roleName)->exists();
    }

    public function getSelectUsersToInvite(int $project_id)
    {

        $authUserId = Auth::id();

        return DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', function ($join) {
                $join->on('role_user.role_id', '=', 'roles.id')
                    ->where('roles.name', '=', 'user');  // Filtra solo los usuarios con rol "user"
            })
            ->leftJoin('projects_invitations', function ($join) use ($project_id) {
                $join->on('users.id', '=', 'projects_invitations.invited_id')
                    ->where('projects_invitations.project_id', '=', $project_id);
            })
            ->whereNull('projects_invitations.invited_id')  // Usuarios que no están invitados al proyecto
            ->where('users.id', '!=', $authUserId)  // Excluir al usuario autenticado
            ->select('users.*')
            ->get();
    }
}
