<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use App\Administrative;
use App\Course;
use App\CourseSchedule;
use App\Carbon;
use App\Matter;
use App\QuizSchedule;
use Illuminate\Support\Facades\DB;
use App\ConfiguracionSistema;


class ScheduleController extends Controller{
	public function createQuiz(Request $request, $idCourse, $parcial) {	
		$courseSchedules= QuizSchedule::where('idCurso',$idCourse)->
											where('tipo',$parcial)->get();
		//if ($parcial == 'clases') {
			//echo 'entra';CourseSchedules
			
			//$courseSchedules = DB::table('courseschedules')
			//	->where(['idCurso' => $idCourse, 'idPeriodo' => $this->idPeriodoUser()])
			//	->get();
		//} else {
			//echo 'entrad';
			//$courseSchedules= QuizSchedule::all();
			
			//$courseSchedules = DB::table('quiz_schedule')
			//	->where(['idCurso' => $idCourse, 'tipo' => $parcial, 'idPeriodo' => $this->idPeriodoUser()])
			//	->get();
		//}
		//$subjects= Matter::getMattersByCourse_Schedulle($idCourse);
		//dd($courseSchedules,$idCourse,$parcial);
		$subjects= Matter::all()->where('estado','=','1')->where('idCurso','=',$idCourse);
		//dd($subjects);
		//echo $subjects;

		$course = Course::find($idCourse);
		return view('UsersViews.administrador.configuraciones.horarioCurso', compact(
			'subjects', 'courseSchedules', 'idCourse', 'parcial', 'course'
		));
	}

	public function storeQuiz(Request $request){
		$data= json_decode($request->jsonString,true);
		//dd($data);
		for ($i=0;$i<$request->count;$i++){
		  $idSchedule= $data['schedule_id'. ($i+1)];
		  $schedule = QuizSchedule::find($idSchedule);
		  if($schedule){
			$courseSchedule = QuizSchedule::find($idSchedule);
			//dd($courseSchedule);
			$courseSchedule->horaInicio=$data['horaInicio'. ($i+1)];
			$courseSchedule->horaFin=$data['horaFin'. ($i+1)];

			// $subjectLun= DB::table('matters')->where('id', )->first();
			$courseSchedule->dia1=$data['selectLun'. ($i+1)];

			// $subjectMar= DB::table('matters')->where('id', $data['selectMar'. ($i+1)])->first();
			$courseSchedule->dia2=$data['selectMar'. ($i+1)];

			// $subjectMier= DB::table('matters')->where('id', $data['selectMier'. ($i+1)])->first();
			$courseSchedule->dia3=$data['selectMier'. ($i+1)];

			// $subjectJue= DB::table('matters')->where('id', $data['selectJue'. ($i+1)])->first();
			$courseSchedule->dia4=$data['selectJue'. ($i+1)];

			// $subjectVie= DB::table('matters')->where('id', $data['selectVie'. ($i+1)])->first();
			$courseSchedule->dia5=$data['selectVie'. ($i+1)];

			$subjectSab= DB::table('matters')->where('id', $data['selectSab'. ($i+1)])->first();
			// $courseSchedule->dia6=$subjectSab->nombre;

			$subjectDom= DB::table('matters')->where('id', $data['selectDom'. ($i+1)])->first();

			if(empty($subjectSab)){
			  $courseSchedule->dia6='0';
			}
			else{
			  $courseSchedule->dia6=$data['selectSab'. ($i+1)];
			}

			if(empty($subjectDom)){
				$courseSchedule->dia7='0';
			  }
			  else{
				$courseSchedule->dia7=$data['selectDom'. ($i+1)];
			  }

			$courseSchedule->idCurso=$data['course_id'];

			$courseSchedule->save();

		}
		else {
			$courseSchedule= new QuizSchedule();
			$course = Course::find($data['course_id']);
			$courseSchedule->tipo = $request->parcial;
			$courseSchedule->idPeriodo = $course->idPeriodo;

			$courseSchedule->horaInicio=$data['horaInicio'. ($i+1)];
			$courseSchedule->horaFin=$data['horaFin'. ($i+1)];

			// $subjectLun= DB::table('matters')->where('id', )->first();
			$courseSchedule->dia1=$data['selectLun'. ($i+1)];

			// $subjectMar= DB::table('matters')->where('id', )->first();
			$courseSchedule->dia2=$data['selectMar'. ($i+1)];

			// $subjectMier= DB::table('matters')->where('id', )->first();
			$courseSchedule->dia3=$data['selectMier'. ($i+1)];

			// $subjectJue= DB::table('matters')->where('id', )->first();
			$courseSchedule->dia4=$data['selectJue'. ($i+1)];

			// $subjectVie= DB::table('matters')->where('id', )->first();
			$courseSchedule->dia5=$data['selectVie'. ($i+1)];

			$subjectSab= DB::table('matters')->where('id', $data['selectSab'. ($i+1)])->first();

			$subjectDom= DB::table('matters')->where('id', $data['selectDom'. ($i+1)])->first();

			// $courseSchedule->dia6=$subjectSab->nombre;
			if(empty($subjectSab)){
			  $courseSchedule->dia6='0';
			}
			else{
			  $courseSchedule->dia6=$data['selectSab'. ($i+1)];
			}

			if(empty($subjectDom)){
				$courseSchedule->dia7='0';
			  }
			  else{
				$courseSchedule->dia7=$data['selectDom'. ($i+1)];
			  }

			$courseSchedule->idCurso=$data['course_id'];

			$courseSchedule->save();
			}
		}
	}

