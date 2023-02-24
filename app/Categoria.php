<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
     protected $table = 'categories';
    public $timestamps = false;

    public static function getAllCategories(){
        return Categoria::all();
    }
}
