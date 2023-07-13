<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Administrative;
use App\Calificacion;
use App\Career;
use App\ConfiguracionSistema;
use App\Course;
use App\Factura;
use App\Fechas;
use App\Institution;
use App\Matter;
use App\PagoEstudianteDetalle;
use App\PeriodoLectivo;
use App\PersonasAutorizadas;
use App\RequestUser;
use App\Semesters;
use App\Student2;
use App\Student2Profile;
use App\Supply;
use App\Syllabus;
use Exception;

use App\CourseSchedule;
use App\Deber;
use App\ParcialPeriodico;
use App\Permiso;
use App\Promedio;
use App\UnidadPeriodica;

use App\TeacherSchedule;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDF;

use Illuminate\Support\Facades\DB;
use Sentinel;
use Session;
use \Validator;


class PdfController extends Controller
{
    public function reporteActaCalificacion($materia_id, $parcial)
    {

        //$materia_id = 2;
        $materia = Matter::where('id', $materia_id)->first();
        $docente = User::select('nombres', 'apellidos')->where('userid', $materia->idDocente)->first();
        $curso = Course::where('id', $materia->idCurso)->where('estado', '1')->first();
        $carrera = Career::where('id', $curso->id_career)->where('estado', '1')->first();
        $semestre = Semesters::where('career_id', $carrera->id)->where('estado', '1')->first();
        $fecha = Fechas::fechaActual();

        $permiso = Permiso::desbloqueo('grade_score');
        $parcial = str_replace(' ', '', $parcial);
        
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
        $unidad = UnidadPeriodica::unidadP();
        $validar = Matter::FindOrFail($materia_id);
        $course = Course::getCoursesByCourse($validar->idCurso);
        $teacher = Administrative::find($course->idProfesor);
        $teacher2 = Administrative::where('userid', $validar->idDocente)->first();
        $supplies = Supply::getSuppliesByMatter($materia_id);
        $students = Student2Profile::getStudentsByCourse($validar->idCurso);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/parcial/' . $parcial . '/curso/' . $validar->idCurso)));
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
        $destrezas = DB::table('destrezas')
            ->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
            ->where('clasesdestrezas.parcial', strtoupper($parcial))
            ->where('idMateria', '=', $validar->id)
            ->get();
        
        $pdf = PDF::loadView('pdf.reportes_calificaciones.acta_calificacion',
            compact('carrera', 'semestre', 'materia', 'fecha', 'curso', 'docente',
            'teacher2', 'teacher', 'destrezas', 'data', 'unidad', 'PromedioInsumo', 'permiso','parcialPrueba',
           'students','validar','supplies','materia_id','course' ))->setPaper('a4', 'portrait');
        return $pdf->stream("Acta Calificaciones - $materia->nombre.pdf", array('Attachment' => false));
    }

