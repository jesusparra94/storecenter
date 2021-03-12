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
            text-align:right;
        }
    </style>
    </head>
    <body>
    @php
     $car = Session::get('car');
     $total = 0;
    @endphp
        <p class="logo">
            <img src="img/logo.png" >
        </p>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($car as $key => $value)
                    @php
                        $total = $total + ($value['PRO_PRECIO']*$value['cantidadcompra']);
                        $imagenes =explode(",",$value['PRO_IMAGENES']);
                    @endphp
                    <tr>
                        <th scope="row"><img alt="{{$value['PRO_NOMBRE']}}" title="{{$value['PRO_NOMBRE']}}" src="https://www.storecenter.cl/cph_upl/{{$imagenes[1]}}" width="90"></th>
                        <td>{{$value['PRO_NOMBRE']}}</td>
                        <td>{{$value['cantidadcompra']}}</td>
                        <td>{{number_format(($value['PRO_PRECIO']*$value['cantidadcompra']),0, '', '.')}}</td>
                    </tr>
                @endforeach
                </tbody>
              </table>
              <br>
              <div class="preciototal">
                <h4>Neto: {{number_format($total,0, '', '.')}}</h4>
                <h4>IVA: {{number_format(($total*0.19),0, '', '.')}}</h4>
                <h4>Total: {{number_format((($total*0.19)+$total),0, '', '.')}}</h4>
                <p style="text-align:center;">StoreCenter Chile Ltda.</p>
              </div>

    </body>
</html>


