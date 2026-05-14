@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Checkout de Compra</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">Resumen del Carrito</h2>
                <div id="carrito-container">
                </div>
            </div>
        </div>
    </div>
    <script>
        // Cargar el carrito del LocalStorage
        var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Obtener el elemento donde se mostrarán los productos del carrito
        var carritoContainer = document.getElementById('carrito-container');

        // Función para eliminar un producto del carrito y actualizar la vista
        function eliminarProducto(index) {
            carrito.splice(index, 1);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            mostrarProductosDelCarrito();
        }

        // Función para mostrar los productos del carrito
        function mostrarProductosDelCarrito() {
            if (carrito.length === 0) {
                carritoContainer.innerHTML = '<p>El carrito está vacío</p>';
            } else {
                var carritoHTML = '';
                carrito.forEach(function(producto, index) {
                    carritoHTML += '<button class="eliminar-button" onclick="eliminarProducto(' + index +
                        ')">Eliminar de la lista</button>';
                    carritoHTML +=
                        '<li class="list-group-item d-flex justify-content-between align-items-center lh-sm"><div><h4 class="my-0">' +
                        producto.nombre + '</h4><small class="text-body-secondary"><h5 class="my-0">Cantidad: ' +
                        producto.cantidad +
                        '</h5></small></div><span class="text-body-secondary"><h5 class="my-0">$' + (producto
                            .precio * producto.cantidad) + '</h5></span>';
                    carritoHTML += '</li>';
                    carritoHTML += '<hr>';
                });

                var totalVenta = carrito.reduce(function(total, producto) {
                    return total + producto.precio * producto.cantidad;
                }, 0);

                carritoHTML +=
                    '<li class="list-group-item d-flex justify-content-between"><span><h4 class="my-0">Total (USD)</h4></span><strong><h4 class="my-0">$' +
                    totalVenta + '</h4></strong></li>';

                carritoHTML += '<li class="list-group-item d-flex justify-content-center">';
                carritoHTML += '<form method="POST" action="' + "{{ route('finalizar.compra') }}" + '">';
                carritoHTML += '<input type="hidden" name="usuario" value="' + "{{ auth()->user()->id }}" + '">';
                carritoHTML += '<input type="hidden" name="_token" value="' + "{{ csrf_token() }}" + '">';
                carritoHTML += '<input type="text" hidden id="carrito-input" name="carrito">';
                carritoHTML +=
                    '<button type="submit" id="finalizar-compra-button" class="btn btn-primary">Finalizar Compra</button>';
                carritoHTML += '</form>';
                carritoHTML += '</li>';

                carritoContainer.innerHTML = carritoHTML;
            }
        }

        mostrarProductosDelCarrito();


        // Obtén el carrito del LocalStorage
        var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Obtén el input donde mostrarás el contenido
        var carritoInput = document.getElementById('carrito-input');

        // Asigna el contenido del carrito al input como un valor JSON
        carritoInput.value = JSON.stringify(carrito);
    </script>
    </style>
@endsection
