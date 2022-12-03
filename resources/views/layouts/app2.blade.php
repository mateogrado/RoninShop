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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        var url_u = "{{url('/usuarios/')}}";
        var url_n = "{{url('/notification/')}}";
      </script>
    <script src="{{ asset('js/EditPerfil.js') }}" defer></script>
    @if(Auth::check())
    <script src="{{ asset('js/appNotification.js') }}"></script>
    @endif
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    
</head>

<body class="bodyInicio">
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <img height="56px" src="{{url('/images/libreria/R.png')}}" alt="">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    Inicio
                </a>
                <a class="navbar-brand text-white" href="{{ url('/product') }}">
                    Tienda
                </a>
                <a class="navbar-brand text-white" href="{{ url('/contacto') }}">
                    Contacto
                </a>          
                @if(Auth::check() && Auth::user()->hasRole(['admin']))
                <a class="navbar-brand text-white" href="{{ url('/admin') }}">
                    Administracion
                </a>
                @endif
              </ul>


               <!-- Right Side Of Navbar -->
               <ul class="navbar-nav ml-auto">

                <li class="nav-item mr-2">
                    <a class="nav-link p-0 m-0" href="{{ route('cart.index') }}">
                    <i class="fas fa-cart-arrow-down text-dark fa-2x"></i>
                        <div class="badge badge-danger">
                        @auth
                        {{Cart::session(auth()->id())->getContent()->count()}}
                        @else
                        0
                        @endauth
                        </div>
                    </a>
                </li>


                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="navbar-brand text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="navbar-brand text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span id="badgeNotificaciones" class="badge badge-pill badge-danger d-none"></span> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <button id="miPerfil" class="dropdown-item">
                                {{ __('Perfil') }}
                            </button>

                            <button class="dropdown-item" id="notificaciones">Notificaciones</button>

                            <a class="dropdown-item" href="{{ url('/MisPedidos') }}">
                                {{ __('Mis Pedidos') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
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

    @if(Auth::check())

    <div id="perfil" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Perfil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-6">
                        <input type="hidden" name="id" id="perfil_id" value="{{Auth::user()->id}}">
                        <div class="form-group text-left">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="perfil_name" class="form-control" value="{{Auth::user()->name}}">
                        </div> 
                  </div>
                  <div class="col-6">
                        <div class="form-group text-left">
                            <label for="name">Teléfono</label>
                            <input type="text" name="telefono" id="perfil_telefono" class="form-control" value="{{Auth::user()->telefono}}">
                        </div> 
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                        <div class="form-group text-left">
                            <label for="name">Email</label>
                            <input type="email" name="email" id="perfil_email" class="form-control" value="{{Auth::user()->email}}" disabled>
                        </div>
                  </div>
              </div>
              <div class="row">
                    <div class="col-6">
                          <div class="form-group text-left">
                              <label for="name">Provincia</label>
                              <input type="text" name="provincia" id="perfil_provincia" class="form-control" value="{{Auth::user()->provincia}}">
                          </div> 
                    </div>
                    <div class="col-6">
                          <div class="form-group text-left">
                              <label for="name">Código postal</label>
                              <input type="text" name="cp" id="perfil_cp" class="form-control" value="{{Auth::user()->cp}}">
                          </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group textleft">
                            <label for="direccion">Dirección</label>
                            <textarea name="direccion" id="perfil_direccion" cols="30" rows="5" class="form-control">{{Auth::user()->direccion}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button id="editar_perfil" type="button" class="btn btn-primary">Guardar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

       {{-- NOTIFICATIONS MODAL --}}

       <input type="hidden" name="id_destinatario" id="id_destinatario" value="{{Auth::user()->id}}">

       <div id="notification-modal" class="modal fade" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <button id="mensajesEnviados" type="button" class="btn btn-primary">Enviados</button>
               <button id="mensajesRecibidos" type="button" class="btn btn-primary">Recibidos</button>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <table id="tabla-notificaciones">

               </table>
             </div>
             <div class="modal-footer">
               <button id="nuevoMensaje" type="button" class="btn btn-success">Nuevo mensaje</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
             </div>
           </div>
         </div>
       </div>

       {{-- MENSAJE MODAL --}}

       <div id="mensaje-modal" class="modal fade" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <div class="cabecera-mensaje"></div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <div class="cuerpo-mensaje">
                 
               </div>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
             </div>
           </div>
         </div>
       </div>

       {{-- ENVIAR MENSAJE MODAL --}}

       <div id="enviar-mensaje-modal" class="modal fade" tabindex="-1" role="dialog">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title">Nuevo mensaje</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <input type="hidden" name="imagen_remitente" id="imagen_remitente" value="{{Auth::user()->imagen}}">
               <input type="hidden" name="nombre_remitente" id="nombre_remitente" value="{{Auth::user()->name}}">
               <div class="row">
                 <div class="col">
                   <div class="form-group">
                     <label for="destinatario">Destinatario</label>
                     <select id="destinatario" name="destinatario" class="form-control">
                        @if(Auth::check() && Auth::user()->hasRole(['admin']))
                       <option value="Todos">Todos</option>
                       @endif
                     </select>
                 </div>
                 </div>
               </div>
               <div class="row">
                 <div class="col">
                   <div class="form-group">
                     <label for="asunto">Asunto</label>
                     <input type="text" name="asunto" id="asunto" class="form-control">
                   </div>
                 </div>
               </div>
               <div class="row">
                 <div class="col">
                   <div class="form-group">
                     <label for="mensaje">Mensaje</label>
                     <textarea name="mensaje" id="mensaje" cols="30" rows="5" class="form-control"></textarea>
                   </div>
                 </div>
               </div>
             </div>
             <div class="modal-footer">
               <button id="enviarMensaje" type="button" class="btn btn-success">Enviar</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
             </div>
           </div>
         </div>
       </div>

    @endif
  
</body>

</html>