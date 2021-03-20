<div class="ml-5 mt-4 mb-5">

    <strong><label style="font-size:25px "> Novedades </label></strong>

    <div class="divseparador"></div>

</div>

<div class="row">
    <div class="col-12">
        <div class="owl-carousel owl-theme">

          @foreach($novedades as $key => $novedad)

          @php
            $imagenes =explode(",",$novedad->NOT_IMAGENES);
          @endphp

            <div class="item">

                <div class="card" style="width: 100%;">
                    <div class="row no-gutters " style="height:25vh;">
                      <div class="col-md-4">
                        <img src="https://www.storecenter.cl/cph_upl/{{$imagenes[1]}}" alt="{{$novedad->NOT_TITULO}}" title="{{$novedad->NOT_TITULO}}">
                      </div>
                      <div class="col-md-8" style="display: flex;justify-content: center;align-items: center;">
                        <div class="card-body">
                          <h5 class="card-title"  style="">{{$novedad->NOT_TITULO}}</h5>
                        </div>
                      </div>
                    </div>
                    <div class="row no-gutters ">
                        <div class="col-md-12">
                        <a href="{{url('/novedades/'.$novedad->NOT_ID)}}" style="float:right;padding:5px;"><small style="color:#234560;">Leer más</small></a>
                        </div>

                    </div>
                </div>

            </div>

          @endforeach

        </div>
    </div>
</div>
