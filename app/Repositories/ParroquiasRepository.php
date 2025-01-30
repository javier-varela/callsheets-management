<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ParroquiasRepository
{
    /**
     * Obtener todas las parroquias o filtrarlas por 'id_canton' si se especifica.
     *
     * @param  int|null  $idCanton
     * @return \Illuminate\Support\Collection
     */
    public function getParroquias($idCanton = null)
    {
        $query = DB::table('parroquias');

        // Si se pasa un id_canton, agregar el filtro
        if ($idCanton) {
            $query->where('id_canton', $idCanton);
        }

        return $query->get();
    }

    /**
     * Obtener una parroquia por ID.
     *
     * @param  int  $id
     * @return \stdClass|null
     */
    public function getParroquiaById($id)
    {
        return DB::table('parroquias')->where('id', $id)->first();
    }

    /**
     * Crear una nueva parroquia.
     *
     * @param  array  $data
     * @return int
     */
    public function createParroquia(array $data)
    {
        return DB::table('parroquias')->insertGetId($data);
    }

    /**
     * Actualizar una parroquia.
     *
     * @param  int  $id
     * @param  array  $data
     * @return bool
     */
    public function updateParroquia($id, array $data)
    {
        return DB::table('parroquias')->where('id', $id)->update($data);
    }

    /**
     * Eliminar una parroquia.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteParroquia($id)
    {
        return DB::table('parroquias')->where('id', $id)->delete();
    }
}
