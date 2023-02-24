<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use App\Administrative;
use App\Course;
use App\Matter;
use App\Student2;
use App\Supply;
use App\Activity;
use App\ActivityStudent;
use PDF;
use App\TeacherSchedule;
use App\Lectionary;
use App\ConfiguracionesParcial;
use App\ClassDay;
use Carbon\Carbon;
use App\Http\Requests\AgendaEscolarAdminRequest;
use App\Parcial;
use App\Institution;
use App\CourseSchedule;
use App\LeccionarioEstudiantil;
use App\Http\Requests\ActivityRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Notificaciones;
use App\Student2Profile;
use App\Traits\mensajeNotificaciones;
use App\QuizSchedule;
use App\UnidadPeriodica;

class LectionaryController extends Controller
{
	use mensajeNotificaciones;
    /*
        A D M I N I S T R A D O R 
    */
    //Administrador - Crear Hora Clase
    public function createHourClass($id, $idCurso){
		$fechaActual = Carbon::now()->format('Y-m-d');
        $dates = ClassDay::all();
        $matter = Matter::findOrFail($id);
        $courses = Course::getAllCourses();
		$course = Course::find($idCurso);
		$students = Student2Profile::getStudentsByCourse($idCurso);
        return view('UsersViews.administrador.grados.agenda.crearClase', compact(
			'matter', 'courses', 'dates', 'course', 'fechaActual',
			'students'
		));
    }

    //Administrador - Crear Hora Clase
    public function storeHourClass(AgendaEscolarAdminRequest $request, $id){
		$parcial_actual = ConfiguracionesParcial::parcialActual();
		if ($parcial_actual == null) {
			return Redirect::back()->withErrors(['login_fail' => 'No se pudo crear la actividad, no coincide con ninguna fecha en Configuraciones Parcial.']);
		}
		

        $data = new Lectionary();
        $data->idMateria   =$id;
        $data->idCurso     =$curso=Matter::getCourse($id);
        $data->fecha      =$request->fecha;
		$data->nombre      =$request->nombre;
		$data->idPeriodo = $this->idPeriodoUser();
		$data->descripcion =$request->descripcion;
		$data->linkVideo = $request->linkVideo;
        $data->observacion =$request->observacion;
		$data->parcial     =$parcial_actual;
		if ($request->hasFile('adjunto')) {
			$nombreAdjunto = request()->adjunto->getClientOriginalName();
			$nombreAdjunto = request()->adjunto->storeAs('public/adjuntos', $nombreAdjunto);
			$data->adjuntos = request()->adjunto->getClientOriginalName();
		}
		$data->save();
		// Creando notificacion
		$this->mensajeCrearActividadAgenda($data);
		return redirect()->route('editClaseAdministrador',['id' => $data->id, 'idCurso' => $data->idCurso, 'fecha='.$request->fecha])->with('message', ['type' => 'success', 'text' => 'Actividad creada con exito.']);
    }

    //Administrador - Editar Hora Clase
    public function editHourClass($id, $idCurso){
		try {
			$parcial_actual = strtoupper(ConfiguracionesParcial::parcialActual());
			$dates = ClassDay::all();
			$classDay = Lectionary::findOrFail($id);
			$observaciones = $classDay->observaciones()->where('parcial', $parcial_actual)->get();
			$observacionesId = [];
			foreach ($observaciones as $observacion) {
				array_push($observacionesId, $observacion->idEstudiante);
			}
			$matter = Matter::findOrFail($classDay->idMateria);
			$courses = Course::getAllCourses();
			$course = Course::find($idCurso);
			$students = DB::table('students2')
				->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
				->where('students2_profile_per_year.idCurso', $idCurso)
				->where('students2_profile_per_year.tipo_matricula', 'Ordinaria')
				->whereNotIn('students2.id', $observacionesId)
				->orderBy('apellidos', 'ASC')
				->get();
			return view('UsersViews.administrador.grados.agenda.editarClase', 
			compact('matter', 'courses', 'dates', 'classDay', 'id', 'course', 
			'students'));
		} catch (Exception $e) {
			return $e->getMessage();
		}
    }

