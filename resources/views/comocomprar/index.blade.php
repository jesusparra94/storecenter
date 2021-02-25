@extends('layouts.app')

@section('content')

<div class=" mt-4 pt-4 p-3">

    <div class="ml-5 mt-4 mb-5">

        <strong><label style="font-size:25px "> Cómo Comprar </label></strong>
    
        <div class="divseparador"></div>
    
    </div>

    <div class="row">
        <div class="col-12">

            <p style="padding: 10px; margin-left: 33px;">

                {!! $comprar->CON_VALOR !!}

            </p>

        </div>
    </div>

    

    @include('inicio.destacados')


</div>

@endsection 


@section('script')


<script src="{{ asset('js/inicio.js') }}"></script>


@endsection 