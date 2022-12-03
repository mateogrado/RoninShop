@extends('layouts.app2')
@section('content')

<div class="container text-center">
    <h3><span class="content-header wow fadeIn " data-wow-delay="0.2s" data-wow-duration="2s">Panel de Administración</span></h3>

    <div class="row justify-content-center">

    <div class="col-12 col-lg-4">
        <div class="card border-card">
        <img style="height:281px;width:100%" class="card-img-top" src="{{url('/images/libreria/pedidos.jpg')}}" alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title">PEDIDOS</h4>
            <p class="card-text">Ver y borrar</p>
            <h5></h5>
        </div>
        <div class="card-body">
            <a href="{{ url('orders') }}" class="button-ronin">VER PEDIDOS</a>
        </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card border-card">
        <img style="height:281px;width:100%" class="card-img-top" src="{{url('/images/libreria/productos.jpg')}}" alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title">PRODUCTOS</h4>
            <p class="card-text">Añadir, editar y borrar</p>
            <h5></h5>
        </div>
        <div class="card-body">
            <a href="{{ route('products.index') }}" class="button-ronin">VER PRODUCTOS</a>
        </div>
        </div>
    </div>

    </div>
</div>

@endsection