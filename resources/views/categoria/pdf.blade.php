<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorias</title>
    <style>

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f0b7b7;
        }
    </style>
</head>

<body>
    <h1>Lista de Categorias</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nombre</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        .producto-details {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles del Producto</h1>
        
        <div class="producto-details">
            <h2>{{ $producto->nombre }}</h2>
            <p>Precio: ${{ $producto->precio }}</p>
            <p>Descripción: {{ $producto->descripcion }}</p>
            <p>Stock: {{ $producto->stock }}</p>
            <img src="{{ asset('ruta_de_tu_imagen/' . $producto->imagen) }}" alt="Imagen del producto">
        </div>        
    </div>
</body>
</html> --}}
