<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>StyleMe - E-commerce Inteligente</title>

    {{-- Icono de la pestaña (Favicon) --}}
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts & Icons Actualizados -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://bunny.net" rel="stylesheet">
    <link rel="stylesheet" href="https://cloudflare.com">

    <!-- Scripts de Laravel (Compilación de Bootstrap/JS) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* BLINDAJE MAESTRO - Fuerza el fondo oscuro instantáneo y elimina degradados residuales */
        html,
        body {
            background-color: #0b0f19 !important;
            background-image: none !important;
            color: #ffffff !important;
            font-family: 'Nunito', sans-serif;
            min-height: 100vh !important;
            height: 100% !important;
            margin: 0;
            padding: 0;
        }

        /* Fuerza a que el contenedor de la aplicación ocupe toda la pantalla disponible */
        #app {
            background-color: #0b0f19 !important;
            background-image: none !important;
            min-height: 100vh !important;
            display: flex;
            flex-direction: column;
        }

        /* Navbar elegante y oscura */
        .custom-navbar {
            background-color: #0f172a !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 15px 0;
            z-index: 10;
        }

        .custom-brand {
            font-size: 22px !important;
            font-weight: 800 !important;
            letter-spacing: 1px;
            color: #4f46e5 !important;
            /* Morado tecnológico */
            text-decoration: none;
        }

        .custom-brand span {
            color: #ffffff !important;
        }

        /* Enlaces de la barra de navegación */
        .custom-nav-link {
            color: #cbd5e1 !important;
            font-weight: 600;
            font-size: 15px;
            transition: 0.3s;
            padding: 8px 16px !important;
        }

        .custom-nav-link:hover {
            color: #4f46e5 !important;
        }

        /* Menú desplegable para el usuario autenticado */
        .custom-dropdown-menu {
            background-color: #1e293b !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 8px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
            margin-top: 10px !important;
        }

        .custom-dropdown-item {
            color: #cbd5e1 !important;
            font-weight: 500;
            padding: 10px 20px !important;
            transition: 0.2s;
        }

        .custom-dropdown-item:hover {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
        }

        /* Contenedor principal de las vistas internas (Fuerza el estirado vertical completo) */
        .main-content-wrapper {
            background-color: #0b0f19 !important;
            background-image: none !important;
            flex: 1;
            /* Empuja el fondo oscuro hasta el borde inferior absoluto de la pantalla */
            display: flex;
            flex-direction: column;
        }

        /* Arreglo para el botón hamburguesa en móviles */
        .custom-toggler {
            border-color: rgba(255, 255, 255, 0.1) !important;
            padding: 4px 8px;
        }

        .custom-toggler .navbar-toggler-icon {
            filter: invert(1);
        }

        /* 1. Ancho de la barra de desplazamiento global */
        ::-webkit-scrollbar {
            width: 10px;
            /* Un poco más ancha que la interna para que sea fácil de arrastrar */
        }

        /* 2. El fondo del canal por donde se desliza */
        ::-webkit-scrollbar-track {
            background: #0f172a;
            /* Un azul muy oscuro (casi negro) que combine con tu fondo */
        }

        /* 3. El indicador o tirador que arrastras con el mouse */
        ::-webkit-scrollbar-thumb {
            background: #334155;
            /* Un gris oscuro discreto */
            border-radius: 5px;
            border: 2px solid #0f172a;
            /* Espaciado transparente artificial */
        }

        /* 4. Color al pasar el mouse por encima */
        ::-webkit-scrollbar-thumb:hover {
            background: #4f46e5;
            /* Cambia a tu morado característico cuando pasas el mouse */
        }

        /* Ocultar las flechas por defecto en Chrome, Edge, Safari y Brave */
        /* #cantidad_prendas::-webkit-outer-spin-button,
        #cantidad_prendas::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        } */

        /* Ocultar las flechas en Firefox */
        /* #cantidad_prendas {
            -moz-appearance: textfield;
        } */

        /* Darle un efecto de iluminación suave cuando el usuario hace clic para escribir */
        #cantidad_prendas:focus {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3);
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Navbar renovada -->
        <nav class="navbar navbar-expand-md custom-navbar shadow-sm">
            <div class="container">
                <a class="custom-brand" href="{{ url('/') }}">
                    Style<span>Me</span>
                </a>

                <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i> Iniciar Sesión
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i> Registrarse
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link custom-nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item custom-dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenedor central inyectado sin rellenos adicionales destructivos -->
        <main class="main-content-wrapper">
            @yield('content')
        </main>
    </div>
</body>

</html>
