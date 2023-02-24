<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TituloPosgrado extends Model
{
    use SoftDeletes;

    public $table = 'titulo_posgrados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'codigo_senescyt',
        'universidad',
        'pais',
        'ano',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}