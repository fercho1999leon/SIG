<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seminario extends Model
{
    use SoftDeletes;

    public $table = 'seminarios';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'institucion',
        'pais',
        'ano',
        'numero_horas',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}