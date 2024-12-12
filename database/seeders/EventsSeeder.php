<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventCastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs de callsheets_cast y callsheets existentes
        $callsheetCastIds = DB::table('callsheets_cast')->pluck('id')->toArray();
        $callsheetIds = DB::table('callsheets')->pluck('id')->toArray();

        // Verificar que hay datos disponibles
        if (empty($callsheetCastIds) || empty($callsheetIds)) {
            $this->command->warn('No hay datos disponibles para generar eventos o casts.');
            return;
        }

        // Generar 50 eventos aleatorios
        for ($i = 0; $i < 50; $i++) {
            // Insertar un evento aleatorio en callsheets_events
            $eventId = DB::table('callsheets_events')->insertGetId([
                'start_hour' => rand(8, 18) + rand(0, 59) / 60, // Hora aleatoria entre 8:00 y 18:59
                'stimated_hours' => rand(1, 5), // Horas estimadas aleatorias entre 1 y 5
                'status' => 'pending', // Estado aleatorio
                'description' => 'Descripción del evento: ' . Str::random(20), // Descripción aleatoria
                'callsheet_id' => $callsheetIds[array_rand($callsheetIds)], // Llamado aleatorio de callsheets
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Verificar si el evento fue creado correctamente
            if ($eventId) {
                // Insertar relaciones en event_cast
                DB::table('event_cast')->insert([
                    'callsheet_cast_id' => $callsheetCastIds[array_rand($callsheetCastIds)],  // Llamado aleatorio de callsheets_cast
                    'callsheet_event_id' => $eventId,  // El ID del evento recién insertado
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Eventos y relaciones entre cast y eventos generadas exitosamente.');
    }
}
