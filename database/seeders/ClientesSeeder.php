<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = [
            ['name' => 'Juan Rauda', 'email' => 'juan@gmail.com', 'phone' => '123456789', 'address' => 'El Salvador, San Salvador'],
            ['name' => 'Diana Pérez', 'email' => 'diana@gmail.com', 'phone' => '987654321', 'address' => 'El Salvador, San Salvador'],
            ['name' => 'Cristofer Mendoza', 'email' => 'cristofer@gmail.com', 'phone' => '987654321', 'address' => 'El Salvador, San Salvador'],
            ['name' => 'Noemy Mejía', 'email' => 'noemy@gmail.com', 'phone' => '987654321', 'address' => 'El Salvador, San Salvador'],
            // ... Agrega más clientes según sea necesario
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}