@extends('layouts.app')

@section('content')

<div class="mt-2 pt-2 p-3">

    <div class="row ml-1 mt-4 mb-5">
        <div class="col-md-12">
            <a href="{{url('/cuenta')}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
            </a>
            <div>
                <strong><label style="font-size:25px "> Detalles del pedido {{$idpedido}}</label></strong>
                <div class="divseparador"></div>
            </div>
        </div>
    </div>
@foreach($detalles as $item)
    <div class="row no-gutters">
        <div class="col-md-12">
          <div class="card-body">
            <h3 class="">Total: {{number_format($item->PED_TOTAL,0, '', '.')}}</h3>
            <br>
          </div>
        </div>
    </div>
@endforeach
    <div class="row no-gutters">
    <div class="col-md-12">
        <table class="table table-striped text-center dt-responsive listado-productos">
        <thead>
            <tr>
            <th scope="col">Foto</th>
            <th scope="col">Descripción</th>
            <th scope="col">Código</th>
            <th scope="col">Marca</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productoscompra as $proc)
                @foreach($productos as $pro)
                    @if($pro->PRO_ID==$proc->PRO_ID)

                        @php
                        $imagenes =explode(",",$pro->PRO_IMAGENES);
                        @endphp
                        <tr class='btn_tr' data-id='{{$pro->PRO_ID}}'>
                            <td scope="row">
                                @if(isset($imagenes[1]))
                                    <img alt="{{$pro->PRO_NOMBRE}}" title="{{$pro->PRO_NOMBRE}}" src="https://www.storecenter.cl/cph_upl/{{$imagenes[1]}}" width="90">
                                @else
                                    <img alt="{{$pro->PRO_NOMBRE}}" title="{{$pro->PRO_NOMBRE}}" src="{{url('img/sinfoto.jpg')}}" width="90">
                                @endif

                            </td>
                            <td class="align-middle">{{$pro->PRO_NOMBRE}}</td>
                            <td class="align-middle">{{$pro->PRO_CODIGO}}</td>
                            <td class="align-middle">{{$pro->PRO_MARCA}}</td>
                            <td class="align-middle">{{$proc->PP_CANTIDAD}}</td>
                            <td class="align-middle">${{number_format($proc->PP_PRECIO,0, '', '.')}}</td>
                        </tr>

                    @endif
                @endforeach
            @endforeach

        </tbody>
        </table>
    </div>
</div>



</div>



@endsection





@section('script')


<script src="{{ asset('js/producto.js') }}"></script>
<script src="{{ asset('js/inicio.js') }}"></script>

@endsection
