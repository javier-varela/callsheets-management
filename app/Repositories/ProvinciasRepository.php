<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProvinciasRepository
{
    /**
     * Obtener todas las provincias o una por id si se especifica.
     *
     * @param  int|null  $id
     * @return \Illuminate\Support\Collection
     */
    public function getProvincias($id = null)
    {
        $query = DB::table('provincias');

        // Si se pasa un ID, agregar el filtro
        if ($id) {
            $query->where('id', $id);
        }

        return $query->get();
    }

    /**
     * Obtener una provincia por ID.
     *
     * @param  int  $id
     * @return \stdClass|null
     */
    public function getProvinciaById($id)
    {
        return DB::table('provincias')->where('id', $id)->first();
    }

    /**
     * Crear una nueva provincia.
     *
     * @param  array  $data
     * @return int
     */
    public function createProvincia(array $data)
    {
        return DB::table('provincias')->insertGetId($data);
    }

    /**
     * Actualizar una provincia.
     *
     * @param  int  $id
     * @param  array  $data
     * @return bool
     */
    public function updateProvincia($id, array $data)
    {
        return DB::table('provincias')->where('id', $id)->update($data);
    }

    /**
     * Eliminar una provincia.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteProvincia($id)
    {
        return DB::table('provincias')->where('id', $id)->delete();
    }
}
