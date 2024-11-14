<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Obtener todos los usuarios
    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    // Obtener usuarios por rol
    public function getUsersByRole($roleName)
    {
        return $this->userRepository->getUsersByRole($roleName);
    }

    // Asignar un rol a un usuario
    public function assignRole(User $user, $roleName)
    {
        $this->userRepository->assignRole($user, $roleName);
    }

    // Remover un rol de un usuario
    public function removeRole(User $user, $roleName)
    {
        $this->userRepository->removeRole($user, $roleName);
    }

    // Verificar si un usuario tiene un rol específico
    public function hasRole(User $user, $roleName)
    {
        return $this->userRepository->hasRole($user, $roleName);
    }
}
