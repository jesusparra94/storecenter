@extends('layouts.app')

@section('content')

<div class="mt-2 pt-2 p-3">

    <div class="row ml-1 mt-4 mb-5">
        <div class="col-md-12">
            <div>
                <strong><label style="font-size:25px "> Resultados de busqueda </label></strong>
                <div class="divseparador"></div>
            </div>
        </div>
    </div>

    <div class="row no-gutters">
    <div class="col-md-12">
        <table class="table table-striped text-center dt-responsive listado-productos">
        <thead>
            <tr>
            <th scope="col">Foto</th>
            <th scope="col">Descripción</th>
            <th scope="col">Código</th>
            <th scope="col">Marca</th>
            @if(Session::has('id'))
            <th scope="col">Precio</th>
            @endif
            </tr>
        </thead>
        <tbody>
            @foreach($resultado as $pro)
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
                    @if(Session::has('id'))
                    <td class="align-middle">${{number_format($pro->PRO_PRECIO,0, '', '.')}}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@include('inicio.destacados')

</div>



@endsection





@section('script')


<script src="{{ asset('js/producto.js') }}"></script>
<script src="{{ asset('js/inicio.js') }}"></script>

@endsection
