<form action="{{url('/solicitud/enviada')}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
    <div class="form-group">
        <label for="producto">Producto </label><span class="text-red"> * </span>
        <input type="text" class="form-control  {{$errors->has('producto')? 'is-invalid': '' }}" name="producto" placeholder="Portavasos 2 cavidades">
        @if($errors->has('producto'))
            <div class="invalid-feedback">
                Debes ingresar el nombre del producto.
            </div>
        @endif
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nombre">Nombre </label><span class="text-red"> * </span>
            <input type="text" class="form-control {{$errors->has('nombre')? 'is-invalid': '' }}" name="nombre" placeholder="Alejandra Valenzuela">
            @if($errors->has('nombre'))
            <div class="invalid-feedback">
                Debes ingresar su nombre.
            </div>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label for="empresa">Empresa</label>
            <input type="text" class="form-control {{$errors->has('empresa')? 'is-invalid': '' }}" name="empresa" placeholder="Empresas Spa.">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">Email </label><span class="text-red"> * </span>
            <input type="email" class="form-control {{$errors->has('email')? 'is-invalid': '' }}" name="email" placeholder="tunombre@empresa.cl">
            @if($errors->has('email'))
            <div class="invalid-feedback">
                Debes ingresar un Email válido.
            </div>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label for="telefono">Teléfono </label><span class="text-red"> * </span>
            <input type="tel" class="form-control {{$errors->has('telefono')? 'is-invalid': '' }}" name="telefono" placeholder="900000000">
            @if($errors->has('telefono'))
            <div class="invalid-feedback">
                Debes ingresar un número válido.
            </div>
            @endif
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
            @if($errors->has('region'))
            <div class="invalid-feedback">
                Debes seleccionar la región.
            </div>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label for="comuna">Comuna</label> <span class="text-red"> * </span>
                <select name="comuna" class="form-control comuna">
                  <option selected value="0">Seleccionar Comuna</option>
                </select>
            @if($errors->has('comuna'))
            <div class="invalid-feedback">
                Debes seleccionar la comuna.
            </div>
            @endif
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="ciudad">Ciudad </label><span class="text-red"> * </span>
            <input type="text" class="form-control {{$errors->has('ciudad')? 'is-invalid': '' }}" name="ciudad" placeholder="Santiago">
            @if($errors->has('ciudad'))
            <div class="invalid-feedback">
                Debes ingresar la ciudad.
            </div>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="comentarios">Comentarios </label><span class="text-red"> * </span>
        <textarea class="form-control {{$errors->has('comentarios')? 'is-invalid': '' }}" name="comentarios" rows="3" placeholder="Necesito 20 unidades de ..."></textarea>
        @if($errors->has('comentarios'))
            <div class="invalid-feedback">
                Debes ingresar algún comentario.
            </div>
        @endif
    </div>
    <div class="form-group">
        <div class="col-md-12">
            {!! NoCaptcha::display() !!}
        </div>
        @if($errors->has('g-recaptcha-response'))
                <div class="invalid-feedback">
                    Recaptcha inválido.
                </div>
        @endif
    </div>
    <div class="form-group">
        <div class="col-md-5">
            <input type="submit" class="btn btn-cotizar"  value="Enviar"/>
        </div>
    </div>
</form>