    //Administrador - Actualizar Hora Clase
    public function updateHourClass(AgendaEscolarAdminRequest $request, $id){
		$data = Lectionary::findOrFail($id);
        $data->fecha       =$request->fecha;
        $data->nombre      =$request->nombre;
		$data->descripcion =$request->descripcion;
		$data->linkVideo = $request->linkVideo;
        $data->observacion =$request->observacion;
		
		if ($request->hasFile('adjunto')) {
			$nombreAdjunto = request()->adjunto->getClientOriginalName();
			$nombreAdjunto = request()->adjunto->storeAs('public/adjuntos', $nombreAdjunto);
			$data->adjuntos = request()->adjunto->getClientOriginalName();
		}
		foreach ($data->observacionEstudiantes as $observacion) {
			$observacion->update([
				'fecha' => request('fecha')
			]);
		}
        $data->save();
		$id = $id;

		// Creando notificacion
		$this->mensajeActualizarActividadAgenda($data);
        if (request('semanal') != null) {
			return redirect()->route('ver_CursoAgenda.semanal',['id' => $data->idCurso,'fecha='.$request->fecha]);
		} else {
			return redirect()->route('ver_CursoAgenda',['id' => $data->idCurso,'fecha='.$request->fecha]);
		}
    }

    //Administrador - Eliminar una Hora Clase
    public function destroyClaseAdministrador($id){
        $data = Lectionary::findOrFail($id);
        $curso=Matter::getCourse($data->idCurso);
        $data->delete();
        return back();
    }

	public function storeObservacionAdministrador(Lectionary $actividad, ActivityRequest $request) {
		if ($request->adjunto != null) {
			$nombre_adjunto = $request->adjunto->getClientOriginalName();
			$request->adjunto->storeAs('public/adjuntos', $nombre_adjunto);
		}

		$lectionarioEstudiantil = LeccionarioEstudiantil::create([
			'idEstudiante' => $request->estudiante,
			'idPeriodo' => Institution::first()->periodoLectivo,
			'idLectionary' => $actividad->id,
			'idPeriodo' => $this->idPeriodoUser(),
			'fecha' => request('fecha'),
			'adjunto' => $nombre_adjunto ?? null,
			'parcial' => $actividad->parcial,
			'observacion' => $request->estudiante_observacion
		]);
		
		// Notificación
		$this->mensajeAgendaObservacion($request->estudiante, $lectionarioEstudiantil);
		return Redirect::back()->with('message', ['type' => 'success', 'text' => 'Observación creada con éxito.']);
	}

	public function updateObservacionAdministrador(LeccionarioEstudiantil $observacion, ActivityRequest $request) {
		$fechaActual = Carbon::now()->format('Y-m-d');
		$parcial1 = ConfiguracionesParcial::query()
		->whereDate('p1q1FI', '<=', $fechaActual)
		->whereDate('p1q1FF', '>=', $fechaActual)
		->get();

		$parcial2 = ConfiguracionesParcial::query()
		->whereDate('p2q1FI', '<=', $fechaActual)
		->whereDate('p2q1FF', '>=', $fechaActual)
		->get();

		$parcial3 = ConfiguracionesParcial::query()
		->whereDate('p3q1FI', '<=', $fechaActual)
		->whereDate('p3q1FF', '>=', $fechaActual)
		->get();

		$parcial4 = ConfiguracionesParcial::query()
		->whereDate('p1q2FI', '<=', $fechaActual)
		->whereDate('p1q2FF', '>=', $fechaActual)
		->get();

		$parcial5 = ConfiguracionesParcial::query()
		->whereDate('p2q2FI', '<=', $fechaActual)
		->whereDate('p2q2FF', '>=', $fechaActual)
		->get();

		$parcial6 = ConfiguracionesParcial::query()
		->whereDate('p3q2FI', '<=', $fechaActual)
		->whereDate('p3q2FF', '>=', $fechaActual)
		->get();

		if(count($parcial1) != 0) {
			$parcial_actual = "P1Q1";
		} else if(count($parcial2) != 0) {
			$parcial_actual = "P2Q1";
		} else if(count($parcial3) != 0) {
			$parcial_actual = "P3Q1";
		} else if(count($parcial4) != 0) {
			$parcial_actual = "P1Q2";
		} else if(count($parcial5) != 0) {
			$parcial_actual = "P2Q2";
		} else if(count($parcial6) != 0) {
			$parcial_actual = "P3Q2";
		} else {
			return Redirect::back()->withErrors(['login_fail' => 'No se pudo crear la actividad, no coincide con ninguna fecha en Configuraciones Parcial.']);
		}
		if ($request->adjunto != null) {
			
		}
		if ($request->adjunto != null) {
			$nombre_adjunto = $request->adjunto->getClientOriginalName();
			$request->adjunto->storeAs('public/adjuntos', $nombre_adjunto);
			$observacion->adjunto = $nombre_adjunto;
			$observacion->save();
		}
		
		$observacion->update([
			'observacion' => $request->estudiante_observacion,
		]);
		// Notificación
		$this->mensajeActualizacionAgendaObservacion($request->idStudent, $observacion);
		return Redirect::back()->with('message', ['type' => 'success', 'text' => 'Observación actualizada con éxito.']);
	}
	public function destroyObservacionAdministrador(LeccionarioEstudiantil $observacion) {
		$observacion->delete();

		return Redirect::back();
	}

