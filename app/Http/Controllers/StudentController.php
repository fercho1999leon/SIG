<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Administrative;
use App\ClassDay;
use App\Comportamiento;
use App\ConfiguracionSistema;
use App\Course;
use App\CourseSchedule;
use App\Deber;
use App\Http\Requests\estudiantes\TareasRequest;
use App\Lectionary;
use App\Matter; 
use App\PagoEstudianteDetalle;
use App\Student2;
use App\DocumentStudens;
use App\Student2Profile;
use App\Supply;
use App\UnidadPeriodica;
use App\User;
use App\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Calificacion;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\BibliotecaReportController;
use App\Cuentasporcobrar;
use Illuminate\Support\Facades\File;
use Sentinel;

class StudentController extends Controller
{
    public function calificaciones($parcial)
    {
        if(session('horaInicio') != null && session('user') != null){
            $sessionHora = new BibliotecaReportController;
            $sessionHora->sessionHora();
        }
        $promediogo = null; 
        $parcial_search = (strlen($parcial) == 4 ? strtoupper($parcial) : (strlen($parcial) == 2 ? ('EX' . (strtoupper(substr($parcial, 0, 2)))) : substr($parcial, 0, 2)));
        $porcentajeInsumos = ConfiguracionSistema::InsumoPorcentual()->valor;
        $diadepago = ConfiguracionSistema::diaDePago()->valor;
        $unidad = UnidadPeriodica::unidadP();
        $dhi = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())->where('nombre', 'DHI')->first();
        
        $user_profile = User::where('userid', Sentinel::getUser()->id)->first();
        $usuario = Student2::where('ci', $user_profile->ci)->where('idProfile', $user_profile->id)->first();
        $student = Student2Profile::getStudent($usuario->id);
        if ($student->bloqueado == 1) {
            return redirect()->back()->with('message', ['type' => 'warning', 'text' => "Opcion bloqueada. Comunicarse los más pronto posible con Colecturía."]);
        }
        // se valida si el estudiante tiene pagos pendientes
        $dia_pago = (int) ConfiguracionSistema::diaDePago()->valor;
        $habilitar_calificaciones = true;
        $pago = PagoEstudianteDetalle::getDetailPaymentsByStudent($student->idStudent, $student->idCurso)->where('estado', '!=', 'PAGADO')->first();
        if ($pago != null) {
            $pago = PagoEstudianteDetalle::find($pago->id);
        }

