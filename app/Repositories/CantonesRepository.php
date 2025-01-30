<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CantonesRepository
{
    /**
     * Obtener todos los cantones o filtrarlos por 'id_provincia' si se especifica.
     *
     * @param  int|null  $idProvincia
     * @return \Illuminate\Support\Collection
     */
    public function getCantones($idProvincia = null)
    {
        $query = DB::table('cantones');

        // Si se pasa un id_provincia, agregar el filtro
        if ($idProvincia) {
            $query->where('id_provincia', $idProvincia);
        }

        return $query->get();
    }

    /**
     * Obtener un canton por ID.
     *
     * @param  int  $id
     * @return \stdClass|null
     */
    public function getCantonById($id)
    {
        return DB::table('cantones')->where('id', $id)->first();
    }

    /**
     * Crear un nuevo canton.
     *
     * @param  array  $data
     * @return int
     */
    public function createCanton(array $data)
    {
        return DB::table('cantones')->insertGetId($data);
    }

    /**
     * Actualizar un canton.
     *
     * @param  int  $id
     * @param  array  $data
     * @return bool
     */
    public function updateCanton($id, array $data)
    {
        return DB::table('cantones')->where('id', $id)->update($data);
    }

    /**
     * Eliminar un canton.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteCanton($id)
    {
        return DB::table('cantones')->where('id', $id)->delete();
    }
}