    /*
        D O C E N T E  
    */
    //Index
    public function lectionaryDocente(){
		$fechaActual = Carbon::now();
		$user = Sentinel::getUser();
		$unidad = UnidadPeriodica::unidadP();
		$tutor = Administrative::where(['userid' => $user->id, 'cargo' => 'Docente'])->first();
		$infouser = TeacherSchedule::where('idProfesor', $user->id)
			->where('idPeriodo', $this->idPeriodoUser())
			->orderBy('horaInicio')
			->get();

        $matters = Matter::getMattersByProfessor($user->id);
        $courses = Course::whereIn('id', $matters->pluck('idCurso'))->get();
		$schedulers = QuizSchedule::where('idPeriodo', $this->idPeriodoUser())
			->where('idCurso',$courses->pluck('id'))
			->orderBy('horaInicio')
			->get();
		$hours = Lectionary::query()
            ->fecha(request('fecha'))
            ->where('idPeriodo', $this->idPeriodoUser())
            ->get();
		//dd($matters->pluck('idCurso'));
		return view('UsersViews.docente.agenda.index', compact('schedulers', 'courses', 'matters', 'hours', 
			'fechaActual', 'user', 'tutor', 'infouser', 'unidad'));
    }
    //Semanal
    public function lectionaryDocenteSemanal(){
		$i = 1;
		$user = Sentinel::getUser();
		$matters = Matter::getMattersByProfessor($user->id);
		$course = Course::find($matters->first()->idCurso);
		$fecha1 = Carbon::createFromDate(substr(request('fecha'),0,4),substr(request('fecha'),5,2),substr(request('fecha'),8,2));
		$fecha2 = Carbon::createFromDate(substr(request('fecha'),0,4),substr(request('fecha'),5,2),substr(request('fecha'),8,2));
		$hours = Lectionary::whereBetween('fecha', [$fecha1->startOfWeek(), $fecha2->endOfWeek()])->get();
		$schedulers = CourseSchedule::where('idCurso', $matters->first()->idCurso)
			->where('idPeriodo', $this->idPeriodoUser())
			->orderBy('horaInicio')
			->get();
		$courses = Course::getAllCourses();
		$fechaActual = Carbon::now();

        return view('UsersViews.docente.agenda.semanal', compact(
			'schedulers', 'courses', 'matters', 'hours', 'fechaActual', 'i', 'course'
		));
    }
    //Crear hora clase
    public function crearHora($id){
        $user = Sentinel::getUser(); 
        $dates = ClassDay::all();
        $matter = Matter::findOrFail($id);
        /*Esta variable es para hacer una verificación si el docente es tutor, es importante incluirla*/
        $courses = Course::getAllCourses();
        return view('UsersViews.docente.agenda.crearClase', compact('dates', 'matter', 'courses'));
    }
    //Crear hora clase
    public function storeHora(AgendaEscolarAdminRequest $request, $id) {
		//dd($request);
		$fechaActual = Carbon::now()->format('Y-m-d');
		$parcial1 = ConfiguracionesParcial::query()
		->whereDate('p1q1FI', '<=', $fechaActual)
		->whereDate('p1q1FF', '>=', $fechaActual)
		->get();

		$parcial2 = ConfiguracionesParcial::query()
		->whereDate('p2q1FI', '<=', $fechaActual)
		->whereDate('p2q1FF', '>=', $fechaActual)
		->get();

		$parcial3 = ConfiguracionesParcial::query()
		->whereDate('p3q1FI', '<=', $fechaActual)
		->whereDate('p3q1FF', '>=', $fechaActual)
		->get();

		$parcial4 = ConfiguracionesParcial::query()
		->whereDate('p1q2FI', '<=', $fechaActual)
		->whereDate('p1q2FF', '>=', $fechaActual)
		->get();

		$parcial5 = ConfiguracionesParcial::query()
		->whereDate('p2q2FI', '<=', $fechaActual)
		->whereDate('p2q2FF', '>=', $fechaActual)
		->get();

		$parcial6 = ConfiguracionesParcial::query()
		->whereDate('p3q2FI', '<=', $fechaActual)
		->whereDate('p3q2FF', '>=', $fechaActual)
		->get();
		//dd($parcial1,$parcial2,$parcial3,$parcial4,$parcial5,$parcial6);
		if(count($parcial1) != 0) {
			$parcial_actual = "p1q1";
		} else if(count($parcial2) != 0) {
			$parcial_actual = "p2q1";
		} else if(count($parcial3) != 0) {
			$parcial_actual = "p3q1";
		} else if(count($parcial4) != 0) {
			$parcial_actual = "p1q2";
		} else if(count($parcial5) != 0) {
			$parcial_actual = "p2q2";
		} else if(count($parcial6) != 0) {
			$parcial_actual = "p3q2";
		} /*else {
			dd($parcial_actual);
			return Redirect::back()->withErrors(['login_fail' => 'No se puede crear la actividad, por favor, comunicarse con administración.']);
		}*/
		//dd($parcial_actual);
        $data = new Lectionary();
        $data->idMateria   =$id;
        $data->idCurso     =$curso=Matter::getCourse($id);
        $data->fecha      =$request->fecha;
		$data->nombre      =$request->nombre;
		$data->idPeriodo = $this->idPeriodoUser();
		$data->linkVideo = $request->linkVideo;
        $data->descripcion =$request->descripcion;
        $data->observacion =$request->observacion;
        //$data->parcial     =$parcial_actual;
		$data->parcial     =1;
		if ($request->hasFile('adjunto')) {
			$nombreAdjunto = request()->adjunto->getClientOriginalName();
			$nombreAdjunto = request()->adjunto->storeAs('public/adjuntos', $nombreAdjunto);
			$data->adjuntos = request()->adjunto->getClientOriginalName();
		}

		$data->save();
		//dd($data);
		// Creando nueva tarea o actividad
		$this->mensajeCrearActividadAgenda($data);

        return redirect()->route('agenda_Docente_editHora', [$data->id, 'fecha='.$request->fecha]);
    }
    //Editar hora clase
    public function editHora($id) {
		$classDay = Lectionary::findOrFail($id);
		$parcial_actual = strtoupper(ConfiguracionesParcial::parcialActual());
        $dates = ClassDay::all();
		$matter = Matter::findOrFail($classDay->idMateria);
		$course = Course::find($matter->idCurso);
		$observaciones = $classDay->observaciones()->where('parcial', $parcial_actual)->get();
		$observacionesId = [];
		foreach ($observaciones as $observacion) {
			array_push($observacionesId, $observacion->idEstudiante);
		}
		$students = DB::table('students2')
			->join('students2_profile_per_year', 'students2.id', '=', 'students2_profile_per_year.idStudent')
			->where('students2_profile_per_year.idCurso', $course->id)
			->where('students2_profile_per_year.tipo_matricula', 'Ordinaria')
			->whereNotIn('students2.id', $observacionesId)
			->orderBy('apellidos', 'ASC')
			->get();
        $courses = Course::getAllCourses();
        return view('UsersViews.docente.agenda.editarClase', compact('dates', 'matter', 'courses', 'course', 'classDay', 'students'));
    }
    //Actualizar hora clase
    public function updateHora(AgendaEscolarAdminRequest $request, $id){
		$fechaActual = Carbon::now()->format('Y-m-d');
		/*$parcial1 = ConfiguracionesParcial::query()
		->whereDate('p1q1FI', '<=', $fechaActual)
		->whereDate('p1q1FF', '>=', $fechaActual)
		->get();

		$parcial2 = ConfiguracionesParcial::query()
		->whereDate('p2q1FI', '<=', $fechaActual)
		->whereDate('p2q1FF', '>=', $fechaActual)
		->get();

		$parcial3 = ConfiguracionesParcial::query()
		->whereDate('p3q1FI', '<=', $fechaActual)
		->whereDate('p3q1FF', '>=', $fechaActual)
		->get();

		$parcial4 = ConfiguracionesParcial::query()
		->whereDate('p1q2FI', '<=', $fechaActual)
		->whereDate('p1q2FF', '>=', $fechaActual)
		->get();

		$parcial5 = ConfiguracionesParcial::query()
		->whereDate('p2q2FI', '<=', $fechaActual)
		->whereDate('p2q2FF', '>=', $fechaActual)
		->get();

		$parcial6 = ConfiguracionesParcial::query()
		->whereDate('p3q2FI', '<=', $fechaActual)
		->whereDate('p3q2FF', '>=', $fechaActual)
		->get();
		if(count($parcial1) != 0) {
			$parcial_actual = "p1q1";
		} else if(count($parcial2) != 0) {
			$parcial_actual = "p2q1";
		} else if(count($parcial3) != 0) {
			$parcial_actual = "p3q1";
		} else if(count($parcial4) != 0) {
			$parcial_actual = "p1q2";
		} else if(count($parcial5) != 0) {
			$parcial_actual = "p2q2";
		} else if(count($parcial6) != 0) {
			$parcial_actual = "p3q2";
		} *//*else {
			return Redirect::back()->withErrors(['login_fail' => 'No se puede crear la actividad, por favor, comunicarse con administración.']);
		}
		dd('here');*/

        $data = Lectionary::findOrFail($id);
        $data->fecha       =$request->fecha;
        $data->nombre      =$request->nombre;
		$data->descripcion =$request->descripcion;
		$data->linkVideo = $request->linkVideo;
        $data->observacion =$request->observacion;
		//$data->parcial     =$parcial_actual;
		if ($request->hasFile('adjunto')) {
			$nombreAdjunto = request()->adjunto->getClientOriginalName();
			$nombreAdjunto = request()->adjunto->storeAs('public/adjuntos', $nombreAdjunto);
			$data->adjuntos = request()->adjunto->getClientOriginalName();
		}
        $data->save();

		foreach ($data->observacionEstudiantes as $observacion) {
			$observacion->update([
				'fecha' => request('fecha')
			]);
		}
		// Creando notificacion
		$this->mensajeActualizarActividadAgenda($data);
		
		if ($request->semanal != null) {
			return redirect()->route('agenda_Docente.semanal', 'fecha='.$request->fecha);
		} else {
			return redirect()->route('agenda_Docente','fecha='.$request->fecha);
		}
    }
    //Eliminar hora clase
    public function deleteHora($id){
        $data = Lectionary::findOrFail($id);
        $curso=Matter::getCourse($data->idCurso);
		$parcial = $data->parcial;


        $data->delete();         

        return redirect()->route('agenda_Docente', 'fecha='.request('fecha'));
    }

