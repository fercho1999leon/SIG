<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activity;
use App\Course;
use DB;
class Supply extends Model
{
    //
     protected $table = 'supplies';
     protected $fillable = ['nombre', 'idDocente','idMateria','idCurso', 'es_aporte', 'idPeriodo','porcentaje'];

    public function activities(){
       return $this->hasMany('App\Activity','idInsumo')->where('calificado', 1);
    }
	public function materia() {
		return $this->belongsTo('App\Matter', 'idMateria');
	}
    public function calificaciones(){
        return$this->hasMany('App\Calificacion','idInsumo');
    }

    public static function getSuppliesOrdered($idCurso){
        $orden_insumos = ConfiguracionSistema::orderInsumos();
        if($orden_insumos->valor != ''){
            return $insumos = Supply::getSuppliesNamesOrder($orden_insumos->valor, $idCurso);
        }else{
            return $insumos = Supply::getSuppliesNames($idCurso);
        }
    }

    public static function getSuppliesNamesOrder($orden, $idCurso){
        return Supply::getSuppliesByCourse($idCurso)->where([
            ['nombre', '!=', 'EXAMEN QUIMESTRAL'],
            ['nombre', '!=', 'RECUPERATORIO']
        ])->select('nombre','porcentaje')->groupBy('nombre')->orderByRaw("FIELD(nombre,".$orden.")")->get();
    }

    public static function getSuppliesOrder($orden){

    return Supply::where([
            ['nombre', '!=', 'EXAMEN QUIMESTRAL'],
            ['nombre', '!=', 'RECUPERATORIO']
        ])->select('nombre','porcentaje')->groupBy('nombre')->orderByRaw("FIELD(nombre,".$orden.")")->get();
    }

    public static function getSuppliesNames($idCurso){
        return Supply::getSuppliesByCourse($idCurso)->where([
            ['nombre', '!=', 'EXAMEN QUIMESTRAL'],
            ['nombre', '!=', 'RECUPERATORIO']
        ])->select('nombre','id','porcentaje')->groupBy('nombre')->get();
    }

    public static function getSuppliesNombres(){
        return Supply::where([
            ['nombre', '!=', 'EXAMEN QUIMESTRAL'],
            ['nombre', '!=', 'RECUPERATORIO']
        ])->select('nombre')->groupBy('nombre')->get();
    }
    public static function getSuppliesByCourse($idCurso){
        $materias = Matter::where('idCurso', $idCurso)->pluck('id')->toArray();
        return Supply::whereIn('idMateria', $materias);
    }
    public static function getSuppliesByMatter($idMatter){
        return Supply::where('idMateria', $idMatter)->where('nombre', '!=', 'RECUPERATORIO')
        ->where('nombre', '!=', 'ENSAYO')->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();
    }
    public static function getSuppliesBySeccion($seccion){
        $cursos = Course::getCourse($seccion)->pluck('id');
        $materias = Matter::whereIn('idCurso', $cursos)->pluck('id')->toArray();
        return Supply::whereIn('idMateria', $materias)->where('nombre', '!=', 'RECUPERATORIO')
        ->where('nombre', '!=', 'ENSAYO')->where('nombre', '!=', 'EXAMEN QUIMESTRAL');

    }
}
