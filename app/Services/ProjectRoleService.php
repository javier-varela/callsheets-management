<?php

namespace App\Services;

use App\Repositories\ProjectRoleRepository;

class ProjectRoleService
{
    protected $projectsRolesRepository;

    public function __construct(ProjectRoleRepository $projectsRolesRepository)
    {
        $this->projectsRolesRepository = $projectsRolesRepository;
    }

    /**
     * Obtiene todos los roles de la tabla.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllRoles()
    {
        return $this->projectsRolesRepository->getAll();
    }

    /**
     * Busca un rol por su ID.
     *
     * @param int $id
     * @return object|null
     */
    public function findRoleById(int $id)
    {
        return $this->projectsRolesRepository->findById($id);
    }

    /**
     * Crea un nuevo rol en la tabla.
     *
     * @param array $data
     * @return bool
     */
    public function createRole(array $data)
    {
        return $this->projectsRolesRepository->create($data);
    }

    /**
     * Actualiza un rol existente.
     *
     * @param int $id
     * @param array $data
     * @return int
     */
    public function updateRole(int $id, array $data)
    {
        return $this->projectsRolesRepository->update($id, $data);
    }

    /**
     * Elimina un rol por su ID.
     *
     * @param int $id
     * @return int
     */
    public function deleteRole(int $id)
    {
        return $this->projectsRolesRepository->delete($id);
    }
}
