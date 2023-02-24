<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Administrative;
use App\Calificacion;
use App\Career;
use App\ConfiguracionSistema;
use App\Course;
use App\CourseSchedule;
use App\Deber;
use App\Fechas;
use App\Institution;
use App\Lectionary;
use App\Matter;
use App\ParcialPeriodico;
use App\PeriodoLectivo;
use App\Permiso;
use App\Promedio;
use App\Student2;
use App\Student2Profile;
use App\Supply;
use App\Traits\mensajeNotificaciones;
use App\UnidadPeriodica;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Sentinel;
use Session;
use \Validator;

class GradeController extends Controller
{
    use mensajeNotificaciones;

    public function getInformation(Request $request)
    {
        return view('UsersViews.grados.informacion');
    }

    /*Se elimino su ruta, debe verificarse el uso*/
    public function getCalendar(Request $request)
    {
        return view('UsersViews.grados.agendaEscolar');
        $data = Course::getCourseEI1();
        $data2 = Course::getCourseEI2();
        $data3 = Course::getCourseEGB1();
        $data4 = Course::getCourseEGB2();
        $data5 = Course::getCourseEGB3();
        $data6 = Course::getCourseEGB4();
        $data7 = Course::getCourseEGB5();
        $data8 = Course::getCourseEGB6();
        $data9 = Course::getCourseEGB7();
        $data10 = Course::getCourseEGB8();
        $data11 = Course::getCourseEGB9();
        $data12 = Course::getCourseEGB10();
        $data13 = Course::getCourseBGU1();
        $data14 = Course::getCourseBGU2();
        $data15 = Course::getCourseBGU3();

        return view('UsersViews.administrador.grados.agenda.index', compact('data', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7', 'data8', 'data9', 'data10', 'data11', 'data12', 'data13', 'data14', 'data15'));
    }

    public function getScores(Request $erquest){
        if((ConfiguracionSistema::editaCalificaciones())->valor == 0){
            return redirect()->back();
        }
        $id_carrera     = \Session::get('idcarrera');
        $regimen        = ConfiguracionSistema::regimen();	
        /*$courses =     Course::where('id_career', $id_carrera)
                            ->where('estado','=','1')
                            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                            ->get();*/
        $courses =    Matter::select('courses.id as id','courses.grado as grado','courses.paralelo as paralelo')
                        ->join('courses','matters.idCurso','=','courses.id')
                        ->where('matters.idDocente',Sentinel::getUser()->id)
                        ->where('id_career', $id_carrera)
                        ->get();
        $unidad = UnidadPeriodica::unidadP();
        $parcial = ParcialPeriodico::parcialP(($unidad->first())->id);
        $user_profile = User::where('userid', Sentinel::getUser()->id)->first();
        //dd($coursess,$courses);
        return view('UsersViews.administrador.grados.calificaciones.index', compact(
            'courses', 'regimen', 'user_profile', 'parcial'
        ));
    }


    public function getScoresReports($parcial)
    {
        $docentes = Administrative::where('cargo', 'Docente')->get();
        session_start();
        $idcarrera = $parcial;
        $nombrecarrera = Career::where('id', $idcarrera)->first()->nombre;
        $courses = Course::where('id_career', $idcarrera)
            ->where('estado','=','1')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();

        $regimen = ConfiguracionSistema::regimen();
        return view('UsersViews.administrador.reportes.reportePorCurso', compact(
            'courses', 'coursesEGB', 'coursesBGU', 'parcial', 'docentes', 'regimen', 'nombrecarrera'
        ));
    }

    public function getStudentsReports($parcial)
    {
        $idcarrera = $parcial;
        $nombrecarrera = Career::where('id', $idcarrera)->first()->nombre;
        $courses = Course::where('id_career', $idcarrera)
                            ->where('estado','=','1')
                            ->get();
        return view('UsersViews.administrador.reportes.reportePorEstudiantes', compact('courses', 'nombrecarrera'));
    }

    public function getLectionary(Request $request)
    {
        try {            
            $id_carrera = \Session::get('idcarrera');
            $user = Sentinel::getUser();
            $user_profile = Administrative::findBySentinelid($user->id);
            $regimen = ConfiguracionSistema::regimen();
            $fechaActual = Carbon::now();
            $courses = Course::where('id_career', $id_carrera)
                            ->where('estado','=','1')
                            ->get();
            $primary = Course::where('grado', 'Primero')
                ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                ->where('estado', 1)
                ->get();
            return view('UsersViews.administrador.grados.agenda.index',
                compact('courses', 'fechaActual', 'regimen', 'user_profile', 'primary'));
        } catch (Excep $e) {
            return $e->getMessage();
        }

    }

    public function getLectionaryCourse($id)
    {
        try {
            if (request('fecha') == null) {
                throw new Exception('Error...');
            }
            $hours = Lectionary::query()
                ->where(['idCurso' => $id])
                ->where('idPeriodo', $this->idPeriodoUser())
                ->fecha(request('fecha'))
                ->get();
            $schedulers = CourseSchedule::where('idCurso', $id)
                ->orderBy('horaInicio')
                ->where('idPeriodo', $this->idPeriodoUser())
                ->get();
            $matters = Matter::where('idCurso', $id)->get();
            $course = Course::find($id);
            $fechaActual = Carbon::now();
            return view('UsersViews.administrador.grados.agenda.agendaCurso',
                compact('schedulers', 'matters', 'course', 'hours', 'fechaActual'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getLectionaryCourseSemanal(Course $course, Request $request)
    {
        $idcarrera = $request->idcarrera;
        $i = 1;
        $fecha1 = Carbon::createFromDate(substr(request('fecha'), 0, 4), substr(request('fecha'), 5, 2), substr(request('fecha'), 8, 2));
        $fecha2 = Carbon::createFromDate(substr(request('fecha'), 0, 4), substr(request('fecha'), 5, 2), substr(request('fecha'), 8, 2));
        $hours = Lectionary::whereBetween('fecha', [$fecha1->startOfWeek(), $fecha2->endOfWeek()])
            ->where('idCurso', $course->id)
            ->where('idPeriodo', $this->idPeriodoUser())
            ->get();
        $schedulers = CourseSchedule::where('idCurso', $course->id)
            ->where('idPeriodo', $this->idPeriodoUser())
            ->orderBy('horaInicio')
            ->get();
        $matters = Matter::where('idCurso', $course->id)
            ->where('idPeriodo', $this->idPeriodoUser())
            ->get();
        $fechaActual = Carbon::now();
        return view('UsersViews.administrador.grados.agenda.agendaSemanal',
            compact('schedulers', 'matters', 'course', 'hours', 'fechaActual', 'i', 'idcarrera'));
    }

    public function getList(Request $request)
    {
        $regimen = ConfiguracionSistema::regimen();
        $id_carrera = \Session::get('idcarrera');
        $materias = Matter::with('curso')
                ->where('idDocente', session('user_data')->userid)
                ->where('idPeriodo', $this->idPeriodoUser())
                ->get()->pluck('idCurso');
        $courses = Course::where('id_career', $id_carrera)
                         ->where('estado', 1)
                         ->whereIn('id',$materias)
                         ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                        ->get();
        return view('UsersViews.administrador.grados.lista.index', compact(
            'courses', 'regimen'
        ));
    }

    public function gradoLista($idCurso)
    {
        $institution = Institution::find(1);
        $course = Course::find($idCurso);
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $pdf = PDF::loadView('pdf.estudiante-lista', compact(
            'institution', 'course', 'students'
        ));
        return $pdf->download("Lista {$course->grado} {$course->paralelo} {$course->especializacion}.pdf");
    }

    public function getDocenteHome()
    {
        try {
            $courses = Course::getAllCourses();
            $materias = Matter::with('curso')
                ->where('idDocente', session('user_data')->userid)
                ->where('idPeriodo', $this->idPeriodoUser())
                ->get()
                ->groupBy('curso.grado');
            //dd($courses,$materias,session('user_data'));
            return view('UsersViews.docente.cursos.index', compact(
                'courses', 'materias'
            ));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDocenteCourse($id)
    {
        $matter = Matter::where('id', $id)->first();
        //dd($matter);
        $courses = Course::getAllCourses();
        $course = Course::find($matter->idCurso);
        $students = Student2::getStudentsByCourse($course->id);
        //dd($students,$course,$matter);
        return view('UsersViews.docente.cursos.verCurso', compact('students', 'courses', 'course'));
    }

    public function getListStudents()
    {
        $course = Course::find(5);
        $students = Course::getStudents(5);

        return view('UsersViews.administrador.grados.lista.listaCurso', compact('course', 'students'));
    }

    //Funcion para la ir a un curso en Grados/Calificaciones . Administrador
    public function getScoresCourse($id, $parcial = 'CII-2022')
    {
        $promedioTotal = 0;
        $course = Course::find($id);
        //$quimestre = (strlen($parcial) < 3 ? $parcial : substr($parcial, 2, 2));
        //dd($quimestre);
        $data = "";
        //$data2 = "";
        //echo(strlen($parcial));
        //if (strlen($parcial) < 3) {
           // $data2 = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/quimestre/' . $quimestre . '/curso/' . $id)));
        //} else {
            $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/parcial/' . $parcial . '/curso/' . $id)));
        //}
        foreach($data as $libretaStudent)
        {
            foreach($libretaStudent->parcial as $parcialStudent)
            {
                $promedioTotal = 0;
            
                if($parcialStudent->visible > 0 )
                {
                    foreach($parcialStudent->insumos as $insumoStudent)
                    {
                        if($insumoStudent->porcentaje >0)
                        {
                            $promedioTotal = $promedioTotal + ($insumoStudent->nota * ($insumoStudent->porcentaje / 100));
                        }                    
                    }    
                    $parcialStudent->promedioFinal = $promedioTotal;                
                }
      
            }
        }
        $unidad = UnidadPeriodica::unidadP();        
        $students = Student2Profile::getStudentsByCourse($course->id);
        
        $matters = Matter::getAllMattersByCourse($id)->where('estado', '=', '1')->where('idDocente','=',session('user_data')->userid);
        $permiso = Permiso::desbloqueo('grade_score');
        /*foreach ($data as $d) {
            $p = new \Illuminate\Support\Collection($d->materias);
        }*/
            //dd($data);
        return view('UsersViews.administrador.grados.calificaciones.calificacionesCurso',
            compact('course', 'parcial', 'students', 'matters', 'unidad', 'data', 'permiso'));
    }

    public function getCourseReports($id)
    {
        $students = Student2Profile::getStudentsByCourse($id);
        $course = Course::find($id);

        return view('UsersViews.administrador.reportes.reportePorEstudiantes-curso', compact('course', 'students'));
    }

    public function promedio(Request $request, $x)
    {
        $promedios = json_decode($request->promedios);

        foreach ($promedios as $p) {

            $promedio = Promedio::where(['idMateria' => $request->materia_id, 'idCurso' => $request->curso_id,
                'idEstudiante' => $p->id, 'parcial' => $request->parcial])->first();
            if ($promedio == null) {
                $promedio = new Promedio();
                $promedio->idMateria = $request->materia_id;
                $promedio->idCurso = $request->curso_id;
                $promedio->idEstudiante = $p->id;
                $promedio->parcial = $request->parcial;
            }

            $promedio->promedio = $p->promedio;
            $promedio->save();
        }
    }

    public function getScoresCourseMatter($id, $parcial)
    {
        if(ConfiguracionSistema::editaCalificaciones()->valor != 0){
            $promedioTotal = 0;       
            $permiso = Permiso::desbloqueo('grade_score');
            $parcialPrueba = str_replace(' ', '', $parcial);
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
            $unidad = UnidadPeriodica::unidadP();
            $validar = Matter::FindOrFail($id);
            $course = Course::getCoursesByCourse($validar->idCurso);
            $teacher = Administrative::find($course->idProfesor);
            $teacher2 = Administrative::where('userid', $validar->idDocente)->first();
            $supplies = Supply::getSuppliesByMatter($id);
            $students = Student2Profile::getStudentsByCourse($validar->idCurso);
            $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/parcial/' . $parcial . '/curso/' . $validar->idCurso)));
            //dd($data);
            foreach($data as $libretaStudent)
            {
                foreach($libretaStudent->parcial as $parcialStudent)
                {
                    $promedioTotal = 0;
                
                    if($parcialStudent->visible > 0 )
                    {
                        foreach($parcialStudent->insumos as $insumoStudent)
                        {
                            if($insumoStudent->porcentaje >0)
                            {
                                $promedioTotal = $promedioTotal + ($insumoStudent->nota * ($insumoStudent->porcentaje / 100));
                            }                    
                        }    
                        $parcialStudent->promedioFinal = $promedioTotal;                
                    }
          
                }
            }
            $idMateria = $id;
            $destrezas = DB::table('destrezas')
                ->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
                ->where('idMateria', '=', $validar->id)
                ->get();
            return view('UsersViews.administrador.grados.calificaciones.Materia',
                compact('teacher2', 'teacher', 'destrezas', 'data', 'unidad', 'PromedioInsumo', 'permiso','idMateria','parcialPrueba'))
                ->with(['Students' => $students, 'course' => $course, 'parcial' => $parcial, 'parcialPrueba' =>$parcial
                    , 'matter' => $validar, 'Supplies' => $supplies, 'id' => $id]);
        }
        return redirect()->back();
        
    }

    public function examenQuimestral($materia, $quimestre)
    {
        $unidad = UnidadPeriodica::unidadP();
        $parciales = ParcialPeriodico::where('activo', 1)->get();
        $un = $unidad->where('identificador', $quimestre)->first();
        $parcialP = $parciales->where('idUnidad', $un->id);
        $nota_minima = ConfiguracionSistema::notaMinima();
        $matter = Matter::find($materia);
        $supply = Supply::where(['idMateria' => $matter->id, 'nombre' => 'EXAMEN QUIMESTRAL'])->first();
        $students = Student2Profile::getStudentsByCourse($matter->idCurso);
        $calificaciones = Calificacion::where('idInsumo', $supply->id)->get();
        $activity = Activity::where(['idInsumo' => $supply->id, 'parcial' => $quimestre])->first();
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/quimestre/' . $quimestre . '/curso/' . $matter->idCurso)));
        $promediosTotal = [];
        $promedios80 = [];
        $c = 0;
        $promediosP = [];
        foreach ($parcialP as $parcial) {
            $c++;
            if (substr($parcial->identificador, 0, 2) == 'p' . $c) {
                $promediosP[$c] = Calificacion::getPromedioMatterParcial($matter->id, 'p' . $c . $quimestre);
            }
        }
        $promediosTotal = [];
        $promedios80 = [];
        $promedio20 = [];
        foreach ($students as $s) {
            $promediosTotal[$s->idStudent] = 0;
            $promedio20[$s->idStudent] = 0;
            foreach ($promediosP as $pro) {
                if ($pro[$s->idStudent]['promedio'] != 0) {
                    $promediosTotal[$s->idStudent] = $promediosTotal[$s->idStudent] + $pro[$s->idStudent]['promedio'];
                } else {
                    $promediosTotal[$s->idStudent] = 0;
                    $promedios80[$s->idStudent] = 0;
                    break;
                }
            }
            if ($promediosTotal[$s->idStudent] != 0) {
                $promediosTotal[$s->idStudent] = bcdiv($promediosTotal[$s->idStudent] / count($promediosP), '1', 2);
                $promedios80[$s->idStudent] = bcdiv($promediosTotal[$s->idStudent] * (0.8), '1', 2);
                if ($calificaciones->where('idEstudiante', $s->idStudent)->where('idActividad', $activity->id)->first() != null) {
                    $promedio20[$s->idStudent] = bcdiv($calificaciones->where('idEstudiante', $s->idStudent)->where('idActividad', $activity->id)->first()->nota * 0.2, '1', 2);
                }
            }
        }

        return view('UsersViews.administrador.grados.calificaciones.examenQuimestral',
            compact('matter', 'activity', 'calificaciones', 'supply', 'students', 'parcialP', 'promediosP', 'promedio20',
                'promediosP1', 'promediosP2', 'promediosP3', 'promedios80', 'quimestre', 'nota_minima', 'unidad', 'parciales',
                'data'
            ));
    }

    public function updateCalificaciones(Request $request, $activity, $student)
    {
        $nota_menor_rojo = ConfiguracionSistema::notaMenorRojo();
        $nota_menor_rojo = (int) $nota_menor_rojo->valor;
        
        if ($request->ajax()) {
            try {
                $calificacion = Calificacion::where(['idActividad' => $activity, 'idEstudiante' => $student])->first();
                if ($calificacion == null) {
                    $calificacion = new Calificacion;
                }

                $calificacion->idActividad = $activity;
                $calificacion->idEstudiante = $student;
                $calificacion->nota = $request->nota;
                $calificacion->idPeriodo = $this->idPeriodoUser();
                $calificacion->idInsumo = $request->supply;
                $calificacion->save();
               // dd($calificacion);
                // Creando Notificacion
                $nota = (int) $calificacion->nota;
                if ($nota < $nota_menor_rojo) {
                    // $this->mensajeNotaRojo($calificacion);
                }

                return response()->json($calificacion, 200);

            } catch (Exception $e) {
                return response()->json(['message' => $e], 500);
            }
        }
    }

    public function materiaInsumo($idMateria, $idInsumo, $parcial)
    {
        if(ConfiguracionSistema::editaCalificaciones()->valor != 0){
            $nota_minima = ConfiguracionSistema::notaMinima();
            $matter = Matter::find($idMateria);
            $course = Course::find($matter->idCurso);
            $teacher = Administrative::find($course->idProfesor);
            $teacher2 = Administrative::where('userid', $matter->idDocente)->first();
            $teachers = Administrative::all();
            $validar = Matter::FindOrFail($idMateria);
            $user_data = User::where('userid', Sentinel::getUser()->id)->first();
            $course = Course::getCoursesByCourse($validar->idCurso);
            $supply = Supply::FindOrFail($idInsumo);
            $activities = Activity::where(['idInsumo' => $idInsumo, 'parcial' => $parcial, 'refuerzo' => 0])->get();
            $calificaciones = Calificacion::where('idInsumo', $idInsumo)->get();
            $refuerzo = Activity::where(['idInsumo' => $idInsumo, 'parcial' => $parcial, 'refuerzo' => 1])->first();
            $students = Student2Profile::getStudentsByCourse($course->id);
            $permiso = Permiso::desbloqueo('grade_score');
            return view('UsersViews.administrador.grados.calificaciones.materiaInsumo',
                compact('teacher', 'teacher2', 'course', 'matter', 'teachers', 'idMateria',
                    'idInsumo', 'refuerzo', 'nota_minima', 'data', 'permiso'))
                ->with(['Students' => $students, 'Course' => $course,
                    'Matter' => $validar,
                    'Supply' => $supply,
                    'Activities' => $activities,
                    'parcial' => $parcial,
                    'calificaciones' => $calificaciones,
                    'user_data' => $user_data,
                ]);
        }
        return redirect()->back();        
    }

    public function storemateriaInsumo(Request $request, $idMateria, $idInsumo, $parcial)
    {
        DB::beginTransaction();
        // try {
        $materia = Matter::FindOrFail($idMateria);
        if (isset($request->recibirTareas)) {
            if ($materia->user == null) {
                throw new Exception("No se puede permitir tarea ya que esta materia no esta vinculada a un docente.");
            }
        }
        $validarInsumo = Supply::FindOrFail($idInsumo);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'descripcion' => 'string|max:300|nullable',
            'adjuntos' => 'nullable',
            'fechaInicio' => 'required|Date',
            'fechaEntrega' => 'required|Date',
            'recibirTareas' => 'nullable',
            'idCurso' => 'nullable',
        ]);
        //dd($validator);
        if ($validator->fails()) {
            return response()->json(['message' => view('layouts.messages')->withErrors($validator->messages())->render()], 500);
        } else {
            $newactivity = new Activity();
            $newactivity->nombre = $request->nombre;
            $newactivity->descripcion = $request->descripcion;
            $newactivity->idPeriodo = $this->idPeriodoUser();
            $newactivity->recibirTareas = isset($request->recibirTareas) ? 1 : 0;

            if ($request->hasFile('adjuntos') && $request->file('adjuntos')->isValid()) {
                $nombre_adjunto = $request->file('adjuntos')->getClientOriginalName();
                $request->file('adjuntos')->storeAs('public/actividades_adjuntos', $request->file('adjuntos')->getClientOriginalName());
                $newactivity->adjuntos = $nombre_adjunto;
            }
            $newactivity->fechaInicio = $request->fechaInicio;
            $newactivity->fechaEntrega = $request->fechaEntrega;
            $newactivity->idInsumo = $idInsumo;
            $newactivity->parcial = $parcial;

            if (isset($request->refuerzo)) {
                $newactivity->refuerzo = isset($request->refuerzo) ? 1 : 0;
                $newactivity->calificado = 1;
            } else {
                $newactivity->calificado = isset($request->calificado) ? 1 : 0;
            }

            //$students = Student2Profile::getStudentsByCourse($request->idCurso);

            //$matter = Matter::find($idMateria);
            //$course = Course::find($matter->idCurso);
            //$students = Student2Profile::getStudentsByCourse($course->id);

            $students = Student2Profile::getStudentsByCourse($request->idCurso);
            //$asigid=$students->idStudent;
            //dd($students);
            $newactivity->save();
            if (isset($request->recibirTareas) != null) {
                foreach ($students as $student) {
                    $deber = new Deber;
                    $deber->idActividad = $newactivity->id;
                    $deber->idPeriodo = $this->idPeriodoUser();
                    $deber->idEstudiante = $student->idStudent;
                    //$deber->idEstudiante = $students->first();
                    //$deber->idEstudiante = $student->idStudent;
                    //$deber->idEstudiante = Student2Profile::where('idStudent', '=', $students->idStudent)->first();
                    //$students = $students->first();

                    $deber->idProfesor = $materia->user->profile->id;
                    $deber->save();
                }
            }

            // Notificaciones
            //$this->mensajeCrearTarea($students, $newactivity);
            DB::commit();
            return '<div class="alert alert-success" role="alert">Actividad Agregada con exito.</div>';
        }
/*
} catch (Exception $e) {
return response()->json([ 'message' => $e->getMessage()], 500);
}*/
    }

    public function activarRefuerzoAcademico($idInsumo, $parcial)
    {
        $newactivity = new Activity();
        $newactivity->nombre = "REFUERZO ACADEMICO";
        $newactivity->descripcion = "REFUERZO ACADEMICO";
        $newactivity->fechaInicio = Carbon::now();
        $newactivity->fechaEntrega = Carbon::now();
        $newactivity->idInsumo = $idInsumo;
        $newactivity->parcial = $parcial;
        $newactivity->refuerzo = 1;
        $newactivity->calificado = 1;
        $newactivity->idPeriodo = $this->idPeriodoUser();
        $newactivity->save();
        return redirect()->back();
    }

    public function desactivarRefuerzoAcademico($idInsumo, $parcial)
    {
        $refuerzo = Activity::where(['idInsumo' => $idInsumo, 'parcial' => $parcial, 'nombre' => "REFUERZO ACADEMICO", 'refuerzo' => 1])->first();

        $refuerzo->delete();
        return redirect()->back();
    }

    public function descargarAdjunto($archivo)
    {
        return response()->download(storage_path("app/public/actividades_adjuntos/{$archivo}"));
    }

    public function destroy(Request $request)
    {
        Activity::destroy($request->idActivity);
        /*$idMateria = $request->idMateria;
        $idInsumo = $request->idInsumo;
        $courses = Course::getAllCourses();
        $teachers = Administrative::all();*/
        return redirect()->back();
    }

    public function reportePorDocente($parcial)
    {

        $d = Administrative::where('cargo', 'Docente')->get();

        $docentes = $d->sortBy('apellidos')->groupBy(function ($item, $key) {
            return substr($item['apellidos'], 0, 1);
        });
        return view('UsersViews.administrador.reportes.reportePorDocente',
            compact('docentes', 'parcial'));
    }

    public function ActaCalificacionesDocente($docente, $parcial)
    {
        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true);

        $teacher = Administrative::find($docente);
        $matters = Matter::getMattersByProfessor($docente);
        $coursesID = $matters->pluck('idCurso')->toArray();

        $students = Student2::getStudentsByCourse($coursesID);

        $promedios = [];
        $supplies = [];
        foreach ($coursesID as $idCurso) {
            foreach ($matters->where('idCurso', $idCurso) as $matter) {
                $supplies[$idCurso][$matter->id] = Supply::getSuppliesByMatter($matter->id);
                $promedios[$idCurso][$matter->id] = Calificacion::getPromedioSupply($matter->id, $idCurso, $parcial);
            }
        }

        $courses = Course::whereIn('id', $coursesID)->where('estado', 1)->get();
        $now = Carbon::now();
        $fechaA = Fechas::fechaActual($now);

        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);

        $pdf = PDF::loadView('pdf.reportes-por-curso.docentes.acta-calificaciones-docente',
            compact('teacher', 'parcial', 'fechaA', 'institution', 'matters',
                'students', 'courses', 'supplies', 'promedios', 'periodo'));

        return $pdf->download('Reporte Actas.pdf');
    }

    public function showActivity($activity, $course, $idMateria, $accion)
    {
        try {
            $i = 1;
            if ($accion == 2) { // mostrar calificaciones y permitir el desbloqueo para entregar tareas
                $display = 'display: none;';
            } else {
                $display = '';
            }

            $nota_minima = ConfiguracionSistema::notaMinima();
            $today = Carbon::today()->format('Y-m-d');
            $configuracion = null;
            $temp = Activity::FindOrFail($activity);
            $validarInsumo = Supply::FindOrFail($temp->idInsumo);
            $temDate = new \DateTime($temp->fechaInicio);
            $temp->fechaInicio = $temDate->format('Y-m-d');
            $temDate = new \DateTime($temp->fechaEntrega);
            $temp->fechaEntrega = $temDate->format('Y-m-d');
            $deberes = DB::table('deberes')
                ->join('students2', 'deberes.idEstudiante', '=', 'students2.id')
                ->where('deberes.idActividad', $activity)
                ->where('idPeriodo', $this->idPeriodoUser())
                ->select('deberes.*', 'students2.nombres', 'students2.apellidos', 'students2.id as idEstudiante')
                ->distinct()->get();
            // dd($deberes);

            $students = Student2Profile::getStudentsByCourse($course);
            return view('layouts.showActivity',
                ['Activity' => $temp, 'deberes' => $deberes, 'students' => $students, 'idCurso' => $course, 'idMateria' => $idMateria,
                    'today' => $today, 'i' => $i, 'nota_minima' => $nota_minima, 'configuracion' => $configuracion, 'accion' => $display]);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }
    public function recuperaciones($idCurso, $idMateria, $ciclo, $parcial)
    {
        $curso = Course::find($idCurso);
    
        $matter = Matter::find($idMateria);
        $students = Student2::getStudentsByCourse($idCurso);
        $unidad = UnidadPeriodica::unidadP();
        $sabana = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/sabana/anual/' . $this->idPeriodoUser() . '/curso/' . $idCurso)));
        //dd($students);

        $supRecuperacion = Supply::where(['nombre' => 'RECUPERATORIO', 'idMateria' => $matter->id])->first();
        if($supRecuperacion == null)
        {
            $supply = new Supply();
            $supply->nombre     = "RECUPERATORIO";
            $supply->idCurso    =  $matter->idCurso;
            $supply->idMateria  = $matter->id;
            $supply->idPeriodo  = $this->idPeriodoUser();
            $supply->idDocente  = $matter->idDocente;    
            $supply->save();
            $supRecuperacion = $supply;
        }
        $actRecuperacion1 = Activity::where(['idInsumo' => $supRecuperacion->id, 'parcial' => 'supletorio'])->first();
        if($actRecuperacion1 == null)
        {
            $activity = new Activity();
            $activity->nombre = "RECUPERACION";
            $activity->descripcion = "";
            $activity->fechaInicio = Carbon::now();
            $activity->fechaEntrega = Carbon::now();
            $activity->idPeriodo = $this->idPeriodoUser();
            $activity->idInsumo = $supRecuperacion->id;
            $activity->parcial = 'supletorio';
            $activity->calificado = 1;
            $activity->refuerzo = 0;
            $activity->save();
            $actRecuperacion1 = $activity;
        }
        

        $supletorio = Activity::where(['idInsumo' => $supRecuperacion->id, 'parcial' => 'supletorio'])->first();
        
        foreach($sabana as $studentSabana)
        {
            foreach($studentSabana->materias as $materia)
            {
                $insumoRecuperacion = Supply::where(['nombre' => 'RECUPERATORIO', 'idMateria' => $materia->materiaId ])->first();
                if($insumoRecuperacion != null){
                    $activity = Activity::where(['idInsumo' => $insumoRecuperacion->id, 'parcial' => 'supletorio'])->first();
                    
                    if($activity != null)
                    {
                        $calificacion = Calificacion::where(['idActividad' => $activity->id, 'idEstudiante' => $studentSabana->estudianteId])->first();
                        if($calificacion != null){
                            $materia->supletorio = $calificacion->nota;
                        }
                    }
                   
                }
            }
        }

        //$remedial = Activity::where(['idInsumo' => $supRecuperacion->id, 'parcial' => 'remedial'])->first();
        //$gracia = Activity::where(['idInsumo' => $supRecuperacion->id, 'parcial' => 'gracia'])->first();
        return view('UsersViews.administrador.grados.calificaciones.recuperaciones',
            compact('curso', 'students', 'matter', 'supRecuperacion', 'actRecuperacion1',
                'califRecuperacion', 'supletorio', 'unidad', 'sabana', 'ciclo', 'parcial'));

    }

    public function desbloqueoDeTarea()
    {

        $deber = Deber::find(request()->idDeber);
        if ($deber->enviado == 1) {
            $deber->enviado = 0;
            $deber->save();
        } else {
            $deber->enviado = 1;
            $deber->save();
        }
    }
    public function desbloqueoDeTareaCaducado()
    {
        $deber = Deber::find(request()->idDeber);
        if ($deber->bloqueo == 1) {
            $deber->bloqueo = 0;
            $deber->save();
        } else {
            $deber->bloqueo = 1;
            $deber->save();
        }
    }

}
