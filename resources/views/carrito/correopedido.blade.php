<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>



    <style>

    table.tableproductos {
            border: 1px solid black;
            width:100%;
            border-collapse: collapse;
         }
    table.tableproductos    tbody {
            border: 1px solid black;
        }
    table.tableproductos tr {
            border: 1px solid black;
        }
    table.tableproductos td {
            border: 1px solid black;
            text-align:center;
        }

      body{

          margin: 0;

          padding: 0;

          /* background-color: #1B262c; */

      }

      table{

          border-spacing: 0;

      }

      td{

          padding: 0;



      }

      img {

          border: 0;

      }

      .wrapper{

          width: 100%;

          table-layout: fixed;

          padding-bottom: 40px;

      }



      .webkit{

          max-width: 600px;

          background-color: #eeeeee;

          margin-top: 40px;



      }



      .outer{

          margin: 0 auto;

          width: 100%;

          max-width: 600px;

          border-spacing: 0;

          color: #4a4a4a;

      }

      @media screen and (max-width: 600px){



      }



      @media screen and (max-width: 400px){



        }

  </style>

</head>

<body>



<center class="wrapper">



    <table>



        <tr>

            <td>



            <div class="webkit" style="border-radius: 14px; border: 1px solid #234560; background:#FFF">



        <table class="outer" align="center">



            <tr>

                <td>

                <table width="100%" style="border-spacing: 0;">

                    <tr>

                        <td style="padding:10px; text-align:center; font-size:25px">



                        <a href=""><img src="https://www.storecenter.cl/img/logo.png" width="280" alt="Logo" title="Logo"></a>



                        </td>

                    </tr>

                </table>

                </td>

            </tr>

            <tr>

                <td style="padding:10px; text-align:left">



                  <div align="left" width="600">

                   <br>
                        @if($modo=='cliente')
                            <p style="font-size: 20px;">Estimado <b>{{$nombre}}</b>, se ha recibido conforme vuestra orden de compra</p>
                        @else
                            <p style="font-size: 20px;">Estimado, Ha recibido un nuevo pedido N° <b>{{$idpedido}}</b> de: <b>{{$nombre}}</b></p>
                        @endif

                        <p style="font-size: 18px;color:#234560;"><b>Fecha:</b> {{date("Y-m-d")}}</p>
                        <p style="font-size: 18px;color:#234560;"><b>Rut:</b> <span>{{$rut}}</span></p>
                        <p style="font-size: 18px;color:#234560;"><b>Nombre:</b> <span>{{$nombre}}</span></p>
                        <p style="font-size: 18px;color:#234560;"><b>Giro:</b> <span>{{$giro}}</span></p>
                        <p style="font-size: 18px;color:#234560;"><b>Email:</b> <span>{{$email}}</span></p>
                        <p style="font-size: 18px;color:#234560;"><b>Teléfono:</b> <span>{{$telefono}}</span></p>
                        <p style="font-size: 18px;color:#234560;"><b>Dirección:</b> <span>{{$direccion}}</span></p>
                        <p style="font-size: 18px;color:#234560;"><b>Comuna:</b> <span>{{$comuna}}</span></p>
                        <p style="font-size: 18px;color:#234560;"><b>Ciudad:</b> <span>{{$ciudad}}</span></p>
                        <br>
                        <p style="font-size: 20px;">Detalles del pedido:</p>

                        <table style="width:100%;" class="tableproductos">
                            <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carrito as $key => $item)
                                <tr>
                                    <td>{{$item['PRO_CODIGO']}}</td>
                                    <td>{{$item['PRO_NOMBRE']}}</td>
                                    <td>{{number_format($item['PRO_PRECIO'],0, '', '.')}}</td>
                                    <td>{{$item['cantidadcompra']}}</td>
                                    <td>{{number_format(($item['PRO_PRECIO']*$item['cantidadcompra']),0, '', '.')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <br>

                        <p style="font-size: 20px;">Neto: <b>{{number_format($totalsiniva,0, '', '.')}}</b></p>
                        <p style="font-size: 20px;">IVA: <b>{{number_format(($totalsiniva*0.19),0, '', '.')}}</b></p>
                        <p style="font-size: 20px;">Total: <b>{{number_format((($totalsiniva*0.19)+$totalsiniva),0, '', '.')}}</b></p>

                        <br>

                        @if($modo=='cliente')
                            <p style="font-size: 20px;">Att: Ventas</p>
                            <p style="font-size: 20px;">Fono: 56 22 4015592</p>
                            <p style="font-size: 20px;">Av. Sergio Vieira de Mello 4524 - bodega 2110 - Macul - Santiago.</p>
                        @else
                            <p style="font-size: 20px;">Saludos.</p>
                        @endif





                  </div>



                </td>

            </tr>



             <tr>

                 <td>

                 <div align="center" width="600">



                 <p>





                </p>

                 </div>



                 </td>

             </tr>





        </table>

    </div>





            </td>

        </tr>

    </table>







</center>



</body>

</html>
