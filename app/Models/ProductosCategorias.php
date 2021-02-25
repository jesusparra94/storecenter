<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosCategorias extends Model
{
    use HasFactory;

    protected $table = 'PRODUCTOS_CATEGORIAS';

    public $timestamps = false;
}
