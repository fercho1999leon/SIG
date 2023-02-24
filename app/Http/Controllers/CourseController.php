<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Matter;
use App\Student2;
use App\User;
use Sentinel;
use App\CourseSchedule;
use App\Http\Requests\CreacionCursoRequest;
use App\ConfiguracionSistema;
use App\Administrative;
use App\CourseAssistance;
use App\Student2Profile;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use Exception;
use Illuminate\Support\Facades\Redirect;
use App\Career;

class CourseController extends Controller
{

    public function index()
    {
        try {
            $careers = Career::all()->where('estado','=','1');

        } catch (Exception $e) {
            return Redirect::back()->withErrors(['login_fail' => 'Ha ocurrido un error.']);
        }
    }




    public function edit()
    {
        $careers = Career::all()->where('estado','=','1');
        return view('UsersViews.administrador.configuraciones.cursosEdicion',compact('careers'));        
    }


    public function store(CreacionCursoRequest $request)
    {
        $course = new Course;
        $course->paralelo = $request->paralelo;
        $course->grado = $request->grado;
        $course->cupos = $request->cupos;
        $course->especializacion = $request->especializacion;
        $course->seccion = $request->seccion;
        $course->idPeriodo = $this->idPeriodoUser();
        $course->observacion = $request->observacion;
        $course->idProfesor = $request->tutor;
        $course->save();

        $parciales = ['p1q1', 'p2q1', 'p3q1', 'p1q2', 'p2q2', 'p3q2'];
        foreach ($parciales as $parcial) {
            $asistenciaDelCurso = new CourseAssistance;
            $asistenciaDelCurso->idCurso = $course->id;
            $asistenciaDelCurso->parcial = $parcial;
            $asistenciaDelCurso->idPeriodo = $this->idPeriodoUser();
            $asistenciaDelCurso->save();
        }
        return redirect('/cursosEdicion');
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->paralelo = $request->paralelo;
        $course->grado = $request->grado;
        $course->cupos = $request->cupos;
        $course->especializacion = $request->especializacion;
        $course->seccion = $request->seccion;
        $course->observacion = $request->observacion;
        $course->idProfesor = $request->tutor;
        $course->save();

        return redirect('/cursosEdicion');
    }

    public function getTutoria($id)
    {
        $courses = Course::getAllCourses();
        $courseTutor = Course::find($id)->get();
        $students = Student2Profile::getStudentsByCourse($id);
        $count = 1;
        $parcial = 'p1q1';
        $matters = Matter::getSubjectsByCourse($id);
        $teachers = User::where('cargo', '=', 'Docente')->get();
        $schedules = CourseSchedule::getScheduleByCourse($id);
        return view('UsersViews.docente.tutoria.informacion.index',
            compact('courses','students', 'count', 'parcial', 'id', 'matters', 'teachers', 'schedules'));

    }

    public function getAgenda($id)
    {
        $courses = Course::getAllCourses();
        return view('UsersViews.docente.tutoria.agenda.index', compact('courses', 'id'));
    }

    public function getAsistencia($id, $parcial)
    {
        try {
            $user = session('user_data');
            $course = Course::findOrFail($id);
            if ($user->id != $course->idProfesor) {
                throw new Exception("No tienes acceso a esta url", 403);
            }
            $courses = Course::getAllCourses();
            $students = Student2Profile::getStudentsByCourse($course->id);
            $count = 1;
            $asistenciaDelCurso = CourseAssistance::query()
                ->where('idCurso', $course->id)
                ->where('parcial', $parcial)
                ->first();
            return view('UsersViews.docente.tutoria.asistencia.index', compact(
                'courses', 'id', 'students', 'count', 'parcial', 'course', 'asistenciaDelCurso' ));
        } catch (Exception $e) {
            return Redirect::back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function getCalificaciones($id)
    {
        $courses = Course::getAllCourses();
        return view('UsersViews.docente.tutoria.calificaciones.index', compact('courses', 'id'));
    }

    public function getEstadisticas($id)
    {
        $courses = Course::getAllCourses();
        return view('UsersViews.docente.tutoria.estadisticas.index', compact('courses', 'id'));
    }

    public function getLibreta(Course $course, $parcial){
        $courses = Course::getAllCourses();
        $unidad = UnidadPeriodica::unidadP();
        $parciales = ParcialPeriodico::all()->where('activo',1);
        $count = 1;
        $students = Student2Profile::getStudentsByCourse($course->id);
        $matters = Matter::where('idCurso', $course->id)->get();
        $tutoria = Course::find($course->id);
        return view('UsersViews.docente.tutoria.libreta.index', compact('courses', 'course', 'parcial', 'students',
            'matters', 'count', 'tutoria', 'unidad', 'parciales'));
    }

    public function show()
    {
        $user = Sentinel::getUser();
        $user_profile = Administrative::findBySentinelid($user->id);
        session()->put('user_data', $user_profile);
        $courses = Course::getAllCourses();

        return view('UsersViews.administrador.institucion.grados.index', compact('courses'));
    }

    public function showGrade($id)
    {
        $course = Course::find($id);
        $students = Student2::getStudentsByCourse($id);
        $teachers = User::all();
        $count = 1;

        return view('UsersViews.administrador.institucion.grados.verGrado', compact('course', 'id', 'students', 'teachers', 'count'));
    }

    public function destroy($id)
    {
        Course::destroy($id);
        return redirect('cursosEdicion');
    }
}
