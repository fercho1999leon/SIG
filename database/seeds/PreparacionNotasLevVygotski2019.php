<?php

use App\Activity;
use App\Calificacion;
use App\Course;
use App\CourseAssistance;
use App\Matter;
use App\Parameters\General;
use App\PeriodoLectivo;
use App\Student2Profile;
use App\Supply;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PreparacionNotasLevVygotski2019 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodo = PeriodoLectivo::where('nombre', '2019-2020')->first();
        $cursos = [
            0 => ['Inicial 1' =>'A'], 
            1 => ['Inicial 2' =>'A'], 
            2 => ['Inicial 2' =>'B'], 
            3 => ['Inicial 2' =>'C'], 
            4 => ['Primero' => 'A'], 
            5 => ['Primero' => 'B'], 
            6 => ['Primero' => 'C'], 
            7 => ['Segundo' => 'A'], 
            8 => ['Segundo' => 'B'], 
            9 => ['Segundo' => 'C'], 
            10 => ['Tercero' => 'A'], 
            11 => ['Tercero' => 'B'], 
            12 => ['Tercero' => 'C'], 
            13 => ['Cuarto' => 'A'], 
            14 => ['Cuarto' => 'B'], 
            15 => ['Quinto' => 'A'], 
            16 => ['Quinto' => 'B'], 
            17 => ['Sexto' => 'A'], 
            18 => ['Sexto' => 'B'], 
            19 => ['Septimo' => 'A'], 
            20 => ['Septimo' => 'B'], 
            21 => ['Octavo' => 'A'], 
            22 => ['Octavo' => 'B'], 
            23 => ['Noveno' => 'A'], 
            24 => ['Noveno' => 'B'], 
            25 => ['Decimo' => 'A']
        ];
        
        // Primer grupo => comprende, a los iniciales 1 y 2, y primer grado.
        // Segundo grupo => comprende de Segundo Grado a Septimo Grado
        // Tercero grupo => comprende de Octavo Grado a DEcimo Grado

            $primer_grupo = [
                'principales' => [
                    'DESCUBRIMIENTO Y COMPRENSIÓN DEL MEDIO NATURAL Y CULTURAL',
                    'COMPUTACION',
                    'INGLES',
                    'COMPRENSIÓN Y EXPRESIÓN ARTÍSTICA',
                    'COMPRENSIÓN Y EXPRESIÓN ORAL Y ESCRITA',
                    'CONVIVENCIA ',
                    'EXPRESIÓN CORPORAL',
                    'IDENTIDAD Y AUTONOMÍA',
                    'PROYECTOS Y RINCONES',
                    'RELACIONES LÓGICO MATEMÁTICO',
                ]
            ];

            $segundo_grupo = [
                'principales' => [
                    'LENGUA Y LITERATURA',
                    'MATEMATICA',
                    'CIENCIAS NATURALES',
                    'ESTUDIOS SOCIALES',
                    'EDUCACION CULTURAL Y ARTISTICA',
                    'CULTURA FISICA',
                    'INGLES',
                ],
                'optativas' => [
                    'COMPUTACION',
                    'PROYECTOS ESCOLARES',
                ]
            ];

            $tercer_grupo = [
                'principales' => [
                    'LENGUA Y LITERATURA',
                    'MATEMATICA',
                    'CIENCIAS NATURALES',
                    'ESTUDIOS SOCIALES',
                    'EDUCACION CULTURAL Y ARTISTICA',
                    'CULTURA FISICA',
                    'INGLES',
                ],
                'optativas' => [
                    'COMPUTACION',
                    'PROYECTOS ESCOLARES',
                    'COMERCIO'
                ]
            ];
        
        // Creando los cursos
        foreach ($cursos as $id => $curso) {
            if ($id < 7) {
                $seccion = 'EI';
            }
            if ($id >= 7) {
                $seccion = 'EGB';
            }
            foreach ($curso as $grado => $paralelo) {
                $course = Course::create([
                    'grado' => $grado,
                    'paralelo' => $paralelo,
                    'idPeriodo' => $periodo->id,
                    'cupos' => 40,
                    'seccion' => $seccion
                ]);

                // Creando las asistencia de los cursos.
                $parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
                foreach ($parciales as $parcial) {
                    $asistenciaDelCurso = new CourseAssistance();
                    $asistenciaDelCurso->idCurso = $course->id;
                    $asistenciaDelCurso->parcial = $parcial;
                    $asistenciaDelCurso->idPeriodo = $periodo->id;
                    $asistenciaDelCurso->save();
                }
            }
        }

        $cursosPrimerGrupo = Course::whereIn('grado', ['Inicial 1', 'Inicial 2', 'Primero'])->get();
        $cursosSegundoGrupo = Course::whereIn('grado', ['Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto', 'Septimo'])->get();
        $cursosTercerGrupo = Course::whereIn('grado', ['Octavo', 'Noveno', 'Decimo'])->get();
        
        foreach ($cursosPrimerGrupo as $course) {
            foreach ($primer_grupo as $materias) {
                foreach ($materias as $materia) {
                    $matter = Matter::create([
                        'nombre' => $materia,
                        'idCurso'   =>  $course->id,
                        'idPeriodo' => $periodo->id,
                        'visible' => 1,
                        'principal' => 1
                    ]);
                    $this->complemento($matter, $periodo);
                }
            }
        }

        foreach ($cursosSegundoGrupo as $course) {
            foreach ($segundo_grupo as $tipo => $materias) {
                $visibilidad = 1;
                if ($tipo == 'optativas') {
                    $visibilidad = 0;
                }
                foreach ($materias as $materia) {
                    $matter = Matter::create([
                        'nombre' => $materia,
                        'idCurso'   =>  $course->id,
                        'idPeriodo' => $periodo->id,
                        'visible' => $visibilidad,
                        'principal' => 1
                    ]);
                    $this->complemento($matter, $periodo);
                }
            }
        }

        foreach ($cursosTercerGrupo as $course) {
            foreach ($tercer_grupo as $tipo => $materias) {
                $visibilidad = 1;
                if ($tipo == 'optativas') {
                    $visibilidad = 0;
                }
                
                foreach ($materias as $materia) {
                    $matter = Matter::create([
                        'nombre' => $materia,
                        'idCurso'   =>  $course->id,
                        'idPeriodo' => $periodo->id,
                        'visible' => $visibilidad,
                        'principal' => 1
                    ]);
                    $this->complemento($matter, $periodo);
                }
            }
        }

        // for ($i=0; $i < 3; $i++) { 
        //     $this->call(factoryEstudiante::class);
        // }

        // Creando notas del usuario
        $parciales = ["p1q1","p2q1","p3q1","p1q2","p2q2","p3q2"];
        $students = Student2Profile::query()
            ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.retirado', 'NO')
            ->orderBy('students2.apellidos')
            ->where('idPeriodo', $periodo->id)
            ->select('students2_profile_per_year.id','students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso', 
                'students2.bloqueado', 'students2_profile_per_year.idPeriodo', 'students2_profile_per_year.idStudent',
                'students2_profile_per_year.numero_matriculacion')
            ->get();
        
        foreach ($cursosSegundoGrupo as $course) {
            echo $course->grado;
            foreach ($course->matters as $materia) {
                foreach ($materia->supplies as $insumo) {
                    foreach ($parciales as $parcial) {
    
                        $activity = factory(Activity::class)->create([
                            'idInsumo' => $insumo->id,
                            'parcial' => $parcial
                        ]);
    
                        foreach ($students as $student) {
                            if ($insumo != 'EXAMEN QUIMESTRAL') {
                                Calificacion::create([
                                    'idActividad' => $activity->id,
                                    'idEstudiante' => $student->idStudent,
                                    'idPeriodo' => $periodo->id,
                                    'nota' => 10,
                                    'idInsumo' => $insumo->id
                                ]);
                            }
                        }
                    }
    
                    foreach (['q1', 'q2'] as $quimestre) {
    
                        $supply = Supply::where(['idMateria' => $materia->id,'nombre' => 'EXAMEN QUIMESTRAL' ])->first();
                        $activity = Activity::where(['idInsumo' => $supply->id, 'parcial' => $quimestre])->first();
                        foreach ($students as $student) { 
                            Calificacion::create([
                                'idActividad' => $activity->id,
                                'idEstudiante' => $student->idStudent,
                                'idPeriodo' => $periodo->id,
                                'nota' => 10,
                                'idInsumo' => $insumo->id
                            ]);
                        }
    
                    }
                }
            }
        }
    }

    public function complemento($matter, $periodo) {
        $supplies = General::$supplies;
        foreach ($supplies as $key) {
            Supply::create([
                'nombre'    =>  $key,
                'idCurso'   =>  $matter->idCurso,
                'idPeriodo' => $periodo->id,
                'idMateria' =>  $matter->id,
                'idDocente' =>  $matter->idDocente,
                'es_aporte' => ($key == 'EVALUACION') ? true : false
            ]);
        }

        $supply = new Supply();
        $supply->nombre = "RECUPERATORIO";
        $supply->idCurso = $matter->idCurso;
        $supply->idMateria = $matter->id;
        $supply->idPeriodo = $periodo->id;
        $supply->idDocente = $matter->idDocente;

        $supply->save();
        
        $activity = new Activity();

        $activity->nombre = "RECUPERACION";
        $activity->descripcion = "";
        $activity->fechaInicio = Carbon::now();
        $activity->fechaEntrega = Carbon::now();
        $activity->idPeriodo = $periodo->id;
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
        $activity->idPeriodo = $periodo->id;
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
        $activity->idPeriodo = $periodo->id;
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
        $activity->idPeriodo = $periodo->id;
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
        $activity->idPeriodo = $periodo->id;
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
        $supply->idPeriodo = $periodo->id;

        $supply->save();   

        
        $activity = new Activity();

        $activity->nombre = "EXAMEN QUIMESTRAL";
        $activity->descripcion = "";
        $activity->fechaInicio = Carbon::now()->format('Y-m-d');
        $activity->fechaEntrega = Carbon::now()->format('Y-m-d');
        $activity->idPeriodo = $periodo->id;
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
        $activity->idPeriodo = $periodo->id;
        $activity->parcial = "q2";
        $activity->calificado = 1;
        $activity->refuerzo = 0;
        $activity->save();
    }
}
