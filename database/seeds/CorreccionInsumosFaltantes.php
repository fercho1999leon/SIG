<?php
use Illuminate\Database\Seeder;
use App\PeriodoLectivo;
use App\Course;
use App\Matter;
use App\Student2Profile;
use App\Student2;
use App\Calificacion;
use App\Supply;
use App\Activity;

class CorreccionInsumosFaltantes extends Seeder{
    public function run(){
        $c=0;
        $periodo = PeriodoLectivo::whereNombre('2020-2021')->first();
        $cursos =  Course::where('idPeriodo',$periodo->id)->get();
        foreach ($cursos as $curso) {
            $materias = Matter::where('idCurso', $curso->id)->get();
            foreach ($materias as $materia) {

                $insumos = Supply::where('idMateria', $materia->id)->get();
                $insumosR = Supply::where('idMateria', 192)->get();
                if (count($insumos) != count($insumosR)){
                    $c++;
                    $insumosEx = $insumos->where('nombre', "EXAMEN QUIMESTRAL")->first();
                    $insumosRe = $insumos->where('nombre', "RECUPERATORIO")->first();
                    if ($insumosEx == null){
                        $ins = new Supply();
                        $ins->nombre = "EXAMEN QUIMESTRAL";
                        $ins->idCurso = $curso->id;
                        $ins->idMateria = $materia->id;
                        $ins->idDocente = $materia->idDocente;
                        $ins->created_at = "2019-11-27 10:42:19";
                        $ins->updated_at = "2019-11-27 10:42:19";
                        $ins->idPeriodo = $periodo->id;
                        $ins->save();

                        $activity = new Activity();
                        $activity->nombre = "EXAMEN QUIMESTRAL";
                        $activity->descripcion = "";
                        $activity->fechaInicio = "2019-11-27";
                        $activity->fechaEntrega = "2019-11-27";
                        $activity->idPeriodo =   $periodo->id;
                        $activity->idInsumo = $ins->id;
                        $activity->parcial = "q1";
                        $activity->calificado = 1;
                        $activity->refuerzo = 0;
                        $activity->save();

                        $activity = new Activity();
                        $activity->nombre = "EXAMEN QUIMESTRAL";
                        $activity->descripcion = "";
                        $activity->idInsumo = $ins->id;
                        $activity->fechaInicio = "2019-11-27";
                        $activity->fechaEntrega = "2019-11-27";
                        $activity->idPeriodo = $periodo->id;
                        $activity->parcial = "q2";
                        $activity->calificado = 1;
                        $activity->refuerzo = 0;
                        $activity->save();
                    }
                    if ($insumosRe == null){
                        $ins = new Supply();
                        $ins->nombre = "RECUPERATORIO";
                        $ins->idCurso = $curso->id;
                        $ins->idMateria = $materia->id;
                        $ins->idDocente = $materia->idDocente;
                        $ins->created_at = "2019-11-27 10:42:19";
                        $ins->updated_at = "2019-11-27 10:42:19";
                        $ins->idPeriodo = $periodo->id;
                        $ins->save();
                        
                        $activity = new Activity();
                        $activity->nombre = "RECUPERACION";
                        $activity->descripcion = "";
                        $activity->fechaInicio = "2019-11-27";
                        $activity->idPeriodo =   $periodo->id;
                        $activity->fechaEntrega = "2019-11-27";
                        $activity->idInsumo = $ins->id;
                        $activity->parcial = "q1";
                        $activity->calificado = 1;
                        $activity->refuerzo = 0;
                        $activity->save();

                        $activity = new Activity();
                        $activity->nombre = "RECUPERACION";
                        $activity->descripcion = "";
                        $activity->fechaInicio = "2019-11-27";
                        $activity->fechaEntrega = "2019-11-27";
                        $activity->idPeriodo = $periodo->id;
                        $activity->idInsumo = $ins->id;
                        $activity->parcial = "q2";
                        $activity->calificado = 1;
                        $activity->refuerzo = 0;
                        $activity->save();

                        $activity = new Activity();
                        $activity->nombre = "SUPLETORIO";
                        $activity->descripcion = "";
                        $activity->fechaInicio = "2019-11-27";
                        $activity->fechaEntrega = "2019-11-27";
                        $activity->idPeriodo = $periodo->id;
                        $activity->idInsumo = $ins->id;
                        $activity->parcial = "supletorio";
                        $activity->calificado = 1;
                        $activity->refuerzo = 0;
                        $activity->save();

                        $activity = new Activity();
                        $activity->nombre = "REMEDIAL";
                        $activity->descripcion = "";
                        $activity->fechaInicio = "2019-11-27";
                        $activity->fechaEntrega = "2019-11-27";
                        $activity->idPeriodo = $periodo->id;
                        $activity->idInsumo = $ins->id;
                        $activity->parcial = "remedial";
                        $activity->calificado = 1;
                        $activity->refuerzo = 0;
                        $activity->save();

                        $activity = new Activity();
                        $activity->nombre = "GRACIA";
                        $activity->descripcion = "";
                        $activity->fechaInicio = "2019-11-27";
                        $activity->fechaEntrega = "2019-11-27";
                        $activity->idPeriodo = $periodo->id;
                        $activity->idInsumo = $ins->id;
                        $activity->parcial = "gracia";
                        $activity->calificado = 1;
                        $activity->refuerzo = 0;
                        $activity->save();
                    }
                }
            }
        }
        echo $c;
    }
}