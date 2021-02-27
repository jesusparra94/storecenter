@extends('layouts.app')

@section('content')
@php
if(Session::has('car')){
    $car = Session::get('car');
    if(count($car)>0){
        $totalproductos = count($car);
    }else{
        $totalproductos = 0;
    }

}else{
    \Session::put('car', array());
    $car = Session::get('car');
}
@endphp

<div class="  mt-2 pt-2 p-3">

    <div class="row ml-1 mt-4 mb-5">

        <div class="col-md-12">
            <a href="{{url('/')}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
            </a>
            <div>
                <strong><label style="font-size:25px "> Productos en el Carrito </label></strong>
                <div class="divseparador"></div>
            </div>
        </div>

    </div>
@if($totalproductos>0)
    <div class="row no-gutters">
        <div class="col-md-12  text-center">
            <a class="btn btn-cotizar" href="{{url('/finalizar-compra')}}" data-id="">
              Finalizar Compra
              <i class="fas fa-dollar-sign" style="font-size:20px;float:right;"></i>
            </a>
            <a class="btn btn-cotizar" href="{{url('/car/pdf')}}" data-id="">
              PDF
              <i class="far fa-file-pdf"  style="font-size:20px;float:right;"></i>
            </a>
            <div class="btn btn-cotizar btn-limpiarcar" style="cursor: pointer;">
              Vaciar Carrito
              <i class="fas fa-trash-alt" style="font-size:20px;float:right;"></i>
            </div>
        </div>
    </div>
@endif
    <div class="row">
        <div class="col-12">

            <table class="table table-striped dt-responsive tableproductoscar" >
                <thead>
                  <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Opción</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($car as $key => $value)
                    @php
                        $imagenes =explode(",",$value['PRO_IMAGENES']);
                    @endphp
                    <tr>
                        <th scope="row"><img alt="{{$value['PRO_NOMBRE']}}" title="{{$value['PRO_NOMBRE']}}" src="https://www.storecenter.cl/cph_upl/{{$imagenes[1]}}" width="90"></th>
                        <td>{{$value['PRO_NOMBRE']}}</td>
                        <td>{{$value['cantidadcompra']}}</td>
                        <td>{{number_format(($value['PRO_PRECIO']*$value['cantidadcompra']),0, '', '.')}}</td>
                        <td><i class="fas fa-trash-alt btnEliminarProd" style="font-size:30px;cursor: pointer;color:red;" data-idpro="{{$value['PRO_ID']}}"></i></td>
                    </tr>
                @endforeach
{{--
                    @foreach ($car as $producto )

                        <tr>
                            <th scope="row">{{$fecha}}</th>
                            <td>StoreCenter Chile</td>
                            <td>${{number_format($pedido->PED_TOTAL,0, '', '.')}}</td>
                            <td><a href="/pedido/{{$pedido->PED_ID}}">Ver detalles</a></td>
                        </tr>

                    @endforeach
--}}
                </tbody>
              </table>

        </div>
    </div>
</div>

@endsection

@section('script')


<script src="{{ asset('js/cuenta.js') }}"></script>


@endsection
