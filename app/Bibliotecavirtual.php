<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bibliotecavirtual extends Model
{
    protected $table ="bibliotecavirtual";
    public static function getAllConfig(){
        return Bibliotecavirtual::all();
    }
}
