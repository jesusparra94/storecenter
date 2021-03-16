<footer>

    @php
        $rem = '<div align="center"><span style="color: yellow;"><br><br><br><br><br><br><br>&nbsp;&nbsp; </span><br><br><br><br><br><br><br><br></div><span style="color: yellow;"></span></div>';
        $resultado = str_replace($rem, "", $footer->CON_VALOR);

        $array = explode('|', $resultado);
        $array0 = str_replace("<b>", "", $array[0]);
        $array3 = str_replace("<b>", "", $array[3]);
        $array6 = str_replace("<b>", "", $array[6]);
    @endphp

    {{-- <small style="margin-bottom: 10px"> {!! $array[0] !!} </small> --}}

{{-- Hola --}}

<div class="row row-cols-1 row-cols-xl-3">
    <div class="col mt-4 mb-4">
      <div class="card" style="border: none; background:none; box-shadow: none !important; display: block !important;" align="center" >
        <img src="{{asset('img/logo.png')}}" class="card-img-top" alt="..." style="width: 150px">
        <div class="card-body">
          <h5 class="card-title">{!! $array0 !!}</h5>
        </div>
      </div>
    </div>

    <div class="col mt-4 mb-4">
        <div class="card" style="border: none; background:none; box-shadow: none !important; display: block !important;" align="center" >
          <h3>Consultas</h3>
          <div class="card-body" style="text-align: start;">
            <h6 class="card-title">{!! $array[1] !!}</h6>
            <h6 class="card-title mt-2 ">{!! $array[2]  !!}</h6>
            <h6 class="card-title mt-2 ">{!! $array3 !!}</h6>
          </div>
        </div>
    </div>

    <div class="col mt-4 mb-4">
        <div class="card" style="border: none; background:none; box-shadow: none !important; display: block !important;" align="center" >
          <h3>Ubícanos</h3>
          <div class="card-body" style="text-align: start;">
            <h6 class="card-title">{!! $array[4] !!} {!! $array[5] !!}</h6>

          </div>
        </div>
    </div>
</div>

<div class="row " align="center">
    <div class="col-12 mb-4 tcondiciones">
        {!! $array6 !!}
    </div>
</div>

</footer>
