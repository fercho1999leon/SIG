<?php
use Illuminate\Database\Seeder;
use App\Course;
use App\Supply;
use App\Matter;
use App\Parameters\General;
use App\Activity;
use Carbon\Carbon;
use App\Area;
use App\PeriodoLectivo;
use Illuminate\Support\Facades\DB;

class PruebasEnMateriasSeeder extends Seeder
{
    public function run()
    {
       // $idPeriodo = PeriodoLectivo::where('nombre', '2019-2020')->first()->id; //periodo lectivo especifico
        $idPeriodo = PeriodoLectivo::where('nombre', '2020-2021')->first()->id; //periodo lectivo especifico
        
        // Educacion Inicial AREAS
        $areast = Area::where('seccion','EI')->where('idPeriodo',$idPeriodo)->get();
        $areas = array('DESARROLLO PERSONAL Y SOCIAL','DESCUBRIMIENTO DE MEDIO NATURAL Y CULTURAL','EXPRESION Y COMUNICACION');
        foreach ($areas as $value) {
            $valid = $areast->where('nombre',$value);
            if ($valid->isEmpty()){
                DB::table('areas')->insert(array(
                    'nombre' => $value,
                    'seccion'   =>  'EI',
                    'observacion'  => '',
                    'idPeriodo'  =>  $idPeriodo,
                    'especializacion' => ''
                ));
            }
        }
        // Bachillerato General Unificado y Educacion General Basica --AREAS
        $areast = Area::whereIn('seccion',['BGU','EGB'])->where('idPeriodo',$idPeriodo)->get();
        $seccion = array('BGU', 'EGB');
        foreach ($seccion as $valuesecc) {
            if ($valuesecc=="BGU"){
                $areas = array('LENGUA Y LITERATURA', 'LENGUA EXTRANJERA', 'MATEMATICA', 'CIENCIAS NATURALES',
                    'CIENCIAS SOCIALES','EDUCACION FISICA','EDUCACION CULTURAL Y ARTISTICA','INTERDISCIPLINAR','DESARROLLO HUMANO INTEGRAL');
            }else if ($valuesecc=="EGB"){
                $areas = array('DESARROLLO PERSONAL Y SOCIAL','DESCUBRIMIENTO DE MEDIO NATURAL Y CULTURAL',
                    'EXPRESION Y COMUNICACION', 'LENGUA Y LITERATURA', 'LENGUA EXTRANJERA', 'MATEMATICA', 'CIENCIAS NATURALES',
                    'CIENCIAS SOCIALES', 'EDUCACION FISICA', 'EDUCACION CULTURAL Y ARTISTICA', 'DESARROLLO HUMANO INTEGRAL');
            }
            foreach ($areas as $value) {
                $valid = $areast->where('nombre',$value);
                if ($valid->isEmpty()){
                    DB::table('areas')->insert(array(
                        'nombre' => $value,
                        'seccion'   =>  $valuesecc,
                        'observacion'  => '',
                        'idPeriodo'  =>  $idPeriodo,
                        'especializacion' => ''
                    ));
                }
            }
        }
        // Educacion Inicial MATERIAS
        $coursesI = Course::where('seccion','EI')->where('idPeriodo', $idPeriodo)->get();
        foreach ($coursesI as $valuecourse) {
            if ($valuecourse->grado=="Inicial 1"){
                $matters = array('VINCULACION EMOCIONAL Y SOCIAL','DESCUBRIMIENTO DEL MEDIO NATURAL Y CULTURAL',
                    'MANIFESTACION DEL LENGUAJE VERBAL Y NO VERBAL','EXPLORACION DEL CUERPO Y MOTRICIDAD');
            }else{
                $matters = array('IDENTIDAD Y AUTONOMIA','CONVIVENCIA','RELACIONES CON EL MEDIO NATURAL Y CULTURAL',
                    'RELACIONES LOGICO/MATEMATICAS','COMPRESION Y EXPRESION DEL LENGUAJE','EXPRESION ARTISTICA',
                    'EXPRESION CORPORAL Y MOTRICIDAD');
            }
            $materiasEi = Matter::where('idCurso',$valuecourse->id)->where('idPeriodo', $idPeriodo)->get();
            foreach ($matters as $value) {
                $valid = $materiasEi->where('nombre',$value);
                if ($valid->isEmpty()){
                    if ($value == "VINCULACION EMOCIONAL Y SOCIAL" || $value == "IDENTIDAD Y AUTONOMIA" || $value == "CONVIVENCIA"){
                        $nombrearea = "DESARROLLO PERSONAL Y SOCIAL";
                    }else if ($value=="DESCUBRIMIENTO DEL MEDIO NATURAL Y CULTURAL" || $value=="RELACIONES CON EL MEDIO NATURAL Y CULTURAL" || $value=="RELACIONES LOGICO/MATEMATICAS"){
                        $nombrearea="DESCUBRIMIENTO DE MEDIO NATURAL Y CULTURAL";
                    }else if ($value == "MANIFESTACION DEL LENGUAJE VERBAL Y NO VERBAL" || $value == "EXPLORACION DEL CUERPO Y MOTRICIDAD" || $value == "COMPRESION Y EXPRESION DEL LENGUAJE" || $value == "EXPRESION ARTISTICA" || $value == "EXPRESION CORPORAL Y MOTRICIDAD"){
                        $nombrearea="EXPRESION Y COMUNICACION";
                    }
                    $idArea = Area::where('nombre',$nombrearea)->where('idPeriodo',$idPeriodo)->first();
                    $m = DB::table('matters')->insertGetId(array(
                        'nombre' => $value,
                        'idCurso'   =>  $valuecourse->id,
                        'visible'   =>  ($value == "DESARROLLO HUMANO INTEGRAL") ? false : true,
                        'principal'   =>  ($value == "DESARROLLO HUMANO INTEGRAL") ? false : true,
                        'idArea'   =>  $idArea->id,
                        'area'    =>  $nombrearea,
                        'idPeriodo' =>   $idPeriodo
                    ));
                    $matter = Matter::find($m);
                    $supplies = General::$supplies;
                    foreach ($supplies as $key2) {
                        Supply::create([
                            'nombre'    =>  $key2,
                            'idCurso'   =>  $valuecourse->id,
                            'idPeriodo' =>   $idPeriodo,
                            'idMateria' =>  $matter->id,
                            'es_aporte' => ($key2 == 'EVALUACION') ? true : false 
                        ]);
                    }
                    $supply = new Supply();
                    $supply->nombre = "RECUPERATORIO";
                    $supply->idCurso = $matter->idCurso;
                    $supply->idMateria = $matter->id;
                    $supply->idDocente = $matter->idDocente;
                    $supply->idPeriodo = $idPeriodo;
                    $supply->save();                
    
                    $activity = new Activity();
                    $activity->nombre = "RECUPERACION";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "q1";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "RECUPERACION";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "q2";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "SUPLETORIO";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "supletorio";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "REMEDIAL";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "remedial";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "GRACIA";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "gracia";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $supply = new Supply();
                    $supply->nombre = "EXAMEN QUIMESTRAL";
                    $supply->idCurso = $matter->idCurso;
                    $supply->idMateria = $matter->id;
                    $supply->idDocente = $matter->idDocente;
                    $supply->idPeriodo =   $idPeriodo;
                    $supply->save();   

                    $activity = new Activity();
                    $activity->nombre = "EXAMEN QUIMESTRAL";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now()->format('Y-m-d');
                    $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "q1";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "EXAMEN QUIMESTRAL";
                    $activity->descripcion = "";
                    $activity->idInsumo = $supply->id;
                    $activity->fechaInicio = Carbon::now()->format('Y-m-d');
                    $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "q2";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();
                }
            }
        }
        // BACHILLERATO--MATERIAS
        $matters = array('LENGUA Y LITERATURA','INGLES','MATEMATICA','BIOLOGIA','FISICA','QUIMICA','HISTORIA','FILOSOFIA',
            'EDUCACION PARA LA CIUDADANIA','EDUCACION FISICA','EDUCACION CULTURAL Y ARTISTICA','EMPRENDIMIENTO Y GESTION','DESARROLLO HUMANO INTEGRAL');
        $coursesB = Course::where('seccion','BGU')->where('idPeriodo', $idPeriodo)->get();
        foreach ($coursesB as $valuecourse) {
            $materiasBGU = Matter::where('idCurso',$valuecourse->id)->where('idPeriodo', $idPeriodo)->get();
            foreach ($matters as $value) {
                $valid = $materiasBGU->where('nombre',$value);
                if ($valid->isEmpty()){
                    if($value == "INGLES"){
                        $nombrearea="LENGUA EXTRANJERA";
                    }elseif($value == "BIOLOGIA" || $value == "FISICA" || $value == "QUIMICA"){
                        $nombrearea="CIENCIAS NATURALES";
                    }elseif($value == "HISTORIA" || $value == "FILOSOFIA" || $value == "EDUCACION PARA LA CIUDADANIA"){
                        $nombrearea="CIENCIAS SOCIALES";
                    }elseif($value == "EMPRENDIMIENTO Y GESTION"){
                        $nombrearea="INTERDISCIPLINAR";
                    }else{
                        $nombrearea=$value;
                    }
                    $idArea = Area::where('nombre',$nombrearea)->where('idPeriodo',$idPeriodo)->first();
                    $m =  DB::table('matters')->insertGetId(array(
                        'nombre' => $value,
                        'idCurso'   =>  $valuecourse->id,
                        'visible'   =>  ($value == "DESARROLLO HUMANO INTEGRAL") ? false : true,
                        'principal'   =>  ($value == "DESARROLLO HUMANO INTEGRAL") ? false : true,
                        'idPeriodo' =>  $idPeriodo,
                        'idArea'   =>  $idArea->id,
                        'area'   =>  $nombrearea
                    ));
                    $matter = Matter::find($m);
                    $supplies = General::$supplies;
                    foreach ($supplies as $key2) {
                        Supply::create([
                            'nombre'    =>  $key2,
                            'idCurso'   =>  $valuecourse->id,
                            'idMateria' =>  $matter->id,
                            'idPeriodo' => $idPeriodo,
                            'es_aporte' => ($key2 == 'EVALUACION') ? true : false
                        ]);
                    }

                    $supply = new Supply();
                    $supply->nombre = "RECUPERATORIO";
                    $supply->idCurso = $matter->idCurso;
                    $supply->idMateria = $matter->id;
                    $supply->idPeriodo = $idPeriodo;
                    $supply->idDocente = $matter->idDocente;
                    $supply->save();                
                    
                    $activity = new Activity();
                    $activity->nombre = "RECUPERACION";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "q1";
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "RECUPERACION";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "q2";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "SUPLETORIO";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "supletorio";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "REMEDIAL";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "remedial";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "GRACIA";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "gracia";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $supply = new Supply();
                    $supply->nombre = "EXAMEN QUIMESTRAL";
                    $supply->idCurso = $matter->idCurso;
                    $supply->idMateria = $matter->id;
                    $supply->idPeriodo =   $idPeriodo;
                    $supply->idDocente = $matter->idDocente;
                    $supply->save();   

                    $activity = new Activity();
                    $activity->nombre = "EXAMEN QUIMESTRAL";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now()->format('Y-m-d');
                    $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "q1";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "EXAMEN QUIMESTRAL";
                    $activity->descripcion = "";
                    $activity->idInsumo = $supply->id;
                    $activity->fechaInicio = Carbon::now()->format('Y-m-d');
                    $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
                    $activity->parcial = "q2";
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();
                }
            }
        }

        //1ro a 10mo --MATERIAS
        $coursesE = Course::where('seccion','EGB')->where('idPeriodo', $idPeriodo)->get();
        foreach ($coursesE as $valuecourse){
            if ($valuecourse->grado != 'Primero'){
                $matters = array('LENGUA Y LITERATURA','INGLES','MATEMATICA','CIENCIAS NATURALES','ESTUDIOS SOCIALES','EDUCACION FISICA',
                    'EDUCACION CULTURAL Y ARTISTICA','DESARROLLO HUMANO INTEGRAL');
            }else{
                $matters = array('IDENTIDAD Y AUTONOMIA','CONVIVENCIA','DESCUBRIMIENTO Y COMPRENSION DEL MEDIO NATURAL Y CULTURAL',
                    'RELACIONES LOGICO/MATEMATICAS','COMPRESION Y EXPRESION ORAL Y ESCRITA', 'COMPRENSION Y EXPRESION ARTISTICA',
                    'EXPRESION CORPORAL','DESARROLLO HUMANO INTEGRAL');
            }
            $materiasEGB = Matter::where('idCurso',$valuecourse->id)->where('idPeriodo', $idPeriodo)->get();
            foreach ($matters as $value){
                $valid = $materiasEGB->where('nombre',$value);
                if ($valid->isEmpty()){
                    if ($value == "IDENTIDAD Y AUTONOMIA" || $value == "CONVIVENCIA"){
                        $nombrearea="DESARROLLO PERSONAL Y SOCIAL";
                    }elseif($value == "DESCUBRIMIENTO Y COMPRENSION DEL MEDIO NATURAL Y CULTURAL" || $value == "RELACIONES LOGICO/MATEMATICAS"){
                        $nombrearea="DESCUBRIMIENTO DE MEDIO NATURAL Y CULTURAL";
                    }elseif($value == "EXPRESION CORPORAL" || $value == "COMPRESION Y EXPRESION ORAL Y ESCRITA" || $value == "COMPRENSION Y EXPRESION ARTISTICA"){
                        $nombrearea="EXPRESION Y COMUNICACION";
                    }elseif($value == "INGLES"){
                        $nombrearea="LENGUA EXTRANJERA";
                    }elseif($value == "ESTUDIOS SOCIALES"){
                        $nombrearea="CIENCIAS SOCIALES";
                    }elseif($value == "DESARROLLO HUMANO INTEGRAL"){
                        $nombrearea="DESARROLLO HUMANO INTEGRAL";
                    }else{
                        $nombrearea=$value;
                    }
                    $idArea = Area::where('nombre',$nombrearea)->where('idPeriodo',$idPeriodo)->first();
                    $m = DB::table('matters')->insertGetId(array(
                        'nombre' => $value,
                        'idCurso'   =>  $valuecourse->id,
                        'visible'   =>  ($value == "DESARROLLO HUMANO INTEGRAL") ? false : true,
                        'principal'   =>  ($value == "DESARROLLO HUMANO INTEGRAL") ? false : true,
                        'idArea'   =>  $idArea->id,
                        'idPeriodo' =>  $idPeriodo,
                        'area'    =>  $nombrearea
                        ));
                    $matter = Matter::find($m);
                    $supplies = General::$supplies;
                    foreach ($supplies as $key2) {
                        Supply::create([
                            'nombre'    =>  $key2,
                            'idCurso'   =>  $valuecourse->id,
                            'idMateria' =>  $matter->id,
                            'idPeriodo' =>  $idPeriodo,
                            'es_aporte' =>  ($key2 == 'EVALUACION') ? true : false
                        ]);
                    }
                    
                    $supply = new Supply();
                    $supply->nombre = "RECUPERATORIO";
                    $supply->idCurso = $matter->idCurso;
                    $supply->idMateria = $matter->id;
                    $supply->idDocente = $matter->idDocente;
                    $supply->idPeriodo = $idPeriodo;
                    $supply->save();  

                    $activity = new Activity();
                    $activity->nombre = "RECUPERACION";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "q1";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "RECUPERACION";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->idInsumo = $supply->id;
                    $activity->parcial = "q2";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "SUPLETORIO";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "supletorio";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "REMEDIAL";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "remedial";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "GRACIA";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now();
                    $activity->fechaEntrega = Carbon::now();
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "gracia";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();
                    
                    $supply = new Supply();
                    $supply->nombre = "EXAMEN QUIMESTRAL";
                    $supply->idCurso = $matter->idCurso;
                    $supply->idMateria = $matter->id;
                    $supply->idPeriodo =   $idPeriodo;
                    $supply->idDocente = $matter->idDocente;
                    $supply->save();  

                    $activity = new Activity();
                    $activity->nombre = "EXAMEN QUIMESTRAL";
                    $activity->descripcion = "";
                    $activity->fechaInicio = Carbon::now()->format('Y-m-d');
                    $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
                    $activity->idInsumo = $supply->id;
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->parcial = "q1";
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();

                    $activity = new Activity();
                    $activity->nombre = "EXAMEN QUIMESTRAL";
                    $activity->descripcion = "";
                    $activity->idInsumo = $supply->id;
                    $activity->fechaInicio = Carbon::now()->format('Y-m-d');
                    $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
                    $activity->parcial = "q2";
                    $activity->idPeriodo =   $idPeriodo;
                    $activity->calificado = 1;
                    $activity->refuerzo = 0;
                    $activity->save();
                }
            }
        }
    }
}