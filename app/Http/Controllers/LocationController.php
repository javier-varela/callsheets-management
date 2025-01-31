<?php

namespace App\Http\Controllers;

use App\Services\LocationService;

class LocationController extends Controller
{
    protected $locationService;

    /**
     * Constructor de la clase, inyectando el servicio.
     *
     * @param  \App\Services\LocationService  $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * Obtener todas las provincias o filtrarlas por 'id'.
     *
     * @param  int|null  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProvincias($id = null)
    {
        $provincias = $this->locationService->getProvincias($id);
        return response()->json($provincias);
    }

    /**
     * Obtener todos los cantones o filtrarlos por 'id_provincia'.
     *
     * @param  int|null  $idProvincia
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCantones($idProvincia = null)
    {
        $cantones = $this->locationService->getCantones($idProvincia);
        return response()->json($cantones);
    }

    /**
     * Obtener todas las parroquias o filtrarlas por 'id_canton'.
     *
     * @param  int|null  $idCanton
     * @return \Illuminate\Http\JsonResponse
     */
    public function getParroquias($idCanton = null)
    {
        $parroquias = $this->locationService->getParroquias($idCanton);
        return response()->json($parroquias);
    }
}
