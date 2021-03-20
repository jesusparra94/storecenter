<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Contenidos;
use App\Models\Productos;
use App\Models\ProductosCategorias;
use App\Models\PedidosProductos;
use App\Models\Slider;
use App\Models\Comunas;
use App\Models\Regiones;
use App\Models\Clientes;
use App\Models\Pedidos;
use App\Mail\RegistroUsuario;

class ClientesController extends Controller
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

        $clientes = Slider:: where([['GRU_ID', '=' , 2],['BAN_ESTADO', '=' , 1]])
                            ->get();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        return view('cliente.index',compact('categorias','subcategorias','destacados','clientes','footer'));

    }

    public function registrarse(){

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

        $categorias = ProductosCategorias::where([['CAT_PADRE', '=' , 0],['CAT_ESTADO', '=' , 1]])
                                            ->orderBy('CAT_NOMBRE', 'asc')
                                            ->get();

        foreach ($categorias as $key => $value) {

            $subcategorias[] =ProductosCategorias::where([['CAT_PADRE', '=' , $value["CAT_ID"]],['CAT_ESTADO', '=' , 1]])
                                                                ->orderBy('CAT_NOMBRE', 'asc')
                                                                ->get();
        }

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        return view('cliente.registrarse',compact('categorias','subcategorias','footer'));


    }

    public function procesarregistro(Request $request){
        $campos = $request->validate([
            'razon'=> 'required|max:320|min:2',
            'rut'=> 'required|max:14|min:2',
            'giro'=> 'required|max:320|min:2',
            'telefono'=> 'required|max:15|min:7',
            'email'=> 'required|email',
            'direccion'=> 'required|max:320|min:2',
            'region'=> 'required',
            'comuna'=> 'required',
            'ciudad'=> 'required|max:320|min:2',
            'password' => 'required|min:8|confirmed',
            'actividadeconomica'=> 'required|mimes:pdf,jpeg,png,jpg',
            'g-recaptcha-response' => 'required|captcha',
        ]);


        if($request->hasFile('actividadeconomica')){
            $pdf = $request->file("actividadeconomica")->store('pdf', 'public');

        }


        //$this->validate($request,$campos);

        $data = request();

        $search = array(".", "-", " ");
        $replace = "";
        $rut = $data['rut'];
        $rutlimpio = strtolower(str_replace($search, $replace, $rut));

        $validarcliente = Clientes::where('vip_rut','=',$rutlimpio)
                        ->get();
        $result = count($validarcliente);

        if($result==0){
            $cliente = Clientes::insert([
                'vip_nombre' => $data['razon'],
                'vip_rut' => $rutlimpio,
                'vip_giro' => $data['giro'],
                'vip_fono_contacto' => $data['telefono'],
                'vip_mail' => $data['email'],
                'vip_direccion' => $data['direccion'],
                'vip_comuna' => $data['comuna'],
                'vip_ciudad' => $data['ciudad'],
                'vip_password' => md5($data['password']),
                'pdf_actividadeconomica' => $pdf,
                'vip_estado' => 0

            ]);
            if($cliente){
                    $nombre = $data['razon'];
                    $rutlimpio = $rutlimpio;
                    $pass = $data['password'];
                    $modo = 'cliente';
                    $mail = Mail::to($data['email'])->send(new RegistroUsuario($nombre,$rutlimpio,$pass,'cliente','',''));
                    $mail = Mail::to('contacto@storecenter.cl')->send(new RegistroUsuario($nombre,$rutlimpio,$pass,'jefe','',''));
                    return redirect('/registro/completo');
            }else{
                return redirect('/registro/error');
            }

        }else{
            return redirect('/registro/errorrut');
        }


    }

    public function registrostatus($id){
        $categorias = ProductosCategorias::where([['CAT_PADRE', '=' , 0],['CAT_ESTADO', '=' , 1]])
                                            ->orderBy('CAT_NOMBRE', 'asc')
                                            ->get();
        foreach ($categorias as $key => $value) {

            $subcategorias[] =ProductosCategorias::where([['CAT_PADRE', '=' , $value["CAT_ID"]],['CAT_ESTADO', '=' , 1]])
                                                                ->orderBy('CAT_NOMBRE', 'asc')
                                                                ->get();
        }

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();

        if($id=='error'){
            return view('cliente.mensaje',compact('categorias','subcategorias','footer'))->with('Mensaje', 'error');
        }elseif($id=='errorrut'){
            return view('cliente.mensaje',compact('categorias','subcategorias','footer'))->with('Mensaje', 'errorrut');
        }else{
            return view('cliente.mensaje',compact('categorias','subcategorias','footer'))->with('Mensaje', 'ok');
        }


    }

    public function traercomunas(Request $request){

        $comunas = Comunas::where('reg_id','=',$request->idregion)
                            ->orderBy('com_nombre', 'asc')
                            ->get();

        return $comunas;

    }

    public function micuenta(){
        if(!\Session::has('car')) \Session::put('car', array());
        $categorias = ProductosCategorias::where([['CAT_PADRE', '=' , 0],['CAT_ESTADO', '=' , 1]])
                                            ->orderBy('CAT_NOMBRE', 'asc')
                                            ->get();

        foreach ($categorias as $key => $value) {

            $subcategorias[] =ProductosCategorias::where([['CAT_PADRE', '=' , $value["CAT_ID"]],['CAT_ESTADO', '=' , 1]])
                                                                ->orderBy('CAT_NOMBRE', 'asc')
                                                                ->get();
        }

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        $idcliente = \Session::get('id');

        $pedidos = Pedidos::where('PED_USUARIO','=',$idcliente)
                            ->orderBy('PED_ID', 'desc')
                            ->get();


        return view('cliente.micuenta',compact('categorias','subcategorias','footer','pedidos'));
    }

    public function misdatos(){

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


        $categorias = ProductosCategorias::where([['CAT_PADRE', '=' , 0],['CAT_ESTADO', '=' , 1]])
                                            ->orderBy('CAT_NOMBRE', 'asc')
                                            ->get();

        foreach ($categorias as $key => $value) {

            $subcategorias[] =ProductosCategorias::where([['CAT_PADRE', '=' , $value["CAT_ID"]],['CAT_ESTADO', '=' , 1]])
                                                                ->orderBy('CAT_NOMBRE', 'asc')
                                                                ->get();
        }

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        $idcliente = \Session::get('id');

        $cliente = Clientes::where('vip_id','=',$idcliente)->first();

        $comunas = Comunas::where('com_id','=',$cliente->vip_comuna)->first();

        $regiones = Regiones::where('reg_id','=',$comunas->reg_id)->first();

        $comuna = $comunas->com_nombre;

        $region = $regiones->reg_nombre;

        return view('cliente.datoscliente',compact('categorias','subcategorias','footer','comuna','region','cliente'));
    }

    public function login(Request $request){

        $validatedData = $request->validate([
            'rut' => 'required',
            'password' => 'required'
        ], [
            'rut.required' => 'Rut requerido',
            'password.required' => 'Contraseña requerida'
        ]);

        $rem = '-';
        $rem2 = '.';
        $rut = str_replace($rem, "", $request->rut);
        $rut = str_replace($rem2, "", $rut);


        $cliente = Clientes::where([['vip_rut','=',$rut],['vip_estado','=',1]])->first();

        if($cliente){

            if(md5($request->password) == $cliente->vip_password){

                session(['id' => $cliente->vip_id,

                    'nombre' => $cliente->vip_nombre,

                    'emaillogin' => $cliente->vip_mail

                ]);

                return redirect('/cuenta');

            }else{
                return redirect('/');
            }

        }else{

            return redirect('/');
        }

    }

    public function logout(Request $request){

        $data = request();
        $id = $data->id;

        \Session::forget('id');
        return "ok";


    }

    public function detalles($id){

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

        $detalles = Pedidos::where('PED_ID','=',$id)
                        ->get();
        $productoscompra = PedidosProductos::where('PED_ID','=',$id)
                        ->get();

        $productos = Productos::get();

        $idpedido = $id;



        return view('cliente.detalles',compact('categorias','subcategorias','footer','empresa','detalles','productoscompra','productos','idpedido'));

    }




}
