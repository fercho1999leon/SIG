<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicacionLibro extends Model
{
    use SoftDeletes;

    public $table = 'publicacion_libros';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titulo',
        'filiacion',
        'codigo_issn',
        'volumen',
        'fecha_publicacion',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}