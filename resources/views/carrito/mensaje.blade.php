@extends('layouts.app')

@section('content')


<div class="mt-2 pt-2 p-3">



            <br><br>
            <div class="row ml-1 mt-4 mb-5">
                <div class="col-md-12">
                    <a href="{{url('/')}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                        <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
                    </a>
                    <div>
                        <strong><label style="font-size:25px "> Resultado </label></strong>
                        <div class="divseparador"></div>
                    </div>
                </div>
            </div>
        <div class="mb-3" style="width: 100%;">
          <div class="row no-gutters text-center">
            <div class="col-md-12">
              <h3>{{$Mensaje}}</h3>
                <br><br>
                <i class="far fa-check-circle"  style="font-size:50px;"></i>
                <br><br>
            </div>
          </div>
        </div>




</div>



@endsection


