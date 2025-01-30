<?php

namespace App\Services;

use App\Repositories\ProvinciasRepository;

class ProvinciasService
{
    protected $provinciaRepository;

    /**
     * Constructor de la clase, inyectando el repositorio.
     *
     * @param  \App\Repositories\ProvinciasRepository  $provinciaRepository
     */
    public function __construct(ProvinciasRepository $provinciaRepository)
    {
        $this->provinciaRepository = $provinciaRepository;
    }

    /**
     * Obtener todas las provincias o una por id si se especifica.
     *
     * @param  int|null  $id
     * @return \Illuminate\Support\Collection
     */
    public function getProvincias($id = null)
    {
        return $this->provinciaRepository->getProvincias($id);
    }

    /**
     * Obtener una provincia por ID.
     *
     * @param  int  $id
     * @return \stdClass|null
     */
    public function getProvinciaById($id)
    {
        return $this->provinciaRepository->getProvinciaById($id);
    }

    /**
     * Crear una nueva provincia.
     *
     * @param  array  $data
     * @return int
     */
    public function createProvincia(array $data)
    {
        return $this->provinciaRepository->createProvincia($data);
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
        return $this->provinciaRepository->updateProvincia($id, $data);
    }

    /**
     * Eliminar una provincia.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteProvincia($id)
    {
        return $this->provinciaRepository->deleteProvincia($id);
    }
}
