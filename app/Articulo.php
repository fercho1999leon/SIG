<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends Model
{
    use SoftDeletes;

    public $table = 'articulos';

    protected $dates = [
        'fecha_publicacion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titulo',
        'nombre_revista',
        'codigo_issn',
        'volumen',
        'fecha_publicacion',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getFechaPublicacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaPublicacionAttribute($value)
    {
        $this->attributes['fecha_publicacion'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}