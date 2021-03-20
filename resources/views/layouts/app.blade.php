<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="canonical" href="https://www.storecenter.cl" />
	<meta name="description" content="Ventas via Internet en Chile de Articulos de oficina, suministros importados, Ferreteria (nacional e importados), Mobiliario de Oficina, Insumos de cafeteria (fabricacion nacional e internacional)."/>
	<meta name="keywords" content="articulos de oficina, ferreteria, mobiliario de oficina, insumos de cafeteria, ventas por internet, ecommerce" />
	<meta property="og:locale" content="es_CL" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="Ventas via Internet en Chile de Articulos de oficina, suministros importados, Ferreteria (nacional e importados), Mobiliario de Oficina, Insumos de cafeteria (fabricacion nacional e internacional)." />
	<meta property="og:url" content="https://www.storecenter.cl" />
	<meta property="og:site_name" content="https://www.storecenter.cl" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('FlexSlider/flexslider.css') }}" rel="stylesheet">  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.1.2/dist/css/bootstrap-colorpicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/keen-slider@5.0.2/keen-slider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script src="https://kit.fontawesome.com/68157c30de.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.1.2/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <!--
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>-->

    {!! NoCaptcha::renderJs() !!}

    <title>StoreCenter</title>
</head>

<style>


table.dataTable tbody th, table.dataTable tbody td {

padding: 12px 10px;

}

.custom-select, .custom-select-sm{
    width:30%!important;
}
.sidebar::-webkit-scrollbar{
    /*width: 80px;     /* Tamaño del scroll en vertical */
    /*height: 80px;    /* Tamaño del scroll en horizontal */
    /*display: none;*/ /*Ocultar Scroll*/
    background-color: #FFF!important;
    width: 8px!important;
    border-radius:15px!important;
}
.sidebar::-webkit-scrollbar-thumb {
	background-color: #45647c!important;
    border-radius:15px!important;
}
.nav-sidebar{
    white-space: normal!important;
}
/*
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {

color: #FFF !important;

border: 1px solid #1b262c !important;

background-color: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

font-weight: bold !important;

}



.dataTables_wrapper .dataTables_paginate .paginate_button {

box-sizing: border-box;

display: inline-block;

min-width: 1.5em;

padding: 0.5em 1em;

margin-left: 2px;

text-align: center;

text-decoration: none !important;

cursor: pointer;

color: #E01428 !important;

font-weight: bold !important;

border-radius: 2px;

}



.dataTables_wrapper .dataTables_paginate .paginate_button:hover {

color: #FFF !important;

border: 1px solid #1b262c !important;

background-color: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

background: #1b262c !important;

font-weight: bold !important;

}
*/

</style>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed  sidebar-collapse">

    <div class="wrapper">

        @include('inicio.navbar')
        @include('inicio.sidebar')

            <section class="content">
                {{-- <div class=" d-none d-xl-block">  d-block d-xl-none" --}}

                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-3 d-none d-xl-block" style="background: #234560; color:#FFF;">
                                @include('inicio.menu')
                            </div>
                            <div class="col-12 col-xl-9">
                                @yield('content')
                            </div>
                        </div>

                    </div>

            </section>

        @include('inicio.footer')

    </div>

    <div class="modal fade" id="modalInicio" tabindex="-1" aria-labelledby="modalInicioLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalInicioLabel">Iniciar Sesión</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12 mb-2" align="center">
                        <img src="{{asset('img/logo.png')}}" alt="" style="height: 60px; object-fit: contain;">
                    </div>
                    <div class="col-12">
                        <form action="{{url('/login')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label for="rut">RUT</label>
                              <input type="text" class="form-control {{$errors->has('rut')? 'is-invalid': '' }}" name="rut" id="rut" aria-describedby="emailHelp">
                              {!! $errors->first('rut','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                            <div class="form-group">
                              <label for="password">Contraseña</label>
                              <input type="password" class="form-control {{$errors->has('password')? 'is-invalid': '' }}" name="password" id="password">
                              {!! $errors->first('password','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                            <button type="submit" class="btn btn-crear float-right">Ingresar</button>
                        </form>
                    </div>

                    <div class="col-12 mb-2">
                        ¿No tienes una cuenta? <a href="{{url('/registrarse')}}">Registrate</a>
                    </div>
                    <div class="col-12 mb-2">
                        <a href="{{url('/recupararpass')}}">Olvidó su contraseña</a>
                    </div>
                </div>

            </div>
          </div>
        </div>
      </div>
    <script>

    </script>

    @yield('script')

</body>
</html>
