<?php

namespace App\Http\Controllers;

use App\Services\ParroquiasService;

class ParroquiasController extends Controller
{
    protected $parroquiaService;

    /**
     * Constructor de la clase, inyectando el servicio.
     *
     * @param  \App\Services\ParroquiaService  $parroquiaService
     */
    public function __construct(ParroquiasService $parroquiaService)
    {
        $this->parroquiaService = $parroquiaService;
    }

    /**
     * Obtener todas las parroquias o filtrarlas por 'id_canton' si se especifica.
     *
     * @param  int|null  $idCanton
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll($idCanton = null)
    {
        // Obtener las parroquias desde el servicio
        $parroquias = $this->parroquiaService->getParroquias($idCanton);

        // Retornar el resultado como un JSON
        return response()->json($parroquias);
    }

    /**
     * Obtener una parroquia por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $parroquia = $this->parroquiaService->getParroquiaById($id);

        if ($parroquia) {
            return response()->json($parroquia);
        }

        return response()->json(['message' => 'Parroquia no encontrada'], 404);
    }

    // Otros métodos para crear, actualizar, eliminar parroquias...
}
