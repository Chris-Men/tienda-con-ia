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
        // 1. Creamos al usuario Administrador por separado para asignarle su rol
        $admin = User::create([
            'name' => 'Juan Rauda',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        // Le asignamos el rol de administrador (Spatie)
        $admin->assignRole('admin');

        // 2. Lista del resto de usuarios comunes (Clientes)
        $usuariosClientes = [
            ['name' => 'Diana Pérez', 'email' => 'diana@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Cristofer Mendoza', 'email' => 'cristofer@gmail.com', 'password' => bcrypt('12345678')],
            ['name' => 'Noemy Mejía', 'email' => 'noemy@gmail.com', 'password' => bcrypt('12345678')],
            // ... Agrega más usuarios según sea necesario
        ];

        // 3. Los registramos en la base de datos y les asignamos el rol de cliente
        foreach ($usuariosClientes as $usuario) {
            $cliente = User::create($usuario);
            $cliente->assignRole('cliente');
        }
    }
}