    public function actaGlobal($materia_id,Request $request)
    {
        $materia = Matter::find($materia_id);
        $docente = User::select('nombres', 'apellidos')->where('userid', $materia->idDocente)->first();
        $curso = Course::where('id', $materia->idCurso)->where('estado', '1')->first();
        $carrera = Career::where('id', $curso->id_career)->where('estado', '1')->first();
        $semestre = Semesters::where('career_id', $carrera->id)->where('estado', '1')->first();
        $fecha = Fechas::fechaActual();
        $permiso = Permiso::desbloqueo('grade_score');
        $PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
        $unidad = UnidadPeriodica::unidadP();
        $ciclo = 0;
        foreach ($unidad as $uni) {
            $parcialP = ParcialPeriodico::parcialP($uni->id);
            foreach ($parcialP as $par) {
                $ciclo=  $par->identificador;
            }
        }
        $validar = Matter::FindOrFail($materia_id);
        $course = Course::getCoursesByCourse($validar->idCurso);
        $teacher = Administrative::find($course->idProfesor);
        $teacher2 = Administrative::where('userid', $validar->idDocente)->first();
        $supplies = Supply::getSuppliesByMatter($materia_id);
        $students = Student2Profile::getStudentsByCourse($validar->idCurso);
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/parcial/' . $request['parcial'] . '/curso/' . $validar->idCurso)));
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
                    $parcialStudent->recuperacion = $promedioTotal;   
                    $parcialStudent->promedioInicial = $promedioTotal;     
                    $parcialStudent->promedioFinal = $promedioTotal;              
                }
      
            }
        }
        foreach($data as $studentSabana)
        {
            foreach($studentSabana->parcial as $parcial)
            {
                $supletorioParcial = 0;
                $insumoRecuperacion = Supply::where(['nombre' => 'RECUPERATORIO', 'idMateria' => $parcial->materiaId ])->first();
                if($insumoRecuperacion != null){

                    $activity = Activity::where(['idInsumo' => $insumoRecuperacion->id, 'parcial' => 'supletorio'])->first();
                    if($activity != null)
                    {
                        $calificacion = Calificacion::where(['idActividad' => $activity->id, 'idEstudiante' => $studentSabana->estudianteId])->first();
                        if($calificacion != null)
                            $supletorioParcial = $calificacion->nota;
                    }
                   
                }
                $parcial->supletorio =  $supletorioParcial;
            }
            
        }
        $reporte = PDF::loadView('pdf.acta_global.acta_global', 
       
        compact('carrera', 'semestre', 'materia', 'fecha', 'curso', 'docente',
            'teacher2', 'teacher', 'data', 'unidad', 'PromedioInsumo', 'permiso','ciclo',
           'students','validar','supplies','materia_id','course' )
        )->setPaper('a4', 'portrait');
        return $reporte->stream("Reporte Global - $materia->nombre.pdf", array('Attachment' => false));
    }

    public function generarReporte(Request $request){
        $materia_id =  $request['matters'];
        $parcial = $request['ciclo'];
        if($request['tipoReporte'] == 1){
            $materia = Matter::where('id', $materia_id)->first();
        
            $docente = User::select('nombres', 'apellidos')->where('userid', $materia->idDocente)->first();
            $curso = Course::where('id', $materia->idCurso)->where('estado', '1')->first();
            $carrera = Career::where('id', $curso->id_career)->where('estado', '1')->first();
            $semestre = Semesters::where('career_id', $carrera->id)->where('estado', '1')->first();
            $fecha = Fechas::fechaActual();
    
            $permiso = Permiso::desbloqueo('grade_score');
            $parcial = str_replace(' ', '', $parcial);
            
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
            $unidad = UnidadPeriodica::unidadP();
            //dd($request);
            $validar = Matter::FindOrFail($materia_id);
            $course = Course::getCoursesByCourse($validar->idCurso);
            $teacher = Administrative::find($course->idProfesor);
            $teacher2 = Administrative::where('userid', $validar->idDocente)->first();
            $supplies = Supply::getSuppliesByMatter($materia_id);
            $students = Student2Profile::getStudentsByCourse($validar->idCurso);
            $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/parcial/' . $parcial . '/curso/' . $validar->idCurso)));
            
            
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
            $destrezas = DB::table('destrezas')
                ->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
                ->where('clasesdestrezas.parcial', strtoupper($parcial))
                ->where('idMateria', '=', $validar->id)
                ->get();
    
            $pdf = PDF::loadView('pdf.reportes_calificaciones.acta_calificacion',
                compact('carrera', 'semestre', 'materia', 'fecha', 'curso', 'docente',
                'teacher2', 'teacher', 'destrezas', 'data', 'unidad', 'PromedioInsumo', 'permiso','parcialPrueba',
               'students','validar','supplies','materia_id','course' ))->setPaper('a4', 'portrait');
            return $pdf->stream("Acta Calificaciones - $materia->nombre.pdf", array('Attachment' => false));
                
        }else if($request['tipoReporte'] == 2){
            $materia = Matter::find($materia_id);
            $docente = User::select('nombres', 'apellidos')->where('userid', $materia->idDocente)->first();
            $curso = Course::where('id', $materia->idCurso)->where('estado', '1')->first();
            $carrera = Career::where('id', $curso->id_career)->where('estado', '1')->first();
            $semestre = Semesters::where('career_id', $carrera->id)->where('estado', '1')->first();
            $fecha = Fechas::fechaActual();
            $permiso = Permiso::desbloqueo('grade_score');
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
            $unidad = UnidadPeriodica::unidadP();
            $ciclo = 0;
            foreach ($unidad as $uni) {
                $parcialP = ParcialPeriodico::parcialP($uni->id);
                foreach ($parcialP as $par) {
                    $ciclo=  $par->identificador;
                }
            }
            $validar = Matter::FindOrFail($materia_id);
            $course = Course::getCoursesByCourse($validar->idCurso);
            $teacher = Administrative::find($course->idProfesor);
            $teacher2 = Administrative::where('userid', $validar->idDocente)->first();
            $supplies = Supply::getSuppliesByMatter($materia_id);
            $students = Student2Profile::getStudentsByCourse($validar->idCurso);
            $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/parcial/' . $parcial . '/curso/' . $validar->idCurso)));
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
                        $parcialStudent->recuperacion = $promedioTotal;   
                        $parcialStudent->promedioInicial = $promedioTotal;     
                        $parcialStudent->promedioFinal = $promedioTotal;              
                    }
        
                }
            }
            foreach($data as $studentSabana)
            {
                foreach($studentSabana->parcial as $parcial)
                {
                    $supletorioParcial = 0;
                    $insumoRecuperacion = Supply::where(['nombre' => 'RECUPERATORIO', 'idMateria' => $parcial->materiaId ])->first();
                    if($insumoRecuperacion != null){

                        $activity = Activity::where(['idInsumo' => $insumoRecuperacion->id, 'parcial' => 'supletorio'])->first();
                        if($activity != null)
                        {
                            $calificacion = Calificacion::where(['idActividad' => $activity->id, 'idEstudiante' => $studentSabana->estudianteId])->first();
                            if($calificacion != null)
                                $supletorioParcial = $calificacion->nota;
                        }
                    
                    }
                    $parcial->supletorio =  $supletorioParcial;
                }
                
            }
            $reporte = PDF::loadView('pdf.acta_global.acta_global', 
        
            compact('carrera', 'semestre', 'materia', 'fecha', 'curso', 'docente',
                'teacher2', 'teacher', 'data', 'unidad', 'PromedioInsumo', 'permiso','ciclo',
            'students','validar','supplies','materia_id','course' )
            )->setPaper('a4', 'portrait');
            return $reporte->stream("Reporte Global - $materia->nombre.pdf", array('Attachment' => false));
        }
        
    }


    public function reporteSyllabus($materia_id)
    {
        $materia = Matter::where('id', $materia_id)->where('estado', '1')->first();
        $curso = Course::where('id', $materia->idCurso)->where('estado', '1')->first();
        $carrera = Career::where('id', $curso->id_career)->where('estado', '1')->first();
        $semestre = Semesters::where('career_id', $carrera->id)->where('estado', '1')->first();
        $docente = User::select('nombres', 'apellidos')->where('userid', $materia->idDocente)->first();
        $syllabus = Syllabus::where('materia_id', $materia->id)->first();
        $date = Fechas::fechaActual();
        $reporte = PDF::loadView('pdf.syllabus.syllabus_pdf', compact('materia', 'curso', 'carrera', 'docente', 'semestre', 'syllabus', 'date'))->setPaper('a4', 'landscape');
        return $reporte->stream("Syllabus.pdf", array('Attachment' => false));
    }

    public function reportePorDocente($idDocente)
    {
        $course = Course::where('idProfesor', $idDocente)->first();
        $docente = Administrative::where('cargo', 'Docente')
            ->where('id', $idDocente)
            ->orderBy('apellidos', 'ASC')
            ->first();
        $institution = Institution::first();
        $horarios = TeacherSchedule::where('idProfesor', $idDocente)
            ->where('idPeriodo', $this->idPeriodoUser())
            ->get();
        $materias = Matter::where('idDocente', $idDocente)
            ->where('idPeriodo', $this->idPeriodoUser())
            ->get();
        $fechaActual = Carbon::now()->toFormattedDateString();
        $pdf = PDF::loadView('pdf.reporte-general.reporte-docentes', compact(
            'institution', 'count', 'course', 'docente', 'materias', 'horarios', 'materias', 'fechaActual'
        ))->setPaper('a4', 'portrait');

        return $pdf->stream("Reporte Docente $docente->apellidos $docente->nombres.pdf");
    }
    /*
    Reporte Supletorio por Materias, no está siendo usado.

    Route::get('Reporte-Supletorio-por-materias/{idCurso}',s'PdfController@reporteSupletorioMaterias')->name('RefuerzoSupletorioMaterias');
     */
    public function reporteSupletorioMaterias($idCurso)
    {
        $institution = Institution::find(1);
        $course = Course::find($idCurso);
        $students = Student2::getStudentsByCourse($idCurso);
        $matters = Matter::getMattersAllByCourse($idCurso);

        $promediosAnuales = Calificacion::AlumnosNotaFinalSinRecuperaciones($idCurso);
        $promediosFinales = Calificacion::AlumnosNotaFinal($idCurso);

        $supletorios = [];
        foreach ($matters as $matter) {
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
        }
        $mattersID = [];
        foreach ($students as $key => $student) {
            $supletorio = false;
            foreach ($matters as $matter) {
                if ($promediosFinales[$matter->id][$student->id] < 7 && $promediosFinales[$matter->id][$student->id] >= 5 && $promediosFinales[$matter->id][$student->id] > 0) {
                    $supletorio = true;
                    array_push($mattersID, $matter->id);
                }
            }
            if (!$supletorio) {
                $students->forget($key);
            }
        }

        $matters = $matters->whereIn('id', $mattersID);

        if (count($students) > 0) {
            $pdf = PDF::loadView('pdf.reportes-por-curso.reporte-supletorios-por-materias',
                compact('institution', 'course', 'matters', 'students', 'promediosFinales', 'promediosAnuales', 'supletorios'));

            return $pdf->download('Reporte Supletorio por Materias.pdf');
        } else {
            return Redirect::back()->withErrors(['login_fail' => 'No hay alumnos en supletorio.']);
        }
    }

    public function calificacionesPendienteExamen($idCurso, $quimestre)
    {
        $students = Student2::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $matters = Matter::where(['idCurso' => $idCurso, 'visible' => 1])->get();
        $institution = Institution::find(1);
        $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);

        foreach ($matters as $matter) {
            $promedios[$matter->id] = Calificacion::getExamenesMateria($matter->id, $quimestre);

        }
        //$pdf = PDF::load

        return View(
            'pdf.reportes-por-curso.curso.quimestral.calificaciones-pendientes-examen',
            compact('promedios', 'institution', 'students', 'course', 'matters', 'quimestre',
                'periodo')
        );

        return $pdf->download('Calificaciones Pendientes.pdf');
    }

    public function reporteDocentes()
    {
        $tutores = 0;
        $count = 1;
        $institution = Institution::first();
        $courses = Course::getAllCourses();
        $docentes = Administrative::where('cargo', 'Docente')->orderBy('apellidos', 'ASC')->get();
        $pdf = PDF::loadView('pdf.fichaspersonales.docentes.reporte-docentes', compact(
            'institution', 'count', 'courses', 'docentes', 'tutores'
        ));
        return $pdf->download('Reporte Docentes.pdf');
    }
    public function reporteDocentesdatos()
    {
        $tutores = 0;
        $count = 1;
        $institution = Institution::first();
        $courses = Course::getAllCourses();

        $docentes = Administrative::where('cargo', 'Docente')->orderBy('apellidos', 'ASC')->get();
        $pdf = PDF::loadView('pdf.fichaspersonales.docentes.docentesDatos', compact(
            'institution', 'count', 'courses', 'docentes', 'tutores'
        ));

        return $pdf->download('Reporte Docentes Datos.pdf');
    }

    public function reportePorGenero()
    {
        $institution = Institution::first();
        $students = Student2Profile::getAllStudents();
        $courses = Course::getAllCourses();
        $pdf = PDF::loadView('pdf.estudiante-por-genero', compact(
            'institution', 'courses', 'students'
        ));

        return $pdf->download('Estudiantes por genero.pdf');
    }

    public function reportePorGeneroCurso($idCurso)
    {
        $institution = Institution::first();
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $course = Course::find($idCurso);
        $pdf = PDF::loadView('pdf.estudiante-por-genero-curso', compact(
            'institution', 'course', 'students'
        ));

        return $pdf->download("Estudiantes por genero($course->grado $course->especializacion $course->paralelo).pdf");
    }

    public function reporteEstudiantesRepresentante()
    {
        $institution = Institution::first();
        $students = Student2Profile::getAllStudents();
        $representantes = Administrative::where('cargo', 'Representante')->get();
        $courses = Course::getAllCourses();
        $pdf = PDF::loadView('pdf.reporte-estudiantes-representantes', compact(
            'institution', 'courses', 'students', 'representantes'
        ));

        return $pdf->download('Reporte Estudiantes y Representantes.pdf');
    }

    public function reporteEstudiantesRepresentanteCurso($idCurso)
    {
        $institution = Institution::first();
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $representantes = Administrative::where('cargo', 'Representante')->get();
        $course = Course::find($idCurso);
        $pdf = PDF::loadView('pdf.reporte-estudiantes-representantes-curso', compact(
            'institution', 'course', 'students', 'representantes'
        ));

        return $pdf->download("Estudiantes y Representantes($course->grado $course->especializacion $course->paralelo).pdf");
    }

    /*
    Reportes de Colecturía. Deben moverse a su controlador respectivo
     */
    public function avisoVencimiento($idEstudiante)
    {
        try {
            $student = Student2Profile::getStudent($idEstudiante);
            $dia_pago = (int) ConfiguracionSistema::diaDePago()->valor;
            $pagosPendientes = PagoEstudianteDetalle::pagosPendientes($student);
            $now = Carbon::now();
            $fecha = Fechas::fechaActual($now);
            $totalRubro = 0;

            $pdf = PDF::loadView('pdf.reporte-aviso-vencimiento',
                compact('pagosPendientes', 'becas', 'student', 'totalRubro', 'fecha', 'dia_pago'));
            return $pdf->download("Aviso de Vencimiento.pdf");
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
    }

    public function avisoVencimientoPorCurso(Course $course)
    {
        try {
            $studentsId = Student2Profile::getStudentsByCourse($course->id)->pluck('idStudent');
            $students = Student2::whereIn('id', $studentsId)->orderBy('apellidos', 'ASC')->get();
            $dia_pago = (int) ConfiguracionSistema::diaDePago()->valor;
            $pagosPendientes = [];
            foreach ($students as $student) {
                $pagosPendientes[$student->id] = PagoEstudianteDetalle::getDetailPaymentsByStudent($student->id, $course->id)->where('estado', 'PENDIENTE');

                if (count($pagosPendientes[$student->id]) > 0) {
                    foreach ($pagosPendientes[$student->id] as $key => $pago) {
                        $pago_mes = $pago->pago;

                        if ($pago->prorroga == null) {
                            $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes + 1, $dia_pago);
                        } else {
                            $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes + 1, $dia_pago + $pago->prorroga);
                        }

                        $now = Carbon::now();
                        if ($fecha_pago >= $now) {
                            $pagosPendientes[$student->id]->forget($key);
                        }
                    }
                }
            }
            $now = Carbon::now();
            $fecha = Fechas::fechaActual($now);
            $pdf = PDF::loadView('pdf.reporte-aviso-vencimiento-por-curso',
                compact('pagosPendientes', 'becas', 'students', 'totalRubro', 'course', 'fecha'));
            return $pdf->download("Aviso de Vencimiento.pdf");
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => 'Ha ocurrido un error.']);
        }
    }

    public function reporteEstudiantesCedula(Course $course)
    {
        $i = 1;
        $institution = Institution::first();
        $students = Student2Profile::getStudentsByCourse($course->id);
        foreach ($students as $s) {
            $fn = Carbon::createFromFormat('Y-m-d', $s->fechaNacimiento);
            $mes = $fn->diff(Carbon::tomorrow())->m == 1 ? $fn->diff(Carbon::tomorrow())->m . ' mes' : $fn->diff(Carbon::tomorrow())->m . ' meses';
            $año = $fn->diff(Carbon::tomorrow())->y == 1 ? $fn->diff(Carbon::tomorrow())->y . ' año' : $fn->diff(Carbon::tomorrow())->y . ' años';
            $dia = $fn->diff(Carbon::tomorrow())->d == 1 ? $fn->diff(Carbon::tomorrow())->d . ' día' : $fn->diff(Carbon::tomorrow())->d . ' días';
            $students_ef[$s->id] = "{$año}, {$mes}, {$dia}";
        }

        $pdf = PDF::loadView('pdf.reporte-estudiantes-por-curso-cedula', compact(
            'institution', 'course', 'students', 'i', 'now', 'students_ef'
        ));

        if (request('varios') == '0') {
            return $pdf->download('Reporte por estudiantes por curso con cédula.pdf');
        } else {
            return $pdf->download('Reporte por estudiantes por curso con cédula y varios.pdf');
        }
    }

    public function reporteDatosCas(Course $course)
    {
        $i = 1;
        $institution = Institution::first();
        $students = Student2Profile::getStudentsByCourse($course->id);
        $pdf = PDF::loadView('pdf.reporte-de datos-cas', compact(
            'institution', 'course', 'students', 'i'
        ))->setOrientation('landscape');

        return $pdf->download('Reporte por estudiantes por curso con cédula.pdf');
    }

    public function reporteEstudiantesBecaCurso($course)
    {
        $course = Course::find($course);
        $i = 1;
        $institution = Institution::first();
        $students = Student2Profile::where('idCurso', $course->id)->where('tipo_matricula', 'Ordinaria')->where('retirado', '!=', 'SI')->get();
        $pdf = PDF::loadView('pdf.reporte-estudiantes-por-curso-con-beca', compact(
            'institution', 'course', 'students', 'i'
        ));

        return $pdf->download('Reporte de estudiantes con beca.pdf');
    }

    public function reporteCalificacionesAtrasadosPorParcial($parcial)
    {
        try {
            $institution = Institution::find(1);
            $periodo = PeriodoLectivo::getPeriodo($institution->periodoLectivo);
            $matters = Matter::getMattersByCourse($idCurso);
            $course = Course::find($idCurso);
            $students = Student2::getStudentsByCourse($idCurso);

            $promedios = [];
            $insumos = [];
            foreach ($matters as $matter) {
                $insumos[$matter->id] = Supply::getSuppliesByMatter($matter->id);
                $promedios[$matter->id] = Calificacion::getPromedioSupply($matter->id, $idCurso, $parcial);
            }
            $idDocentes = [];
            $hasStudents = false;
            foreach ($matters as $matter) {
                array_push($idDocentes, $matter->idDocente);
                foreach ($students as $student) {
                    foreach ($insumos[$matter->id] as $key => $insumo) {
                        if ($promedios[$matter->id][$insumo->id][$student->id]['promedio'] == 0) {
                            $hasStudents = true;
                        }

                    }
                }
            }

            if ($hasStudents) {
                $docentes = Administrative::whereIn('id', $idDocentes)->get();
                $pdf = PDF::loadView('pdf.pdf.acta-de-calificaciones-atrasados-por-parcial', compact('matters', 'promedios', 'insumos',
                    'docentes', 'parcial', 'students', 'institution', 'course', 'periodo'));

                return $pdf->download('Calificaciones Pendiente.pdf');
            } else {
                return Redirect::back()->withErrors(['login_fail' => 'No existen alumnos con calificaciones pendientes.']);
            }

            // $institution = Institution::first();
            // $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/pendientes/materias/parcial/'.$parcial)) );
            // return view('pdf.acta-de-calificaciones-atrasados-por-parcial', compact(
            //     'institution', 'data'
            // ));
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function documentosDeCobro()
    {
        try {
            $facturas = Factura::with('facturaDetalle', 'abonos', 'cliente')
                ->orderBy('numeroFactura', 'ASC')
                ->where('idPeriodo', $this->idPeriodoUser())
                ->whereDate('created_at', '>=', request('fechaInicio'))
                ->whereDate('created_at', '<=', request('fechaFin'))
                ->where('total', '>', 0)
                ->get();

            if ($facturas->isEmpty()) {
                throw new \Exception('No hay registros a generar en el reporte.');
            }

            // fechaInicio
            $fecha_dia = Carbon::createFromDate(substr(request('fechaInicio'), 0, 4), substr(request('fechaInicio'), 5, 2), substr(request('fechaInicio'), 8, 2))->day;
            $fecha_mes = Carbon::createFromDate(substr(request('fechaInicio'), 0, 4), substr(request('fechaInicio'), 5, 2), substr(request('fechaInicio'), 8, 2))->month;
            $fecha_anio = Carbon::createFromDate(substr(request('fechaInicio'), 0, 4), substr(request('fechaInicio'), 5, 2), substr(request('fechaInicio'), 8, 2))->year;
            $mes = Fechas::obtenerMes($fecha_mes);
            $fechaInicio = "$fecha_dia $mes $fecha_anio";

            // fechaFin
            $fecha_dia = Carbon::createFromDate(substr(request('fechaFin'), 0, 4), substr(request('fechaFin'), 5, 2), substr(request('fechaFin'), 8, 2))->day;
            $fecha_mes = Carbon::createFromDate(substr(request('fechaFin'), 0, 4), substr(request('fechaFin'), 5, 2), substr(request('fechaFin'), 8, 2))->month;
            $fecha_anio = Carbon::createFromDate(substr(request('fechaFin'), 0, 4), substr(request('fechaFin'), 5, 2), substr(request('fechaFin'), 8, 2))->year;

            $mes = Fechas::obtenerMes($fecha_mes);
            $fechaFin = "$fecha_dia $mes $fecha_anio";

            // fechaActual
            $mes = Fechas::obtenerMes(Carbon::now()->month);
            $fechaActual = Carbon::now()->day . " " . $mes . " " . Carbon::now()->year;

            $i = 1;
            $institution = Institution::first();
            $total = 0;
            $totalAbonos = 0;
            $totabonos = [];
            $ver = [];
            $abonosF = [];
            foreach ($facturas as $factura) {
                $ver[$factura->id] = true;
                $totabonos[$factura->id] = $factura->abonos->sum('cantidad');
                if ($totabonos[$factura->id] != $factura->total && !$factura->abonos->isEmpty()) {
                    $ver[$factura->id] = false;
                    $abonosF[$factura->id] = $factura;
                    $totalAbonos += $factura->abonos->sum('cantidad');
                }
                if ($ver[$factura->id] == true && $factura->estatus !== 'BAJA' && count($factura->facturaDetalle) > 0) {
                    $total += $factura->total;
                }
            }
            $pdf = PDF::loadView('pdf.listado-de-documentos-de-cobro', compact(
                'institution', 'data', 'facturas', 'i', 'fechaActual', 'fechaInicio', 'fechaFin', 'total', 'totabonos', 'ver',
                'abonosF', 'totalAbonos'
            ))->setOrientation('landscape');

            return $pdf->download('Listado de documentos de cobro.pdf');

        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function reporteInsumos(User $docente, $parcial)
    {
        $i = 1;
        $institution = Institution::first();
        $materias = Matter::where('idDocente', $docente->userid)->get();
        $fecha = Carbon::now()->format('Y/m/d');
        $totalR = 0;
        $totalP = 0;
        $totalActividades = 0;
        $totalActividadesRecibidas = 0;
        $totalActividadesPendientes = 0;

        $pdf = PDF::loadView('pdf.reporte-insumos', compact(
            'institution', 'parcial', 'materias', 'docente', 'fecha', 'i', 'totalActividades',
            'totalActividadesRecibidas', 'totalActividadesPendientes', 'totalR', 'totalP'
        ));

        return $pdf->download('Reporte Insumos.pdf');
    }

    public function reporteActaDeControlDeInsumos(Matter $materia, $parcial)
    {
        $valorInicial = 20;
        $valor = $valorInicial;
        $count = 1;
        $materias = Matter::where('id', $materia->id)->get();
        $course = Course::findOrFail($materia->idCurso);
        $institution = Institution::first();
        switch ($parcial) {
            case 'p1q1':
                $parcial = 'Primer Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p2q1':
                $parcial = 'Segundo Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p3q1':
                $parcial = 'Tercer Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p1q2':
                $parcial = 'Primer Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            case 'p2q2':
                $parcial = 'Segundo Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            case 'p3q2':
                $parcial = 'Tercer Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            default:
                break;
        }

        $pdf = PDF::loadView('pdf.acta-de-control-insumos', compact(
            'institution', 'parcial', 'materias', 'quimestre', 'count',
            'valorInicial', 'valor'
        ))->setOrientation('landscape');
        return $pdf->download("Acta de control de insumos({$course->grado} {$course->especializacion} {$course->paralelo} - {$materia->nombre}).pdf");

    }

    public function reporteActaDeControlDeInsumosDocente(User $docente, $parcial)
    {
        $valorInicial = 20;
        $valor = $valorInicial;
        $count = 1;
        $materias = Matter::where('idDocente', $docente->id)->get();
        $course = Course::findOrFail($materias->first()->idCurso);
        $institution = Institution::first();
        switch ($parcial) {
            case 'p1q1':
                $parcial = 'Primer Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p2q1':
                $parcial = 'Segundo Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p3q1':
                $parcial = 'Tercer Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p1q2':
                $parcial = 'Primer Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            case 'p2q2':
                $parcial = 'Segundo Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            case 'p3q2':
                $parcial = 'Tercer Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            default:
                break;
        }

        $pdf = PDF::loadView('pdf.acta-de-control-insumos', compact(
            'institution', 'parcial', 'materias', 'quimestre', 'count',
            'valorInicial', 'valor'
        ))->setOrientation('landscape');
        return $pdf->download("Acta de control de insumos({$course->grado} {$course->especializacion} {$course->paralelo}).pdf");

    }

    public function reporteActaDeControlDeInsumosCurso(Course $course, $parcial)
    {
        $valorInicial = 25;
        $valor = $valorInicial;
        $count = 1;
        $materias = Matter::where('idCurso', $course->id)->where('visible', 1)->get();
        $insumos = Supply::where('idCurso', $course->id)->where([
            ['nombre', '!=', 'EXAMEN QUIMESTRAL'],
            ['nombre', '!=', 'RECUPERATORIO'],
        ])->get();
        $activities = Activity::whereIn('idInsumo', $insumos->pluck('id'))->where('parcial', $parcial)->get();
        $calificaciones = Calificacion::whereIn('idInsumo', $insumos->pluck('id')->toArray())->get();
        $institution = Institution::first();
        switch ($parcial) {
            case 'p1q1':$parcial = 'Primer Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p2q1':$parcial = 'Segundo Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p3q1':$parcial = 'Tercer Parcial';
                $quimestre = 'Primer Quimestre';
                break;
            case 'p1q2':$parcial = 'Primer Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            case 'p2q2':$parcial = 'Segundo Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            case 'p3q2':$parcial = 'Tercer Parcial';
                $quimestre = 'Segundo Quimestre';
                break;
            default:break;
        }
        $pdf = PDF::loadView('pdf.acta-de-control-insumos', compact(
            'institution', 'parcial', 'materias', 'quimestre', 'count',
            'valorInicial', 'valor', 'insumos', 'activities', 'calificaciones'
        ))->setOrientation('landscape');
        return $pdf->download("Acta de control de insumos({$course->grado} {$course->especializacion} {$course->paralelo}).pdf");
    }

    public function certificadoEconomico(Student2 $student)
    {
        $student = Student2Profile::getStudent($student->id);
        $pagosPendientes = PagoEstudianteDetalle::getDetailPaymentsByStudent($student->idStudent, $student->idCurso)
            ->where('estado', 'PENDIENTE');
        $totalPagoPendiente = 0;
        $fecha = Carbon::now()->format('Y-m-d');
        $fecha = Fechas::fechaActual($fecha);
        foreach ($pagosPendientes as $pago) {
            $totalPagoPendiente += PagoEstudianteDetalle::descuento($pago);

        }
        $institution = Institution::first();

        $pdf = PDF::loadView('pdf.certificado-economico', compact(
            'institution', 'student', 'pagosPendientes', 'totalPagoPendiente', 'fecha'
        ));

        return $pdf->download("Reporte Económico({$student->apellidos} {$student->nombres}).pdf");
    }

    public function personasAutorizadas($id)
    {
        $institution = Institution::first();
        $student = Student2Profile::getStudent($id);
        $personasAutorizadas = PersonasAutorizadas::whereIn('id', $student->student->personasAutorizadas->pluck('id'))
            ->orderBy('nombres')
            ->get();
        $pdf = PDF::loadView('pdf.reporteInstitucionales.autorizacion-de-movilizacion', compact(
            'student', 'institution', 'personasAutorizadas'
        ));

        return $pdf->download("Autorización de Movilización Estudiantil({$student->apellidos} {$student->nombres}).pdf");
    }

    public function autorizacionFotosVideos($idEstudiante)
    {
        $fecha = Fechas::fechaActual();
        $student = Student2Profile::getStudent($idEstudiante);
        $institution = Institution::first();
        $pdf = PDF::loadView('pdf.autorizacion-fotos-videos', compact(
            'institution', 'student', 'fecha'
        ));

        return $pdf->download("Autorización de fotos y videos({$student->apellidos} {$student->nombres}).pdf");
    }

    public function datosVarios($idCurso)
    {

        $course = Course::findOrFail($idCurso);
        $institution = Institution::first();
        $students = Student2Profile::getStudentsByCourse($idCurso);

        $pdf = PDF::loadView('pdf.datosVarios', compact(
            'course', 'institution', 'students'
        ));

        return $pdf->download("Datos Varios({$course->grado} {$course->especializacion} {$course->paralelo}).pdf");
    }

    public function archivo1()
    {
        $pdf = PDF::loadView('pdf.observacion-ludica.archivo1');
        return $pdf->inline('archivo1.pdf');
    }

    public function archivo2()
    {
        $pdf = PDF::loadView('pdf.observacion-ludica.archivo2');
        return $pdf->inline('archivo2.pdf');
    }

    public function reporteSolicitud($id)
    {
        $count = 1;
        $solicitud = RequestUser::where('id', $id)->first();
        $pdf = PDF::loadView('pdf.solicitudes.solicitud', compact(
            'solicitud'));
            
        return  $pdf->stream("Reporte Global - $solicitud->ci_student $solicitud->id.pdf.pdf", array('Attachment' => false));
        //return $pdf->download("Solicitud Docente $solicitud->ci_student $solicitud->id.pdf");
    }
/*
    public function generarReporte(Request $request){
        dd($request->ciclo);
        $carrera = Career::find($request->carrera);
        $semestre = Semesters::find($request->semestre);
        $curso = course::find($request->curso);
        $materia = Matter::find($request->matters);
        $fecha = Carbon::now();
        
        $docente = User::select('nombres', 'apellidos')->where('id', $materia->idDocente)->first();
        //dd($docente);
        $pdf = PDF::loadView('pdf.reportes_calificaciones.acta_calificacion',compact('curso','carrera'
                                                            ,'semestre','materia','fecha','docente'));
        return $pdf->inline('archivo2.pdf');
    }
*/
    
    
}
