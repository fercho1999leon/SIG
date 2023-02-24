<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use App\Administrative;
use App\Course;
use App\TeacherSchedule;
use App\Matter;
use App\Usuario;
use App\User;
use Illuminate\Support\Facades\DB;
use App\UnidadPeriodica;
use App\QuizSchedule;

use App\CourseSchedule;


class TeacherScheduleController extends Controller
{
    /*
        CRUD de horario del docente
	*/
	public function adminHorarioStore(Request $request, Usuario $user) {
		$data= json_decode($request->jsonString,true);

		for ($i=0;$i<$request->count;$i++){
		  $idSchedule= $data['schedule_id'. ($i+1)];
		  $schedule = TeacherSchedule::find($idSchedule);
		  if($schedule){
			$courseSchedule = TeacherSchedule::find($idSchedule);
			$courseSchedule->horaInicio=$data['horaInicio'. ($i+1)];
			$courseSchedule->horaFin=$data['horaFin'. ($i+1)];
			$courseSchedule->idDia1=$data['selectLun'. ($i+1)];
			$courseSchedule->idDia2=$data['selectMar'. ($i+1)];
			$courseSchedule->idDia3=$data['selectMier'. ($i+1)];
			$courseSchedule->idDia4=$data['selectJue'. ($i+1)];
			$courseSchedule->idDia5=$data['selectVie'. ($i+1)];
			$subjectSab= DB::table('matters')->where('id', $data['selectSab'. ($i+1)])->first();
  
			if(empty($subjectSab)){
			  $courseSchedule->idDia6='0';
			}
			else{
			  $courseSchedule->idDia6=$data['selectSab'. ($i+1)];
			}
  
			$courseSchedule->idProfesor= $user->profile->id;
  
			$courseSchedule->save();
  
		  }
		  else{
			$courseSchedule= new TeacherSchedule();
  
			$courseSchedule->horaInicio=$data['horaInicio'. ($i+1)];
			$courseSchedule->horaFin=$data['horaFin'. ($i+1)];
			$courseSchedule->idDia1=$data['selectLun'. ($i+1)];
			$courseSchedule->idDia2=$data['selectMar'. ($i+1)];
			$courseSchedule->idDia3=$data['selectMier'. ($i+1)];
			$courseSchedule->idDia4=$data['selectJue'. ($i+1)];
			$courseSchedule->idDia5=$data['selectVie'. ($i+1)];

			$subjectSab= DB::table('matters')->where('id', $data['selectSab'. ($i+1)])->first();
			if(empty($subjectSab)){
			  $courseSchedule->idDia6='0';
			}
			else{
			  $courseSchedule->dia6=$data['selectSab'. ($i+1)];
			}
			$courseSchedule->idProfesor = $user->profile->id;
			$courseSchedule->save();
		  }
		}
	}

	public function adminHorarioDestroy(TeacherSchedule $courseSchedule, Usuario $user) {
		$courseSchedule->delete();

		return redirect()->route('fichaDocenteHorario', $user->profile->id);
	}
	public function indexHorario(Usuario $user) {
		$course = Course::where('idProfesor', $user->id)->first();
		$courseSchedules = TeacherSchedule::where('idProfesor', $user->id)->orderBy('horaInicio')->get();
		$subjects= Matter::getMattersByProfessor($user->id);
		return view('UsersViews.administrador.fichasPersonales.Docente.horario.index', compact(
			'course', 'courseSchedules', 'subjects', 'user'
		));
	}

    public function home() {
		$user = Sentinel::getUser();
		$schedulers = TeacherSchedule::query()
			->where('idProfesor', $user->id)
			->where('idPeriodo', $this->idPeriodoUser())
			->orderBy('horaInicio')
			->get();
        $courses = Course::getAllCourses();
        $matters = Matter::where('idDocente', $user->id)->get();
		dd($matters);
    	return view('UsersViews.docente.horarios.index', compact('user', 'schedulers', 'courses', 'matters'));
    }

	//FUNCION DE PRUEBA PARA CAMBIAR HORARIO DE DOCENTE

	public function homev2(Request $request){
		$user = Sentinel::getUser();
		$unidad = UnidadPeriodica::unidadP();
		$parcial = $request->parcial;
		$infouser = TeacherSchedule::query()
			->where('idProfesor', $user->id)
			->orderBy('horaInicio')
			->get();
		/*$schedulers = QuizSchedule::where('idPeriodo', $this->idPeriodoUser())
		->where('tipo',$parcial)
		->orderBy('horaInicio')
		->get();*/
		$matters = Matter::where('idDocente',$user->id)->get();
        $courses = Course::query()
					->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
					->whereIn('id',$matters->pluck("idCurso"))
					->where('id_career', '!=', 'null')
					->get();
		$schedulers = Matter::join('courses','matters.idCurso','=','courses.id')
					->join('quiz_schedule','courses.id','=','quiz_schedule.idCurso')
					->where('matters.idDocente',Sentinel::getUser()->id)
					->where('quiz_schedule.tipo',$parcial)
					->where('quiz_schedule.idPeriodo',$this->idPeriodoUser())
					->orderBy('quiz_schedule.horaInicio')
					->groupBy('quiz_schedule.horaInicio')
					->get();
		//dd($schedulers,$matters,$courses);
    	return view('UsersViews.docente.horarios.index', compact('user', 'schedulers', 'courses', 'matters', 'infouser', 'unidad', 'parcial'));
	}

    public function create($id){
		$user = Sentinel::getUser();
        $matters = Matter::getMattersByProfessorSchedule($user->id); 
        $courses = Course::getAllCourses();

        return view('UsersViews.docente.horarios.horarioCrear', compact('user','matters', 'courses'));
    }

    public function store(Request $request){
        $user = Sentinel::getUser(); 
        $data = new TeacherSchedule();

        $data->horaInicio = $request->horaInicio;
		$data->horaFin = $request->horaFin;
		$data->idPeriodo = Sentinel::getUser()->idPeriodoLectivo;
        $data->idDia1 = $request->idDia1;
        $data->idDia2 = $request->idDia2;
        $data->idDia3 = $request->idDia3;
        $data->idDia4 = $request->idDia4;
        $data->idDia5 = $request->idDia5;
        $data->idDia6 = $request->idDia6;
        $data->idProfesor = $user->id;

        $data->save();
        return redirect()->route('horario_Docente');
    }

    public function edit($id){
        $user = Sentinel::getUser(); 
    	$data = TeacherSchedule::findOrFail($id);
    	$horaClase = new TeacherSchedule();
        $matters = Matter::getMattersByProfessorSchedule($user->id); 
        $courses = Course::getAllCourses();
        return view('UsersViews.docente.horarios.horarioEditar', compact('data', 'matters', 'courses', 'user'));
    }

    public function update(Request $request, $id){
        $data = TeacherSchedule::findOrFail($id);

        $data->horaInicio = $request->horaInicio;
        $data->horaFin = $request->horaFin;
        $data->idDia1 = $request->idDia1;
        $data->idDia2 = $request->idDia2;
        $data->idDia3 = $request->idDia3;
        $data->idDia4 = $request->idDia4;
        $data->idDia5 = $request->idDia5;
        $data->idDia6 = $request->idDia6;
        
        $data->save();
        return redirect()->route('horario_Docente');
    }

    public function destroy($id){
        $data = TeacherSchedule::findOrFail($id);

        $data->delete();
        return redirect()->route('horario_Docente');
    }
}
