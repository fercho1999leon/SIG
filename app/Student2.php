<?php

namespace App;

use App\Course;
use App\Student2Profile;
use App\Transporte;
use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Student2 extends Model
{

    protected $table = "students2";
    protected $guarded = [];

    public static function cursoDelEstudiante($student)
    {
        $curso = Course::findOrFail($student->idCurso);
        return "{$curso->grado} {$curso->especializacion} {$curso->paralelo}";
    }

    public function personasAutorizadas()
    {
        return $this->belongsToMany('App\PersonasAutorizadas', 'personas_autorizadas_estudiantes', 'idEstudiante', 'idPersonaAutorizada');
    }

    public static function getStudentsByCourse($course)
    {
        if (is_array($course)) {
            return Student2::with('pagos')->whereIn('idCurso', $course)
                ->where([
                    ['matricula', '!=', 'Pre Matricula'],
                    ['retirado', '!=', 'SI'],
                ])
                ->orderBy('nivelDeIngles')
                ->orderBy('apellidos')
                ->get();
        } else {
            
            //$studentsId = Student2Profile::where('idCurso', $course)->get()->pluck('idStudent');
            $studentsId2 =  Student2Profile::where('students2_profile_per_year.idCurso', $course)
            ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->select('students2.id as idStudent')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('students2_profile_per_year.retirado', 'NO')
            ->get()->pluck('idStudent');
            //dd($studentsId2);
            return Student2::with('pagos')->whereIn('id', $studentsId2)
                ->where([
                    ['matricula', '!=', 'Pre Matricula'],
                    ['retirado', '!=', 'SI'],
                ])
                ->orderBy('nivelDeIngles')
                ->orderBy('apellidos')
                ->get();
        }
    }

    public static function getStudentsByCourseAsistencia($course,$fecha)
    {
        $studentsId2 =  Student2Profile::where('students2_profile_per_year.idCurso', $course)
        ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
        ->select('students2.id as idStudent')
        ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
        ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
        ->where('students2_profile_per_year.retirado', 'NO')
        ->get()->pluck('idStudent');
        $studentsId2 = Student2::select('*','students2.id as id','asistencia.id as asistenciaId')
            ->join('asistencia','students2.id','=','asistencia.idEstudiante')
            ->with('pagos')
            ->whereIn('students2.id', $studentsId2)
            ->where([
                ['matricula', '!=', 'Pre Matricula'],
                ['retirado', '!=', 'SI'],
                ['fecha', $fecha]
            ])
            ->orderBy('nivelDeIngles')
            ->orderBy('apellidos')
            ->get();
        //dd($studentsId2[0],$studentsId2[1]);
        if($studentsId2->isEmpty()){
            $studentsId2 =  Student2Profile::where('students2_profile_per_year.idCurso', $course)
            ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->select('students2.id as idStudent')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('students2_profile_per_year.retirado', 'NO')
            ->get()->pluck('idStudent');
            $studentsId2 = Student2::
                with('pagos')
                ->whereIn('students2.id', $studentsId2)
                ->where([
                    ['matricula', '!=', 'Pre Matricula'],
                    ['retirado', '!=', 'SI'],
                ])
                ->orderBy('nivelDeIngles')
                ->orderBy('apellidos')
                ->get();
        }
        return $studentsId2;
        
    }

    public static function getStudentsByCourseAsistenciaNew($course,$fecha,$idSchedule)
    {
        $studentsId2 =  Student2Profile::where('students2_profile_per_year.idCurso', $course)
        ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
        ->select('students2.id as idStudent')
        ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
        ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
        ->where('students2_profile_per_year.retirado', 'NO')
        ->get()->pluck('idStudent');
        $studentsId2 = Student2::select('*','students2.id as id','asistencia.id as asistenciaId')
            ->join('asistencia','students2.id','=','asistencia.idEstudiante')
            ->with('pagos')
            ->whereIn('students2.id', $studentsId2)
            ->where([
                ['matricula', '!=', 'Pre Matricula'],
                ['retirado', '!=', 'SI'],
                ['fecha', $fecha]
            ])
            ->where('idSchedule',$idSchedule)
            ->groupBy('students2.id')
            ->orderBy('nivelDeIngles')
            ->orderBy('apellidos')
            ->get();
        if($studentsId2->isEmpty()){
            $studentsId2 =  Student2Profile::where('students2_profile_per_year.idCurso', $course)
            ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->select('students2.id as idStudent')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('students2_profile_per_year.retirado', 'NO')
            ->get()->pluck('idStudent');
            $studentsId2 = Student2::
                with('pagos')
                ->whereIn('students2.id', $studentsId2)
                ->where([
                    ['matricula', '!=', 'Pre Matricula'],
                    ['retirado', '!=', 'SI'],
                ])
                ->groupBy('id')
                ->orderBy('nivelDeIngles')
                ->orderBy('apellidos')
                ->get();
        }
        return $studentsId2;
        
    }


    public static function getStudentsById($ids)
    {
        return Student2::with('pagos')->whereIn('id', $ids)
            ->where([
                ['matricula', '!=', 'Pre Matricula'],
                ['retirado', '!=', 'SI'],
            ])
            ->orderBy('nivelDeIngles')
            ->orderBy('apellidos')
            ->get();
    }
    public function calificaciones()
    {
        return $this->hasMany('App\Calificacion', 'idEstudiante');
    }

    public function becasDescuentos()
    {
        return $this->hasMany('App\BecaDetalle', 'idEstudiante');
    }

    public function pagos()
    {
        return $this->hasMany('App\PagoEstudianteDetalle', 'idEstudiante');
    }

    public function calificacionesParcial($parcial)
    {
        return $this->hasMany('App\Calificacion', 'idEstudiante');
    }

    public function representante()
    {
        return $this->belongsTo('App\Administrative', 'idRepresentante');
    }

    public function curso()
    {
        return $this->belongsTo('App\Course', 'idCurso');
    }

    public function transporte()
    {
        return $this->belongsTo('App\Transporte')->withDefault();
    }

    public function profilePerYear()
    {
        return $this->hasMany('App\Student2Profile', 'idStudent');

    }
    public function profilePerYearNavBar()
    {
        return $this->hasMany('App\Student2Profile', 'idStudent')
            ->where('tipo_matricula', '<>', 'Pre Matricula');
    }

    public function prorroga()
    {
        return $this->hasMany('App\PagoEstudianteDetalle', 'idEstudiante');
    }

    public function comportamientos()
    {
        return $this->hasMany('App\Comportamiento', 'idStudent')->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo);
    }

    public function profile()
    {
        return $this->belongsTo('App\User', 'idProfile')->withDefault();
    }

    public function asistencias()
    {
        return $this->hasMany('App\DailyAssistance', 'idEstudiante');
    }

    // Query Scope
    public function scopeName($query, $name)
    {
        if ($name) {
            $x = $query->where('nombres', 'LIKE', "%$name%")->orWhere('apellidos', 'LIKE', "%$name%");
            return $x;
        }
    }

    public function scopeCourses($query, $courses)
    {
        $query->when($courses, function ($query, $courses) {
            $query->where('students2_profile_per_year.idCurso', $courses)->orderBy('apellidos', 'ASC');
        });
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search, function ($query, $search) {
            $query->where('nombres', 'like', "%{$search}%")
                ->orWhere('apellidos', 'like', "%{$search}%");
        });
    }

    public function scopeMatricula($query, $matricula)
    {
        if ($matricula == 'Pre Matricula') {
            $query->where('tipo_matricula', $matricula);
        }

    }

    public static function getStudentsBySeccion($seccion)
    {
        $cursos = Course::where('seccion', $seccion)->where('estado', 1)->get();
        return Student2::whereIn('idCurso', $cursos->pluck('id'))->get();
    }

    public static function getProfileOfYear($idStudent)
    {
        return Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->where('students2_profile_per_year.idStudent', $idStudent)
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso',
                'students2_profile_per_year.numero_matriculacion')
            ->first();
    }
    // public static function getStudentsByDocente($docente){
    //     $mattersID = Matter::where('idDocente',$docente)->distinct()->pluck('idCurso');
    //     return Student2::whereIn('idCurso', $mattersID)->get();
    // }
    public function comporMateria($id, $parcial)
    {
        //return $this->belongsToMany('App\Student2','id','idStudent');
        return $this->hasMany('App\comportamientoMateria', 'idStudent', 'id')
            ->where('idMateria', $id)
            ->where('parcial', $parcial)
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }
    public function comporMateriaEstudiante($parcial)
    {
        //return $this->belongsToMany('App\Student2','id','idStudent');
        return $this->hasMany('App\comportamientoMateria', 'idStudent', 'id')
            ->join('matters', 'comportamientoMateria.idMateria', '=', 'matters.id')
            ->leftjoin('users_profile as UP', 'matters.idDocente', '=', 'UP.userid')
            ->where('matters.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('parcial', $parcial)
            ->where('comportamientoMateria.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->select('matters.nombre', 'comportamientoMateria.nota', 'comportamientoMateria.observacion', 'UP.nombres', 'UP.apellidos')
            ->get();

    }
}
