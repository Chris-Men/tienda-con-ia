<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Bebidas', 'descripcion' => 'Bebidas deliciosas que le gustaran a tu paladar'],
            ['nombre' => 'Postres', 'descripcion' => 'Variedad de postres seleccionados para ti'],
            // ... Agrega más categorías según sea necesario
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
