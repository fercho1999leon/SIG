<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificacione extends Model
{
    use SoftDeletes;

    public $table = 'certificaciones';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'registro_setec',
        'institucion_certificadora',
        'pais',
        'ano',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}