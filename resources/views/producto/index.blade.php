@extends('layouts.app')

@section('content')

<div class=" mt-5 pt-5 p-3">

    <table class="table table-striped text-center dt-responsive listado-productos">
    <thead>
        <tr>
        <th scope="col">Foto</th>
        <th scope="col">Descripción</th>
        <th scope="col">Código</th>
        <th scope="col">Marca</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $pro)
            @php
            $imagenes =explode(",",$pro->PRO_IMAGENES);
            @endphp
            <tr class='btn_tr_' onClick="btn_tr({{$pro->PRO_ID}})" data-id='{{$pro->PRO_ID}}'>
            <td scope="row">
                        @if(isset($imagenes[1]))
                            <img alt="{{$pro->PRO_NOMBRE}}" title="{{$pro->PRO_NOMBRE}}" src="https://img.storecenter.cl/{{$imagenes[1]}}" width="90">
                        @else
                            <img alt="{{$pro->PRO_NOMBRE}}" title="{{$pro->PRO_NOMBRE}}" src="{{url('img/sinfoto.jpg')}}" width="90">
                        @endif
                </td>
                <td class="align-middle">{{$pro->PRO_NOMBRE}}</td>
                <td class="align-middle">{{$pro->PRO_CODIGO}}</td>
                <td class="align-middle">{{$pro->PRO_MARCA}}</td>
            </tr>
        @endforeach
    </tbody>
    </table>


@include('inicio.destacados')

</div>



@endsection

@section('script')

<script src="{{ asset('js/inicio.js') }}"></script>
<script src="{{ asset('js/producto.js') }}"></script>

@endsection


