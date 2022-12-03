@extends('layouts.app2')
@section('content')

<div class="container text-center">


    <h1>Comics</h1>
    <div class="row">

        <div class="containerProductoTienda">
    @foreach ($allProducts as $product)
        @if($product->categoria == 'comic') 

        <div class="card border-card" style="width:350px;height:645px;">
        <img style="width:100%" class="ImagenTienda" src="{{url('/images/libreria/'.$product->img)}}" alt="">
        <div class="card-body">
            <h4 class="card-title">{{$product->name}}</h4>
            <p class="card-text">{{$product->description}}</p>
            <h5>{{$product->price}}€</h5>
            <p>Unidades: {{$product->unidades}}</p>
        </div>
        <div class="card-body">
            @if($product->unidades == 0)
            <button class="button-ronin" disabled>Comprar</button>
            @else
            <a href="{{ route('cart.add', $product->id)}}" id="buyProduct" class="button-ronin">Comprar</a>
            @endif
        </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    
    <h1>Mangas</h1>
    <div class="row">
        <div class="containerProductoTienda">
    @foreach ($allProducts as $product)

        @if($product->categoria == 'manga') 
        <div class="card border-card" style="width:350px;height:645px;">
            <img style="width:100%" class="ImagenTienda" src="{{url('/images/libreria/'.$product->img)}}" alt="">
        <div class="card-body">
            <h4 class="card-title">{{$product->name}}</h4>
            <p class="card-text">{{$product->description}}</p>
            <h5>{{$product->price}}€</h5>
            <p>Unidades: {{$product->unidades}}</p>
        </div>
        <div class="card-body">
            @if($product->unidades = 0)
            <a href="{{ route('cart.add', $product->id)}}" class="button-ronin" disabled>Comprar</a>
            @else
            <a href="{{ route('cart.add', $product->id)}}" id="buyProduct" class="button-ronin">Comprar</a>
            @endif
        </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    
    <h1>Libros</h1>
    <div class="row">
        <div class="containerProductoTienda">
    @foreach ($allProducts as $product)
    
        @if($product->categoria == 'libro') 
        <div class="card border-card" style="width:350px;height:645px;">
            <img style="width:100%" class="ImagenTienda" src="{{url('/images/libreria/'.$product->img)}}" alt="">
        <div class="card-body">
            <h4 class="card-title">{{$product->name}}</h4>
            <p class="card-text">{{$product->description}}</p>
            <h5>{{$product->price}}€</h5>
            <p>Unidades: {{$product->unidades}}</p>
        </div>
        <div class="card-body">
            @if($product->unidades = 0)
            <a href="{{ route('cart.add', $product->id)}}" class="button-ronin" disabled>Comprar</a>
            @else
            <a href="{{ route('cart.add', $product->id)}}" id="buyProduct" class="button-ronin">Comprar</a>
            @endif
        </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
</div>

@endsection