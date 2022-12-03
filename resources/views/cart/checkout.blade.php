@extends('layouts.app2')
@section("script")
<script src="https://www.paypal.com/sdk/js?client-id=Aenshv-xXFr_yDcrDF-IUjSUeSeQohiAs1jFG3q8vKKqtm32lpH1F-NYeu4CrjbYPSoq8ItPEg9pTknR&currency=EUR"></script>
<script>
    create_email = true;
    create_cp = true;
    create_telefono = true;
</script>
<script src="{{asset('js/Checkout.js')}}"></script>
<script defer>
    setTimeout(function () {
        paypal.Buttons({
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: '{{ Cart::session(auth()->id())->getTotal() }}'
                }
              }]
            });
          },
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
               alert('Transaction completed by ' + details.payer.name.given_name)
                $("#form").submit();
            });
          }
        }).render('#paypal-button-container'); // Display payment options on your web page
    },1000)

  </script>
@endsection
@section('content')

<section class="container">
    <div class="checkoutTitulo">Información de pago</div>

    <form class="checkoutForm" id="form" action="{{route('orders.store')}}" method="post">
        @csrf 

            <div class="loginCampo">
                <div class="form-group">
                    <label for="">Nombre completo</label>
                    <input id="name" type="text" name="shipping_fullname" class="form-control" value="{{Auth::user()->name}}" required>
                </div>
            </div>
            <div class="loginCampo">
                <div class="form-group">
                    <label for="">Email</label>
                    <input placeholder="Example@example.com" id="email" type="email" name="shipping_email" class="form-control" value="{{Auth::user()->email}}" required>
                </div>
            </div>
            <div class="loginCampo">
                <div class="form-group">
                    <label for="">Provincia</label>
                    <input id="provincia" type="text" name="shipping_state" class="form-control" value="{{Auth::user()->provincia}}" required>
                </div>
            </div>
            <div class="loginCampo">
                <div class="form-group">
                    <label for="">Dirección</label>
                    <input placeholder="C/ Gran Vía 17 4D" id="direccion" type="text" name="shipping_address" class="form-control" value="{{Auth::user()->direccion}}" required>
                </div>
            </div>
            <div class="loginCampo">
                <div class="form-group">
                    <label for="">Código Postal</label>
                    <input id="cp" type="text" name="shipping_zipcode" class="form-control" value="{{Auth::user()->cp}}" pattern="^\d{5}$" required>
                </div>
            </div>
            <div class="loginCampo">
                <div class="form-group">
                    <label for="">Teléfono</label>
                    <input id="telefono" type="text" name="shipping_phone" class="form-control" value="{{Auth::user()->telefono}}" pattern="^\d{9}$" required>
                </div>
            </div>
    </form>

    <div id="paypal-button-container"></div>
    
</section>
@endsection