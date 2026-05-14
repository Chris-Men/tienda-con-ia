@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Categorias</h1>
@stop
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} categoria</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('categorias.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $categoria->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $categoria->descripcion }}
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

{{-- @section('template_title')
    {{ $categoria->name ?? "{{ __('Show') Categoria" }}
@endsection --}}
