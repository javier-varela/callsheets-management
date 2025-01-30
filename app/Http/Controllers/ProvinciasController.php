<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProvinciasService;

class ProvinciasController extends Controller
{
    protected $provinciasService;

    public function __construct(ProvinciasService $provinciasService = null)
    {
        $this->provinciasService = $provinciasService;
    }

    public function getAll()
    {
        // Obtener todas las provincias desde el servicio
        $provincias = $this->provinciasService->getProvincias();

        // Retornar el resultado como un JSON
        return response()->json($provincias);
    }
}
