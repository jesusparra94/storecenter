<nav class="navbar navbar-expand nav-bar d-none d-xl-flex">
  <ul class="navbar-nav">
      <li class="nav-item ml-auto">
          <a class="nav-link colorlink" data-widget="pushmenu" href="{{url('/')}}" role="button"> <img src="{{asset('img/logo.png')}}" alt="" style="height: 60px; object-fit: contain;"> </a>
        </li>

  </ul>
  <ul class="navbar-nav ml-auto d-none d-md-flex">
    <li class="nav-item">
        <form class="form-inline bagcarnav">
        <a class="nav-link colorlink" href="{{url('/')}}">INICIO</a>
        <a class="nav-link colorlink" href="{{url('/empresa')}}">EMPRESA</a>
        <a class="nav-link colorlink" href="{{url('/comocomprar')}}">CÓMO COMPRAR</a>
        <a class="nav-link colorlink" href="{{url('/despacho')}}">DESPACHO</a>
        <a class="nav-link colorlink" href="{{url('/servicio-cliente')}}">CONTACTO</a>
        <a class="nav-link colorlink" href="{{url('/servicio-cliente')}}">GUÍA DE AYUDA</a>
        <a class="nav-link colorlink" href="{{url('/clientes')}}">CLIENTES</a>
        @if(Session::has('id'))
            <a class="nav-link colorlink" href="{{url('/cuenta')}}">MI CUENTA</a>
        @else
            <a class="nav-link colorlink" data-toggle="modal" data-target="#modalInicio" style="cursor: pointer">INICIAR SESIÓN</a>
        @endif
        @if(Session::has('id'))


        <span class="badge badge-light badgecar" data-count="{{count(Session::get('car'))}}"
                    style="position: absolute; background-color: #FFFFFF; color: #072146; margin-top: 15px; right: 13px;
                    padding: 4px 5px 2px 5px; font-size: 10px; border-radius: 50%;">
                   {{count(Session::get('car'))}}
        </span>


        <a href="{{url('/carrito')}}" class="btn btn-acciones " data-target="#Modalcar" style="color:#FFFFFF; float:right; width: auto;">
            <img class="img-fluid" style="width: 27px " src=" {{asset('img/cart.png')}}" >
        </a>

        {{--

            <button type="button" class="btn btn-acciones " data-toggle="modal" data-target="#Modalcar" style="color:#FFFFFF; float:right; width: auto;">

            <img class="img-fluid" style="width: 27px " src=" {{asset('img/cart.png')}}" >

            </button>
        --}}




        @else
        {{--
        <span class="badge badge-light badgecar"
                    style="position: absolute; background-color: #FFFFFF; color: #072146; margin-top: 15px; right: 13px;
                    padding: 4px 5px 2px 5px; font-size: 10px; border-radius: 50%;">
                    0
        </span>
        <button type="button" class="btn btn-acciones " data-toggle="modal" data-target="#Modalcar" style="color:#FFFFFF; float:right; width: auto;">

          <img class="img-fluid" style="width: 27px " src=" {{asset('img/cart.png')}}" >

        </button>
        --}}

        @endif
        </form>

    </li>
  </ul>
</nav>

<nav class="main-header navbar navbar-expand nav-bar d-flex d-xl-none">
  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars icons" aria-hidden="true"></i></a>

    <div style="display:flex;flex-direction: column;align-items: center;width: 80%;">
        <ul class="navbar-nav ml-auto mr-auto">
          <li class="nav-item ml-auto">

            <a class="nav-link colorlink d-none d-md-block" data-widget="pushmenu" href="{{url('/')}}" role="button">
              <img src="{{asset('img/logo.png')}}" alt="" style="height: 40px; object-fit: contain;">
            </a>

          </li>

        </ul>
    </div>

    <div class="dropdown">
      <button class="btn  dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 70px; background-color: #234560 !important; color: #FFF">
        Menú
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="left: -35px">
        <a class="nav-link colorlink dropdown-item" href="{{url('/')}}">INICIO</a>
        <a class="nav-link colorlink dropdown-item" href="{{url('/empresa')}}">EMPRESA</a>
        <a class="nav-link colorlink dropdown-item" href="{{url('/comocomprar')}}">CÓMO COMPRAR</a>
        <a class="nav-link colorlink dropdown-item" href="{{url('/despacho')}}">DESPACHO</a>
        <a class="nav-link colorlink dropdown-item" href="{{url('/servicio-cliente')}}">CONTACTO</a>
        <a class="nav-link colorlink dropdown-item" href="{{url('/servicio-cliente')}}">GUÍA DE AYUDA</a>
        <a class="nav-link colorlink dropdown-item" href="{{url('/clientes')}}">CLIENTES</a>
        @if(Session::has('id'))
            @php $cliente = Session::get('id'); @endphp
            <a class="nav-link colorlink dropdown-item" href="{{url('/carrito')}}">CARRITO</a>
            <a class="nav-link colorlink logout" data-cliente="{{$cliente}}" style="cursor: pointer">MI CUENTA</a>
        @else
            <a class="nav-link colorlink" data-toggle="modal" data-target="#modalInicio" style="cursor: pointer">INICIAR SESIÓN</a>
        @endif
      </div>
    </div>

    {{-- <div class="bagcarnav">



      @if (Session::has('car'))

      <span class="badge badge-light badgecar"
                  style="position: absolute; background-color: #FFFFFF; color: #072146; margin-top: 15px; right: 13px;
                  padding: 4px 5px 2px 5px; font-size: 10px; border-radius: 50%;">
                 {{count(Session::get('car'))}}
      </span>
      <button type="button" class="btn btn-acciones " data-toggle="modal" data-target="#Modalcar" style="color:#FFFFFF; float:right; width: auto;">

        <img class="img-fluid" style="width: 27px " src=" {{asset('img/cart.png')}}" >

      </button>

      @else

      <span class="badge badge-light badgecar"
                  style="position: absolute; background-color: #FFFFFF; color: #072146; margin-top: 15px; right: 13px;
                  padding: 4px 5px 2px 5px; font-size: 10px; border-radius: 50%;">
                  0
      </span>
      <button type="button" class="btn btn-acciones " data-toggle="modal" data-target="#Modalcar" style="color:#FFFFFF; float:right; width: auto;">

        <img class="img-fluid" style="width: 27px " src=" {{asset('img/cart.png')}}" >

      </button>

      @endif


    </div> --}}





</nav>
