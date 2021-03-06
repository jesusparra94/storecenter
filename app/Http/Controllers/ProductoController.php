<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cotizaciones;
use App\Models\ProductosCategorias;
use App\Models\Productos;
use App\Models\Novedades;
use App\Models\Slider;
use App\Models\Contenidos;
use App\Mail\RegistroUsuario;

class ProductoController extends Controller
{
    public function index($id){

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

        $empresa =  Contenidos:: where([['CON_CODIGO', '=' , 'txt_empresa']])
                            ->first();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        $productos = Productos::where([['CAT_ID', '=' , $id],['PRO_ESTADO', '=' , 1]])
                    ->orderBy('PRO_NOMBRE', 'asc')
                    ->get();


        return view('producto.index',compact('categorias','subcategorias','destacados','empresa','footer','productos'));

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


        $destacados = Productos::where([['PRO_DESTACADO', '=' , 1],['PRO_ESTADO', '=' , 1]])
                                ->orderBy('PRO_NOMBRE', 'asc')
                                ->get();


        $empresa =  Contenidos:: where([['CON_CODIGO', '=' , 'txt_empresa']])
                            ->first();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        $detalles = Producto::where([['PRO_ID', '=' , $id]])
                    ->get();

        //return $detalles;

        return view('producto.descripcion',compact('categorias','subcategorias','destacados','empresa','footer','detalles'))->with('Modo', 'Descripcion');
    }

    public function novedades($id){

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


        $empresa =  Contenidos:: where([['CON_CODIGO', '=' , 'txt_empresa']])
                            ->first();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        $novedad = Novedades::where([['NOT_ID', '=' , $id]])
                    ->get();
        return view('producto.descripcion',compact('categorias','subcategorias','destacados','empresa','footer','novedad'))->with('Modo', 'Novedades');
    }

    public function destacados($id){

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


        $destacado = Productos::where([['PRO_ID', '=' , $id]])
                                ->get();

        $novedades = Novedades::where([['NOT_ESTADO', '=' , 1]])
                                ->orderBy('NOT_FECHA', 'desc')
                                ->get();

        $empresa =  Contenidos:: where([['CON_CODIGO', '=' , 'txt_empresa']])
                            ->first();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        //$novedad = Novedades::where([['NOT_ID', '=' , $id]])
        //            ->get();
        return view('producto.descripcion',compact('categorias','subcategorias','destacado','empresa','footer','novedades'))->with('Modo', 'Destacados');
    }

    public function listado($idCategoria){
        return view('producto.index');
    }

    public function generarpdf($id){
            $detalles = Producto::where([['PRO_ID', '=' , $id]])
                        ->get();
            $pdf = \PDF::loadView('producto.pdf', compact('detalles'));
            return $pdf->download('cotizacion.pdf');
    }

    public function cotizar($id){

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
        $detalles = Producto::where([['PRO_ID', '=' , $id]])
                                ->get();
        //\Session::put('detalles', $detalles);

        return view('producto.descripcion',compact('categorias','subcategorias','destacados','empresa','footer','detalles'))->with('Modo', 'Cotizar');
    }

    public function buscarproducto(Request $request){
        $data = request();

        $productosearch = $data->nameproducto;

        $mensaje = "";

        $resultado = Producto::where('PRO_NOMBRE', 'like', '%'.$productosearch.'%')
                              ->get();

        $totalresultados = count($resultado);
        if($totalresultados>0){
            $mensaje = "Hay resultados";
        }else{
            $mensaje = "No se encontraron resultados";
        }


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
        //$detalles = Producto::where([['PRO_ID', '=' , $id]])
        //->get();

        return view('producto.busqueda',compact('categorias','subcategorias','destacados','empresa','footer','mensaje','resultado'));
    }

    public function generarcotizacion(Request $request){

        /*
        $campos = [
            'producto'=> 'required|max:320|min:2',
            'nombre'=> 'required|max:|10|min:2',
            'empresa'=> 'required|max:320|min:2',
            'email'=> 'required',
            'telefono'=> 'required|max:15|min:7',
            'ciudad'=> 'required|max:320|min:2',
            'comuna'=> 'required|max:320|min:2',
            'comentarios' => 'required|max:320|min:2'
            ];

        $this->validate($request,$campos);
*/
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
        $detalles = Producto::where([['PRO_ID', '=' , $data['idproducto']]])
                                ->get();


        $destacados = Productos::where([['PRO_DESTACADO', '=' , 1],['PRO_ESTADO', '=' , 1]])
        ->orderBy('PRO_NOMBRE', 'asc')
        ->get();

        $cotizacion = Cotizaciones::insert([
                    'fecha' => date("Y-m-d"),
                    'cliente' => $data['nombre'],
                    'empresa' => $data['nombre'],
                    'ciudad' => $data['ciudad'],
                    'telefono' => $data['telefono'],
                    'email' => $data['email'],
                    'comentarios' => $data['comentarios'],
                    'producto' => $data['producto'],
                    'codigo' => $data['idproducto']

        ]);

        if($cotizacion){
            return view('producto.mensaje',compact('categorias','subcategorias','empresa','footer','detalles'))->with('Mensaje', 'Cotización generada exitosamente.');
        }else{
            return view('producto.mensaje',compact('categorias','subcategorias','empresa','footer','detalles'))->with('Mensaje', 'Ocurrio un error, por favor intente nuevamente.');
        }


    }






}