    public function getCourse() {
        $course = Course::find(2);
        return view('UsersViews.administrador.grados.agenda.agendaCurso', compact('course'));
    }

	public function storeObservacion(Lectionary $actividad, ActivityRequest $request) {
		if ($request->adjunto != null) {
			$nombre_adjunto = $request->adjunto->getClientOriginalName();
			$request->adjunto->storeAs('public/adjuntos', $nombre_adjunto);
		}
		$lectionarioEstudiantil = LeccionarioEstudiantil::create([
			'idEstudiante' => $request->estudiante,
			'idPeriodo' => Institution::first()->periodoLectivo,
			'idLectionary' => $actividad->id,
			'fecha' => request('fecha'),
			'adjunto' => $nombre_adjunto ?? null,
			'parcial' => $actividad->parcial,
			'observacion' => $request->estudiante_observacion
		]);
		
		// Notificación
		$this->mensajeAgendaObservacion($lectionarioEstudiantil->idEstudiante, $lectionarioEstudiantil);
		
		return Redirect::back()->with('message', ['type' => 'success', 'text' => 'Observación creada con éxito.']);
	}
	
	public function updateObservacion(LeccionarioEstudiantil $observacion, ActivityRequest $request) {
		if ($request->adjunto != null) {
			$nombre_adjunto = $request->adjunto->getClientOriginalName();
			$request->adjunto->storeAs('public/adjuntos', $nombre_adjunto);
			$observacion->adjunto = $nombre_adjunto;
			$observacion->save();
		}
		$observacion->update([
			'observacion' => $request->estudiante_observacion,
		]);
		$this->mensajeActualizacionAgendaObservacion($observacion->idEstudiante, $observacion);
		
		return Redirect::back()->with('message', ['type' => 'success', 'text' => 'Observación actualizada con éxito.']);
	}

