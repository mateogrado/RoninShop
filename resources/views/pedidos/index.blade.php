@extends('layouts.app2')
@section("script")  
<script>
    var url_ = "{{url('/orders_items/')}}";
    var url_p = "{{url('/MisPedidos/')}}";
    var url_img = "{{url('/images/libreria/')}}"
</script>

<script src="{{asset('js/MisPedidos.js')}}" defer></script>
@endsection
@section('content')

<?php setlocale(LC_TIME,'es_ES'); ?> 
<div class="container mt-3">
    <h3>Mis Pedidos</h3>
<img src="" alt="">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
            <th>Número de pedido</th>
            <th>Estatus</th>
            <th>Direccion</th> 
            <th>Fecha</th>
            <th>Precio total</th>
            <th>Detalles</th>
            <th>Cancelar</th>
            </tr>
        </thead>

        @foreach ($MisPedidos as $MisPedidos)
            <tr>
                <td class="No{{$MisPedidos->id}}">{{ $MisPedidos->order_number }}</td>
                <td>{{ $MisPedidos->status }}</td>
                <td>{{ $MisPedidos->shipping_address }}, {{ $MisPedidos->shipping_zipcode }}, {{ $MisPedidos->shipping_state }} </td>
                <td>{{strftime('%d de %B de %Y', strtotime($MisPedidos->created_at))}}</td>
                <td>{{ $MisPedidos->grand_total}}€</td>
                <td><button id="{{$MisPedidos->id}}" class="detalles btn btn-success p-2">Detalles</button></td>
                <td><button id="{{$MisPedidos->id}}" class="cancelar btn btn-danger p-2">Cancelar</button></td>
            </tr>
        @endforeach
    </table>
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