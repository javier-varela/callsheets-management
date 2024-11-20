<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProjectsRolesRepository
{
    /**
     * Obtiene todos los roles de la tabla.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return DB::table('projects_roles')->get();
    }

    /**
     * Busca un rol por su ID.
     *
     * @param int $id
     * @return object|null
     */
    public function findById(int $id)
    {
        return DB::table('projects_roles')->find($id);
    }

    /**
     * Crea un nuevo rol en la tabla.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        return DB::table('projects_roles')->insert($data);
    }

    /**
     * Actualiza un rol existente.
     *
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update(int $id, array $data)
    {
        return DB::table('projects_roles')->where('id', $id)->update($data);
    }

    /**
     * Elimina un rol por su ID.
     *
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        return DB::table('projects_roles')->where('id', $id)->delete();
    }
}
