@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/homeuser.css') }}">
    <br>
    <center>
        <div class="card" style="width: 15rem;">
            <img src="{{ asset('imagenes/coffee-cup.png') }}" alt="" height="200em" width="200em">
            <div class="card">
                <div class="row mb-1">
                </div>
            </div>
        </div>
    </center>
    <div class="container">
        <h1 class="text-center">La compra se realizó con éxito</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="GET" action="{{ route('cart') }}">
                    <h2 class="text-center">
                        <button type="submit" class="btn btn-primary" id="seguirComprandoBtn">Seguir Comprando</button>
                    </h2>
                </form>
            </div>
        </div>
    </div>

    @if (session('clearCart'))
        <script>
            // Borrar el carrito en localStorage
            localStorage.removeItem('carrito');
        </script>
    @endif
    {{-- <script>
        document.getElementById('seguirComprandoBtn').addEventListener('click', function() {
            // Remover el item 'carrito' del localStorage al hacer clic en el botón
            localStorage.removeItem('carrito');
        });
    </script> --}}
@endsection
