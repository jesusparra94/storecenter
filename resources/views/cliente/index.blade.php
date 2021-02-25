@extends('layouts.app')

@section('content')

<div class=" mt-4 pt-4 p-3">

    <div class="ml-5 mt-4 mb-5">

        <strong><label style="font-size:25px "> Clientes </label></strong>
    
        <div class="divseparador"></div>
    
    </div>

    <div class="row row-cols-1 row-cols-md-2">
        @foreach ($clientes as $cliente )

        <div class="col mb-4">
            <div class="card h-100">
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-4">

                        <img  src="https://www.storecenter.cl/cph_upl/{{$cliente->BAN_UBICACION}}" class="img-fluid" alt="..." width="150">

                      </div>
                      <div class="col-md-8 text-center">
                          
                        <h5 style="text-transform: uppercase;" >{{$cliente->BAN_NOMBRE}}</h5>

                      </div>
                  </div>
                
              </div>
            </div>
          </div>
            
        @endforeach
        
      </div>

    

    @include('inicio.destacados')


</div>

@endsection 


@section('script')


<script src="{{ asset('js/inicio.js') }}"></script>


@endsection 