	public function destroyObservacion(LeccionarioEstudiantil $observacion) {
		$observacion->delete();

		return Redirect::back();
	}




    /*
        A D M I N I S T R A D O R  --- D O C E N T E
    */
    
    //Administrador-Docente  Index
    public function lectionaryDocente_A(){
        $user = Sentinel::getUser();
        $schedulers = TeacherSchedule::where('idProfesor', $user->id)->orderBy('horaInicio')->get();
        $courses = Course::getAllCourses();
        $matters = Matter::where('idDocente', $user->id)->get();
        $hours = Lectionary::all();

        return view('UsersViews.administrador.grados.agenda.misClases.index', compact('schedulers', 'courses', 'matters', 'hours'));
    }

    //Crear Hora Clase
    public function create($id){
        $dates = ClassDay::all();
        $matter = Matter::findOrFail($id);
        /*Esta variable es para hacer una verificación si el docente es tutor, es importante incluirla*/
        $courses = Course::getAllCourses();

        return view('UsersViews.administrador.grados.agenda.misClases.crearClase', compact('dates', 'matter', 'courses'));
        return "Hola";
    }

    //Crear Hora Clase 
    public function store(Request $request, $id){
        $data = new Lectionary();

        $data->idMateria   =$id;
        $data->idCurso     =$curso=Matter::getCourse($id);
        $data->fecha      =$request->fecha;
        $data->nombre      =$request->nombre;
        $data->descripcion =$request->descripcion;
        $data->observacion =$request->observacion;
        $data->parcial     =$request->parcial;

        $data->save();
        return redirect()->route('agenda_MisClases');
    }

