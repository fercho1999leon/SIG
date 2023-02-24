<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpVincColectiva extends Model
{
    use SoftDeletes;

    public $table = 'exp_vinc_colectivas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tipo_experiencia',
        'programa_proyecto',
        'duracion',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}