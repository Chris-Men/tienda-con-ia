@extends('layouts.app')

@section('content')

<div class="container"> <h1 class="text-center">La compra se realizo con exito</h1> <div class="row justify-content-center">
    <div class="col-md-8">
    <form method="GET" action="{{ route('catalogo') }}">
    <h2 class="text-center"><button type="submit" class="btn btn-primary">Seguir Comprando</button></h2>
    </form>


@endsection