@extends('layouts.app2')
@section("script")  
<script>
  var url_ = "{{url('/orders/')}}";
  var url_2 = "{{url('/orders_items/')}}";
</script>

<script src="{{asset('js/ShowOrders.js')}}" defer></script>
@endsection
@section('content')
<div class="alerts">

</div>
<div class="table my-4">
<div class="table-title">
    <div class="row">
        <div class="col-12 text-dark" style="color: white">
          <h3>Pedidos</h3>
        </div>              
    </div> 
</div>

<section class="container-fluid">
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Número de pedido</th>
      <th>Estatus</th>
      <th>Precio total</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Telf</th>
      <th>Direccion</th>   
      <th>Acciones</th>
    </tr>
  </thead>

  @foreach ($orders as $pedidos)
      <tr>
        <td class="No{{$pedidos->id}}">{{ $pedidos->order_number }}</td>
        <td>
        <input list="estado" type="text" id="status" name="status" class="{{ $pedidos->id }}" value="{{$pedidos->status}}">
        <datalist id="estado">
          <option value="pending">
          <option value="procesing">
          <option value="completed">
          <option value="decline">
        </datalist>
        </td>
        <td>{{ $pedidos->grand_total }}</td>
        <td>{{ $pedidos->shipping_fullname }}</td>
        <td>{{ $pedidos->shipping_email }}</td>
        <td>{{ $pedidos->shipping_phone }}</td>
        <td>{{ $pedidos->shipping_address }}, {{ $pedidos->shipping_zipcode }}, {{ $pedidos->shipping_state }} </td>

        <td>
            {{-- <a href='{{ action('OrderController@show', $pedidos->id)}}'>
                <button class="btn btn-info m-2">Mostrar</button>
            </a> --}}
            <button id="{{$pedidos->id}}" class="detalles btn btn-success p-2">Detalles</button>
            <form action="{{ action('OrderController@destroy', $pedidos->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger m-2" value="Borrar" type="submit">
            </form>

            </div>
        </td>
      </tr>
  @endforeach
</table>
</section>
</div>

<div id="DetallesPedidos" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header m-auto">
        </div>
        <div class="modal-body">
          <table id="TablaDetalles" class="w-100">

          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection