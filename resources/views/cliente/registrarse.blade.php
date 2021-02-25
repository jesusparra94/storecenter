@extends('layouts.app')

@section('content')

<div class=" mt-2 pt-2 p-3">

<div class="row ml-1 mt-4 mb-5">
        <div class="col-md-12">
            <a href="{{url('/')}}" class="navbar-brand" style="margin-bottom: 0px !important; margin-top: 0px !important; ">
                <i class="fas fa-arrow-left" style="color:#234560; margin-top: 0px;float:left;" aria-hidden="true"></i>
            </a>
            <div>
                <strong><label style="font-size:25px "> Detalles del producto </label></strong>
                <div class="divseparador"></div>
            </div>
        </div>
    </div>


    <form>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="razon">Razón social o Nombre</label> <span class="text-red"> * </span>
            <input type="text" class="form-control" name="razon">
          </div>
          <div class="form-group col-md-6">
            <label for="rut">Rut de la empresa</label> <span class="text-red"> * </span>
            <input type="text" class="form-control" name="rut">
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="giro">Giro</label> <span class="text-red"> * </span>
              <input type="text" class="form-control" name="giro">
            </div>
            <div class="form-group col-md-6">
              <label for="telefono">Teléfono</label> <span class="text-red"> * </span>
              <input type="text" class="form-control" name="telefono">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email</label> <span class="text-red"> * </span>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group col-md-6">
              <label for="direccion">Dirección</label> <span class="text-red"> * </span>
              <input type="text" class="form-control" name="direccion">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="region">Región</label> <span class="text-red"> * </span>
                <select name="region" class="form-control region">
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
            </div>
            <div class="form-group col-md-6">
                <label for="comuna">Comuna</label> <span class="text-red"> * </span>
                <select name="comuna" class="form-control comuna">
                  <option selected value="0">Seleccionar Comuna</option>
                </select>
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="ciudad">Ciudad</label> <span class="text-red"> * </span>
              <input type="text" class="form-control" name="ciudad">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="password">Contraseña</label> <span class="text-red"> * </span>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group col-md-6">
              <label for="repetirpass">Repita Contraseña</label> <span class="text-red"> * </span>
              <input type="password" class="form-control" name="repetirpass">
            </div>
        </div>
        <button type="submit" class="btn btn-crear">Registrar</button>
    </form>

</div>

@endsection

@section('script')


<script src="{{ asset('js/registrarse.js') }}"></script>


@endsection
