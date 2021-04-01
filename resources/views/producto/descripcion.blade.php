@extends('layouts.app')

@section('content')

<div class="mt-2 pt-2 p-3">
@if($Modo == "Descripcion")
@foreach($detalles as $producto)



@php
  $imagenes =explode(",",$producto->PRO_IMAGENES);
@endphp
<div class="item">

<div >
@if(Session::has('car'))
@php $car = Session::get('car'); @endphp
    @if(isset($car[$producto->PRO_ID]))

        @php
            $car = Session::get('car');
            $totalcar = $car[$producto->PRO_ID]->cantidadcompra;
        @endphp

    @else

        @php
            $totalcar = 0;
        @endphp

    @endif
@else
    @php
        $totalcar = 0;
    @endphp
@endif
    <br><br>
    <div class="row ml-1 mt-4 mb-5">
        <div class="col-md-12">
            <a href="{{url('/listado/producto/'.$producto->CAT_ID)}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
            </a>
            <div>
                <strong><label style="font-size:25px "> Detalles del producto </label></strong>
                <div class="divseparador"></div>
            </div>
        </div>
    </div>


    <div itemscope itemtype="https://schema.org/Product">
      <div class="row no-gutters infoproducto">
        <div class="col-md-4 visorImg">
            <figure class="visor" style="height:400px">
                @php $i = 0; @endphp
                @foreach($imagenes as $img)
                    @if($img!='' || $img!=null)
                        <img id="lupa{{$i}}" class="img-thumbnail" src="https://img.storecenter.cl/{{$img}}" style="height:400px" alt="{{$producto->PRO_NOMBRE}}" title="{{$producto->PRO_NOMBRE}}" itemprop="image">
                        @php $i++; @endphp
                    @endif
                @endforeach
            </figure>
            <div class="flexslider">
                <ul class="slides">
                    @php $t = 0; @endphp
                    @foreach($imagenes as $img)
                        @if($img!='' || $img!=null)
                            <li>
                                <img value="{{$t}}" class="img-thumbnail" src="https://img.storecenter.cl/{{$img}}" style="height: 75px; object-fit: contain;"alt="{{$producto->PRO_NOMBRE}}" title="{{$producto->PRO_NOMBRE}}" itemprop="image">
                            </li>
                            @php $t++; @endphp
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="col-md-8">
          <div class="card-body">
            <h3 class="" itemprop="name">{{$producto->PRO_NOMBRE}}</h3>
            <br>
            <h6>Código: {{$producto->PRO_CODIGO}}</h6>
            <h6>Marca: {{$producto->PRO_MARCA}}</h6>
            @php $descripcion = str_replace("<br>", "", $producto->PRO_DESCRIPCION); @endphp
            <span itemprop="description">
                <h5 class="card-title">{!! $producto->PRO_DESCRIPCION !!}</h5>
            </span>
          </div>
        </div>
      </div>
      @if(Session::has('id'))
      <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
      <div class="row no-gutters">
        <div class="col-md-7 col-sm-7 text-center mx-auto">
            <div class="card m-3" style="background-color: #234560;color:#fff;">
                <div class="card-body" style="padding:5px;">
                    <div class="row no-gutters" style="display: flex;justify-content: center;align-items: center;">
                        <div class="col-md-7  pr-2" style="border-right:0.9px solid #fff;">
                            <h5 class="">Precio Neto: <span itemprop="priceCurrency" content="CLP">$</span>
                            <span itemprop="price" content="{{$producto->PRO_PRECIO}}">{{number_format($producto->PRO_PRECIO,0, '', '.')}}</span>
                            </h5>
                            <p class="textcantidad">Tiene <b>{{$totalcar}}</b> unidades agregadas</p>
                        </div>
                        <div class="col-md-5 p-2">
                            <div class="pb-2">
                                <input class="form-control mx-auto text-center" type="number" name="cantidadp" value="1" placeholder="N°" style="width:50%;">
                            </div>
                            <button class="btn-addcar btn btn-cotizar" style="width:70%;font-size:12px;" data-totalcar="{{$totalcar}}" data-id="{{$producto->PRO_ID}}">
                                Añadir al
                                <i class="fas fa-cart-plus" style="font-size:20px;float:right;"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
        <div class="col-md-3 text-center" style="display:none;">
            <div class="m-3">
                    <button class="btn btn-addcar" data-id="{{$producto->PRO_ID}}">
                      <i class="fas fa-plus-circle" style="font-size:35px;color:#234560;"></i>
                      <p>Añadir al carrito</p>
                    </button>

            </div>
        </div>
      </div>
      @endif
      <div class="row no-gutters">
        <div class="col-md-12  text-center">
            @if(!Session::has('id'))
            <a class="btn btn-cotizar" href="{{url('/cotizar/'.$producto->PRO_ID)}}" data-id="{{$producto->PRO_ID}}">
              Cotizar
              <i class="fas fa-dollar-sign" style="font-size:20px;float:right;"></i>
            </a>
            @endif
            <a class="btn btn-cotizar" href="{{url('/producto/'.$producto->PRO_ID.'/pdf')}}" data-id="{{$producto->PRO_ID}}">
              PDF
              <i class="far fa-file-pdf"  style="font-size:20px;float:right;"></i>
            </a>
        </div>
      </div>
