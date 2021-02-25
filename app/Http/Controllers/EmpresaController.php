<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenidos;
use App\Models\Productos;
use App\Models\ProductosCategorias;

class EmpresaController extends Controller
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

        $empresa =  Contenidos:: where([['CON_CODIGO', '=' , 'txt_empresa']])
                            ->first();

        $footer =  Contenidos:: where([['CON_CODIGO', '=' , 'pie']])
        ->first();


        return view('empresa.index',compact('categorias','subcategorias','destacados','empresa','footer'));

    }
}
