<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>

<body class="bodyInicio">
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <img height="56px" src="{{url('/images/logoWeb.jpg')}}" alt="">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    Inicio
                </a>
                <a class="navbar-brand text-white" href="{{ url('/match') }}">
                    Partidos
                </a>
                <a class="navbar-brand text-white" href="{{ url('/product') }}">
                    Tienda
                </a>
                <a class="navbar-brand text-white" href="{{ url('/contacto') }}">
                    Contacto
                </a>          
                @if(Auth::check() && Auth::user()->hasRole(['administrador','moderador']))
                <a class="navbar-brand text-white" href="{{ url('/admin') }}">
                    Administracion
                </a>
                @endif
              </ul>
            </div>
          </nav>
        
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>
        @endif    

        <main>
            @yield('content')
        </main>
    </div>
  
</body>

</html>