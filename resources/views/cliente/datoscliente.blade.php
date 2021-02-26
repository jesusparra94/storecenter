@extends('layouts.app')

@section('content')

<div class=" mt-4 pt-4 p-3">

    <div class="ml-5 mt-4 mb-5">

        <strong><label style="font-size:25px "> Mis Datos</label></strong>

        <div class="divseparador"></div>

    </div>

    <div class="row mb-4">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="/cuenta">Mis Pedidos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/misdatos">Mis Datos<span class="sr-only">(current)</span></a>
                    </li>
                  </ul>
              </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card" style="border-left: 5px solid #234560;">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">

                            <h5>{{$cliente->vip_nombre}}</h5>

                        </div>
                        <div class="col-12 mb-2">
                            <span class="card-text"> Giro Comercial: {{$cliente->vip_giro}} </span>
                        </div>
                        <div class="col-12 mb-2">
                            <span> Teléfono Contacto: {{$cliente->vip_fono_contacto}}</span>
                        </div>
                        <div class="col-12 mb-2">
                            <span> Email: {{$cliente->vip_mail}} </span>
                        </div>
                        <div class="col-12 mb-2">
                            <span> Región: {{$region}}</span>
                        </div>
                        <div class="col-12 mb-2">
                            <span> Dirección: {{$cliente->vip_direccion}} </span>
                        </div>
                        <div class="col-12 mb-2">
                            <span> Comuna: {{$comuna}} </span>
                        </div>
                        <div class="col-12 mb-2">
                            <span> Ciudad: {{$cliente->vip_ciudad}} </span>
                        </div>
                    </div>





                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')


<script src="{{ asset('js/cuenta.js') }}"></script>


@endsection
