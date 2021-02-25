@extends('layouts.app')

@section('content')

<div class=" mt-4 pt-4 p-3">

    <div class="ml-5 mt-4 mb-5">

        <strong><label style="font-size:25px "> Despacho </label></strong>
    
        <div class="divseparador"></div>
    
    </div>

    <div class="row"> 
        <div class="col-12" style="padding: 0px 54px 0px 54px;">

                {!! $despacho->CON_VALOR !!}


        </div>
    </div>

    

    @include('inicio.destacados')


</div>

@endsection 


@section('script')


<script src="{{ asset('js/inicio.js') }}"></script>


@endsection 