</div>

</div>
@endforeach
@include('inicio.destacados')
@elseif($Modo == "Novedades")
@foreach($novedad as $item)

@php
  $imagenes =explode(",",$item->NOT_IMAGENES);
@endphp
<div class="item">

<div class="mb-3" style="width: 100%;">
    <br><br>
    <div class="row ml-1 mt-4 mb-5">
        <div class="col-md-12">
            <a href="{{url('/')}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
            </a>
            <div>
                <strong><label style="font-size:25px "> Novedades </label></strong>
                <div class="divseparador"></div>
            </div>
        </div>
    </div>

    <div itemscope itemtype="https://schema.org/Product">

    <div class="row no-gutters infoproducto">

        <div class="col-md-4 visorImg">
            <figure class="visor" style="height:400px">
                @php $i = 0; @endphp
                @foreach($imagenes as $img)
                    @if($img!='' || $img!=null)
                        <img id="lupa{{$i}}" class="img-thumbnail" src="https://img.storecenter.cl/{{$img}}" style="height:400px" alt="{{$item->NOT_TITULO}}" title="{{$item->NOT_TITULO}}" width="100%"  itemprop="image">
                        @php $i++; @endphp
                    @endif
                @endforeach
            </figure>
            <div class="flexslider">
                <ul class="slides">
                    @php $t = 0; @endphp
                    @foreach($imagenes as $img)
                        @if($img!='' || $img!=null)
                            <li>
                                <img value="{{$t}}" class="img-thumbnail" src="https://img.storecenter.cl/{{$img}}" style="height: 75px; object-fit: contain;" alt="{{$item->NOT_TITULO}}" title="{{$item->NOT_TITULO}}" width="100%"  itemprop="image">
                            </li>
                            @php $t++; @endphp
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-8">
          <div class="card-body">
            <h3 class="">{{$item->NOT_TITULO}}</h3>
            <br>
            @php $descripcion = str_replace("<br>", "", $item->NOT_EPIGRAFE); @endphp
            <span itemprop="description">
                <h5 class="card-title">{!! $item->NOT_DETALLE !!}</h5>
            </span>
          </div>
        </div>

      </div>
    </div>

</div>

</div>
@endforeach
@include('inicio.destacados')
@elseif($Modo == "Destacados")
@foreach($destacado as $item)

@php
  $imagenes =explode(",",$item->PRO_IMAGENES);
@endphp
<div class="item">

