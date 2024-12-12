<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CallsheetCastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs de callsheets y projects_roles_assignments existentes
        $callsheetIds = DB::table('callsheets')->pluck('id')->toArray();
        $roleAssignmentIds = DB::table('projects_roles_assignments')->pluck('id')->toArray();

        // Verificar que hay datos disponibles
        if (empty($callsheetIds) || empty($roleAssignmentIds)) {
            $this->command->warn('No hay callsheets o roles asignados disponibles para generar cast.');
            return;
        }

        // Generar 30 registros de cast aleatorios
        for ($i = 0; $i < 30; $i++) {
            DB::table('callsheets_cast')->insert([
                'callsheet_id' => $callsheetIds[array_rand($callsheetIds)],  // Callsheet aleatorio
                'project_role_assignment_id' => $roleAssignmentIds[array_rand($roleAssignmentIds)], // Asignación de rol aleatoria
                'instructions' => 'Instrucciones para el cast: ' . Str::random(20), // Instrucciones aleatorias
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Registros de cast generados exitosamente.');
    }
}