    //Editar Hora Clase
    public function edit($id){
        $classDay = Lectionary::findOrFail($id);

        $dates = ClassDay::all();
        $matter = Matter::findOrFail($classDay->idMateria);
        $courses = Course::getAllCourses();

        return view('UsersViews.administrador.grados.agenda.misClases.editarClase', compact('dates', 'matter', 'courses', 'classDay'));
    }

    //Editar Hora Clase
    public function update(Request $request, $id){
        $data = Lectionary::findOrFail($id);

       
        $data->fecha       =$request->fecha;
        $data->nombre      =$request->nombre;
        $data->descripcion =$request->descripcion;
        $data->observacion =$request->observacion;
        $data->parcial     =$request->parcial;
        
		$data->save();
        return redirect()->route('agenda_MisClases');
    }

    //Eliminar Hora Clase
    public function destroy($id){
        $data = Lectionary::findOrFail($id);
        $curso=Matter::getCourse($data->idCurso);
        $data->delete();

        return redirect()->route('agenda_MisClases');
    }

	/** Reporte Diario Administrador*/
	public function reporteDiario(Course $course) {
		$hours = Lectionary::query()
			->where(['idCurso'=> $course->id])
			->fecha(request('fecha'))
			->get();
		$tutor = Administrative::where('id', $course->id)->first();
		$schedulers = CourseSchedule::where('idCurso', $course->id)->orderBy('horaInicio')->get();
        $matters = Matter::where('idCurso', $course->id)->get();
		$institution = Institution::first();
		$observaciones = LeccionarioEstudiantil::all();
		if ($hours->isNotEmpty()) {
			$pdf = PDF::loadView('pdf.reporte-agenda-escolar', compact(
				'institution', 'hours', 'schedulers', 'matters', 'course', 'tutor', 'observaciones'
			));
			return $pdf->download('Reporte Agenda Escolar.pdf');
		} else {
			return Redirect::back()->withErrors(['login_fail' => 'No existe ningun ninguna actividad creada.']);
		}
	}

