<?php

namespace App;

use App\Supply;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'adjuntos',
        'fechaInicio', 
        'fechaEntrega',
        'idInsumo',
        'calificado',
        'recibirTareas',
        'idPeriodo'
    ];

    public function supply()
    {
        return $this->belongsTo('App\Supply', 'idInsumo');
    }

    public function deberes()
    {
        return $this->hasMany(Deber::class, 'idActividad');
    }


    public function insumo()
    {
        return $this->belongsTo('App\Supply', 'idInsumo');
    }

    public function califications()
    {
        return $this->hasMany('App\Calificacion', 'idActividad');
    }

    public static function getRefuerzo($matterId, $parcial)
    {

        $insumos = Supply::where('idMateria', $matterId)->get();
        $activities = Activity::whereIn('idInsumo', $insumos->pluck('id'))->where(['parcial' => $parcial, 'refuerzo' => 1])->get();

        return $activities;
    }
}
