@extends('layouts.app')

@section('content')

<div class=" mt-5 pt-5 p-3">

    @include('inicio.slider')

    @include('inicio.novedades')

    @include('inicio.destacados')


</div>



@endsection 





@section('script')


<script src="{{ asset('js/inicio.js') }}"></script>


@endsection 