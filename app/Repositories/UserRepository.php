<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;

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
}
