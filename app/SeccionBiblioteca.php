<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionBiblioteca extends Model
{
    protected $table ="seccion_biblioteca";
    public static function getAllConfig(){
        return SeccionBiblioteca::all();
    }
}
