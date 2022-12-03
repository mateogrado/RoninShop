@extends('layouts.app2')
@section('content')

<link href="{{ asset('css/contact.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> --}}
{{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->

    <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
   	{{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> --}}
  
	<section id="contact">
			<div class="section-content">
				<h1 class="section-header">Contacta con <span class="content-header">Ronin<i>Shop</i></span></h1>
				<h4>Mándanos tus preguntas o sugerencias</h4>
			</div>
			<div class="contact-section">			
			<div class="container">
				<form method="POST" action="{{ route('contacto') }}">
					<div class="col-md-12 form-line">
					@csrf
					<div class="form-group">
					<label for="nombre">Nombre:</label>
					<input class="form-control" name="nombre" placeholder="nombre...." required> 
					{!! $errors->first('nombre','<small>:message</small>') !!} <br>
					</div>

					<div class="form-group">
					<label for="email">Email: </label>
					<input class="form-control" type="email" name="email" placeholder="email...." value="{{ old('email') }}" required> 
					{!! $errors->first('email','<small>:message</small>') !!} <br>
					</div>

					<div class="form-group">
					<label for="subject">Asunto: </label>
					<input class="form-control" name="subject" placeholder="Asunto...." value="{{ old('subject') }}" required> 
					{!! $errors->first('subject','<small>:message</small>') !!} <br>
					</div>

					<div class="form-group">
					<label for="contenido">Mensaje: </label>
					<textarea class="form-control" name="contenido" placeholder="Mensaje...." value="{{ old('contenido') }}" required></textarea>
					{!! $errors->first('contenido','<small>:message</small>') !!} <br>
					</div>
					</div>
					<button class="btn btn-default submit m-1"><i class="fa fa-paper-plane" aria-hidden="true"></i>Enviar mensaje</button> 
					</form>
			</div>
		</div>
			
		</section>
@endsection



