@extends('layouts.app2')
@section("script")  
<script>
  url_ = "{{url('/product/')}}";
</script>

<script src="{{asset('js/CRUDProductos.js')}}" defer></script>
@endsection
@section('content')

<div class="row">
    <div class="col text-dark">
      <h3>Productos</h3>
      <button id="button-create-product" class="button-ronin-red">Añadir producto</button>
    </div>  
</div>            
<div class="containerProd">

@foreach ($allProducts as $product)

    <div class="card border-card">
    <img class="ImagenProducto" src="{{url('/images/libreria/'.$product->img)}}" alt="">
    <div class="card-body">
        <h4 class="card-title">{{$product->name}}</h4>
        <p class="card-text">{{$product->description}}</p>
        <h5>{{$product->price}}€</h5>
    </div>
    <div class="card-body">
        <button id="edit" class="{{$product->id}} btn btn-outline-success py-2 px-3 mr-2">Editar</button>
        <button id="borrar" class="{{$product->id}} btn btn-outline-danger py-2 px-3 ml-2">Borrar</button>
    </div>
    </div>

@endforeach
</div>

<form id="create_form" method="post" enctype="multipart/form-data">   
  @csrf
  <div id="create_producto" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nuevo Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row text-left">
              <div class="col-6 form-group">
                  <label for="name">Nombre</label>
                  <input type="text" name="name" id="name" class="form-control">
              </div>
              <div class="col-6 form-group">
                <label for="autor">Autor</label>
                <input type="text" name="autor" id="autor" class="form-control">
            </div>
            </div>
                        <div class="row text-left">
              <div class="col-6 form-group">
                <label for="editorial">Editorial</label>
                <input type="text" name="editorial" id="editorial" class="form-control">
            </div>
            <div class="col-6 form-group">
              <label for="categoria">Categoria</label>
              <input type="text" name="categoria" id="categoria" class="form-control">
          </div>
            </div>
            <div class="row text-left">
              <div class="col-12 form-group">
                  <label for="description">Descripción</label>
                  <textarea type="text" name="description" id="description" class="form-control"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-12 form-group">
                  <input type="file" name="img" id="imagen" class="d-none">
                  <button id="img-button" type="button" class="form-control">Imágen</button>
              </div>
            </div>
            <div class="row">
              <div class="col-6 form-group">
                <label for="unidades">Unidades</label>
                <input type="text" name="unidades" id="unidades" class="form-control">
            </div>
              <div class="col-6 form-group">
                <label for="price">Precio</label>
                <input type="text" name="price" id="price" class="form-control">
            </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Create</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<form id="edit_form" method="post" enctype="multipart/form-data">   
  @csrf
  <div id="editar_producto" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row text-left">
              <div class="col-6 form-group">
                  <label for="name">Nombre</label>
                  <input type="text" name="name" id="edit_name" class="form-control">
              </div>
              <div class="col-6 form-group">
                <label for="autor">Autor</label>
                <input type="text" name="autor" id="edit_autor" class="form-control">
            </div>
            </div>
            <div class="row text-left">
              <div class="col-6 form-group">
                  <label for="editorial">Editorial</label>
                  <input type="text" name="editorial" id="edit_editorial" class="form-control">
              </div>
              <div class="col-6 form-group">
                <label for="categoria">Categoria</label>
                <input type="text" name="categoria" id="edit_categoria" class="form-control">
            </div>
            </div>
            <div class="row text-left">
              <div class="col-12 form-group">
                  <label for="description">Descripción</label>
                  <textarea type="text" name="description" id="edit_description" class="form-control"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-6 form-group">
                <label for="unidades">Unidades</label>
                <input type="text" name="unidades" id="edit_unidades" class="form-control">
            </div>
              <div class="col-6 form-group">
                <label for="price">Precio</label>
                <input type="text" name="price" id="edit_price" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col-12 form-group">
                  <input type="file" name="img" id="edit_imagen" class="d-none">
                  <button id="edit_img-button" type="button" class="form-control">Imágen</button>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Editar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection