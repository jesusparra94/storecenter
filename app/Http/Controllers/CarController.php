<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Producto;
use App\Models\ProductosCategorias;
use App\Models\Contenidos;

class CarController extends Controller
{
    //

    public function add2($id){

        //\Session::forget('car');

        if(!\Session::has('car')) \Session::put('car', array());
        $car = \Session::get('car');
        //return count(\Session::get('car'));
        if(count(\Session::get('car'))>0){
            $igual = 0;
            foreach ($car as $key => $value) {
                if($value['PRO_ID']==$id){
                    $igual = 1;
                }
            }
            //return $igual;
            //return $car[$id];
            if($igual){

                $cant = $car[$id]->cantidadcompra + 1;
                $car[$id]->cantidadcompra = $cant;
            }else{

                $producto = Producto::where("PRO_ID","=",$id)->first();

                $car = \Session::get('car');
                $producto->cantidadcompra = 1;
                $car[$id] = $producto;

                \Session::put('car',$car);
            }
        }else{
            $producto = Producto::where("PRO_ID","=",$id)->first();

               // $car = \Session::get('car');
                $producto->cantidadcompra = 1;
                $car[$id] = $producto;

                \Session::put('car',$car);
        }




        return  \Session::get('car');






        //if(!\Session::has('car')) \Session::put('car', array());
        //$producto = Producto::where("PRO_ID","=",$id)->first();
        //guardar en id del producto los datos

        //unset($car[$id]);
        //\Session::forget('car');

        //\Session::push('car', ['item5'=>15]);
        $car = \Session::get('car');
        $total = count($car);

        foreach ($car as $clave => $item){
            return $item;
        }

        return $total;

       /*
        $total = count($car);
        if($total>0){
            foreach($car['idproducto'] as $i){
                if($i['idproducto']==$id){
                    $data = array(
                        'idproducto' => $id,
                        'cantidad' => $i['cantidad']+1
                    );
                    \Session::put('car', $data);
                    return "Ya existe";
                }else{
                    $data = array(
                        'idproducto' => $id,
                        'cantidad' => 1
                    );
                    \Session::push('car', $data);
                    return "Agregado";
                }
            }
        }else{
            \Session::push('car', array(
                'idproducto' => $id,
                'cantidad' => 1

            ));
            return "Agregado";
        }
*/


        //return $car;
        if($car['idproducto']==$id){
            \Session::put('car', array(
                'idproducto' => $id,
                'cantidad' => $car['cantidad']+1

            ));
        }else{

            \Session::push('car', array(
                'idproducto' => $id,
                'cantidad' => 1

            ));
            return "no existe";
        }
        return $car;
        \Session::push('car', array(
            $id => 1
        ));

        if(isset($car[$id])){
            $data = array(
                $id => $car[$id]+1
            );
            \Session::put('car', $data);
        }else{
            $data = array(
                $id =>1
            );
            \Session::push('car', $data);
        }


        //\Session::put('car', $data);
        return $car;


        //unset($car[$data->id]);
        $idproducto = $id;
        $cant = 1;
        //$data = Arr::add(['id' => $idproducto], 'cant', $cant);
        $data = array(
            "id" => $idproducto,
            "cant" => $cant,
        );
        \Session::put('car', $data);
        $car = \Session::get('car');
        return $car[$idproducto];
        //$producto = Producto::where("PRO_ID","=",$id)->first();
        \Session::put('car', 1);
        if($car = \Session::get('car')){
            return $car;
        }else{
            \Session::put('car', 1);
            return "NO EXISTE";
        }



        $producto = Producto::where("PRO_ID","=",$id)->first();

        $car[$productos->id] = $productos;

        \Session::put('car', $car);


        //return \Session::get('car');


     }

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
}
