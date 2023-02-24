<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use SoftDeletes;

    public $table = 'eventos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'lugar',
        'fecha_publicacion',
        'url',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}