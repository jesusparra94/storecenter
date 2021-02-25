<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
        h1{
        text-align: center;
        text-transform: uppercase;
        }
        .contenido{
        font-size: 20px;
        }
        table {
            border: 1px solid black;
            width:100%;
            border-collapse: collapse;
         }
         tbody {
            border: 1px solid black;
        }
        tr {
            border: 1px solid black;
        }
        td {
            border: 1px solid black;
            text-align:center;
        }
        .logo{
            text-align:center;
        }
        .preciototal{
            text-align:center;
        }
    </style>
    </head>
    <body>
        <p class="logo">
            <img src="img/logo.png" >
        </p>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($detalles as $producto)
                    @php
                        $imagenes =explode(",",$producto->PRO_IMAGENES);
                    @endphp
                    <tr>
                        <th scope="row"><img src="https://www.storecenter.cl/cph_upl/{{$imagenes[1]}}" width="90"></th>
                        <td>{{$producto->PRO_NOMBRE}}</td>
                        <td>{!!$producto->PRO_DESCRIPCION!!}</td>
                        <td>{{number_format(($producto->PRO_PRECIO),0, '', '.')}}</td>
                    </tr>
                @endforeach
                </tbody>
              </table>
              <br>
              <div class="preciototal">
                <p>Todos los precios publicados en StoreCenter Chile Ltda, son netos.</p>
              </div>

    </body>
</html>


