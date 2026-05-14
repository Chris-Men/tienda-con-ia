@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <h1>Dashboard</h1>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop

@php
    $totalCategorias = \App\Models\Categoria::count();
@endphp
@php
    $totalClientes = \App\Models\Cliente::count();
@endphp
@php
    $totalProductos = \App\Models\Producto::count();
@endphp
@php
    $totalPedidos = \App\Models\Pedido::count();
@endphp
@php
    // Obtener datos de la tabla de pedidos
    $pedidos = \App\Models\Pedido::select('fecha_pedido', \DB::raw('SUM(total) as total_compra'))
        ->groupBy('fecha_pedido')
        ->orderBy('fecha_pedido')
        ->get();
@endphp

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalCategorias }}</h3>
                            <p>Categorias</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('categorias.index') }}" class="small-box-footer">Más información <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalProductos }}</h3>
                            <p>Productos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('productos.index') }}" class="small-box-footer">Más información <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalClientes }}</h3>
                            <p>Usuarios Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('clientes.index') }}" class="small-box-footer">Más información <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalPedidos }}</h3>
                            <p>Pedidos Totales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('pedidos.index') }}" class="small-box-footer">Más información <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <section class="col-lg-7 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Pedidos por Fecha
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Barra</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            {{-- <div class="row">
                <section class="col-lg-7 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Sales
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">

                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div> --}}
            {{-- <script>
                // Código para inicializar y mostrar un gráfico de barras
                var ctx = document.getElementById('revenue-chart-canvas').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Categoría 1', 'Categoría 2', 'Categoría 3'], // Puedes personalizar tus categorías
                        datasets: [{
                            label: 'Ventas',
                            data: [10, 20, 30], // Puedes personalizar tus datos de ventas
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script> --}}
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        var pedidos = @json($pedidos); // Convierte los datos de pedidos a formato JSON

        // Extrae las fechas y totales de la respuesta JSON
        var fechas = pedidos.map(item => item.fecha_pedido);
        var totales = pedidos.map(item => item.total_compra);

        var ctx = document.getElementById('revenue-chart-canvas').getContext('2d');
        ctx.canvas.width = window.innerWidth; // Establece el ancho del canvas al ancho de la ventana
        ctx.canvas.height = window.innerHeight; // Establece el alto del canvas al alto de la ventana

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: fechas,
                datasets: [{
                    label: 'Ganancias por fecha',
                    data: totales,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return '$' + value; // Agrega el símbolo de dólar a las etiquetas del eje y
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                label += ': $' + context.formattedValue;
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>

    {{-- <script>
        var ctx = document.getElementById('revenue-chart-canvas').getContext('2d');
        var pedidos = @json($pedidos); // Convierte los datos de pedidos a formato JSON

        // Extrae las fechas y totales de la respuesta JSON
        var fechas = pedidos.map(item => item.fecha_pedido);
        var totales = pedidos.map(item => item.total_compra);

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: fechas,
                datasets: [{
                    label: 'Total de Pedidos',
                    data: totales,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script> --}}
    {{-- <script>
        console.log('Hi!');
    </script> --}}
@stop
