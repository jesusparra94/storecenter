@extends('layouts.app')

@section('content')

<div class="mt-2 pt-2 p-3">

    <div class="row ml-1 mt-4 mb-5">
        <div class="col-md-12">
            <a href="{{url('/')}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
            </a>
            <div>
                <strong><label style="font-size:25px "> Formulario de Contacto</label></strong>
                <div class="divseparador"></div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
            <div class="col-md-12">
              <div class="card-body">
                @include('contacto.form')
              </div>
            </div>
          </div>
    </div>

@include('inicio.destacados')

</div>



@endsection





@section('script')


<script src="{{ asset('js/producto.js') }}"></script>
<script src="{{ asset('js/inicio.js') }}"></script>

@endsection