	/** Reporte Diario Docente*/
	public function reporteDiarioDocente(Administrative $docente) {
		$fechaActual = Carbon::now()->format('Y-m-d');
		$parcial1 = ConfiguracionesParcial::query()
		->whereDate('p1q1FI', '<=', $fechaActual)
		->whereDate('p1q1FF', '>=', $fechaActual)
		->get();

		$parcial2 = ConfiguracionesParcial::query()
		->whereDate('p2q1FI', '<=', $fechaActual)
		->whereDate('p2q1FF', '>=', $fechaActual)
		->get();

		$parcial3 = ConfiguracionesParcial::query()
		->whereDate('p3q1FI', '<=', $fechaActual)
		->whereDate('p3q1FF', '>=', $fechaActual)
		->get();

		$parcial4 = ConfiguracionesParcial::query()
		->whereDate('p1q2FI', '<=', $fechaActual)
		->whereDate('p1q2FF', '>=', $fechaActual)
		->get();

		$parcial5 = ConfiguracionesParcial::query()
		->whereDate('p2q2FI', '<=', $fechaActual)
		->whereDate('p2q2FF', '>=', $fechaActual)
		->get();

		$parcial6 = ConfiguracionesParcial::query()
		->whereDate('p3q2FI', '<=', $fechaActual)
		->whereDate('p3q2FF', '>=', $fechaActual)
		->get();

		if(count($parcial1) != 0) {
			$parcial = "p1q1";
		} else if(count($parcial2) != 0) {
			$parcial = "p2q1";
		} else if(count($parcial3) != 0) {
			$parcial = "p3q1";
		} else if(count($parcial4) != 0) {
			$parcial = "p1q2";
		} else if(count($parcial5) != 0) {
			$parcial = "p2q2";
		} else if(count($parcial6) != 0) {
			$parcial = "p3q2";
		}
		$matters = Matter::where('idDocente', $docente->id)->get();
		$materiasIdCurso = [];
		foreach ($matters->groupBy('idCurso') as $key => $matter) {
			array_push($materiasIdCurso, $key);
		}
		$courses = Course::whereIn('id',$materiasIdCurso)->get();
		$institution = Institution::first();
		$materiasId = [];
		foreach ($matters as $materia) {
			array_push($materiasId, $materia->id);
		}
		$hours = Lectionary::query()
			->whereIn('idMateria', $materiasId)
			->fecha(request('fecha'))
			->get();
		if ($hours->isNotEmpty()) {
			$pdf = PDF::loadView('pdf.reporte-agenda-escolar-docente', compact(
				'institution', 'hours', 'schedulers', 'matters', 'docente', 'courses', 'parcial'
			));
			return $pdf->download('Reporte Agenda Escolar.pdf');
		} else {
			return Redirect::back()->withErrors(['login_fail' => 'No existe ningun ninguna actividad creada.']);
		}
	}
}
