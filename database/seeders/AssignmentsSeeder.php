<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generar asignaciones de proyectos
        $projectIds = [1, 2, 3];
        $userIds = DB::table('users')->pluck('id')->toArray();

        if (empty($projectIds) || empty($userIds)) {
            $this->command->warn('No hay proyectos o usuarios disponibles para asignar.');
            return;
        }

        // Crear 20 asignaciones aleatorias
        for ($i = 0; $i < 20; $i++) {
            DB::table('projects_assignments')->insert([
                'nick_name' => Str::random(8),
                'project_id' => $projectIds[array_rand($projectIds)],
                'user_id' => $userIds[array_rand($userIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Generar asignaciones por roles
        $assignmentIds = DB::table('projects_assignments')->pluck('id')->toArray();
        $roleIds = DB::table('projects_roles')->pluck('id')->toArray();

        if (empty($assignmentIds) || empty($roleIds)) {
            $this->command->warn('No hay asignaciones o roles disponibles para crear asignaciones de roles.');
            return;
        }

        // Crear 50 asignaciones de roles aleatorias
        for ($i = 0; $i < 30; $i++) {
            DB::table('projects_roles_assignments')->insert([
                'project_assignment_id' => $assignmentIds[array_rand($assignmentIds)],
                'project_role_id' => $roleIds[array_rand($roleIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Asignaciones y roles generados exitosamente.');
    }
}
