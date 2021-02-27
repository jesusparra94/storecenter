@extends('layouts.app')

@section('content')

<div class=" mt-4 pt-4 p-3">

    <div class="ml-5 mt-4 mb-5">

        <strong><label style="font-size:25px "> Mi cuenta </label></strong>

        <div class="divseparador"></div>

    </div>

    <div class="row mb-4">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Mis Pedidos<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Mis Datos</a>
                    </li>
                    <li class="nav-item">
                      @php $cliente = Session::get('id'); @endphp
                      <a class="nav-link logout" data-cliente="{{$cliente}}" style="cursor: pointer">Cerrar Sesión</a>
                    </li>
                  </ul>
              </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <table class="table table-striped dt-responsive tablepedidos" >
                <thead>
                  <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Total</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido )

                        @php

                            $fechadb = $pedido->PED_FECHA;

                            $datefecha = date_create($fechadb);

                            $fecha=date_format($datefecha, 'H:i d/m/Y');

                        @endphp

                        <tr>
                            <th scope="row">{{$fecha}}</th>
                            <td>StoreCenter Chile</td>
                            <td>${{number_format($pedido->PED_TOTAL,0, '', '.')}}</td>
                            <td><a href="/pedido/{{$pedido->PED_ID}}">Ver detalles</a></td>
                        </tr>

                    @endforeach

                </tbody>
              </table>

        </div>
    </div>
</div>

@endsection

@section('script')


<script src="{{ asset('js/cuenta.js') }}"></script>


@endsection
