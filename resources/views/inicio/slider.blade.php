<div class="row">
    <div class="col-md-7 col-sm-12 mx-auto">

        <div id="carouselExampleControls" class="carousel slide mb-4" data-touch="false" data-interval="true" data-ride="carousel" style="height: 200px">

        <div class="carousel-inner">
            @php $item = 0; @endphp
            @foreach($sliders as $key => $slider)
            @php
                if($item==0){
                    $clase = 'active';
                }else{
                    $clase = '';
                }
            @endphp
            <div class="carousel-item {{$clase}}" data-interval="2000">
            <img src="https://www.storecenter.cl/cph_upl/{{$slider->BAN_UBICACION}}" class="d-block w-100 img-fluid" alt="{{$slider->BAN_NOMBRE}}" title="{{$slider->BAN_NOMBRE}}" style="height: 200px; object-fit: unset" >
            </div>
            @php $item = $item+1; @endphp
            @endforeach

        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>

    </div>
</div>


