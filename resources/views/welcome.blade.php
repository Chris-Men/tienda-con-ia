<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafetería</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/homeuser.css') }}"> <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/animado.css') }}"> <!-- Enlace al archivo CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/carrusel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <div class="header">
        <div>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
        <a href="#">
            <div class="loader"><i class="fas fa-coffee" style="font-size: 20px;"></i></div>

            <link rel="stylesheet"
                href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

            <a href="https://wa.me/50370816666?text=Me%20gustaría%20saber%20el%20precio%20del%20coche" class="whatsapp"
                target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>
        </a>
    </div>

    <div class="container mb-lg-auto">
        <div id="slide">
            <div class="item estilo" style="background-image: url(imagenes/bloggings.jpg);">
                <div class="content">
                    <div class="name">Aroma Digital</div>
                    <div class="des">Tu cafetería online, siempre a tu alcance.</div>

                </div>
            </div>
            <div class="item" style="background-image: url(imagenes/tostaccino.jpg);">
                <div class="content">
                    <div class="name">Café en un Clic</div>
                    <div class="des">Inicia tu experiencia cafetera aquí.</div>

                </div>
            </div>
            <div class="item" style="background-image: url(imagenes/capuchino.jpg);">
                <div class="content">
                    <div class="name">Sabor Navegante</div>
                    <div class="des">Encuentra tu rincón cafetero en nuestro sitio web.</div>

                </div>
            </div>
            <div class="item estilo" style="background-image: url(imagenes/cheesecake.jpg);">
                <div class="content">
                    <div class="name">De Grano a tu Pantalla</div>
                    <div class="des">La mejor selección de café, a solo un click de distancia.</div>

                </div>
            </div>
            <div class="item estilo" style="background-image: url(imagenes/pastel\ de\ mora.jpg);">
                <div class="content">
                    <div class="name">Sonrisas en Cada Taza Online</div>
                    <div class="des">Tu lugar favorito para disfrutar de momentos especiales.</div>

                </div>
            </div>
            <div class="item estilo"
                style="background-image: url(imagenes/tartaleta\ de\ crema\ y\ frutos\ del\ bosque.jpg);">
                <div class="content">
                    <div class="name">Explora el Café Virtual</div>
                    <div class="des"> Bienvenido a tu rincón cafetero en línea.</div>

                </div>
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><i class="fas fa-angle-left"></i></button>
            <button id="next"><i class="fas fa-angle-right"></i></button>
        </div>
    </div>

    <script>
        document.getElementById('next').onclick = function() {
            let lists = document.querySelectorAll('.item');
            document.getElementById('slide').appendChild(lists[0]);
        };

        document.getElementById('prev').onclick = function() {
            let lists = document.querySelectorAll('.item');
            document.getElementById('slide').prepend(lists[lists.length - 1]);
        }
    </script>
</body>

</html>
