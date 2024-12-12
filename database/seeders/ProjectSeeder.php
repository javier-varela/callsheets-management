<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generar 20 proyectos con user_id entre 2 y 10
        for ($i = 0; $i < 3; $i++) {
            DB::table('projects')->insert([
                'title' => 'Project ' . Str::random(5), // Título aleatorio
                'user_id' => 2,             // ID aleatorio entre 2 y 10
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
