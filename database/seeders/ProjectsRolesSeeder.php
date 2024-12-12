<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Director',
            'Producer',
            'Scriptwriter',
            'Cinematographer',
            'Editor',
            'Sound Designer',
            'Art Director',
            'Production Manager',
            'Gaffer',
            'Grip',
            'Costume Designer',
            'Makeup Artist',
            'Location Manager',
            'Casting Director',
            'Actor',
            'Assistant Director',
            'Production Assistant',
            'Storyboard Artist',
            'Set Designer',
            'Colorist',
        ];

        foreach ($roles as $role) {
            DB::table('projects_roles')->insert([
                'name' => $role,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]);
        }
    }
}
