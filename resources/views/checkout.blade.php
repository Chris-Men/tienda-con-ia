@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}"> <!-- Enlace al archivo CSS externo -->
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css
    " rel="stylesheet">
    <script src="
            https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js
            "></script>
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
    <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <script>
        // Cargar el carrito del LocalStorage
        var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Obtener el elemento donde se mostrarán los productos del carrito
        var carritoContainer = document.getElementById('carrito-container');

        // Función para eliminar un producto del carrito y actualizar la vista
        function eliminarProducto(index) {
            Swal.fire({
                icon: 'warning',
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el producto de tu carrito.',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Elimina el producto del carrito
                    carrito.splice(index, 1);
                    localStorage.setItem('carrito', JSON.stringify(carrito));
                    mostrarProductosDelCarrito();

                    // Muestra la SweetAlert de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto eliminado del carrito',
                        text: 'El producto se ha eliminado exitosamente de tu carrito.'
                    });
                }
            });
            // carrito.splice(index, 1);
            // localStorage.setItem('carrito', JSON.stringify(carrito));
            // mostrarProductosDelCarrito();
        }

        // Función para mostrar los productos del carrito
        function mostrarProductosDelCarrito() {
            if (carrito.length === 0) {
                carritoContainer.innerHTML = '<p>El carrito está vacío</p>';
                carritoContainer.innerHTML +=
                    '<a href="{{ route('cart') }}" class="btn btn-primary mr-2">Regresar</button>';
            } else {
                var carritoHTML = '';
                carrito.forEach(function(producto, index) {
                    // carritoHTML += '<button class="eliminar-button" onclick="eliminarProducto(' + index +
                    //     ')">Eliminar de la lista</button>';
                    carritoHTML +=
                        '<li class="list-group-item d-flex justify-content-between align-items-center lh-sm">' +
                        '<div>' +
                        '<h4 class="my-0">' + producto.nombre + '</h4>' +
                        '<small class="text-body-secondary">' +
                        '<h5 class="my-0">Cantidad: ' + producto.cantidad +
                        '<span class="eliminar-container">' +
                        '<button class="eliminar-button" onclick="eliminarProducto(' + index +
                        ')">Eliminar de la lista</button>' +
                        '</span>' +
                        '</h5></small>' +
                        '</div>' +
                        '<span class="text-body-secondary"><h5 class="my-0">$' + (producto.precio * producto
                            .cantidad).toFixed(2) + '</h5></span>' +
                        '</li>' +
                        '<hr>';

                });

                var totalVenta = carrito.reduce(function(total, producto) {
                    return total + producto.precio * producto.cantidad;
                }, 0);

                carritoHTML +=
                    '<li class="list-group-item d-flex justify-content-between">' +
                    '<span><h4 class="my-0">Total (USD)</h4></span>' +
                    '<strong><h4 class="my-0">$' + totalVenta.toFixed(2) + '</h4></strong>' +
                    '</li>' +
                    '<li class="d-flex justify-content-center">' +
                    '<div class="container">' +
                    '<div class="row justify-content-center">' +
                    '<div class="col-md-8 text-center">' +
                    '<p class="text-center">' +
                    '<a href="{{ route('cart') }}" class="button-85 mr-2">Ir al Carrito</a>' +
                    // Agregado mr-2 para separación
                    '<form method="GET" action="{{ route('processPaypal') }}" class="d-inline">' +
                    '<input type="hidden" name="usuario" value="{{ auth()->user()->id }}">' +
                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                    '<input type="text" hidden id="carrito-input" name="carrito">' +
                    '<input type="hidden" name="totalVenta" id="total-venta-input" value="' + totalVenta.toFixed(2) + '">' +
                    '<button type="submit" id="finalizar-compra-button" class="button-85">Finalizar Compra</button>' +
                    '</form>' +
                    '</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</li>';


                carritoContainer.innerHTML = carritoHTML;
            }
        }

        mostrarProductosDelCarrito();

        var carritoInput = document.getElementById('carrito-input');
        carritoInput.value = JSON.stringify(carrito);


        // Obtén el carrito del LocalStorage
        var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Obtén el input donde mostrarás el contenido
        var carritoInput = document.getElementById('carrito-input');

        // Asigna el contenido del carrito al input como un valor JSON
        carritoInput.value = JSON.stringify(carrito);
    </script>
    </style>
