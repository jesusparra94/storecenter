@extends('layouts.app')

@section('content')

<div class="mt-2 pt-2 p-3">
@foreach($detalles as $producto)

@php
  $imagenes =explode(",",$producto->PRO_IMAGENES);
@endphp



            <br><br>
            <div class="row ml-1 mt-4 mb-5">
                <div class="col-md-12">
                    <a href="{{url('/listado/producto/'.$producto->CAT_ID)}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                        <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
                    </a>
                    <div>
                        <strong><label style="font-size:25px "> Resultado </label></strong>
                        <div class="divseparador"></div>
                    </div>
                </div>
            </div>
        <div class="card mb-3" style="width: 100%;">
          <div class="row no-gutters text-center">
            <div class="col-md-12">
              <h3>{{$producto->PRO_NOMBRE}}</h3>
              <img src="https://img.storecenter.cl/{{$imagenes[1]}}" alt="{{$producto->PRO_NOMBRE}}" title="{{$producto->PRO_NOMBRE}}" width="20%">
            </div>
          </div>
          <div class="row no-gutters text-center">
            <div class="col-md-12">
              <div class="card-body">
                <h3 class="">{{$Mensaje}}</h3>
              </div>
            </div>
          </div>
        </div>

@endforeach
@include('inicio.destacados')
</div>



@endsection

@section('script')

<script src="{{ asset('js/inicio.js') }}"></script>

@endsection


