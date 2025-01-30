<?php

namespace App\Services;

use App\Repositories\CantonesRepository;

class CantonesService
{
    protected $cantonRepository;

    /**
     * Constructor de la clase, inyectando el repositorio.
     *
     * @param  \App\Repositories\CantonRepository  $cantonRepository
     */
    public function __construct(CantonesRepository $cantonRepository)
    {
        $this->cantonRepository = $cantonRepository;
    }

    /**
     * Obtener todos los cantones o filtrarlos por 'id_provincia' si se especifica.
     *
     * @param  int|null  $idProvincia
     * @return \Illuminate\Support\Collection
     */
    public function getCantones($idProvincia = null)
    {
        return $this->cantonRepository->getCantones($idProvincia);
    }

    /**
     * Obtener un canton por ID.
     *
     * @param  int  $id
     * @return \stdClass|null
     */
    public function getCantonById($id)
    {
        return $this->cantonRepository->getCantonById($id);
    }

    /**
     * Crear un nuevo canton.
     *
     * @param  array  $data
     * @return int
     */
    public function createCanton(array $data)
    {
        return $this->cantonRepository->createCanton($data);
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
        return $this->cantonRepository->updateCanton($id, $data);
    }

    /**
     * Eliminar un canton.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteCanton($id)
    {
        return $this->cantonRepository->deleteCanton($id);
    }
}
