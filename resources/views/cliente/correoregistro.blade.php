<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>



    <style>

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



                        <a href=""><img src="https://www.storecenter.cl/images/logo.png" width="280" alt="Logo" title="Logo"></a>



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
                            <p style="font-size: 20px;">Estimado <b>{{$nombre}}</b>, su registro se ha completado.</p>
                        @else
                            <p style="font-size: 20px;">El Usuario <b>{{$nombre}}</b> se ha registrado en la web.</b></p>
                        @endif

                        <p style="font-size: 18px;color:#234560;"><b>Fecha:</b> {{date("Y-m-d")}}</p>
                        <p style="font-size: 18px;color:#234560;"><b>Usuario:</b> <span>{{$rut}}</span></p>

                        @if($modo=='cliente')
                            <p style="font-size: 18px;color:#234560;"><b>Clave:</b> <span>{{$clave}}</span></p>
                            <p style="font-size: 20px;">Puede acceder desde nuestra web https://www.storecenter.cl, opción Iniciar Sesión.</p>
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
