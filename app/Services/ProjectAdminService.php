<?php

namespace App\Services;

use App\Repositories\ProjectAdminRepository;

class ProjectAdminService
{
    protected $projectAdminRepository;

    public function __construct(ProjectAdminRepository $projectAdminRepository)
    {
        $this->projectAdminRepository = $projectAdminRepository;
    }

    /**
     * Obtener todos los registros.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllAdmins()
    {
        return $this->projectAdminRepository->getAll();
    }

    /**
     * Obtener un registro por su clave primaria compuesta.
     *
     * @param int $projectId
     * @param int $userId
     * @return \stdClass|null
     */
    public function getAdminById($projectId, $userId)
    {
        return $this->projectAdminRepository->getById($projectId, $userId);
    }

    /**
     * Crear un nuevo registro.
     *
     * @param array $data
     * @return bool
     */
    public function createAdmin(array $data)
    {
        return $this->projectAdminRepository->create($data);
    }

    /**
     * Actualizar un registro por su clave primaria compuesta.
     *
     * @param int $projectId
     * @param int $userId
     * @param array $data
     * @return int
     */
    public function updateAdmin($projectId, $userId, array $data)
    {
        return $this->projectAdminRepository->update($projectId, $userId, $data);
    }

    /**
     * Eliminar un registro por su clave primaria compuesta.
     *
     * @param int $projectId
     * @param int $userId
     * @return int
     */
    public function deleteAdmin($projectId, $userId)
    {
        return $this->projectAdminRepository->delete($projectId, $userId);
    }
}
