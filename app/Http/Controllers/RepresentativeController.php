<?php

namespace App\Http\Controllers;

use App\Comportamiento;
use Illuminate\Http\Request;
use App\Student2;
use Sentinel;
use App\Course;
use App\User;
use App\CourseSchedule;
use App\Matter;
use App\QuizSchedule;
use App\Activity;
use App\ActivityStudent;
use App\Supply;
use App\Administrative;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Lectionary;
use App\ClassDay;
use App\Calificacion;
use App\Pago;
use App\Deber;
use App\PagoRealizado;
use App\PaymentStudent;
use App\BecasYDescuentos;
use App\ConfiguracionSistema;
use App\Http\Controllers\parseInt;
use App\PagoEstudianteDetalle;
use App\Student2Profile;
use Exception;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use App\PeriodoLectivo;
use Illuminate\Support\Facades\Redirect;

class RepresentativeController extends Controller{

    public function getChildren(Request $request, $hijo){

        $preinscripcion = '';
        $gradoSiguiente = '';
        $nextYearCourse = '';
        $ModuloAdmisiones = ConfiguracionSistema::admisiones();// saber si estan habilitadas las admisiones
        $ActRepre = ConfiguracionSistema::ActRepre()->valor;
        $studiante = Student2::findOrFail($hijo);
        $hijo = Student2Profile::getStudent($hijo);
        abort_if(!$hijo, 404);
        $course = Course::findOrFail($hijo->idCurso);
        if( $ModuloAdmisiones != null){
            $SelectParalelo = ConfiguracionSistema::SelectParalelo($ModuloAdmisiones->idPeriodo)->valor;// saber se si pueden escojer los paralelos y especializaciones desde inscripción
            $ExisteEstNuevPeriodo = Student2Profile::where('idPeriodo',$ModuloAdmisiones->idPeriodo)
                ->where('idStudent', $hijo->idStudent)->exists();
            if (!$ExisteEstNuevPeriodo) {
                $preinscripcion = PeriodoLectivo::findOrFail($ModuloAdmisiones->idPeriodo);
                $gradoSiguiente = Calificacion::gradoSiguienteAdmision($course->grado);
                $paralelo = $course->paralelo != '' ? $course->paralelo : '';
                $especializacion = $course->especializacion != '' ? $course->especializacion : '';
                $nextYearCourse = Course::where('idPeriodo', $preinscripcion->id)
                    ->where('grado',$gradoSiguiente['buscar'])
                    ->when($SelectParalelo != '0', function ($q) use($paralelo, $especializacion,$SelectParalelo) {
                        return $q->where('paralelo',$paralelo)
                            ->when($especializacion != '' && $SelectParalelo == '2', function ($e) use($especializacion) {
                                return $e->where('especializacion',$especializacion);
                            });
                        })
                    ->get();
                if($nextYearCourse== null){//verifico si existe el curso y el paralelo correcto de lo contrario no muestro el boton en la vista
                    $nextYearCourse = '';
                    $preinscripcion = '';
                    $gradoSiguiente = '';
                }
            }
        }
        $user = Sentinel::getUser();
        $user_profile = Administrative::findBySentinelid($user->id);
		$mostrar_calificaciones = ConfiguracionSistema::calificaciones();
        $dia_pago = (int)ConfiguracionSistema::diaDePago()->valor;
        $habilitar_calificaciones = true;
        $contrato = ConfiguracionSistema::ContratoEconomico($this->idPeriodoUser())->valor;
        $pago = PagoEstudianteDetalle::getDetailPaymentsByStudent($hijo->idStudent, $course->id)->where('estado', '!=', 'PAGADO')->first();
        if ($pago != null)
            $pago = PagoEstudianteDetalle::find($pago->id);

        if($pago != null){
            $pago_mes = $pago->pago;
            if($pago->prorroga == null)
                $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago);
            else
                $fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes+1, $dia_pago+$pago->prorroga);
            $now = Carbon::now();
            if($now->greaterThan($fecha_pago)){
                $habilitar_calificaciones = false;
            }
        }
        //se realiza lo siguiente para determinar el nuevo año al cual sera preinscrito el estudiante

        try {
            //Se lo modifico por el error de usuario desfasado
            if($hijo->idRepresentante == $user_profile->id){
            //pertenece como representado
            return view('UsersViews.representante.hijo.index',
                compact('mostrar_calificaciones', 'hijo', 'course', 'habilitar_calificaciones','preinscripcion','studiante','nextYearCourse','gradoSiguiente','ModuloAdmisiones','ActRepre', 'contrato'));
            } else {
                //no pertenece como representado
                return redirect()->back()->with('message', [
                    'type' => 'warning', 'text' => "Solicitud Invalida."
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('message', [
                'type' => 'warning', 'text' => $e->getMessage()
            ]);
		}

    }

    //Funcion para ir al index(fecha del dia)
    public function getLectionaryChildern($hijo){
		$hijo = Student2Profile::getStudent($hijo);
        $hours = Lectionary::where('idCurso', $hijo->idCurso)
							->where('fecha', request('fecha'))
							->where('idPeriodo', $this->idPeriodoUser())
							->get();
		$matters = Matter::where('idCurso', $hijo->idCurso)->get();
        $course = Course::findOrFail($hijo->idCurso);
        $tutor = User::find($course->idProfesor);
        $classDays = ClassDay::all();

        return view('UsersViews.representante.agenda_escolar.index', compact('hijo', 'course', 'tutor', 'hours', 'matters', 'classDays'));
	}

    public function agendaSemanal($hijo){
		$hijo = Student2Profile::getStudent($hijo);
        $user_profile = Administrative::findBySentinelid(Sentinel::getUser()->id);
		$i = 1;
		$course = Course::find($hijo->idCurso);
		$tutor = User::find($course->idProfesor);
		$fecha1 = Carbon::createFromDate(substr(request('fecha'),0,4),substr(request('fecha'),5,2),substr(request('fecha'),8,2));
		$fecha2 = Carbon::createFromDate(substr(request('fecha'),0,4),substr(request('fecha'),5,2),substr(request('fecha'),8,2));
		$hours = Lectionary::whereBetween('fecha', [$fecha1->startOfWeek(), $fecha2->endOfWeek()])
			->where('idCurso', $course->id)
			->where('idPeriodo', $this->idPeriodoUser())
			->get();
		$schedulers = CourseSchedule::where('idCurso', $hijo->idCurso)
			->orderBy('horaInicio')
			->get();
		$matters = Matter::query()
			->where('idCurso', $hijo->idCurso)
			->where('idPeriodo', $this->idPeriodoUser())
			->get();
		$fechaActual = Carbon::now();

		return view('UsersViews.representante.agenda_escolar.semanal', compact(
			'i', 'schedulers', 'hours', 'matters', 'course', 'tutor', 'hijo'
		));
    }

    public function getAgendaPasada(Request $request, $id){
        $date = $request->fecha;

        $hijo = Student2::find($id);
        //Horas Clases
        $hours = Lectionary::where('idCurso', $hijo->idCurso)
                            ->where('fecha', $date)
                            ->get();

		$matters = Matter::where('idCurso', $hijo->idCurso)->get();
        $course = Course::findOrFail($hijo->idCurso);
        $tutor = User::find($course->idProfesor);
        $classDays = ClassDay::all();

        //return "Hola";
        return view('UsersViews.representante.agenda_escolar.agendaPasada', compact('hijo', 'course', 'tutor', 'classDays', 'date', 'hours', 'matters'));
    }

    public function configuracionHijo($id){
        try{
            $userR = Sentinel::getUser();
            $hijo = Student2Profile::getStudent($id);
            $representante = User::find($hijo->idRepresentante);
            if ($hijo->idRepresentante == null || $representante->userid!=$userR->id) {
                return redirect('/perfil');
            }
            $curso = Course::findOrFail($hijo->idCurso);
            $data = Student2::findOrFail($hijo->idStudent);
            if($data->idProfile==null){
            	$correo='';
            }else{
            	$user = User::findOrFail($data->idProfile);
            	$correo = $user->correo;
            }
            return view('UsersViews.representante.hijo.configuracion',compact(
				'hijo','curso','data','correo'
			));
        }catch (Exception $e) {
            return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "Algo salio mal." ]);
        }
    }

    public function postConfiguracionHijo(Request $request,$id){
		$student2P = Student2Profile::where('id', $id)->first();
		$student2 = Student2::find($student2P->idStudent);
		$user = User::find($student2->idProfile);
		$this->validate($request,[
			// 'ci' =>  'required|string|max:14',
			// 'nombres'    =>  'required|string|between:2,30',
			// 'apellidos'    =>  'required|string|between:2,30',
			// 'sexo'  =>  'required|in:Femenino,Masculino',
			// 'fNacimiento' =>  'required|date',
			'email'  =>  'required|email',
			// 'movil' =>  'string|max:10|nullable',
			// 'bio' =>  'string||between:3,300|nullable',
			// 'dDomicilio'  =>  'string|between:3,200|nullable',
			// 'tDomicilio'  =>  'string|max:30|nullable',
			'password'  =>  'string|min:3|max:20|nullable',
		]);
        try {
			if ($user->correo != $request->email){
				$user->correo = $request->email;
				$user->save();
			}
			if(isset($request->password) || isset($request->email) ){
				$user_Sentinel = Sentinel::findById($user->userid);
				$credentials = array();
				if(isset($request->email) && $user->correo != $request->email){
					$user_Sentinel->email = $request->email;
					$user_Sentinel->save();
				}
				if(isset($request->password)){
					$credentials['email'] = $request->email;
					$credentials['password'] = $request->password;
					Sentinel::update($user_Sentinel, $credentials);
				}
			}
			return redirect()->back()->with('message',['type'  => 'success','text' =>  "Usuario $user->nombres Actualizado." ]);
        } catch (Exception $e) {
            return redirect()->back()->with('message', ['type'=> 'danger', 'text' =>  "Algo salio mal." ]);
        }
    }

    public function getSchedulerChildern($hijo, $parcial){
		$hijo = Student2Profile::getStudent($hijo);
        $course = Course::findOrFail($hijo->idCurso);
		$tutor = User::find($course->idProfesor);
		$docentes = User::where('cargo', 'Docente')->get();
		$matters = Matter::where('idCurso', $hijo->idCurso)
			->where('idPeriodo', $this->idPeriodoUser())
			->get();
        if ($parcial == 'clases') {
			$schedules = CourseSchedule::where(['idCurso' => $course->id])
				->where('idPeriodo', $this->idPeriodoUser())
				->orderBy('horaInicio')
				->get();
		} else {
			$schedules = QuizSchedule::where(['idCurso' => $course->id, 'tipo' => $parcial])
				->where('idPeriodo', $this->idPeriodoUser())
				->orderBy('horaInicio')
				->get();
		}
        return view('UsersViews.representante.horario_de_clases.index', compact(
			'hijo', 'course', 'tutor', 'schedules', 'matters', 'docentes', 'parcial'
		));
    }

    public function getAsistenciaChildern($hijo){
		$hijo = Student2Profile::getStudent($hijo);
        $course = Course::findOrFail($hijo->idCurso);
		$tutor = User::find($course->idProfesor);
		$unidad = UnidadPeriodica::unidadP();
		$parcialP = ParcialPeriodico::all()->where('activo',1);
        return view('UsersViews.representante.asistencia.index', compact(
			'hijo', 'course', 'tutor', 'unidad', 'parcialP'
		));
    }

    public function getTareasChildren($hijo,$parcial){
        $user = Sentinel::getUser();
        $hijo = Student2Profile::getStudent($hijo);
        $representante = User::find($hijo->idRepresentante);
        if ($hijo->idRepresentante == null || $representante->userid!=$user->id) {
            return redirect('/perfil');
        }
		$deberes = Deber::where('idEstudiante', $hijo->idStudent)->get();
		$today = Carbon::today()->format('Y-m-d');
        $course = Course::findOrFail($hijo->idCurso);
		$tutor = User::find($course->idProfesor);
		$date = new Carbon();

		$activitiesInactive = DB::table('supplies')
			->join('matters', 'supplies.idMateria', '=', 'matters.id')
			->join('activities', 'supplies.id', '=', 'activities.idInsumo')
			->select('activities.id', 'matters.nombre as materia', 'activities.created_at',
				'supplies.nombre as insumo', 'activities.nombre as actividad', 'activities.fechaEntrega',
				'supplies.id as insumoId', 'matters.id as materiaId',
				'activities.adjuntos as adjunto', 'matters.idDocente')
			->whereDate('activities.fechaEntrega', '<', $today)
			->where('activities.parcial', $parcial)
			->where('supplies.idCurso', $course->id)
			->where('activities.idPeriodo', $this->idPeriodoUser())
			->orderBy('activities.fechaEntrega', 'DESC')
			->get();

		$activitiesActive = DB::table('supplies')
			->join('matters', 'supplies.idMateria', '=', 'matters.id')
			->join('activities', 'supplies.id', '=', 'activities.idInsumo')
			->select('activities.id', 'matters.nombre as materia', 'activities.created_at',
				'supplies.nombre as insumo', 'activities.nombre as actividad', 'activities.fechaEntrega',
				'supplies.id as insumoId', 'matters.id as materiaId',
				'activities.adjuntos as adjunto', 'matters.idDocente')
			->whereDate('activities.fechaInicio', '<=', $today)
			->whereDate('activities.fechaEntrega', '>=', $today)
			->where('activities.parcial', $parcial)
			->where('supplies.idCurso', $course->id)
			->where('activities.idPeriodo', $this->idPeriodoUser())
			->orderBy('activities.fechaEntrega', 'ASC')
			->get();

        return view('UsersViews.representante.tareas.index',
		compact('hijo', 'course', 'tutor', 'date','parcial', 'activitiesActive',
		'activitiesInactive', 'deberes'));
	}

    public function getTareaHijo(Activity $activity, Matter $matter, Supply $supply){
		$docente = User::where(['id' => $matter->idDocente])->first();
		return view('layouts.modals.RepresentanteTarea', compact(
			'activity', 'matter', 'docente', 'supply'
		));
    }

    public function getScoreChildren($hijo, $parcial) {
        if($parcial =='q1'){
            $parcial_search ='EXQ1';
        }elseif($parcial =='q2'){
              $parcial_search ='EXQ2';
        }else{
            $parcial_search = $parcial;
        }
        try {
            $user = Sentinel::getUser();
			$destrezas = "";
			$lectivo = Carbon::now();
			$dhi = ConfiguracionSistema::where('idPeriodo', $this->idPeriodoUser())->where('nombre', 'DHI')->first();
			$hijo = Student2Profile::getStudent($hijo);
			$student = Student2::where('id',$hijo->idStudent)->first();
            $mostrar_calificaciones = ConfiguracionSistema::calificaciones();
            $representante = User::find($hijo->idRepresentante);
            if ($hijo->idRepresentante == null || $representante->userid!=$user->id) {
				return redirect('/perfil');
			}
			if ($student->retirado=="SI") {
				throw new Exception('Estudiante retirado, comuníquese con colecturia.');
			}
			if ($hijo->bloqueado==1) {
				throw new Exception('Opcion inhabilitada, acerquese a colecturia.');
			}
			if ($mostrar_calificaciones->valor === '0') {
				throw new Exception('Usted no tiene acceso a calificaciones.');
			}
			$dia_pago = (int)ConfiguracionSistema::diaDePago()->valor;
            $habilitar_calificaciones = true;
			$pago = PagoEstudianteDetalle::getDetailPaymentsByStudent($hijo->idStudent, $hijo->idCurso)->where('estado', '!=', 'PAGADO')->first();
            if($pago != null && $dia_pago != 0) {
				$pago_mes = $pago->pago;
                if($pago->prorroga == null)
					$fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes, $dia_pago)->addMonths(1);
                else
					$fecha_pago = Carbon::createFromDate($pago_mes->anio, $pago_mes->mes, $dia_pago)->addMonths(1)->addDays($pago->prorroga);
				$now = Carbon::now();
                if($now->greaterThan($fecha_pago)){
                    throw new Exception('Opcion inhabilitada, acerquese a colecturia.');
                }
            }
            $examenQuimestral[]='null';
			$comportamiento = Comportamiento::where(['idStudent' => $hijo->idStudent, 'parcial' => strlen($parcial)==3 ? substr($parcial,0,2) : $parcial ])
				->where('idPeriodo', $this->idPeriodoUser())
				->first();
            $course = Course::findOrFail($hijo->idCurso);
            $tutor = User::find($course->idProfesor);
			$matters = Matter::getMattersByCourse( $hijo->idCurso);
			$matterDHI = Matter::where('area', 'DESARROLLO HUMANO INTEGRAL')->where('idCurso', $course->id)->where('visible', 'NO')->where('principal', 'NO')->first();
            $promediosmateria = [];
            $examenQuimestral = [];
            $mostrar_libreta = ConfiguracionSistema::mostrarLibretaRepresentante();
			$unidad = UnidadPeriodica::unidadP();
			$parciales = ParcialPeriodico::all()->where('activo',1);
			$PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
			$quimestre = ( strlen($parcial) == 2 ? $parcial : (strlen($parcial) < 4 ? substr($parcial,0,2) : substr($parcial,2,2) ) );
			if (strlen($parcial) < 4){
				$data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/quimestre/'.$quimestre.'/curso/'.$course->id)));
				$prm = $data->where('estudianteId', $hijo->idStudent)->first();
				$promediosmateria = new \Illuminate\Support\Collection($prm->materias);
			}else{
				$data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/libreta/periodo/'. $this->idPeriodoUser().'/parcial/'.(strlen($parcial) == 3 ? substr($parcial,0,2) : $parcial).'/curso/'.$course->id)));
				$prm = $data->where('estudianteId', $hijo->idStudent)->first();
				$promediosmateria = new \Illuminate\Support\Collection($prm->parcial);
			}
			if ($course->seccion == "EI"  || $course->grado=="Primero"){
				$destrezas = DB::table('destrezas')
                ->join('matters', 'destrezas.idMateria', '=', 'matters.id')
				->join('clasesdestrezas', 'clasesdestrezas.idDestrezas', '=', 'destrezas.id')
				->where('parcial', $parcial_search)
                ->where('matters.idCurso', $hijo->idCurso)
                ->select('destrezas.*', 'matters.id','clasesdestrezas.calificacion')
                ->get();
			}

			return view('UsersViews.representante.calificaciones.index', compact('hijo', 'course', 'tutor','matters',
				'promediosmateria','parcial', 'destrezas', 'mostrar_libreta', 'comportamiento', 'examenQuimestral',
				'matterDHI', 'dhi', 'unidad', 'parciales', 'PromedioInsumo', 'prm', 'quimestre'));
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['Factura' => $e->getMessage()]);
        }

    }

    public function getTareasInsumoChildren($alumno, $insumo, $parcial) {

		$activities = Activity::where(['idInsumo' => $insumo, 'parcial' => $parcial, 'calificado' => 1])->get();
        $notas = Calificacion::where(['idInsumo' => $insumo])->get();
		$supply = Supply::find($insumo);
		$materia = Matter::findOrFail($supply->idMateria)->nombre;
        $alumno = Student2Profile::getStudent($alumno);
        $course = Course::findOrFail($alumno->idCurso);
		$tutor = User::find($course->idProfesor);
		$data = new \Illuminate\Support\Collection(json_decode(file_get_contents('http://'. config('app.api_host_name') .':8081/promedio/periodo/'. $this->idPeriodoUser().'/parcial/'.$parcial.'/curso/'.$course->id.'/insumo/'.$insumo)));
		$calificaciones = $data->where('alumnoID', $alumno->idStudent)->first();
        return view('layouts.modals.detalleInsumo',
                compact( 'notas', 'activities', 'alumno', 'supply', 'course', 'tutor', 'parcial', 'materia' , 'calificaciones'));
    }

    public function getTareaRepresentante($id){
        return view('layouts.modals.ver');
    }
}