@endsection
{{-- @extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}"> <!-- Enlace al archivo CSS externo -->

    <div class="container">
        <h1 class="text-center">Checkout de Compra</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">Resumen del Carrito</h2>
                <ul id="carrito-container" class="list-group">
                    <!-- Aquí se mostrarán los productos del carrito -->
                </ul>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <p class="text-center">
                            <a href="{{ route('cart') }}" class="btn btn-primary">Ir al Carrito</a>
                        </p>
            
                        <button onclick="finalizarCompra()" class="btn btn-primary">Finalizar Compra</button>
                    </div>
                </div>
            </div>
            

    <script>
        // Cargar el carrito del LocalStorage
        var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Obtener el elemento donde se mostrarán los productos del carrito
        var carritoContainer = document.getElementById('carrito-container');

        // Función para mostrar los productos del carrito
        function mostrarProductosDelCarrito() {
            if (carrito.length === 0) {
                carritoContainer.innerHTML = '<p>El carrito está vacío</p>';
            } else {
                carritoContainer.innerHTML = ''; // Limpiar contenido previo

                carrito.forEach(function(producto, index) {
                    var listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center lh-sm';

                    var nombreProducto = document.createElement('div');
                    nombreProducto.innerHTML = '<h4 class="my-0">' + producto.nombre +
                        '</h4><small class="text-body-secondary"><h5 class="my-0">Cantidad: ' + producto.cantidad +
                        '</h5></small>';

                    var precioProducto = document.createElement('span');
                    precioProducto.className = 'text-body-secondary';
                    precioProducto.innerHTML = '<h5 class="my-0">$' + (producto.precio * producto.cantidad).toFixed(2) +
                        '</h5>';

                    var eliminarButton = document.createElement('button');
                    eliminarButton.className = 'eliminar-button';
                    eliminarButton.innerHTML = 'Eliminar de la lista';
                    eliminarButton.onclick = function() {
                        eliminarProducto(index);
                    };

                    listItem.appendChild(nombreProducto);
                    listItem.appendChild(precioProducto);
                    listItem.appendChild(eliminarButton);

                    carritoContainer.appendChild(listItem);
                });

                var totalVenta = carrito.reduce(function(total, producto) {
                    return total + producto.precio * producto.cantidad;
                }, 0);

                var totalVentaRedondeado = totalVenta.toFixed(2);

                var totalItem = document.createElement('li');
                totalItem.className = 'list-group-item d-flex justify-content-between';
                totalItem.innerHTML = '<span><h4 class="my-0">Total (USD)</h4></span><strong><h4 class="my-0">$' +
                    totalVentaRedondeado + '</h4></strong>';

                carritoContainer.appendChild(totalItem);
            }
        }

        function eliminarProducto(index) {
            carrito.splice(index, 1);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            mostrarProductosDelCarrito();
        }

        // Función para finalizar la compra y pagar con PayPal
        function finalizarCompra() {
            // Construir la URL de PayPal con los parámetros necesarios
            var usuarioId = "{{ auth()->user()->id }}";
            var token = "{{ csrf_token() }}";
            var carritoJson = JSON.stringify(carrito);
            var total = calcularTotal().toFixed(2);;

            // Limpiar el carrito en el LocalStorage
            localStorage.removeItem('carrito');

            // Redirigir a PayPal
            window.location.href = "{{ route('confirmar') }}";
        }

        // Cargar y mostrar productos del carrito al cargar la página
        mostrarProductosDelCarrito();

        // Función para calcular el total del carrito
        function calcularTotal() {
            var totalVenta = carrito.reduce(function(total, producto) {
                return total + producto.precio * producto.cantidad;
            }, 0);

            return totalVenta;
        }
    </script>
@endsection --}}