	public function destroy($idCourse, $parcial, $id) {
		if ($parcial == 'clases') {
			$courseSchedules = CourseSchedule::find($id);
		} else {
			$courseSchedules = QuizSchedule::find($id);
		}
		$courseSchedules->delete();
		return redirect()->route('creacionHorarioGeneral', [ 'idCourse' => $idCourse, 'parcial' => $parcial]);
	}
    public function home(){
    	try {
	        $user = Sentinel::getUser();
	        $user_profile = Administrative::findBySentinelid($user->id);
	        session()->put('user_data',$user_profile);
        if($user_profile)
            return view(session('rol')->slug.'.horarios.index');
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }

    public function index(Request $request){
		
		$idcarrera = \Session::get('idcarrera');
		
        //\Session::put('idcarrera', $idcarrera);


    	$regimen = ConfiguracionSistema::regimen();
		$coursesEI = Course::where('seccion', 'EI')
			//->where('grado', '!=', 'primero')
			->where('estado', '=', '1')
			->where('id_career', '=', $idcarrera)
			//->where('id_career', '=', $idcarrera)
			//->where('idPeriodo', $this->idPeriodoUser())
			->get();
		/*$coursesEGB = Course::where('seccion', 'EGB')
			->where('idPeriodo', $this->idPeriodoUser())
			->get();
		$coursesBGU = Course::where('seccion', 'BGU')
			->where('idPeriodo', $this->idPeriodoUser())
			->get();
		//agre
		$coursesid = Course::where('seccion', 'EI')
			->where('id_career', $this->id())
			->get();
		*/
		try {
            $user = Sentinel::getUser();
            $user_profile = Administrative::findBySentinelid($user->id);
            session()->put('user_data',$user_profile);
            if($user_profile){
                $courses = Course::getAllCourses();
				
                return view(session('rol')->slug.'.configuraciones.horariosEdicion', compact('coursesEI', 'coursesEGB', 'coursesBGU', 'coursesPrimaria', 'regimen','coursesid','idcarrera'));
            }
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }
	
	public function asignarcarreraSesion(Request $request){
        $idcarrera=$request->idcarrera;
		\Session::put('idcarrera', $idcarrera);
		return redirect()->route('horariosEdicion');      
    }

    public function edit(Request $request){
        $idCourse=$request->course_id;
        //$subjects= DB::table('matters')->where('idCurso', $idCourse)->get();
		$subjects= Matter::all()->where('estado','=','1');

        $courseSchedules = DB::table('courseschedules')->where('idCurso', $idCourse)->get();
        return view('UsersViews.administrador.configuraciones.horariosEdicionCurso',compact('courseSchedules','idCourse','subjects'));
    }

    public function schedules(){
    	$regimen = ConfiguracionSistema::regimen();
		$id_carrera = \Session::get('idcarrera');
		$courses = Course::where('id_career', $id_carrera)->where('estado', 1)->get();
		$schedulers = CourseSchedule::all();
		$primary = Course::where('grado', 'Primero')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
        try {
            $user = Sentinel::getUser();
            $user_profile = Administrative::findBySentinelid($user->id);
            session()->put('user_data',$user_profile);
        if($user_profile)
            return view(session('rol')->slug.'.horarios.index', compact(
				'courses', 'regimen','user_profile','primary','schedulers', 'user'
			));
        } catch (Exception $e) {
            logout();
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }

    public function courseSchedule($id, $parcial){
		if ($parcial == 'clases') {
			$schedules = CourseSchedule::where(['idCurso' => $id])->orderBy('horaInicio')->get();
		} else {
			$schedules = QuizSchedule::where(['idCurso' => $id, 'tipo' => $parcial])->orderBy('horaInicio')->get();
		}
		$data = Course::findOrFail($id);
		$matters = Matter::all();
		$course = Course::find($id);

        return view('UsersViews.administrador.horarios.horarioCurso', compact('data', 'schedules', 'matters', 'course', 'parcial'));
    }

    public function saveChanges(Request $request){
      $data= json_decode($request->jsonString,true);
	  $curso = Course::where('id', $data['course_id'])->first();
      for ($i=0;$i<$request->count;$i++){
        $idSchedule= $data['schedule_id'. ($i+1)];
        $schedule = CourseSchedule::where('id',$idSchedule)->where('idPeriodo',$curso->idPeriodo)->first();
        if($schedule){
		  $courseSchedule = CourseSchedule::where('id',$idSchedule)->where('idPeriodo',$curso->idPeriodo)->first();
		  $courseSchedule->idPeriodo = $curso->idPeriodo;
          $courseSchedule->horaInicio=$data['horaInicio'. ($i+1)];
          $courseSchedule->horaFin=$data['horaFin'. ($i+1)];
          $courseSchedule->dia1=$data['selectLun'. ($i+1)];
          $courseSchedule->dia2=$data['selectMar'. ($i+1)];
          $courseSchedule->dia3=$data['selectMier'. ($i+1)];
          $courseSchedule->dia4=$data['selectJue'. ($i+1)];
          $courseSchedule->dia5=$data['selectVie'. ($i+1)];
          
		  $subjectSab= DB::table('matters')->where('id', $data['selectSab'. ($i+1)])->first();
		  $subjectDom= DB::table('matters')->where('id', $data['selectDom'. ($i+1)])->first();
		  
		  if(empty($subjectSab)){
            $courseSchedule->dia6='0';
          }
          else{
            $courseSchedule->dia6=$data['selectSab'. ($i+1)];
          }
		  if(empty($subjectDom)){
            $courseSchedule->dia7='0';
          }
          else{
            $courseSchedule->dia7=$data['selectDom'. ($i+1)];
          }

          $courseSchedule->idCurso=$data['course_id'];
          $courseSchedule->save();
        }
        else{
		  $courseSchedule= new CourseSchedule();
		  $courseSchedule->idPeriodo = $curso->idPeriodo;
          $courseSchedule->horaInicio=$data['horaInicio'. ($i+1)];
          $courseSchedule->horaFin=$data['horaFin'. ($i+1)];
          $courseSchedule->dia1=$data['selectLun'. ($i+1)];
          $courseSchedule->dia2=$data['selectMar'. ($i+1)];
          $courseSchedule->dia3=$data['selectMier'. ($i+1)];
          $courseSchedule->dia4=$data['selectJue'. ($i+1)];
          $courseSchedule->dia5=$data['selectVie'. ($i+1)];

          $subjectSab= DB::table('matters')->where('id', $data['selectSab'. ($i+1)])->first();
		  $subjectDom= DB::table('matters')->where('id', $data['selectDom'. ($i+1)])->first();

          if(empty($subjectSab)){
            $courseSchedule->dia6='0';
          }
          else{
            $courseSchedule->dia6=$data['selectSab'. ($i+1)];
          }
		  if(empty($subjectDom)){
            $courseSchedule->dia7='0';
          }
          else{
            $courseSchedule->dia7=$data['selectDom'. ($i+1)];
          }
          $courseSchedule->idCurso=$data['course_id'];
          $courseSchedule->save();
        }
      }
    }
}
