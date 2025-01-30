<?php

namespace App\Services;

use App\Repositories\ParroquiasRepository;

class ParroquiasService
{
    protected $parroquiaRepository;

    /**
     * Constructor de la clase, inyectando el repositorio.
     *
     * @param  \App\Repositories\ParroquiaRepository  $parroquiaRepository
     */
    public function __construct(ParroquiasRepository $parroquiaRepository)
    {
        $this->parroquiaRepository = $parroquiaRepository;
    }

    /**
     * Obtener todas las parroquias o filtrarlas por 'id_canton' si se especifica.
     *
     * @param  int|null  $idCanton
     * @return \Illuminate\Support\Collection
     */
    public function getParroquias($idCanton = null)
    {
        return $this->parroquiaRepository->getParroquias($idCanton);
    }

    /**
     * Obtener una parroquia por ID.
     *
     * @param  int  $id
     * @return \stdClass|null
     */
    public function getParroquiaById($id)
    {
        return $this->parroquiaRepository->getParroquiaById($id);
    }

    /**
     * Crear una nueva parroquia.
     *
     * @param  array  $data
     * @return int
     */
    public function createParroquia(array $data)
    {
        return $this->parroquiaRepository->createParroquia($data);
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
        return $this->parroquiaRepository->updateParroquia($id, $data);
    }

    /**
     * Eliminar una parroquia.
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteParroquia($id)
    {
        return $this->parroquiaRepository->deleteParroquia($id);
    }
}
