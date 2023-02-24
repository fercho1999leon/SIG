<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'authors';
    public $timestamps = false;

    public static function getAllAuthors(){
        return Autor::all();
    }
}
