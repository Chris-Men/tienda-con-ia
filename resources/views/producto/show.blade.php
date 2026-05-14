@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $producto->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Stock:</strong>
                            {{ $producto->stock }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $producto->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Imagen:</strong>
                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}"
                                style="max-width: 100px;">
                        </div>
                        <div class="form-group">
                            <strong>Categoria:</strong>
                            {{ $producto->categoria->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
