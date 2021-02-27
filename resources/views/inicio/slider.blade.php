<div id="carouselExampleControls" class="carousel slide mb-4" data-touch="false" data-interval="true" style="height: 200px">
  <div class="carousel-inner">
    @foreach($sliders as $key => $slider)
    <div class="carousel-item active">
      <img src="https://www.storecenter.cl/cph_upl/{{$slider->BAN_UBICACION}}" class="d-block w-100 img-fluid" alt="..." style="height: 200px; object-fit: unset" >
    </div>
      
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

