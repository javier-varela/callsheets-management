<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CallsheetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs de proyectos existentes
        $projectIds = DB::table('projects')->pluck('id')->toArray();

        // Verificar que hay proyectos disponibles
        if (empty($projectIds)) {
            $this->command->warn('No hay proyectos disponibles para generar callsheets.');
            return;
        }

        // Generar 15 callsheets aleatorios
        for ($i = 0; $i < 15; $i++) {
            DB::table('callsheets')->insert([
                'title' => 'Callsheets ' . Str::random(5),           // Título aleatorio
                'instructions' => 'Instrucciones: ' . Str::random(20), // Instrucciones aleatorias
                'start_date' => now()->addDays(rand(1, 30)),         // Fecha aleatoria dentro de los próximos 30 días
                'project_id' => $projectIds[array_rand($projectIds)], // Proyecto aleatorio
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Callsheets generados exitosamente.');
    }
}