<div class="mb-3" style="width: 100%;">
    <br><br>
    <div class="row ml-1 mt-4 mb-5">
        <div class="col-md-12">
            <a href="{{url('/')}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
            </a>
            <div>
                <strong><label style="font-size:25px "> Destacados </label></strong>
                <div class="divseparador"></div>
            </div>
        </div>
    </div>

    <div itemscope itemtype="https://schema.org/Product">

        <div class="row no-gutters infoproducto">

        <div class="col-md-4 visorImg">
            <figure class="visor" style="height:400px">
                @php $i = 0; @endphp
                @foreach($imagenes as $img)
                    @if($img!='' || $img!=null)
                        <img id="lupa{{$i}}" class="img-thumbnail" src="https://img.storecenter.cl/{{$img}}" style="height:400px" alt="{{$item->PRO_NOMBRE}}" title="{{$item->PRO_NOMBRE}}"  itemprop="image">
                        @php $i++; @endphp
                    @endif
                @endforeach
            </figure>
            <div class="flexslider">
                <ul class="slides">
                    @php $t = 0; @endphp
                    @foreach($imagenes as $img)
                        @if($img!='' || $img!=null)
                            <li>
                                <img value="{{$t}}" class="img-thumbnail" src="https://img.storecenter.cl/{{$img}}" style="height: 75px; object-fit: contain;" alt="{{$item->PRO_NOMBRE}}" title="{{$item->PRO_NOMBRE}}"  itemprop="image">
                            </li>
                            @php $t++; @endphp
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-8">
          <div class="card-body">
            <h3 class="">{{$item->PRO_NOMBRE}}</h3>
            <br>
            @php $descripcion = str_replace("<br>", "", $item->PRO_EPIGRAFE); @endphp
            <span itemprop="description">
                <h5 class="card-title">{!! $item->PRO_DESCRIPCION !!}</h5>
            </span>
          </div>
        </div>

      </div>
      <div class="row no-gutters">
        <div class="col-md-12  text-center">
            @if(!Session::has('id'))
            <a class="btn btn-cotizar" href="{{url('/cotizar/'.$item->PRO_ID)}}" data-id="{{$item->PRO_ID}}">
              Cotizar
              <i class="fas fa-dollar-sign" style="font-size:20px;float:right;"></i>
            </a>
            @endif
            <a class="btn btn-cotizar" href="{{url('/producto/'.$item->PRO_ID.'/pdf')}}" data-id="{{$item->PRO_ID}}">
              PDF
              <i class="far fa-file-pdf"  style="font-size:20px;float:right;"></i>
            </a>
        </div>
      </div>
    </div>
</div>

</div>
@endforeach
@include('inicio.novedades')
@else
@foreach($detalles as $producto)

@php $imagenes =explode(",",$producto->PRO_IMAGENES); @endphp
  <div class="item">
    <div>
        <br><br>
        <div class="row ml-1 mt-4 mb-5">
            <div class="col-md-12">
                <a href="{{url('/producto/'.$producto->PRO_ID)}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                    <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
                </a>
                <div>
                    @if(isset($status))
                        <strong><label style="font-size:25px "> Resultado </label></strong>
                    @else
                        <strong><label style="font-size:25px "> Formulario de Cotización </label></strong>
                    @endif

                    <div class="divseparador"></div>
                </div>
            </div>
        </div>

          <div class="row no-gutters">
            <div class="col-md-3">
              <img src="https://img.storecenter.cl/{{$imagenes[1]}}" alt="{{$producto->PRO_NOMBRE}}" title="{{$producto->PRO_NOMBRE}}" width="100%">
            </div>
            <div class="col-md-9">
              <div class="card-body">
                @include('producto.form')
              </div>
            </div>
          </div>
    </div>

  </div>
@endforeach
@include('inicio.destacados')
@endif


</div>



@endsection





@section('script')

<script src="{{ asset('FlexSlider/jquery.flexslider.js') }}"></script>
<script src="{{ asset('js/producto.js') }}"></script>
<script src="{{ asset('js/inicio.js') }}"></script>

@endsection