        if ($pago != null) {
            $pago_mes = $pago->pago;
            if ($pago->prorroga == null) {
                $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes + 1, $dia_pago);
            } else {
                $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes + 1, $dia_pago + $pago->prorroga);
            }

            $now = Carbon::now();
            if ($diadepago != 0 && $now->greaterThan($fecha_pago)) {
                $habilitar_calificaciones = false;
            }
        }
        //---------------------------------------------------------------------------------
        $comportamiento = Comportamiento::where([
            'idStudent' => $student->idStudent,
            'idPeriodo' => $this->idPeriodoUser(),
            'parcial' => strlen($parcial) == 3 ? substr($parcial, 0, 2) : $parcial])
            ->first();
        $course = Course::findOrFail($student->idCurso);
        $tutor = User::find($course->idProfesor);
        $matters = Matter::getMattersByCourse($course->id);
        $matterDHI = Matter::where('area', 'DESARROLLO HUMANO INTEGRAL')->where('idCurso', $course->id)->where('visible', 'NO')->where('principal', 'NO')->first();
        $quimestre = (strlen($parcial) == 2 ? $parcial : (strlen($parcial) < 4 ? substr($parcial, 0, 2) : substr($parcial, 2, 2)));
        $data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://' . config('app.api_host_name') . ':8081/libreta/periodo/' . $this->idPeriodoUser() . '/parcial/' . $parcial . '/curso/' . $course->id)));
        //dd($course,$matters,$promediogo);
        /*foreach($data as $studentLibretaPersonal)
        {
            if($studentLibretaPersonal->estudianteId == $student->idStudent)
            {
                $promediogo = $studentLibretaPersonal;                
    
            }

        }*/
        $promedioTotal = 0;
        //dd($data[0]);
        foreach($data as $libretaStudent)
        {
            foreach($libretaStudent->parcial as $parcialStudent)
            {
                $promedioTotal = 0;
                $recuperacionParcial = 0;
                $insumoRecuperacion = Supply::where(['nombre' => 'RECUPERATORIO', 'idMateria' => $parcialStudent->materiaId ])->first();
                if($parcialStudent->visible > 0 )
                {
                    foreach($parcialStudent->insumos as $insumoStudent)
                    {
                        if($insumoStudent->porcentaje >0)
                        {
                            $promedioTotal = $promedioTotal + ($insumoStudent->nota * ($insumoStudent->porcentaje / 100));
                        }                    
                    }    
                        
                }
                $parcialStudent->promedioFinal = $promedioTotal;
                if($insumoRecuperacion != null){

                    $activity = Activity::where(['idInsumo' => $insumoRecuperacion->id, 'parcial' => 'supletorio'])->first();
                    if($activity != null)
                    {
                        $calificacion = Calificacion::where(['idActividad' => $activity->id, 'idEstudiante' => $libretaStudent->estudianteId])->first();
                        if($calificacion != null)
                            $recuperacionParcial = $calificacion->nota;
                    }
                }
                $parcialStudent->recuperacion =  $recuperacionParcial;
            }
        }
        foreach($data as $studentLibretaPersonal)
        {
            if($studentLibretaPersonal->estudianteId == $student->idStudent)
            {
                $promediogo = $studentLibretaPersonal;                
    
            }

        }
        $ppp = 0;

        if ($promediogo != null) {
            $ppp = new \Illuminate\Support\Collection($promediogo->parcial);
        }

        
        $mostrar_libreta = ConfiguracionSistema::mostrarLibretaRepresentante();
        /* Destrezas del estudiante*/
        if ($course->seccion == "EI" || $course->grado == "Primero") {
            $destrezas = DB::table('destrezas')
                ->join('matters', 'destrezas.idMateria', '=', 'matters.id')
                ->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
                ->where('parcial', $parcial_search)
                ->where('matters.idCurso', $student->idCurso)
                ->select('destrezas.*', 'matters.id', 'clasesdestrezas.calificacion')
                ->get();
        }
        if ($habilitar_calificaciones == false) {
            return redirect('/perfil')->withErrors(['warning' => 'Por favor comuniquese con la institución.']);
        }
        return view('UsersViews.estudiante.calificaciones.index', compact('student', 'course', 'tutor', 'matters',
            'destrezas', 'parcial', 'comportamiento', 'matterDHI', 'dhi', 'ppp', 'porcentajeInsumos',
            'unidad', 'mostrar_libreta', 'promediogo', 'habilitar_calificaciones'));
    }

    public function getLectionary()
    {
        if(session('horaInicio') != null && session('user') != null){
            $sessionHora = new BibliotecaReportController;
            $sessionHora->sessionHora();
          }
        $user_profile = User::where('userid', Sentinel::getUser()->id)->first();
        //doble validacion porque en algunos casos el idProfile se repite en la tabla students2
        $usuario = Student2::where('ci', $user_profile->ci)
            ->where('idProfile', $user_profile->id)->first();
        $hijo = Student2Profile::getStudent($usuario->id);
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $hours = Lectionary::where('idCurso', $hijo->idCurso)
            ->where('fecha', request('fecha'))
            ->where('idPeriodo', $this->idPeriodoUser())
            ->get();
        $matters = Matter::where('idCurso', $hijo->idCurso)->get();
        $course = Course::findOrFail($hijo->idCurso);
        $tutor = User::find($course->idProfesor);
        $classDays = ClassDay::all();
        return view('UsersViews.estudiante.agenda.index', compact('hijo', 'course', 'tutor', 'date', 'hours', 'matters', 'classDays'));
    }

    public function agendaSemanal()
    {
        //$user_profile = Administrative::findBySentinelid(Sentinel::getUser()->id);//cambien la consulta por la de abajo
        $user_profile = User::where('userid', Sentinel::getUser()->id)->first();
        $hijo = Student2Profile::getStudent($user_profile->profileStudent->id);
        $student = Student2::where('idProfile', $user_profile->id)->first();
        $i = 1;
        $course = Course::find($hijo->idCurso);
        $tutor = User::find($course->idProfesor);
        $fecha1 = Carbon::createFromDate(substr(request('fecha'), 0, 4), substr(request('fecha'), 5, 2), substr(request('fecha'), 8, 2));
        $fecha2 = Carbon::createFromDate(substr(request('fecha'), 0, 4), substr(request('fecha'), 5, 2), substr(request('fecha'), 8, 2));

        $schedulers = CourseSchedule::where('idCurso', $student->idCurso)->orderBy('horaInicio')->get();
        $hours = Lectionary::whereBetween('fecha', [$fecha1->startOfWeek(), $fecha2->endOfWeek()])
            ->where('idPeriodo', $this->idPeriodoUser())
            ->where('idCurso', $course->id)
            ->get();
        $matters = Matter::where('idCurso', $course->id)->get();
        $fechaActual = Carbon::now();

        return view('UsersViews.estudiante.agenda.semanal', compact(
            'i', 'schedulers', 'hours', 'matters', 'student', 'course', 'tutor'
        ));
    }
    public function getAgendaPasadaStudent(Request $request)
    {
        $date = $request->fecha;
        $user_profile = Administrative::findBySentinelid(Sentinel::getUser()->id);
        $student = Student2::where('idProfile', $user_profile->id)->first();
        //Horas Clases
        $hours = Lectionary::where('idCurso', $student->idCurso)
            ->where('fecha', $date)
            ->get();

        $matters = Matter::where('idCurso', $student->idCurso)->get();
        $course = Course::findOrFail($student->idCurso);
        $tutor = User::find($course->idProfesor);
        $classDays = ClassDay::all();

        return view('UsersViews.estudiante.agenda.agendaPasada', compact('student', 'course', 'tutor', 'classDays', 'date', 'hours', 'matters'));
    }

    public function descargarTarea($archivo)
    {
        return response()->download(storage_path("app/public/deberes_adjuntos/{$archivo}"));
    }

    public function subirTareas(TareasRequest $request)
    {
        
        $student = Student2::findOrFail($request->idEstudiante);
        $estudiante = $this->limpiarString($student->nombres);
        foreach ($request->tareas_adjuntos as $key => $adjunto) {
            if ($adjunto != null) {
                $docente = Usuario::findOrFail($request->idProfesor[$key]);
                $deber = Deber::where(['idActividad' => $key,
                    'idEstudiante' => $request->idEstudiante,
                    'idPeriodo' => $this->idPeriodoUser(),
                    'idProfesor' => $docente->profile->id])
                    ->first();
                $datos_Actividad = Activity::findOrFail($deber->idActividad);
                $insumo = Supply::findOrFail($datos_Actividad->idInsumo);
                $materia = Matter::findOrFail($insumo->idMateria);
                $actividad = Activity::findOrFail($deber->idActividad);
                $carpeta = 'public/deberes_adjuntos/curso_' . $insumo->idCurso . '/' . substr($materia->nombre, 0, 25) . '/parcial_' . $datos_Actividad->parcial . '/Insumo_' . $datos_Actividad->idInsumo . '/' . substr($actividad->nombre, 0, 25);
                $extension = $request->tareas_adjuntos[$key]->extension();
                
                $name = $estudiante . '-' . time() . '.' . $extension;
                if ($deber == null) {
                    $deber = new Deber;
                    $deber->idActividad = $key;
                    $deber->idEstudiante = $request->idEstudiante;
                    $deber->idProfesor = $docente->profile->id;
                    $deber->idPeriodo = $this->idPeriodoUser();
                    //$nombre_adjunto = $adjunto->getClientOriginalName();
                    $nombre_adjunto = $name;
                    if ($deber->adjunto != '') {
                        $existe_deber = storage_path() . '/app/' . $carpeta . '/' . $deber->adjunto; //saber si el alumno tiene archivo en la carpeta de la actividad
                        if (file_exists($existe_deber)) {
                            unlink($existe_deber); // se elimina para guardar el proximo
                        }
                    }
                    $adjunto->storeAs($carpeta, $nombre_adjunto);
                    $deber->adjunto = $nombre_adjunto;
                    $deber->save();
                } else {
                    $deber->idActividad = $key;
                    $deber->idEstudiante = $request->idEstudiante;
                    $deber->idProfesor = $docente->profile->id;
                    $deber->enviado = 1;
                    $deber->bloqueo = 1;
                    $deber->disabled = 0;
                    $nombre_adjunto = $name;
                    //$nombre_adjunto = $adjunto->getClientOriginalName();
                    if ($deber->adjunto != '') {
                        $existe_deber = storage_path() . '/app/' . $carpeta . '/' . $deber->adjunto; //saber si el alumno tiene archivo en la carpeta de la actividad
                        if (file_exists($existe_deber)) {
                            unlink($existe_deber); // se elimina para guardar el proximo
                        }
                    }
                    $adjunto->storeAs($carpeta, $nombre_adjunto);
                    $deber->adjunto = $nombre_adjunto;
                    $deber->save();
                }
            }
        }
        return redirect()->back()->with('message', ['type' => 'info', 'text' => 'Tareas guardadas.']);
    }

    public function getTareas(Student2 $hijo, $parcial)
    {
        //dd($parcial);
        if(session('horaInicio') != null && session('user') != null){
            $sessionHora = new BibliotecaReportController;
            $sessionHora->sessionHora();
          }
    
        $user = Sentinel::getUser();
        if ($hijo->idProfile != null && (($user->id == $hijo->profile()->first()->user()->first()->id) || ($user->id == $hijo->representante()->first()->id))) {

            $correcto = '';
            $hijo = Student2Profile::getStudent($hijo->id);
          
            $student = Student2::find($hijo->idStudent);
            //dd($hijo->student()->first());
            $deberes = Deber::where('idEstudiante', $hijo->idStudent)
                ->where('idPeriodo', $this->idPeriodoUser())
                ->get();
                //dd($deberes);
            $course = Course::findOrFail($hijo->idCurso);
           // dd($course);
            $tutor = User::find($course->idProfesor);
            $today = Carbon::today()->format('Y-m-d');
            $activitiesInactive = DB::table('supplies')
                ->join('matters', 'supplies.idMateria', '=', 'matters.id')
                ->join('activities', 'supplies.id', '=', 'activities.idInsumo')
                ->select('activities.id', 'matters.nombre as materia', 'activities.created_at',
                    'supplies.nombre as insumo', 'activities.nombre as actividad', 'activities.fechaEntrega',
                    'supplies.id as insumoId', 'matters.id as materiaId',
                    'activities.adjuntos as adjunto', 'matters.idDocente','activities.parcial')
                ->whereDate('activities.fechaEntrega', '<', $today)
               // ->where('activities.parcial', $parcial)
                ->where('supplies.idCurso', $course->id)
                ->where('activities.idPeriodo', $this->idPeriodoUser())
                ->orderBy('activities.fechaEntrega', 'DESC')
                ->get();
           // dd( $activitiesInactive );
            $activitiesActive = DB::table('supplies')
                ->join('matters', 'supplies.idMateria', '=', 'matters.id')
                ->join('activities', 'supplies.id', '=', 'activities.idInsumo')
                ->select('activities.id', 'matters.nombre as materia', 'activities.created_at',
                    'supplies.nombre as insumo', 'activities.nombre as actividad', 'activities.fechaEntrega',
                    'supplies.id as insumoId', 'matters.id as materiaId',
                    'activities.adjuntos as adjunto', 'matters.idDocente')
                ->whereDate('activities.fechaInicio', '<=', $today)
                ->whereDate('activities.fechaEntrega', '>=', $today)
                //->where('activities.parcial', $parcial)
                ->where('supplies.idCurso', $course->id)
                ->where('activities.idPeriodo', $this->idPeriodoUser())
                ->orderBy('activities.fechaEntrega', 'ASC')
                ->get();

            $date = new Carbon();
           //    dd($activitiesActive);
            return view('UsersViews.estudiante.tareas.tareas',
                compact('hijo', 'course', 'tutor', 'deberes', 'today',
                    'date', 'parcial', 'activitiesActive', 'activitiesInactive'));
        } else {
            return redirect('/perfil');
        }
    }

    public function tareaEstudiante($activity, $matter, $supply)
    {
        $activity = Activity::find($activity);
        $matter = Matter::find($matter);
        $supply = Supply::find($supply);

        $docente = Usuario::find($matter->idDocente)->profile;

        return view('layouts.modals.RepresentanteTarea', compact(
            'activity', 'matter', 'docente', 'supply'
        ));
    }

    public function destroy(Student2 $student)
    {

        try {
            DB::beginTransaction();

                /*$pagos = PagoEstudianteDetalle::where('idEstudiante', $student->id)
                    ->where('idPeriodo', $this->idPeriodoUser())
                    ->get();
            
                $profileOfYear = Student2::getProfileOfYear($student->id);
                $DocumentsStudent = DocumentStudens::where('id_studen',$student->id)->get();    
                                    foreach ($DocumentsStudent as $document) {
                                        $document->delete();
                                    }   
                $profileStudent =  (Student2Profile::where('idStudent', $student->id))->get();
                if(count($profileStudent) < 2)
                {
                    $user_profile = User::where('id', $student->idProfile)->first();
                    $user = Sentinel::findById($user_profile->userid);
                    $DocumentsStudent = DocumentStudens::where('id_studen',$student->id)->get();  
                    foreach ($DocumentsStudent as $document) {
                        $document->delete();
                    }
                    foreach ($pagos as $pago) {
                        $pago->delete();
                    }
                 
                    $profileOfYear->delete();

                    $user->delete();
                    $student->delete();
                    $user_profile->delete();
                }else{
                    $profileOfYear->delete();
                }

            DB::commit();
            return redirect()->back()->with('message', [
                'type' => 'info', 'text' => "Alumno eliminado",
            ]);*/
            $profileOfYear = Student2::getProfileOfYear($student->id);
            $course = Course::findOrFail($profileOfYear->idCurso);
            $pagos = Cuentasporcobrar::where('cliente_id', $student->id)
                    ->where('id_semesters', $course->id_semester)
                    ->get();
            $DocumentsStudent = DocumentStudens::where('id_studen',$student->id)->get();   
            $profileStudent =  (Student2Profile::where('idStudent', $student->id))->get();
            if(count($profileStudent) < 2)
            {
                $user_profile = User::where('id', $student->idProfile)->first();
                $user = Sentinel::findById($user_profile->userid);
                $DocumentsStudent = DocumentStudens::where('id_studen',$student->id)->get();  
                foreach ($DocumentsStudent as $document){
                    //dd($document);
                    if(file_exists($document->url)){
                        File::delete($document->url);
                        $document->delete();
                    }
                }
                foreach ($pagos as $pago) {
                    $pago->delete();
                }
                
                $profileOfYear->delete();

                $user->delete();
                $student->delete();
                $user_profile->delete();
            }else{
                $profileOfYear->delete();
            }
            DB::commit();
            return redirect()->back()->with('message', [
                'type' => 'info', 'text' => "Alumno eliminado",
            ]);

            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function limpiarString($cadena)
    {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
        $texto = str_replace($no_permitidas, $permitidas, $cadena);
        return $texto;
    }

    public function conUnico($idStudent)
    {

    }

    public static function getStudent($idStudent)
    {
        return Student2Profile::getStudent($idStudent);
    }

    public static function getStudentsByCourse($idCurso)
    {
        return Student2Profile::getStudentsByCourse($idCurso);
    }

}
