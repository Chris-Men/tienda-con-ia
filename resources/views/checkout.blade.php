@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cloudflare.com">

    <style>
        /* Sincronización con el ecosistema StyleMe */
        body {
            background-color: #0b0f19 !important;
            color: #ffffff;
        }

        .checkout-container {
            max-width: 750px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .checkout-card {
            background: rgba(22, 30, 49, 0.6) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.06) !important;
            border-radius: 16px !important;
            padding: 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .checkout-header h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 5px;
            text-align: center;
        }

        .checkout-header p {
            color: #94a3b8;
            font-size: 15px;
            text-align: center;
            margin-bottom: 35px;
        }

        /* Lista de productos en el resumen */
        .checkout-item-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .checkout-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .checkout-item-details h4 {
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: #ffffff;
        }

        .checkout-item-details p {
            font-size: 14px;
            color: #94a3b8;
            margin: 0;
        }

        /* Botón eliminar minimalista */
        .btn-delete-item {
            background: transparent;
            border: none;
            color: #f87171;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            margin-top: 5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: 0.2s;
        }

        .btn-delete-item:hover {
            color: #ef4444;
            text-decoration: underline;
        }

        .checkout-item-price {
            font-size: 16px;
            font-weight: 700;
            color: #38bdf8;
        }

        /* Bloque de Total */
        .checkout-total-block {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 0;
            margin-top: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .checkout-total-block h3 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: #94a3b8;
        }

        .checkout-total-block .total-price {
            font-size: 26px;
            font-weight: 800;
            color: #38bdf8;
        }

        /* Bloque de botones de acción */
        .checkout-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-checkout-secondary {
            background-color: #1e293b !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #cbd5e1 !important;
            padding: 14px 24px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex: 1;
            transition: 0.2s;
        }

        .btn-checkout-secondary:hover {
            background-color: #334155 !important;
            color: #ffffff !important;
        }

        .btn-checkout-primary {
            background-color: #4f46e5 !important;
            border: none !important;
            color: white !important;
            padding: 14px 24px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex: 1;
            transition: 0.2s;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .btn-checkout-primary:hover {
            background-color: #4338ca !important;
            transform: translateY(-1px);
        }

        /* Estado Carrito Vacío */
        .empty-cart-state {
            text-align: center;
            padding: 40px 0;
        }

        .empty-cart-state i {
            font-size: 60px;
            color: #334155;
            margin-bottom: 20px;
        }

        .empty-cart-state p {
            color: #94a3b8;
            font-size: 16px;
            margin-bottom: 25px;
        }
    </style>

    <div class="checkout-container">
        <div class="checkout-card">

            <div class="checkout-header">
                <h1>Checkout de Compra</h1>
                <p>Revisa los artículos de tu orden antes de proceder al pago seguro</p>
            </div>

            <!-- Contenedor dinámico controlado por JavaScript -->
            <div id="carrito-container"></div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    <script>
        // Cargar el carrito del LocalStorage
        var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        var carritoContainer = document.getElementById('carrito-container');

        function eliminarProducto(index) {
            Swal.fire({
                title: '¿Retirar producto?',
                text: 'Esta acción removerá la prenda seleccionada de tu resumen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Sí, remover',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    carrito.splice(index, 1);
                    localStorage.setItem('carrito', JSON.stringify(carrito));
                    mostrarProductosDelCarrito();

                    Swal.fire({
                        title: 'Actualizado',
                        text: 'El artículo fue retirado de tu orden.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }

        function mostrarProductosDelCarrito() {
            if (carrito.length === 0) {
                carritoContainer.innerHTML = `
                    <div class="empty-cart-state">
                        <i class="fas fa-shopping-bag"></i>
                        <p>Tu bolsa de compras está vacía de momento.</p>
                        <a href="{{ route('cart') }}" class="btn-checkout-secondary" style="display:inline-flex; width:auto;">
                            <i class="fas fa-arrow-left"></i> Volver al Catálogo
                        </a>
                    </div>`;
            } else {
                var carritoHTML = '<ul class="checkout-item-list">';

                carrito.forEach(function(producto, index) {
                    carritoHTML += `
                        <li class="checkout-item">
                            <div class="checkout-item-details">
                                <h4>${producto.nombre}</h4>
                                <p>Cantidad: ${producto.cantidad}</p>
                                <button class="btn-delete-item" onclick="eliminarProducto(${index})">
                                    <i class="fas fa-trash-can"></i> Quitar artículo
                                </button>
                            </div>
                            <div class="checkout-item-price">
                                $${(producto.precio * producto.cantidad).toFixed(2)}
                            </div>
                        </li>`;
                });

                var totalVenta = carrito.reduce(function(total, producto) {
                    return total + (producto.precio * producto.cantidad);
                }, 0);

                carritoHTML += `
                    </ul>
                    <div class="checkout-total-block">
                        <h3>Total de tu Orden (USD)</h3>
                        <div class="total-price">$${totalVenta.toFixed(2)}</div>
                    </div>

                    <div class="checkout-actions">
                        <a href="{{ route('cart') }}" class="btn-checkout-secondary">
                            <i class="fas fa-arrow-left"></i> Seguir Comprando
                        </a>

                        <form method="GET" action="{{ route('processPaypal') }}" class="d-inline flex-grow-1" id="paypal-form" style="display:flex !important; flex:1;">
                            <input type="hidden" name="usuario" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="carrito-input" name="carrito">
                            <input type="hidden" name="totalVenta" id="total-venta-input" value="${totalVenta.toFixed(2)}">
                            <button type="submit" id="finalizar-compra-button" class="btn-checkout-primary">
                                <i class="fab fa-paypal"></i> Proceder al Pago
                            </button>
                        </form>
                    </div>`;

                carritoContainer.innerHTML = carritoHTML;

                // Sincronizar de forma segura el valor del input oculto para PayPal en tiempo real
                var carritoInput = document.getElementById('carrito-input');
                if(carritoInput) {
                    carritoInput.value = JSON.stringify(carrito);
                }
            }
        }

        // Renderizado inicial
        mostrarProductosDelCarrito();
    </script>
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
