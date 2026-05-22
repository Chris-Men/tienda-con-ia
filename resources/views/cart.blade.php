@extends('layouts.app')

@section('content')
    <!-- ESTILOS -->
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background-color: #0b0f19 !important;
            color: #ffffff;
            overflow-x: hidden;
        }

        html {
            background-color: #0b0f19 !important;
        }

        .studio-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px;
            box-sizing: border-box;
        }

        .studio-grid {
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 50px;
            margin-top: 30px;
            width: 100%;
        }

        @media (max-width: 992px) {
            .studio-grid {
                grid-template-columns: 1fr;
            }
        }

        .ai-control-panel {
            background: rgba(22, 30, 49, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .panel-section-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #4f46e5;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group-studio {
            margin-bottom: 20px;
        }

        .form-group-studio label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 8px;
        }

        .select-studio {
            width: 100%;
            background-color: #0f172a !important;
            border: 1px solid #334155 !important;
            border-radius: 8px !important;
            padding: 12px !important;
            color: #ffffff !important;
            font-size: 14px;
            box-sizing: border-box;
        }

        .textarea-studio {
            width: 100%;
            background-color: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            padding: 12px;
            color: #ffffff;
            font-size: 14px;
            resize: none;
            height: 100px;
            box-sizing: border-box;
        }

        .avatar-3d-viewport {
            background: radial-gradient(circle at center, #1e1b4b 0%, #090d16 100%);
            border: 1px solid rgba(79, 70, 229, 0.3);
            border-radius: 16px;
            height: 650px;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }

        .mannequin-display {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .placeholder-icon {
            font-size: 240px;
            color: rgba(79, 70, 229, 0.15);
            text-shadow: 0 0 40px rgba(79, 70, 229, 0.4);
        }

        .generated-image {
            max-width: 92%;
            max-height: 92%;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(79, 70, 229, 0.5);
        }

        .laser-scanner-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right,
                    transparent,
                    #38bdf8,
                    #4f46e5,
                    #38bdf8,
                    transparent);
            box-shadow: 0 0 15px #38bdf8, 0 0 30px #4f46e5;
            z-index: 3;
            animation: scanMove 4s linear infinite;
        }

        @keyframes scanMove {
            0% {
                top: 0%;
                opacity: 0;
            }

            5% {
                opacity: 1;
            }

            95% {
                opacity: 1;
            }

            100% {
                top: 100%;
                opacity: 0;
            }
        }

        .viewport-overlay-controls {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 5;
            width: 85%;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-display {
            font-size: 24px;
            font-weight: 800;
            color: #38bdf8;
        }

        .btn-studio-generate {
            background-color: #4f46e5 !important;
            border: none !important;
            color: white !important;
            width: 100%;
            padding: 14px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
            transition: 0.2s;
        }

        .btn-studio-generate:hover {
            background-color: #4338ca !important;
        }

        .btn-studio-checkout {
            background-color: #22c55e !important;
            border: none !important;
            color: white !important;
            padding: 12px 24px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-studio-checkout:hover {
            background-color: #16a34a !important;
        }

        .ai-loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(11, 15, 25, 0.95);
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }

        .ai-loading-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .sparkle-spinner {
            font-size: 50px;
            color: #38bdf8;
            animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div class="studio-container">

        <!-- HEADER -->
        <div class="catalog-header-section"
            style="padding: 20px 0; display: flex; justify-content: space-between; align-items: center;">

            <div class="catalog-title">
                <h1>AI Design Studio — StyleMe</h1>
                <p>Crea, simula en tiempo real y adquiere tus prendas personalizadas</p>
            </div>

            <div>
                <button class="btn-view-cart" onclick="verCarrito()"
                    style="
                    background-color: #4f46e5;
                    border: none;
                    color: white;
                    padding: 12px 24px;
                    border-radius: 30px;
                    font-weight: 700;
                ">
                    <i class="fas fa-shopping-bag"></i>
                    Ver Carrito

                    <span class="badge bg-danger text-white ms-1" id="carritoCantidad">0</span>
                </button>
            </div>
        </div>

        <!-- GRID -->
        <div class="studio-grid">

            <!-- PANEL -->
            <div class="ai-control-panel">

                <div class="panel-section-title">
                    <i class="fas fa-wand-magic-sparkles"></i>
                    Parámetros de Generación IA
                </div>

                <div class="form-group-studio">
                    <label>
                        Describe el estampado:
                    </label>

                    <textarea id="prompt" class="textarea-studio" placeholder="Ej. Dragon Ball Android 17 anime style"></textarea>
                </div>

                <div class="form-group-studio">
                    <label>
                        Tipo de Prenda:
                    </label>

                    <select id="tipo_camisa" class="select-studio">

                        <option value="premium cotton t-shirt">
                            Camisa Premium
                        </option>

                        <option value="oversized streetwear t-shirt">
                            Oversized Streetwear
                        </option>

                        <option value="black hoodie">
                            Hoodie
                        </option>

                    </select>
                </div>

                <div class="form-group-studio">
                    <label>
                        Talla:
                    </label>

                    <select id="talla" class="select-studio">

                        <option value="S">S</option>
                        <option value="M" selected>M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>

                    </select>
                </div>

                <button class="btn-studio-generate" onclick="simularGeneracionIA()">

                    <i class="fas fa-arrows-spin"></i>
                    Generar Diseño
                </button>

            </div>

            <!-- VISOR -->
            <div class="avatar-3d-viewport">

                <div class="laser-scanner-line"></div>

                <!-- LOADING -->
                <div class="ai-loading-overlay" id="loadingAi">

                    <i class="fas fa-circle-notch sparkle-spinner"></i>

                    <h5 class="mt-4">
                        Generando diseño IA...
                    </h5>

                    <p class="text-muted small">
                        Procesando mockup de ropa
                    </p>
                </div>

                <!-- DISPLAY -->
                <div class="mannequin-display" id="viewportDisplay">

                    <i class="fas fa-shirt placeholder-icon" id="placeholderIcon"></i>

                    <img id="generatedImage" class="generated-image" style="display:none;">
                </div>

                <!-- CONTROLES -->
                <div class="viewport-overlay-controls">

                    <!-- Bloque Izquierdo: Precio Estimado (Se mantiene igual) -->
                    <div>
                        <div style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase;">
                            Precio Estimado
                        </div>
                        <div class="price-display">
                            $35.00
                        </div>
                    </div>

                    <!-- Bloque Derecho Nuevo: Contenedor flexible que junta la Cantidad y tu Botón -->
                    <div style="display: flex; align-items: center; gap: 12px;">

                        <!-- Input para seleccionar la cantidad de camisetas -->
                        <div class="quantity-control-studio" style="display: flex; align-items: center; gap: 6px;">
                            <label
                                style="font-size: 11px; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin: 0;">Cant:</label>
                            <input type="number" id="cantidad_prendas" value="1" min="1" max="99"
                                style="width: 55px; height: 42px; background-color: #1e293b; border: 1px solid #334155; color: white; padding: 6px; border-radius: 8px; text-align: center; font-weight: 700; outline: none;">
                        </div>

                        <!-- Tu botón original de Añadir al Carrito -->
                        <button class="btn-studio-checkout" onclick="agregarDisenoAlCarrito()" style="margin: 0;">
                            <i class="fas fa-cart-plus"></i>
                            Añadir al Carrito
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        var productosSeleccionados =
            JSON.parse(localStorage.getItem('carrito')) || [];

        function simularGeneracionIA() {

            var promptInput =
                document.getElementById('prompt').value;

            if (!promptInput.trim()) {

                Swal.fire(
                    'Diseño IA',
                    'Por favor escribe un diseño.',
                    'info'
                );

                return;
            }

            var loading =
                document.getElementById('loadingAi');

            var generatedImage =
                document.getElementById('generatedImage');

            var placeholderIcon =
                document.getElementById('placeholderIcon');

            loading.classList.add('active');

            var tipoPrenda =
                document.getElementById('tipo_camisa').value;

            // PROMPT ULTRA ESTRICTO
            var finalPrompt = `
front view of a ${tipoPrenda},

plain black fabric,

minimalist fashion mockup,

realistic clothing folds,

centered apparel product photography,

studio lighting,

white background,

the shirt contains ONLY a printed graphic design of:

${promptInput},

anime print style,

the print must stay inside the shirt area,

high detail print,

screen printing style,

fashion ecommerce mockup,

realistic t-shirt texture,

no extra characters outside the shirt,

no scene,

no background objects,

clean clothing catalog photo,

professional clothing mockup,

isolated apparel product,

ultra realistic fashion photography
`;

            var cleanPrompt =
                encodeURIComponent(finalPrompt);

            // MÁS RÁPIDO QUE FLUX
            var imageUrl =
                `https://image.pollinations.ai/prompt/${cleanPrompt}?model=turbo&width=768&height=768&enhance=true`;

            console.log(imageUrl);

            var imgTester = new Image();

            imgTester.src = imageUrl;

            imgTester.onload = function() {

                loading.classList.remove('active');

                generatedImage.src = imageUrl;

                generatedImage.style.display = 'block';

                placeholderIcon.style.display = 'none';

                Swal.fire({
                    icon: 'success',
                    title: '¡Diseño generado!',
                    text: 'La IA creó el mockup correctamente.',
                    timer: 2200,
                    showConfirmButton: false
                });
            };

            imgTester.onerror = function() {

                loading.classList.remove('active');

                Swal.fire(
                    'Error',
                    'No se pudo generar la imagen.',
                    'error'
                );
            };
        }

        function agregarDisenoAlCarrito() {
            var prompt = document.getElementById('prompt').value;
            var tipoPrenda = document.getElementById('tipo_camisa').value;
            var talla = document.getElementById('talla').value;
            var generatedImage = document.getElementById('generatedImage');

            // CAPTURAR LA CANTIDAD SELECCIONADA
            var cantidadInput = document.getElementById('cantidad_prendas');
            var cantidadSeleccionada = cantidadInput ? parseInt(cantidadInput.value) : 1;

            // Validación básica por si ponen números negativos o vacíos
            if (isNaN(cantidadSeleccionada) || cantidadSeleccionada < 1) {
                cantidadSeleccionada = 1;
            }

            if (!prompt.trim() || generatedImage.style.display === 'none' || !generatedImage.src) {
                Swal.fire(
                    'Diseño IA',
                    'Debes escribir un prompt y presionar "Generar Diseño" antes de añadir al carrito.',
                    'warning'
                );
                return;
            }

            var itemDiseno = {
                id: Date.now(),
                nombre: "Diseño IA (" + tipoPrenda + " - " + talla + ")",
                precio: 35.00,
                cantidad: cantidadSeleccionada, // <--- AHORA USA EL NÚMERO DEL INPUT
                imagen: generatedImage.src
            };

            // Buscar si el producto idéntico ya estaba en el carrito
            var productoExistente = productosSeleccionados.find(item =>
                item.nombre === itemDiseno.nombre && item.imagen === itemDiseno.imagen
            );

            if (productoExistente) {
                // En lugar de sumar 1, sumamos la cantidad que eligió el usuario
                productoExistente.cantidad += cantidadSeleccionada;
            } else {
                productosSeleccionados.push(itemDiseno);
            }

            localStorage.setItem('carrito', JSON.stringify(productosSeleccionados));
            actualizarCantidadCarrito();

            // Reiniciar el input a 1 tras agregar con éxito
            if (cantidadInput) cantidadInput.value = 1;

            Swal.fire({
                icon: 'success',
                title: '¡Agregado al carrito!',
                text: `Se añadieron ${cantidadSeleccionada} unidades correctamente.`,
                timer: 1800,
                showConfirmButton: false
            });
        }

        function actualizarCantidadCarrito() {

            var carrito =
                JSON.parse(localStorage.getItem('carrito')) || [];

            var totalCantidad = 0;

            carrito.forEach(function(item) {

                totalCantidad += item.cantidad;
            });

            var element =
                document.getElementById('carritoCantidad');

            if (element) {

                element.textContent = totalCantidad;
            }
        }

        function verCarrito() {

            window.location.href =
                '{{ route('checkout') }}';
        }

        actualizarCantidadCarrito();
    </script>
@endsection
