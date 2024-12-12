<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProjectAdminRepository
{
    protected $table = 'projects_admins';

    /**
     * Obtener todos los registros.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return DB::table($this->table)->get();
    }

    /**
     * Obtener un registro por su clave primaria compuesta.
     *
     * @param int $projectId
     * @param int $userId
     * @return \stdClass|null
     */
    public function getById($projectId, $userId)
    {
        return DB::table($this->table)
            ->where('project_id', $projectId)
            ->where('user_id', $userId)
            ->first();
    }

    /**
     * Crear un nuevo registro.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        return DB::table($this->table)->insert($data);
    }

    /**
     * Actualizar un registro por su clave primaria compuesta.
     *
     * @param int $projectId
     * @param int $userId
     * @param array $data
     * @return int
     */
    public function update($projectId, $userId, array $data)
    {
        return DB::table($this->table)
            ->where('project_id', $projectId)
            ->where('user_id', $userId)
            ->update($data);
    }

    /**
     * Eliminar un registro por su clave primaria compuesta.
     *
     * @param int $projectId
     * @param int $userId
     * @return int
     */
    public function delete($projectId, $userId)
    {
        return DB::table($this->table)
            ->where('project_id', $projectId)
            ->where('user_id', $userId)
            ->delete();
    }
}
