<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class provincias_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provincias')->insert([
            ['id' => 1, 'latitud' => -2.9, 'longitud' => -79, 'nombre' => 'Azuay'],
            ['id' => 2, 'latitud' => -1.6, 'longitud' => -78.6, 'nombre' => 'Bolívar'],
            ['id' => 3, 'latitud' => -2.9, 'longitud' => -78.9, 'nombre' => 'Cañar'],
            ['id' => 4, 'latitud' => 0.9, 'longitud' => -78, 'nombre' => 'Carchi'],
            ['id' => 5, 'latitud' => -1.6, 'longitud' => -78.8, 'nombre' => 'Chimborazo'],
            ['id' => 6, 'latitud' => -0.7, 'longitud' => -78.5, 'nombre' => 'Cotopaxi'],
            ['id' => 7, 'latitud' => -3.4, 'longitud' => -79.5, 'nombre' => 'El Oro'],
            ['id' => 8, 'latitud' => 0.9, 'longitud' => -79.8, 'nombre' => 'Esmeraldas'],
            ['id' => 9, 'latitud' => -0.7, 'longitud' => -90.3, 'nombre' => 'Galápagos'],
            ['id' => 10, 'latitud' => -2.2, 'longitud' => -79.9, 'nombre' => 'Guayas'],
            ['id' => 11, 'latitud' => 0.3, 'longitud' => -78.2, 'nombre' => 'Imbabura'],
            ['id' => 12, 'latitud' => -3.9, 'longitud' => -79.2, 'nombre' => 'Loja'],
            ['id' => 13, 'latitud' => -1.2, 'longitud' => -79.7, 'nombre' => 'Los Ríos'],
            ['id' => 14, 'latitud' => -1, 'longitud' => -80.4, 'nombre' => 'Manabí'],
            ['id' => 15, 'latitud' => -2, 'longitud' => -77.8, 'nombre' => 'Morona Santiago'],
            ['id' => 16, 'latitud' => -0.7, 'longitud' => -77.7, 'nombre' => 'Napo'],
            ['id' => 17, 'latitud' => -0.5, 'longitud' => -76.3, 'nombre' => 'Orellana'],
            ['id' => 18, 'latitud' => -1.5, 'longitud' => -77.5, 'nombre' => 'Pastaza'],
            ['id' => 19, 'latitud' => -0.2, 'longitud' => -78.5, 'nombre' => 'Pichincha'],
            ['id' => 20, 'latitud' => -2.2, 'longitud' => -80.9, 'nombre' => 'Santa Elena'],
            ['id' => 21, 'latitud' => -0.2, 'longitud' => -79.2, 'nombre' => 'Santo Domingo de los Tsáchilas'],
            ['id' => 22, 'latitud' => 0.3, 'longitud' => -76.9, 'nombre' => 'Sucumbíos'],
            ['id' => 23, 'latitud' => -1.5, 'longitud' => -78.4, 'nombre' => 'Tungurahua'],
            ['id' => 24, 'latitud' => -4, 'longitud' => -79.3, 'nombre' => 'Zamora Chinchipe'],
        ]);
    }
}
