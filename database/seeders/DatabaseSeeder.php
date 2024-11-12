<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear los roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Crear el usuario admin y asignarle el rol de 'admin'
        $adminUser = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // puedes cambiar la contraseña
        ]);
        $adminUser->roles()->attach($adminRole); // Asignar el rol de admin al usuario

        // Crear 9 usuarios de ejemplo con rol 'user'
        for ($i = 1; $i <= 9; $i++) {
            $user = User::factory()->create([
                'name' => "usuario{$i}",
                'email' => "user{$i}@user.com",
                'password' => bcrypt('password'), // puedes cambiar la contraseña
            ]);
            $user->roles()->attach($userRole); // Asignar el rol de usuario al usuario
        }
    }
}
