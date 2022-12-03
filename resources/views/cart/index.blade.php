@extends('layouts.app2')
@section("script")  
<script>
    var url_ = "{{url('/cart/update/')}}";
</script>

<script src="{{asset('js/Cart.js')}}" defer></script>
@endsection
@section('content')

    <div class="container-fluid">
        <h3 class="w-50 m-auto">Mi carrito</h3>
        <p>¡Atención! Si el número de unidades supera al de existencias, se comprarán todas ellas hasta llegar a 0</p>

        <div class="carrito">
                @foreach ($cartItems as $item)
                    <div class="card">
                        <input type="hidden" name="price" id="price{{$item->id}}" value="{{$item->price}}">
                        <img class="miCarritoImg" src="{{url('/images/libreria/'.$item->img)}}" alt="">
                        <div class="info">
                            <div class="name">{{$item->name}}</div>
                            <div class="cantYPrecio">
                                <span class="cantidad"><input class="{{$item->id}} form-control" id="quantity" name="quantity" type="number" value ="{{ $item->quantity }}"></span>
                                <span id="precio{{$item->id}}" class="precio">{{Cart::session(auth()->id())->get($item->id)->getPriceSum()}}€</span>
                            </div>
                            <a class="btn btn-danger w-100 p-2" href="{{ route('cart.destroy', $item->id) }}">Eliminar</a>
                        </div>
                    </div>
                @endforeach
        </div>
        <div class="Pago mt-4">
            <h2 id="precioTotal" class="colorAmarillo">
                Precio total: <span id="PrecioTotal">{{ Cart::session(auth()->id())->getTotal() }}</span>€  
            </h2>
            @if (Cart::session(auth()->id())->getTotal() > 0) 
                <a class="button-ronin-red" href="{{ url('/cart/checkout') }}" role="button">Proceder al pago</a>
            @endif
        </div>
    </div>
@endsection
