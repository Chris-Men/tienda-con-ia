@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <button class="btn btn-primary" onclick="verCarrito()"> Ver Carrito <svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart"
                        viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5
        0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0
        0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1
        0-2z">
                        </path>
                    </svg> <span class="badge bg-danger text-white" id="carritoCantidad">0</span> </button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="welcome-message">
                    <h1 class="text-center">Catálogo de venta</h1>
                    <p class="text-center">Elige lo que deseas comprar</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($productos as $producto)
                <!-- Producto -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Nombre: {{ $producto->nombre }}</h5>
                            <input type="text" id="nombre{{ $producto->id }}" disabled
                                value="{{ $producto->nombre }}
                                    " hidden>
                            <h5 class="card-title" hidden>Id: {{ $producto->id }}</h5> <img src="{{ $producto->imagen }}"
                                alt="Imagen del producto" style="width: 100%; height; 100%; object-fit: cover;">
                            <p class="card-text">Disponible: {{ $producto->stock }}</p>
                            <input type="number" id="stock{{ $producto->id }}" disabled value="{{ $producto->stock }}"
                                hidden>
                            <p class="card-text">Precio: ${{ $producto->precio }}</p>
                            <input type="text" id="precio{{ $producto->id }}" disabled
                                value="{{ $producto->precio }}
                                    " hidden>
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" id="cantidad{{ $producto->id }}" value="1" min="1"> <br>
                            <br>
                            <div class="text-center">
                                <a href="{{ route('productos.show', ['producto' => $producto->id]) }}"
                                    class="btn btn-primary">Ver Detalles</a>
                                <button class="btn btn-success"
                                    onclick="editarCantidad({{ $producto->id }})">Editar</button>
                            </div>
                        </div>
                        <button class="btn btn-primary" onclick="agregarAlCarrito({{ $producto->id }})"> Agregar al
                            carrito</button>

                    </div>
                </div>
            @endforeach
        </div>
    </div>



    <script>
        var productosSeleccionados = {};

        function agregarAlCarrito(id) {
            var cantidadInput = document.getElementById('cantidad' + id);
            var stockInput = document.getElementById('stock' + id);
            var precioInput = document.getElementById('precio' + id);
            var nombreInput = document.getElementById('nombre' + id);
            var cantidad = parseInt(cantidadInput.value);
            var cantidadPedido = parseInt(stockInput.value);
            var precio = parseFloat(precioInput.value);
            var nombre = nombreInput.value;


            if (cantidad > 0 && cantidad <= cantidadPedido) {
                // Verifica si ya hay elementos en el carrito
                var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

                // Busca si el producto ya está en el carrito
                var productoEnCarrito = carrito.find(function(item) {
                    return item.id === id;
                });

                if (productoEnCarrito) {
                    // Si el producto ya está en el carrito, aumenta la cantidad
                    productoEnCarrito.cantidad = cantidad;
                } else {

                    carrito.push({
                        id: id,
                        nombre: nombre,
                        precio: precio,
                        cantidad: cantidad
                    });
                }

                // Guarda el carrito en el localStorage
                localStorage.setItem('carrito', JSON.stringify(carrito));

                // Desactiva el botón "Agregar al carrito"
                var agregarBtn = document.querySelector(`[onclick="agregarAlCarrito(${id})"]`);
                agregarBtn.disabled = true;
                cantidadInput.disabled = true;
                actualizarCantidadCarrito();
            } else {
                alert('Puedes agregar desde 1 producto y tiene que ser menor que la cantidad disponible')
            }
        }

        function editarCantidad(id) {
            var cantidadInput = document.getElementById('cantidad' + id);
            cantidadInput.removeAttribute("disabled");

            // Habilita el botón "Agregar al carrito" y cambia la función
            var agregarBtn = document.querySelector(`[onclick="agregarAlCarrito(${id})"]`);
            agregarBtn.disabled = false;
            cantidadInput.disabled = false;
            agregarBtn.onclick = function() {
                agregarAlCarrito(id);
            };
        }

        function actualizarCantidadCarrito() {
            var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            var totalCantidad = 0;
            carrito.forEach(function(item) {
                totalCantidad += item.cantidad;
            });
            document.getElementById('carritoCantidad').textContent = totalCantidad;
        }

        function verCarrito() {
            window.location.href = '{{ route('checkout') }}';
        }


        // Actualizar la cantidad del carrito al cargar la página
        actualizarCantidadCarrito();
    </script>
@endsection
