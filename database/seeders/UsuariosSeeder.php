<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            ['name' => 'Juan Rauda', 'email' => 'juan@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Diana Pérez', 'email' => 'diana@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Cristofer Mendoza', 'email' => 'cristofer@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Noemy Mejía', 'email' => 'noemy@gmail.com', 'password' => bcrypt('12345678')],
            // ... Agrega más usuarios según sea necesario
        ];

        foreach ($usuarios as $usuario) {
            User::create($usuario);
        }
    }
}
