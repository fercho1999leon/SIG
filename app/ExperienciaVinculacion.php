<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienciaVinculacion extends Model
{
    use SoftDeletes;

    public $table = 'experiencia_vinculacions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tipo_experiencia',
        'programa',
        'duracion',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}