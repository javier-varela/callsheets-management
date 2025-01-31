<?php

namespace App\Services;

use App\Repositories\ProvinciasRepository;
use App\Repositories\CantonesRepository;
use App\Repositories\ParroquiasRepository;

class LocationService
{
    protected $provinciaRepository;
    protected $cantonRepository;
    protected $parroquiaRepository;

    /**
     * Constructor de la clase, inyectando los repositorios.
     *
     * @param  \App\Repositories\ProvinciasRepository  $provinciaRepository
     * @param  \App\Repositories\CantonesRepository  $cantonRepository
     * @param  \App\Repositories\ParroquiasRepository  $parroquiaRepository
     */
    public function __construct(
        ProvinciasRepository $provinciaRepository,
        CantonesRepository $cantonRepository,
        ParroquiasRepository $parroquiaRepository
    ) {
        $this->provinciaRepository = $provinciaRepository;
        $this->cantonRepository = $cantonRepository;
        $this->parroquiaRepository = $parroquiaRepository;
    }

    // Métodos de Provincias

    /**
     * Obtener todas las provincias o filtrarlas por 'id'.
     *
     * @param  int|null  $id
     * @return \Illuminate\Support\Collection
     */
    public function getProvincias($id = null)
    {
        return $this->provinciaRepository->getProvincias($id);
    }

    // Métodos de Cantones

    /**
     * Obtener todos los cantones o filtrarlos por 'id_provincia'.
     *
     * @param  int|null  $idProvincia
     * @return \Illuminate\Support\Collection
     */
    public function getCantones($idProvincia = null)
    {
        return $this->cantonRepository->getCantones($idProvincia);
    }

    // Métodos de Parroquias

    /**
     * Obtener todas las parroquias o filtrarlas por 'id_canton'.
     *
     * @param  int|null  $idCanton
     * @return \Illuminate\Support\Collection
     */
    public function getParroquias($idCanton = null)
    {
        return $this->parroquiaRepository->getParroquias($idCanton);
    }
}
