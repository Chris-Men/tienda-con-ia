@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/homeuser.css') }}"> <!-- Enlace al archivo CSS externo -->
    <br><br>

   <center> <div class="card" style="width: 15rem;"> 
         <img src="{{ asset('imagenes/coffee-cup.png') }}" alt="" height="200em" width="200em">
        <div class="card">
            <div class="row mb-1">
            </div>
        </div>
    </div></center>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="welcome-message">
                    <h1 class="text-center">¡Bienvenido a nuestra cafetria en linea!</h1>
                    <p class="text-center"><a href="{{ route('cart') }}" class="btn btn-primary" style="margin-left: 10px;">
                            Explora Nuestra Variedad
                        </a>
                    <p class="card-text">Nuestro café premium te espera para una experiencia única.</p>
                    </p>
                    <div class="card-body">
                        <h5 class="card-title">¡Disfruta de un Café Exquisito!</h5>


                    </div>

                </div>
            </div>

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

            <a href="https://wa.me/50370816666?text=Me%20gustaría%20saber%20el%20precio%20del%20coche" class="whatsapp"
                target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a>


        </div>
    </div>
@endsection

@push('styles')
@endpush