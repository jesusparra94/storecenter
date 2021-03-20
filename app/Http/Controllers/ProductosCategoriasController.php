<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Models\ProductosCategorias;
use App\Models\Productos;
use App\Models\Novedades;
use App\Models\Slider;
use App\Models\Contenidos;
use App\Models\Visitas;
use App\Mail\RegistroUsuario;

class ProductosCategoriasController extends Controller
{
    public function index(){


        $categorias = ProductosCategorias::where([['CAT_PADRE', '=' , 0],['CAT_ESTADO', '=' , 1]])
                                            ->orderBy('CAT_NOMBRE', 'asc')
                                            ->get();

        foreach ($categorias as $key => $value) {

            $subcategorias[] =ProductosCategorias::where([['CAT_PADRE', '=' , $value["CAT_ID"]],['CAT_ESTADO', '=' , 1]])
                                                                ->orderBy('CAT_NOMBRE', 'asc')
                                                                ->get();
        }

        $destacados = Productos::where([['PRO_DESTACADO', '=' , 1],['PRO_ESTADO', '=' , 1]])
                                ->orderBy('PRO_NOMBRE', 'asc')
                                ->get();


        $novedades = Novedades::where([['NOT_ESTADO', '=' , 1]])
                                ->orderBy('NOT_FECHA', 'desc')
                                ->get();

        $sliders = Slider:: where([['GRU_ID', '=' , 1],['BAN_ESTADO', '=' , 1]])
                            ->get();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
                            ->first();

        /*Registro de IP Unica y notificación de visita*/

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }
        $fecha = date("Ymd");
        $url = $_SERVER['REQUEST_URI'];
        $contadorvisitas = 0;
        $urlnotificacion = $_SERVER['SCRIPT_FILENAME'];
        $visitasxip = Visitas::select('CON_VALOR')
                      ->where('con_ip','=',$ip)
                      ->where('con_fecha','=',$fecha)
                      ->get();

        if(count($visitasxip)>0){
            $n = $visitasxip[0]->CON_VALOR;
        }else{
            $n = 0;
        }

		if($n > 0){
            $contadorvisitas = $n + 1;
			$updatevisitas = Visitas::where('con_ip','=',$ip)
                             ->update(['con_valor' => $contadorvisitas]);
            //$mail = Mail::to('visitas@storecenter.cl')->send(new RegistroUsuario('','','','envioip',$urlnotificacion,$ip));
		}else{
            $visita = Visitas::insert([
                       'con_ip' => $ip,
                       'con_fecha' => $fecha,
                       'con_valor' => 1,
                       'con_address' => $url,
                      ]);
            $mail = Mail::to('visitas@storecenter.cl')->send(new RegistroUsuario('','','','envioip',$urlnotificacion,$ip));
		}

        /*Registro de IP Unica*/

        return view('inicio.inicio',compact('categorias','subcategorias','destacados','novedades','sliders','footer'));

    }
}
