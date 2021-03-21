<div class="ml-5 mt-4 mb-5">

    <strong><label style="font-size:25px "> Destacados </label></strong>

    <div class="divseparador"></div>

</div>

<div class="row">
    <div class="col-12">
        <div class="owl-carousel owl-theme">

          @foreach($destacados as $key => $destacado)

          @php
            $imagenes =explode(",",$destacado->PRO_IMAGENES);
          @endphp



            <div class="item">

                <div class="card mb-3" style="width: 100%;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="https://img.storecenter.cl/{{$imagenes[1]}}" alt="{{$destacado->PRO_NOMBRE}}" title="{{$destacado->PRO_NOMBRE}}">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title" style="margin-top: 25%;">{{$destacado->PRO_NOMBRE}}</h5>
                        </div>
                      </div>
                    </div>
                  </div>

            </div>

          @endforeach



                {{-- <a href="">

                    <div class="item">

                        <div class="card mb-3" style="width: 100%;">
                            <div class="row no-gutters">
                              <div class="col-md-4">
                                <img src="{{asset('img/sinimagen.svg')}}" alt="...">
                              </div>
                              <div class="col-md-8">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                              </div>
                            </div>
                          </div>

                    </div>
                </a> --}}


        </div>
    </div>
</div>
