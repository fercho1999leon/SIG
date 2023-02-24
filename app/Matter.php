<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Matter extends Model
{
    protected $table = 'matters';

    protected $fillable = [
        'nombre',
        'idDocente',
        'idCurso',
        'visible',
        'principal',
        'area',
        'nivel',
        'idArea',
        'nombre_abreviado',
        'observacion',
        'idPeriodo',
        'idDocente',
        'idEstructura',
        'Orden_materia',
        'estado',
    ];

    public function supplies()
    {
        return $this->hasMany('App\Supply', 'idMateria');
    }

    public function area()
    {
        return $this->belongsTo('App\Area', 'idArea');
    }

    public function getArea()
    {
        return $this->belongsTo(Area::class, 'idArea');
    }

    public function user()
    {
        return $this->belongsTo('App\Usuario', 'idDocente');
    }

    public function asistencia()
    {
        return $this->hasMany('App\DailyAssistance', 'idMateria');
    }

    public function matterflux()
    {
        //return $this->hasMany('App\MatterFlux', 'idMateria');
        return $this->belongsToMany(MatterFlux::class);

    }

    public function curso()
    {
        return $this->belongsTo('App\Course', 'idCurso');
    }

    public function activities()
    {
        return $this->hasManyThrough('App\Activity', 'App\Supply', 'id', 'idInsumo');
    }

    public static function getSubjectsByCourse($idCurso)
    {
        return Matter::query()
            ->where('idCurso', $idCurso)
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->orderBy('nombre', 'ASC')
            ->get();
    }

    public static function getAllSubjects()
    {
        return Matter::where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
    }

    public static function getMattersByProfessor($idProfessor)
    {
        return Matter::with('curso')
        //->where(['idDocente' => $idProfessor, 'visible' => 1])
            ->where(['idDocente' => $idProfessor])
            //->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->orderBy('nombre')
            ->get();
    }

    public static function getMattersByProfessorSchedule($idProfessor)
    {
        return Matter::with('curso')
            ->where(['idDocente' => $idProfessor])
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->orderBy('nombre')
            ->get();
    }

    public static function getMattersByStudent($id)
    {
        $student = Student2::find($id);
        return Matter::where('idCurso', $student->idCurso)->get();
    }

    public static function getMattersByProfessorDestrezas($idProfessor)
    {
        try {
            return Matter::where('idDocente', $idProfessor)->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getMattersByCourseConfig($idCourse)
    {
        try {
            return Matter::where('idCurso', $idCourse)->orderBy('posicion')->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getMattersByCourse($idCourse)
    {
        try {
            return Matter::query()
                //->where(['idCurso' => $idCourse, 'visible' => 1, 'idPeriodo' => Sentinel::getUser()->idPeriodoLectivo])
                ->where(['idCurso' => $idCourse, 'visible' => 1])
                ->orderBy('area')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    //Función para extración de materias en creacion de horario escolar
    public static function getMattersByCourse_Schedulle($idCourse)
    {
        try {
            return Matter::query()
                ->where(['idCurso' => $idCourse, 'idPeriodo' => Sentinel::getUser()->idPeriodoLectivo])
                ->orderBy('nombre')
                ->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getMattersExtraByCourse($idCourse)
    {
        try {
            return Matter::where(['idCurso' => $idCourse, 'visible' => 1, 'principal' => 0])->orderBy('nombre')->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getMattersAllByCourse($idCourse)
    {
        try {
            return Matter::where(['idCurso' => $idCourse, 'visible' => 1, 'estado' => 1])->orderBy('nombre')->get();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function getAllMattersByCourse($idCourse)
    {
        try {
            return Matter::where(['idCurso' => $idCourse])->orderBy('nombre')->get();
            //$course=DB::table('courses')->join('Semesters','Semesters.id','=','courses.id_career')->where('Semesters.id','=',$id)->where('Semesters.estado','=','1')->where('courses.estado','=','1')->get();

            //$carrera = careerStudents::join("students2", "students2.id", "=", "career_students.students_id")->join("Career", "Career.id", "=", "career_students.career_id")
            //->select("Career.nombre")->where("career_students.students_id","=",$id)
            //->first();
            //$user = DB::table('users')->where('name', 'John')->first();
            //return $user->email;
            //$course=DB::table('courses')->join('Semesters','Semesters.id','=','courses.id_career')->where('Semesters.id','=',$idCourse)->where('Semesters.estado','=','1')->where('courses.estado','=','1')->first();

            //$course = Matter::join("Semesters", "Semesters.id", "=", "courses.id_career")->join("matters", "matters.idCurso", "=", "courses.id")
            //->select("matters.nombre")->where("Semesters.id","=",$idCourse)
            //->first();

            //return Matter::where(['idCurso' => $idCourse])->orderBy('nombre')->get();
        } catch (Exception $e) {
            return null;
        }
    }
    public static function getAllMatters()
    {
        try {
            return Matter::all();
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getCourse($idMateria)
    {
        $matters = Matter::all();

        try {
            foreach ($matters as $matter) {
                if ($matter->id == $idMateria) {
                    return $matter->idCurso;
                }
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getSubjectDHI($idCurso)
    {
        try {
            return Matter::where('nombre', 'DESARROLLO HUMANO INTEGRAL')
                ->where('idCurso', $idCurso)->get();
        } catch (Exception $e) {
            return null;
        }
    }
}
