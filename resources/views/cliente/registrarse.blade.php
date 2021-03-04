@extends('layouts.app')

@section('content')

<div class=" mt-2 pt-2 p-3">

<div class="row ml-1 mt-4 mb-5">
        <div class="col-md-12">
            <a href="{{url('/')}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
            </a>
            <div>
            <strong><label style="font-size:25px ">Datos requeridos </label></strong>
                <div class="divseparador"></div>
            </div>
        </div>
    </div>

    <form action="{{url('/procesar/registro')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="razon">Razón social o Nombre</label> <span class="text-red"> * </span>
            <input type="text" class="form-control {{$errors->has('razon')? 'is-invalid': '' }}" name="razon">
            @if($errors->has('razon'))
                    <div class="invalid-feedback">
                        Contraseña invalida.
                    </div>
              @endif
          </div>
          <div class="form-group col-md-6">
            <label for="rut">Rut</label> <span class="text-red"> * </span>
            <input type="text" class="form-control {{$errors->has('rut')? 'is-invalid': '' }}" name="rut">
            <small>Sin puntos ni guión, ejemplo(23223223K)</small>
            @if($errors->has('rut'))
                    <div class="invalid-feedback">
                        Contraseña invalida.
                    </div>
              @endif
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="giro">Giro</label> <span class="text-red"> * </span>
              <input type="text" class="form-control {{$errors->has('giro')? 'is-invalid': '' }}" name="giro">
              @if($errors->has('giro'))
                    <div class="invalid-feedback">
                        Contraseña invalida.
                    </div>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="telefono">Teléfono</label> <span class="text-red"> * </span>
              <input type="text" class="form-control {{$errors->has('telefono')? 'is-invalid': '' }}" name="telefono">
              @if($errors->has('telefono'))
                    <div class="invalid-feedback">
                        Contraseña invalida.
                    </div>
              @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email</label> <span class="text-red"> * </span>
              <input type="email" class="form-control {{$errors->has('email')? 'is-invalid': '' }}" name="email">
              @if($errors->has('email'))
                    <div class="invalid-feedback">
                        Contraseña invalida.
                    </div>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="direccion">Dirección</label> <span class="text-red"> * </span>
              <input type="text" class="form-control {{$errors->has('direccion')? 'is-invalid': '' }}" name="direccion">
              @if($errors->has('direccion'))
                    <div class="invalid-feedback">
                        Dirección invalida.
                    </div>
              @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="region">Región</label> <span class="text-red"> * </span>
                <select name="region" class="form-control region {{$errors->has('region')? 'is-invalid': '' }}">
                  <option selected value="0">Seleccionar Región</option>
                  <option  value="14">Región de Los Ríos</option>
                  <option  value="13">Región Metropolitana</option>
                  <option  value="12">Región de Magallanes y la Antártica Chilena</option>
                  <option  value="11">Región de Aysén del General Carlos Ibáñez del Campo</option>
                  <option  value="10">Región de Los Lagos</option>
                  <option  value="9">Región de la Araucanía</option>
                  <option  value="8">Región del Bío-Bío</option>
                  <option  value="7">Región del Maule</option>
                  <option  value="6">Región del Libertador General Bernardo O Higgins</option>
                  <option  value="5">Región de Valparaiso</option>
                  <option  value="4">Región de Coquimbo</option>
                  <option  value="3">Región de Atacama</option>
                  <option  value="2">Región de Antofagasta</option>
                  <option  value="1">Región de Tarapacá</option>
                  <option  value="15">Región de Arica y Parinacota</option>
                </select>
                @if($errors->has('region'))
                    <div class="invalid-feedback">
                        Región invalida.
                    </div>
              @endif
            </div>
            <div class="form-group col-md-6">
                <label for="comuna">Comuna</label> <span class="text-red"> * </span>
                <select name="comuna" class="form-control comuna {{$errors->has('comuna')? 'is-invalid': '' }}">
                  <option selected value="0">Seleccionar Comuna</option>
                </select>
                @if($errors->has('comuna'))
                    <div class="invalid-feedback">
                        Comuna invalida.
                    </div>
              @endif
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="ciudad">Ciudad</label> <span class="text-red"> * </span>
              <input type="text" class="form-control {{$errors->has('ciudad')? 'is-invalid': '' }}" name="ciudad">
              @if($errors->has('ciudad'))
                    <div class="invalid-feedback">
                        Contraseña invalida.
                    </div>
              @endif
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="password">Contraseña</label> <span class="text-red"> * </span>
              <input type="password" class="form-control {{$errors->has('password')? 'is-invalid': '' }}" name="password">
              @if($errors->has('password'))
                    <div class="invalid-feedback">
                    Contraseña invalida (min. 8 carácteres)/ Deben coincidir.
                    </div>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="password_confirmation">Repita Contraseña</label> <span class="text-red"> * </span>
              <input type="password" class="form-control {{$errors->has('password')? 'is-invalid': '' }}" name="password_confirmation">
              @if($errors->has('password'))
                    <div class="invalid-feedback">
                        Contraseña invalida (min. 8 carácteres)/ Deben coincidir.
                    </div>
              @endif
            </div>
        </div>

        <div class="form-group">
        <div class="col-md-12">
            {!! NoCaptcha::display() !!}
        </div>

        @if ($errors->has('g-recaptcha-response'))
            <span class="feedbak-error">
                <strong>Recaptcha inválido.</strong>
            </span>
        @endif
    </div>

        <button type="submit" class="btn btn-crear">Registrarme</button>
    </form>

</div>

@endsection

@section('script')


<script src="{{ asset('js/registrarse.js') }}"></script>


@endsection
