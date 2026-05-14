@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Pedido registrados') }}
                        </span>

                         <div class="float-right">
                            <a href="{{ route('pedidos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                              {{ __('Crear nuevo pedido') }}
                            </a>
                          </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    
                                    <th>Cliente</th>
                                    <th>Fecha del Pedido</th>
                                    <th>Total</th>
                                    <th>Estado</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
                                        <td>{{ $pedido->cliente->name }}</td>
                                        <td>{{ $pedido->fecha_pedido }}</td>
                                        <td>${{ $pedido->total }}</td>
                                        {{-- <td>{{ $pedido->estado }}</td> --}}
                                        <td>
                                            @if($pedido->estado == 0)
                                                <span class="badge badge-danger">Cancelado</span>
                                            @else
                                                {{ $pedido->estado }}
                                            @endif
                                        </td>

                                        <td>
                                            <form action="{{ route('pedidos.destroy',$pedido->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('pedidos.show',$pedido->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('pedidos.edit',$pedido->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $pedidos->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        /* Agrega estilos personalizados para el paginado aquí */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination li {
            margin: 0 5px;
            list-style: none;
            display: inline-block;
        }

        .pagination li a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: #3490dc;
            color: #ffffff;
            border-radius: 5px;
        }

        .pagination li.active a {
            background-color: #007bff;
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
    
