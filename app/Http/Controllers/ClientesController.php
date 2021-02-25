<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenidos;
use App\Models\Productos;
use App\Models\ProductosCategorias;
use App\Models\Slider;
use App\Models\Comunas;
use App\Models\Clientes;
use App\Models\Pedidos;

class ClientesController extends Controller
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

        $clientes = Slider:: where([['GRU_ID', '=' , 2],['BAN_ESTADO', '=' , 1]])
                            ->get();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        return view('cliente.index',compact('categorias','subcategorias','destacados','clientes','footer'));

    }

    public function registrarse(){

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
                            ->orderBy('PED_FECHA', 'desc')
                            ->get();


        return view('cliente.micuenta',compact('categorias','subcategorias','footer','pedidos'));
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




}
