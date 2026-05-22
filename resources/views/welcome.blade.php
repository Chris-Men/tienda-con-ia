<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleMe - Tienda con IA</title>

    {{-- Icono de la pestaña (Favicon) --}}
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">

    <!-- Mantenemos tus estilos base, pero limpiaremos el carrusel -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <style>
        /* Estilos modernos e integrados para evitar que se rompa la vista */
        body {
            margin: 0;
            padding: 0;
            background-color: #0b0f19;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Navbar elegante */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: linear-gradient(to bottom, rgba(11,15,25,0.9), rgba(11,15,25,0));
            position: absolute;
            width: 100%;
            box-sizing: border-box;
            z-index: 10;
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 2px;
            color: #4f46e5; /* Morado tecnológico IA */
            text-decoration: none;
        }

        .logo span { color: #ffffff; }

        .nav-auth a {
            color: #ffffff;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 20px;
            transition: 0.3s;
        }

        .nav-auth a:hover { background-color: rgba(255,255,255,0.1); }
        .nav-auth .btn-register { background-color: #4f46e5; }
        .nav-auth .btn-register:hover { background-color: #4338ca; }

        /* Contenedor del Carrusel pantalla completa */
        .slider-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        .slide-item {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding-left: 10%;
            box-sizing: border-box;
        }

        .slide-item.active { opacity: 1; }

        /* Capa oscura sobre la imagen para que resalte el texto */
        .slide-item::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(11, 15, 25, 0.55);
            z-index: 1;
        }

        .slide-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .slide-content h1 {
            font-size: 3.5rem;
            margin-bottom: 15px;
            font-weight: 800;
            line-height: 1.2;
        }

        .slide-content p {
            font-size: 1.2rem;
            color: #cbd5e1;
            margin-bottom: 30px;
        }

        /* Botones de navegación */
        .slider-nav {
            position: absolute;
            bottom: 50px;
            right: 50px;
            z-index: 5;
            display: flex;
            gap: 15px;
        }

        .slider-nav button {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
        }

        .slider-nav button:hover {
            background: #4f46e5;
            border-color: #4f46e5;
        }

        /* Botón WhatsApp Flotante */
        .whatsapp-btn {
            position: fixed;
            bottom: 40px;
            left: 40px;
            background-color: #25d366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            z-index: 100;
            text-decoration: none;
            transition: 0.3s;
        }
        .whatsapp-btn:hover { transform: scale(1.1); }
    </style>
</head>

<body>

    <!-- Menú de navegación adaptado a StyleMe -->
    <nav class="navbar">
        <a href="#" class="logo">Style<span>Me</span></a>
        <div class="nav-auth">
            <a href="{{ route('login') }}">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="btn-register">Registrarse</a>
        </div>
    </nav>

    <!-- Carrusel Adaptativo Inteligente -->
    <div class="slider-container">

        <!-- Slide 1 -->
        <div class="slide-item active" style="background-image: url('{{ asset('imagenes/banner1.jpg') }}');">
            <div class="slide-content">
                <h1>Moda Inteligente <br><span style="color:#4f46e5;">Diseñada para ti</span></h1>
                <p>Explora colecciones exclusivas seleccionadas mediante inteligencia artificial según tus gustos y estilo único.</p>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide-item" style="background-image: url('{{ asset('imagenes/banner2.jpg') }}');">
            <div class="slide-content">
                <h1>Tu Probador Virtual</h1>
                <p>Encuentra tu combinación ideal de prendas sin salir de casa. Redefine tu clóset hoy mismo.</p>
            </div>
        </div>

        <!-- Controles -->
        <div class="slider-nav">
            <button id="prevBtn"><i class="fas fa-chevron-left"></i></button>
            <button id="nextBtn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <!-- WhatsApp Flotante (Tu número configurado) -->
    <a href="https://wa.me" class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Lógica JavaScript simplificada para evitar bloqueos gráficos -->
    <script>
        const slides = document.querySelectorAll('.slide-item');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        let currentIndex = 0;

        function showSlide(index) {
            slides[currentIndex].classList.remove('active');
            currentIndex = (index + slides.length) % slides.length;
            slides[currentIndex].classList.add('active');
        }

        nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
        prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));

        // Cambio automático suave cada 6 segundos
        setInterval(() => showSlide(currentIndex + 1), 6000);
    </script>
</body>

</html>
