@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Detalles de los pedidos</h1>
@stop

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Mostrar') }} detalles del pedido</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('detallespedidos.index') }}"> {{ __('Regresar') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="form-group">
                        <strong>Pedido #:</strong>
                        {{ $detallespedido->pedido->id }}
                    </div>
                    <div class="form-group">
                        <strong>Producto:</strong>
                        {{ $detallespedido->producto->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Cantidad:</strong>
                        {{ $detallespedido->cantidad }}
                    </div>
                    <div class="form-group">
                        <strong>Subtotal:</strong>
                        ${{ $detallespedido->subtotal }}
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
    

