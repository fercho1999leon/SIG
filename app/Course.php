<?php

namespace App;

use App\Matter;
use App\Student2;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Course extends Model
{
    protected $table = 'courses';

    protected $guarded = [];

    public function pagos()
    {
        return $this->hasMany('App\Payment', 'idCurso');
    }

    public function periodo()
    {
        return $this->belongsTo('App\PeriodoLectivo', 'idPeriodo');
    }

    public function matters()
    {
        return $this->hasMany('App\Matter', 'idCurso');
    }

    public function students()
    {
        return $this->hasMany('App\Student2', 'idCurso');
    }

    public function schedules()
    {
        return $this->hasMany('App\QuizSchedule', 'idCurso');
    }

    public function tutor()
    {
        return $this->belongsTo('App\Administrative', 'idProfesor');
    }
    public static function getCourse($seccion)
    {
        return Course::where('seccion', $seccion)
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
    }
    public static function nombreCurso(Course $course)
    {
        $course = "$course->grado $course->especializacion $course->paralelo";
        return $course ?? null;
    }

    public function asistenciaDelCurso()
    {
        return $this->hasMany('App\CourseAssistance', 'idCurso');
    }

    public static function getCoursesByProfessor($idProfessor)
    {
        try {
            return Course::where('idProfesor', $idProfessor)->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseWithoutPrimaria()
    {
        return Course::where('seccion', 'EGB')
            ->where('grado', '!=', 'Primero')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
    }

    public static function getCoursesByDocente($idProfessor)
    {
        try {
            $mattersID = Matter::getMattersByProfessor($idProfessor)->pluck('idCurso')->toArray();
            return Course::whereIn('id', $mattersID)->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCoursesByCourse($idCourse)
    {
        try {
            return Course::query()
                ->where('id', $idCourse)
                //->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                ->first();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseByMatter($matter_id)
    {
        try {
            return Course::query()
                ->where('idMaterias', $matter_id)
                ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                ->first();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function getAllCourses()
    {
        try {
            return Course::query()
                ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                ->where('id_career', '!=', 'null')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEI1()
    {
        try {
            return Course::where('grado', 'Inicial 1')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEI2()
    {
        try {
            return Course::where('grado', 'Inicial 2')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB1()
    {
        try {
            return Course::where('grado', 'Primero')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB2()
    {
        try {
            return Course::where('grado', 'Segundo')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB3()
    {
        try {
            return Course::where('grado', 'Tercero')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB4()
    {
        try {
            return Course::where('grado', 'Cuarto')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB5()
    {
        try {
            return Course::where('grado', 'Quinto')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB6()
    {
        try {
            return Course::where('grado', 'Sexto')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB7()
    {
        try {
            return Course::where('grado', 'Septimo')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB8()
    {
        try {
            return Course::where('grado', 'Octavo')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB9()
    {
        try {
            return Course::where('grado', 'Noveno')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseEGB10()
    {
        try {
            return Course::where('grado', 'Decimo')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseBGU1()
    {
        try {
            return Course::where('grado', 'Primero de Bachillerato')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseBGU2()
    {
        try {
            return Course::where('grado', 'Segundo de Bachillerato')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourseBGU3()
    {
        try {
            return Course::where('grado', 'Tercero de Bachillerato')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getStudents($idCourse)
    {

        return $data = Student2::where('idCurso', $idCourse)->get();

    }

    public static function getStudentsByMatter($idMatter)
    {
        $matters = Matter::all();
        foreach ($matters as $matter) {
            if ($matter->id == $idMatter) {
                return $students = Student2::where('idCurso', $matter->idCurso)->orderBy('apellidos', 'ASC')->get();
            }
        }
    }

    public static function courseEI()
    {
        try {
            return Course::where('seccion', 'EI')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function courseEGB()
    {
        try {
            return Course::where('seccion', 'EGB')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function courseBGU()
    {
        try {
            return Course::where('seccion', 'BGU')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function gradoAnterior($idEstudiante)
    {
        $periodo = PeriodoLectivo::findOrFail(Sentinel::getUser()->idPeriodoLectivo);
        $periodoAnterior = Carbon::createFromFormat('Y', substr($periodo->nombre, 0, 4))->addYears(-1)->format('Y');
        $periodoActual = Carbon::createFromFormat('Y', substr($periodo->nombre, 0, 4))->format('Y');
        $periodoAnterior = PeriodoLectivo::where('nombre', "$periodoAnterior-$periodoActual")->first();
        $gradoAnterior = null;
        if ($periodoAnterior != null) {
            $gradoAnterior = Student2Profile::where('idStudent', $idEstudiante)->where('idPeriodo', $periodoAnterior->id)->first();
        }

        if ($gradoAnterior == null) {
            return null;
        }

        return "{$gradoAnterior->course->grado} {$gradoAnterior->course->especializacion} {$gradoAnterior->course->paralelo}";
    }
}
