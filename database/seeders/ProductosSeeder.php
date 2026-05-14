<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'Café con crema batida',
                'descripcion' => 'Descripción del Producto 1',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/cafe con crema batida.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Café descafeinado',
                'descripcion' => 'Descripción del Producto 2',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/cafe descafeinado.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Café espeso',
                'descripcion' => 'Descripción del Producto 3',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/cafe espeso.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Café helado',
                'descripcion' => 'Descripción del Producto 4',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/cafe helado.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Café negro',
                'descripcion' => 'Descripción del Producto 5',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/cafe negro.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Capuchino',
                'descripcion' => 'Descripción del Producto 6',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/capuchino.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Chocolate con leche',
                'descripcion' => 'Descripción del Producto 7',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/chocolate con leche.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Frozen de cafe',
                'descripcion' => 'Descripción del Producto 8',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/frozen de cafe.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Frozen de fresa',
                'descripcion' => 'Descripción del Producto 9',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/frozen de fresa.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Tostaccino',
                'descripcion' => 'Descripción del Producto 10',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/tostaccino.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Bebida 11',
                'descripcion' => 'Descripción del Producto 11',
                'stock' => 10,
                'precio' => 5.99,
                'imagen' => 'imagenes/helado de galleta.jpg',
                'id_categoria' => 1,
            ],
            [
                'nombre' => 'Postre 1',
                'descripcion' => 'Descripción del Postre 1',
                'stock' => 5,
                'precio' => 3.99,
                'imagen' => 'imagenes/pastel de mora.jpg',
                'id_categoria' => 2,
            ],[
                'nombre' => 'Postre 2',
                'descripcion' => 'Descripción del Postre 2',
                'stock' => 5,
                'precio' => 3.99,
                'imagen' => 'imagenes/crema pastelera.jpg',
                'id_categoria' => 2,
            ],
            [
                'nombre' => 'Postre 3',
                'descripcion' => 'Descripción del Postre 3',
                'stock' => 5,
                'precio' => 3.99,
                'imagen' => 'imagenes/flan de caramelo.jpg',
                'id_categoria' => 2,
            ],
            [
                'nombre' => 'Postre 4',
                'descripcion' => 'Descripción del Postre 4',
                'stock' => 5,
                'precio' => 3.99,
                'imagen' => 'imagenes/stuffed.jpg',
                'id_categoria' => 2,
            ],
            [
                'nombre' => 'Postre 5',
                'descripcion' => 'Descripción del Postre 5',
                'stock' => 5,
                'precio' => 3.99,
                'imagen' => 'imagenes/suspiros de limeña.jpg',
                'id_categoria' => 2,
            ],
            [
                'nombre' => 'Postre 6',
                'descripcion' => 'Descripción del Postre 6',
                'stock' => 5,
                'precio' => 3.99,
                'imagen' => 'imagenes/bloggings.jpg',
                'id_categoria' => 2,
            ],
            [
                'nombre' => 'Postre 7',
                'descripcion' => 'Descripción del Postre 7',
                'stock' => 5,
                'precio' => 3.99,
                'imagen' => 'imagenes/pie de mantequilla.jpg',
                'id_categoria' => 2,
            ],
            
            // ... Agrega más productos según sea necesario
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
