<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // Creamos rol administrador 
        $administrador = User::factory()->create([
            'name' => 'Aldana',
            'email' => 'aldana@gmail.com',
            'password' => bcrypt('aldana12345678'), 
        ]);
        $administrador->assignRole('administrador');

        // Creamos rol usuario
        $usuario = User::factory()->create([
            'name' => 'Maicol',
            'email' => 'maicol@gmail.com',
            'password' => bcrypt('maicol12345678'), 
        ]);
        $usuario->assignRole('usuario');
    }
}
