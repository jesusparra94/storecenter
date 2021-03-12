<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Car;
use App\Models\Producto;
use App\Models\Pedidos;
use App\Models\ProductosCategorias;
use App\Models\PedidosProductos;
use App\Models\Contenidos;
use App\Models\Clientes;
use App\Models\Comunas;
use App\Mail\CotizacionCarrito;

class CarController extends Controller
{

    public function add(Request $request){

        $data = request();
        $id = $data->id;
        $cantidadp = $data->cantidadp;
        if(!\Session::has('car')) \Session::put('car', array());
            $car = \Session::get('car');
            if(count(\Session::get('car'))>0){
                $igual = 0;
                foreach ($car as $key => $value) {
                    if($value['PRO_ID']==$id){
                        $igual = 1;
                    }
                }

                if($igual){
                    $cant = $car[$id]->cantidadcompra + $cantidadp;
                    $car[$id]->cantidadcompra = $cant;
                }else{
                    $producto = Producto::where("PRO_ID","=",$id)->first();
                    $car = \Session::get('car');
                    $producto->cantidadcompra = $cantidadp;
                    $car[$id] = $producto;

                    \Session::put('car',$car);
                }
            }else{
                $producto = Producto::where("PRO_ID","=",$id)->first();
                $producto->cantidadcompra = $cantidadp;
                $car[$id] = $producto;

                \Session::put('car',$car);
            }
            $producto = \Session::get('car');
            return  $producto[$id]->cantidadcompra;


     }

    public function carrito(){

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

        return view('carrito.index',compact('categorias','subcategorias','footer'));
    }

    public function limpiarcar(){

        \Session::forget('car');
        return "ok";

     }

    public function generarpdf(){
        $pdf = \PDF::loadView('carrito.pdf');
        return $pdf->download('cotizacion.pdf');
    }

    public function deleteproducto(Request $request){

        $data = request();
        $id = $data->id;


        $car = \Session::get('car');

        unset($car[$id]);

        \Session::put('car', $car);

        return "ok";
    }

    public function insert(){
        $car = \Session::get('car');
        $id = \Session::get('id');
        $cliente = Clientes::where('vip_id','=',$id)
                    ->select('vip_nombre', 'vip_rut', 'vip_mail', 'vip_fono_contacto', 'vip_direccion', 'vip_comuna', 'vip_ciudad', 'vip_giro')
                    ->get();
        $comuna = Comunas::where('com_id','=',$cliente[0]->vip_comuna)
                    ->select('com_nombre')
                    ->get();


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
        $totalsiniva = 0;

        foreach ($car as $key => $value) {
            $totalsiniva = $totalsiniva + (($value->PRO_PRECIO)*($value->cantidadcompra));
        }

        $pedido = Pedidos::insert([
                    'PED_NOMBRE' => $cliente[0]->vip_nombre,
                    'PED_CORREO' => $cliente[0]->vip_mail,
                    'PED_FONO' => $cliente[0]->vip_fono_contacto,
                    'PED_FECHA' => date("Y-m-d"),
                    'PED_COMENTARIOS' => '',
                    'PED_DIRECCION' =>$cliente[0]->vip_direccion,
                    'PED_TOTAL' =>$totalsiniva,
                    'PED_USUARIO' => $id,
        ]);

        $idPedido = Pedidos::orderBy('PED_ID', 'desc')
                    ->first();
        $idp = $idPedido['PED_ID'];

        foreach ($car as $key => $value) {
            PedidosProductos::insert([
                'PED_ID' => $idp,
                'PRO_ID' => $value['PRO_ID'],
                'PP_CANTIDAD' => $value['cantidadcompra'],
                'PP_PRECIO' =>$value['cantidadcompra']*$value['PRO_PRECIO']
            ]);
        }
        $lastpedido = Pedidos::select('PED_ID')
                    ->orderByDesc('PEDIDOS.PED_FECHA')
                    ->limit(1)
                    ->get();
        //return $lastpedido;

        if($pedido){
            $carrito = $car;
            $idpedido = $lastpedido[0]->PED_ID;
            $nombre = $cliente[0]->vip_nombre;
            $rut = $cliente[0]->vip_rut;
            $giro = $cliente[0]->vip_giro;
            $email = $cliente[0]->vip_mail;
            $direccion = $cliente[0]->vip_direccion;
            $comuna = $cliente[0]->vip_comuna;
            $ciudad = $cliente[0]->vip_ciudad;
            $telefono = $cliente[0]->vip_fono_contacto;
            $mail = Mail::to('jdparrau@gmail.com')->send(new CotizacionCarrito($carrito,$idpedido,$nombre,$rut,$giro,$email,$direccion,$comuna,$ciudad,$telefono,$totalsiniva,'cliente'));
            $mail = Mail::to('jdparrau@gmail.com')->send(new CotizacionCarrito($carrito,$idpedido,$nombre,$rut,$giro,$email,$direccion,$comuna,$ciudad,$telefono,$totalsiniva,'jefe'));
            return redirect('/pedido-generado/');
            //return view('cotizaciones.mensaje',compact('categorias','subcategorias','empresa','footer','detalles'))->with('Mensaje', 'Cotización generada exitosamente.');

        }

    }

    public function pedidogenerado(){
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
        return view('carrito.mensaje',compact('categorias','subcategorias','empresa','footer'))->with('Mensaje', 'Pedido generado exitosamente.');
    }
}
