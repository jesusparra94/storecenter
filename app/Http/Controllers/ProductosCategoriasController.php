<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductosCategorias;
use App\Models\Productos;
use App\Models\Novedades;
use App\Models\Slider;
use App\Models\Contenidos;

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


        return view('inicio.inicio',compact('categorias','subcategorias','destacados','novedades','sliders','footer'));

    }
}
