<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    protected $table = 'contenido';
    public $timestamps = false;

    public static function getContenidosByUnidad($unidad_id)
    {
        return Contenido::all();
    }
}
