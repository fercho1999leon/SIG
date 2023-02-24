<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienciaProfesional extends Model
{
    use SoftDeletes;

    public $table = 'experiencia_profesionals';

    protected $dates = [
        'desde',
        'hasta',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'empresa_institucion',
        'cargo',
        'desde',
        'hasta',
        'usuario',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDesdeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDesdeAttribute($value)
    {
        $this->attributes['desde'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHastaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHastaAttribute($value)
    {
        $this->attributes['hasta'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}