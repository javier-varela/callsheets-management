<?php

namespace App\Services;

use App\Repositories\CallsheetCastRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CallsheetCastService
{
    protected $repository;

    public function __construct(CallsheetCastRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addCast($cast, $callsheet_id)
    {
        // Transformar la data para que sea compatible con la tabla 'callsheets_cast'
        $data = array_map(function ($item) use ($callsheet_id) {
            return [
                'callsheet_id' => $callsheet_id,
                'project_role_assignment_id' => $item->pra_id, // Tomamos 'pra_id' para esta clave foránea
                'instructions' => 'Default instructions',     // Puedes cambiar esto si hay datos reales

                'created_at' => now(),                        // Marca de tiempo actual
                'updated_at' => now()
            ];
        }, $cast);

        // Llamar al repositorio para insertar los datos
        return $this->repository->addCast($data);
    }

    public function getCastByCallsheetId($callsheet_id)
    {
        return $this->repository->getCastByCallsheetId($callsheet_id);
    }
}
