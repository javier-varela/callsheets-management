<?php

namespace App\Http\Controllers;

use App\Services\CantonesService;

class CantonesController extends Controller
{
    protected $cantonService;

    /**
     * Constructor de la clase, inyectando el servicio.
     *
     * @param  \App\Services\CantonService  $cantonService
     */
    public function __construct(CantonesService $cantonService)
    {
        $this->cantonService = $cantonService;
    }

    /**
     * Obtener todos los cantones o filtrarlos por 'id_provincia' si se especifica.
     *
     * @param  int|null  $idProvincia
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll($idProvincia = null)
    {
        // Obtener los cantones desde el servicio
        $cantones = $this->cantonService->getCantones($idProvincia);

        // Retornar el resultado como un JSON
        return response()->json($cantones);
    }

    /**
     * Obtener un canton por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $canton = $this->cantonService->getCantonById($id);

        if ($canton) {
            return response()->json($canton);
        }

        return response()->json(['message' => 'Canton no encontrado'], 404);
    }

    // Otros métodos para crear, actualizar, eliminar cantones...
}
