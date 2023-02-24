<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'ebooks';
    public $timestamps = false;


    public static function getAllBooks(){
        return Libro::all();
    }
}
