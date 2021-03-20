<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Producto;
use App\Models\Cotizaciones;
use App\Models\ProductosCategorias;
use App\Models\Productos;
use App\Models\Novedades;
use App\Models\Slider;
use App\Models\Contenidos;
use App\Mail\CotizacionUnica;
use App\Mail\RegistroUsuario;

class ContactoController extends Controller
{
    public function index(){

        /*Notificación de visita*/
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        if(filter_var($client, FILTER_VALIDATE_IP)){ $ip = $client;}
        elseif(filter_var($forward, FILTER_VALIDATE_IP)){ $ip = $forward;}
        else{ $ip = $remote;}
        $urlnotificacion = $_SERVER['REQUEST_URI'];
        $mail = Mail::to('visitas@storecenter.cl')->send(new RegistroUsuario('','','','envioip',$urlnotificacion,$ip));
        /***/

        $data = request();

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


        $empresa =  Contenidos:: where([['CON_CODIGO', '=' , 'txt_empresa']])
                                ->first();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
                                ->first();
        return view('contacto.index',compact('categorias','subcategorias','destacados','empresa','footer'));
    }

    public function insert(Request $request){


        $campos = $request->validate([
            'producto'=> 'required|max:320|min:2',
            'nombre'=> 'required|max:320|min:2',
            'empresa'=> 'required|max:320|min:2',
            'email'=> 'required|email',
            'telefono'=> 'required|max:15|min:7',
            'region'=> 'required',
            'comuna'=> 'required',
            'ciudad'=> 'required|max:320|min:2',
            'comentarios' => 'required|max:320|min:2'
        ]);

        $this->validate($request,$campos);


        $data = request();

        $categorias = ProductosCategorias::where([['CAT_PADRE', '=' , 0],['CAT_ESTADO', '=' , 1]])
                                            ->orderBy('CAT_NOMBRE', 'asc')
                                            ->get();

        foreach ($categorias as $key => $value) {

            $subcategorias[] =ProductosCategorias::where([['CAT_PADRE', '=' , $value["CAT_ID"]],['CAT_ESTADO', '=' , 1]])
                                                                ->orderBy('CAT_NOMBRE', 'asc')
                                                                ->get();
        }


        $empresa =  Contenidos:: where([['CON_CODIGO', '=' , 'txt_empresa']])
                                ->first();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
                                ->first();
        //$detalles = Producto::where([['PRO_ID', '=' , $data['idproducto']]])
         //                       ->get();
        $cotizacion = Cotizaciones::insert([
                    'fecha' => date("Y-m-d"),
                    'cliente' => $data['nombre'],
                    'empresa' => $data['empresa'],
                    'ciudad' => $data['ciudad'],
                    'telefono' => $data['telefono'],
                    'email' => $data['email'],
                    'comentarios' => $data['comentarios'],
                    'producto' => $data['producto']

        ]);
        $num = Cotizaciones::select('id')
                            ->orderByDesc('cotizaciones.id')
                            ->limit(1)
                            ->get();

        if($cotizacion){
            $nombre = $data['nombre'];
            $producto = $data['producto'];
            $codigo = $data['idproducto'];
            $ciudad = $data['ciudad'];
            $empresa = $data['empresa'];
            $email = $data['email'];
            $telefono = $data['telefono'];
            $comentarios = $data['comentarios'];
            $mail = Mail::to($data['email'])->send(new CotizacionUnica($nombre,$producto,$codigo,$ciudad,$empresa,$email,$telefono,'cliente',$num[0]->id,$comentarios));
            $mail = Mail::to('contacto@storecenter.cl')->send(new CotizacionUnica($nombre,$producto,$codigo,$ciudad,$empresa,$email,$telefono,'jefe',$num[0]->id,$comentarios));
            return redirect('/solicitud/enviada/');
            //return view('cotizaciones.mensaje',compact('categorias','subcategorias','empresa','footer','detalles'))->with('Mensaje', 'Cotización generada exitosamente.');

        }


    }

    public function cotizacioncontacto(){
        $categorias = ProductosCategorias::where([['CAT_PADRE', '=' , 0],['CAT_ESTADO', '=' , 1]])
                                            ->orderBy('CAT_NOMBRE', 'asc')
                                            ->get();

        foreach ($categorias as $key => $value) {

            $subcategorias[] =ProductosCategorias::where([['CAT_PADRE', '=' , $value["CAT_ID"]],['CAT_ESTADO', '=' , 1]])
                                                                ->orderBy('CAT_NOMBRE', 'asc')
                                                                ->get();
        }


        $empresa =  Contenidos:: where([['CON_CODIGO', '=' , 'txt_empresa']])
                                ->first();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
                                ->first();
        //$detalles = Producto::where([['PRO_ID', '=' , $idproducto]])
        //                        ->get();
        return view('contacto.mensaje',compact('categorias','subcategorias','empresa','footer'))->with('Mensaje', 'Mensaje enviado exitosamente.');
    }
}
