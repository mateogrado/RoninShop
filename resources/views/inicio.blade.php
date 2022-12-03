@extends('layouts.app2')
@section('content')

    <section class="Titulo">

      <h1 class="tituloInicio">Ronin<span>Shop</span></h1>

    </section>

    <section class="Tienda">

      <div class="tituloTienda">Los más vendidos</div>

            <div class="InicioTiendaLibreria">
        
                <div class="card">
                  <div class="img">
                    <img src="{{url('/images/libreria/infinite-crisis-superman.jpg')}}" alt="">
                </div>
                <div class="datos">
                  <div class="cuadradito"></div>
                  <div class="nombre"><b>Superman infinite crisis</b></div>
                  <div class="precio">30€</div>
                </div>     
                </div>  
                  <div class="card d-none d-sm-inline-block">
                    <div class="img">
                        <img src="{{url('/images/libreria/DrStrange.jpg')}}" alt="">
                    </div>
                    <div class="datos">
                      <div class="cuadradito"></div>
                      <div class="nombre"><b>Dr Strange V1</b></div>
                      <div class="precio">25€</div>
                    </div>     
                  </div>
                    <div class="card d-none d-md-inline-block">
                      <div class="img">
                        <img src="{{url('/images/libreria/els3.jpg')}}" alt="">
                    </div>
                    <div class="datos">
                      <div class="cuadradito"></div>
                      <div class="nombre"><b>El retorno del rey</b></div>
                      <div class="precio">45€</div>
                    </div>     
                    </div>   
                      <div class="card d-none d-lg-inline-block">
                        <div class="img">
                          <img src="{{url('/images/libreria/onepiece.jpg')}}" alt="">
                      </div>
                      <div class="datos">
                        <div class="cuadradito"></div>
                        <div class="nombre"><b>One piece</b></div>
                        <div class="precio">20€</div>
                      </div>     
                      </div>

                    </div>

    </section>

  <footer class="footer">
    <div class="titulo">Siguenos en nuestras redes sociales</div>
    <div class="redessociales">

      <a target="_blank" href="#" class="red fb">
        <div class="logo"><i class="fab fa-facebook"></i></div>
        <div class="datos">
          <div class="nombre">RoninShop</div>
          <div class="arroba">@RoninShop</div>
        </div>
      </a>

      <a target="_blank" href="#" class="red ig">
        <div class="logo"><i class="fab fa-instagram"></i></div>
        <div class="datos">
          <div class="nombre">RoninShop</div>
          <div class="arroba">@RoninShop</div>
        </div>
      </a>

      <a target="_blank" href="#" class="red tw">
        <div class="logo"><i class="fab fa-twitter"></i></div>
        <div class="datos">
          <div class="nombre">RoninShop</div>
          <div class="arroba">@RoninShop</div>
        </div>
      </a>
  
      <a target="_blank" href="#" class="red yt">
        <div class="logo"><i class="fab fa-youtube"></i></div>
        <div class="datos">
          <div class="nombre">RoninShop</div>
          <div class="arroba">@RoninShop</div>
        </div>
      </a>

    </div>

    <div class="creditos">
      <div class="derechos"><span>@ Copyright RoninShop</span> Página Oficial de la tienda RoninShop</div>
    </div>
  </footer>

@endsection