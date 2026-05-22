<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. PRIMERO LOS ROLES (Obligatorio para que existan en el sistema)
        $this->call(RolesAndPermissionsSeeder::class);

        // 2. LUEGO LOS COMPONENTES DE LA TIENDA
        $this->call(CategoriasSeeder::class);
        $this->call(ProductosSeeder::class);

        // 3. DESPUÉS LOS USUARIOS (Ya que dependen de los roles creados en el paso 1)
        $this->call(UsuariosSeeder::class);
        $this->call(ClientesSeeder::class);
    }
}
