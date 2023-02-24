<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Student2Profile extends Model
{
    protected $dates = ['fecha_matriculacion'];
    protected $table = 'students2_profile_per_year';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Student2', 'idStudent');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'idCliente')->withDefault();
    }

    public function course()
    {
        return $this->belongsTo('App\Course', 'idCurso')->withDefault();
    }

    public function bloqueos()
    {
        return $this->belongsToMany('App\TipoBloqueo', 'students2_profile_per_year_tipo_bloqueos', 'idStudent', 'idBloqueo');
    }

    public function periodoLectivo()
    {
        return $this->belongsTo('App\PeriodoLectivo', 'idPeriodo');
    }

    public function asistenciaParcial($parcialActual)
    {
        return $this->hasMany('App\AsistenciaParcial', 'idStudent')
            ->where('parcial', $parcialActual)
            ->first();
    }

    public function representante()
    {
        return $this->belongsTo('App\Administrative', 'idRepresentante')->withDefault();
    }

    public function transporte()
    {
        return $this->belongsTo('App\Transporte')->withDefault();
    }

    public function padre()
    {
        return $this->belongsTo('App\Parents', 'idPadre')->withDefault();
    }

    public function madre()
    {
        return $this->belongsTo('App\Parents', 'idMadre')->withDefault();
    }

    public static function getStudentsByCourse($idCurso)
    {
        return Student2Profile::where('students2_profile_per_year.idCurso', $idCurso)
            ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso', 'students2.id as idStudent', 'students2_profile_per_year.idPeriodo',
                'students2.fechaNacimiento', 'students2.ci', 'students2_profile_per_year.idRepresentante', 'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil',
                'students2_profile_per_year.created_at', 'students2.sexo', 'students2_profile_per_year.transporte_id', 'students2_profile_per_year.condicionado',
                'students2_profile_per_year.nacionalidad', 'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.numero_matriculacion','students2_profile_per_year.tipo_matricula')
            ->orderBy('students2.apellidos')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('students2_profile_per_year.retirado', 'NO')
            ->get();

    }

    public static function getDataTableStudentsByCourse($idCurso)
    {
        /*return Student2Profile::where('students2_profile_per_year.idCurso', $idCurso)
        ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
        ->select('students2_profile_per_year.id','students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso', 'students2.id as idStudent', 'students2_profile_per_year.idPeriodo',
        'students2.fechaNacimiento', 'students2.ci', 'students2_profile_per_year.idRepresentante', 'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil',
        'students2_profile_per_year.created_at', 'students2.sexo', 'students2_profile_per_year.transporte_id', 'students2_profile_per_year.condicionado',
        'students2_profile_per_year.nacionalidad', 'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.numero_matriculacion')
        ->orderBy('students2.apellidos')
        ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
        ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
        ->where('students2_profile_per_year.retirado', 'NO')
        ->get();

         */
        return DB::table('courses')
            ->join('Semesters', 'Semesters.id', '=', 'courses.id_career')
            ->join('career_students', 'career_students.career_id', '=', 'Semesters.career_id')
            ->join('students2', 'students2.id', '=', 'career_students.students_id')
            ->join('students2_profile_per_year', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso', 'students2.id as idStudent', 'students2_profile_per_year.idPeriodo',
                'students2.fechaNacimiento', 'students2.ci', 'students2_profile_per_year.idRepresentante', 'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil',
                'students2_profile_per_year.created_at', 'students2.sexo', 'students2_profile_per_year.transporte_id', 'students2_profile_per_year.condicionado',
                'students2_profile_per_year.nacionalidad', 'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.numero_matriculacion')
            ->where("courses.id", "=", $idCurso)
            ->orderBy('students2.apellidos')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('students2_profile_per_year.retirado', 'NO')
            ->get();
        //return view('UsersViews.administrador.grados.calificaciones.calificacionesCurso', compact('data'));

    }
    public static function getStudentsByCourseUser($idCurso)
    {
        return Student2Profile::where('students2_profile_per_year.idCurso', $idCurso)
            ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->join('users_profile', 'students2.idProfile', '=', 'users_profile.id')
            ->where('users_profile.cargo', 'Estudiante')
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso', 'students2.id as idStudent', 'students2_profile_per_year.idPeriodo',
                'students2.fechaNacimiento', 'students2.ci', 'students2_profile_per_year.idRepresentante', 'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil',
                'students2_profile_per_year.created_at', 'students2.sexo', 'students2_profile_per_year.transporte_id', 'students2_profile_per_year.condicionado',
                'students2_profile_per_year.nacionalidad', 'students2_profile_per_year.estado_civil_padres', 'users_profile.correo')
            ->orderBy('students2.apellidos')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->where('students2_profile_per_year.retirado', 'NO')
            ->get();
    }

    public static function getStudent($idStudent)
    {
        return Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->where('students2_profile_per_year.idStudent', $idStudent)
            ->where('students2_profile_per_year.idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso',
                'students2.bloqueado', 'students2_profile_per_year.idPeriodo', 'students2_profile_per_year.idStudent',
                'students2_profile_per_year.idRepresentante', 'students2.idPadre', 'students2.idMadre', 'students2_profile_per_year.fecha_matriculacion',
                'students2_profile_per_year.created_at', 'students2.sexo', 'students2_profile_per_year.idCliente', 'students2_profile_per_year.numero_matriculacion',
                'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil', 'students2.fechaNacimiento', 'students2.ci',
                'students2_profile_per_year.nombre_contacto_emergencia', 'students2_profile_per_year.movil_contacto_emergencia', 'students2.tipoSangre',
                'students2_profile_per_year.tipo_matricula', 'students2_profile_per_year.nacionalidad', 'students2_profile_per_year.se_va_solo', 'students2_profile_per_year.transporte_id',
                'students2_profile_per_year.celular', 'students2.institucionAnterior', 'students2.lugarNacimiento', 'students2_profile_per_year.alergias', 'students2_profile_per_year.inclusion',
                'students2_profile_per_year.seguro_institucional', 'students2_profile_per_year.nombre_contacto_emergencia', 'students2_profile_per_year.movil_contacto_emergencia',
                'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.porcentaje_discapacidad', 'students2_profile_per_year.discapacidad',
                'students2_profile_per_year.disciplina_practica', 'students2_profile_per_year.actividad_artistica', 'students2_profile_per_year.enfermedad',
                'students2_profile_per_year.nombre_contacto_emergencia2', 'students2_profile_per_year.movil_contacto_emergencia2', 'students2_profile_per_year.con_quien_vive',
                'students2_profile_per_year.con_quien_vive', 'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.condicionado', 'students2.idProfile', 'students2_profile_per_year.actDesdeAdmisiones')
            ->first();
    }
    public static function getStudentAdmision($idStudent, $periodo)
    {
        return Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->where('students2_profile_per_year.idStudent', $idStudent)
            ->where('students2_profile_per_year.idPeriodo', $periodo)
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso',
                'students2.bloqueado', 'students2_profile_per_year.idPeriodo', 'students2_profile_per_year.idStudent',
                'students2_profile_per_year.idRepresentante', 'students2.idPadre', 'students2.idMadre', 'students2_profile_per_year.fecha_matriculacion',
                'students2_profile_per_year.created_at', 'students2.sexo', 'students2_profile_per_year.idCliente', 'students2_profile_per_year.numero_matriculacion',
                'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil', 'students2.fechaNacimiento', 'students2.ci',
                'students2_profile_per_year.nombre_contacto_emergencia', 'students2_profile_per_year.movil_contacto_emergencia', 'students2.tipoSangre',
                'students2_profile_per_year.tipo_matricula', 'students2_profile_per_year.nacionalidad', 'students2_profile_per_year.se_va_solo', 'students2_profile_per_year.transporte_id',
                'students2_profile_per_year.celular', 'students2.institucionAnterior', 'students2.lugarNacimiento', 'students2_profile_per_year.alergias', 'students2_profile_per_year.inclusion',
                'students2_profile_per_year.seguro_institucional', 'students2_profile_per_year.nombre_contacto_emergencia', 'students2_profile_per_year.movil_contacto_emergencia',
                'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.porcentaje_discapacidad', 'students2_profile_per_year.discapacidad',
                'students2_profile_per_year.disciplina_practica', 'students2_profile_per_year.actividad_artistica', 'students2_profile_per_year.enfermedad',
                'students2_profile_per_year.nombre_contacto_emergencia2', 'students2_profile_per_year.movil_contacto_emergencia2', 'students2_profile_per_year.con_quien_vive',
                'students2_profile_per_year.con_quien_vive', 'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.condicionado', 'students2.idProfile', 'students2_profile_per_year.actDesdeAdmisiones')
            ->first();
    }

    public static function getStudentsBySeccion($seccion)
    {
        return Student2Profile::where('seccion', $seccion)
            ->where('tipo_matricula', '!=', 'Pre Matricula')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->get();
    }
    public static function getStudentPreMatricula($id)
    {
        return Student2Profile::where('idStudent', $id)
            ->where('tipo_matricula', '!=', 'Pre Matricula')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->first();
    }

    public static function getAllStudents()
    {
        return Student2Profile::join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.retirado', 'NO')
            ->orderBy('students2.apellidos')
            ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2.sexo', 'students2_profile_per_year.idCurso',
                'students2.bloqueado', 'students2_profile_per_year.idPeriodo', 'students2_profile_per_year.idStudent',
                'students2_profile_per_year.numero_matriculacion', 'students2_profile_per_year.idRepresentante')
            ->get();
    }
    public static function getStudentAll()
    {
        return Student2Profile::join('students2 as S', 'students2_profile_per_year.idStudent', '=', 'S.id')
            ->leftjoin('clientes as C', 'students2_profile_per_year.idCliente', '=', 'C.id')
            ->leftjoin('periodo_lectivo as PE', 'students2_profile_per_year.idPeriodo', '=', 'PE.id')
            ->leftjoin('courses as E', 'students2_profile_per_year.idCurso', '=', 'E.id')
            ->leftjoin('users_profile as R', 'students2_profile_per_year.idRepresentante', '=', 'R.id')
            ->leftjoin('datospadres as M', 'S.idMadre', '=', 'M.id')
            ->leftjoin('datospadres as P', 'S.idPadre', '=', 'P.id')
            ->leftjoin('users_profile as Es', 'S.idProfile', '=', 'Es.id')
            ->select('E.grado', 'E.paralelo', 'E.especializacion', 'S.ci', 'S.apellidos', 'S.nombres', 'Es.correo', \DB::raw('(CASE
                        WHEN S.bloqueado = "1" THEN "SI"
                        ELSE "NO"
                        END) AS Bloqueado'),

                'students2_profile_per_year.retirado', 'PE.nombre as Periodo_lectivo', 'students2_profile_per_year.fecha_matriculacion', 'S.sexo', 'students2_profile_per_year.numero_matriculacion', 'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil', 'S.fechaNacimiento', 'students2_profile_per_year.nombre_contacto_emergencia', 'students2_profile_per_year.movil_contacto_emergencia', 'S.tipoSangre',
                'students2_profile_per_year.tipo_matricula', 'students2_profile_per_year.nacionalidad',
                \DB::raw('(CASE
                        WHEN students2_profile_per_year.se_va_solo = "1" THEN "SI"
                        ELSE "NO"
                        END) AS Se_va_solo'),
                'students2_profile_per_year.celular', 'S.institucionAnterior', 'S.lugarNacimiento', 'students2_profile_per_year.alergias',
                \DB::raw('(CASE
                        WHEN students2_profile_per_year.inclusion = "1" THEN "SI"
                        ELSE "NO"
                        END) AS Inclusión'),
                'students2_profile_per_year.seguro_institucional', 'students2_profile_per_year.nombre_contacto_emergencia', 'students2_profile_per_year.movil_contacto_emergencia',
                'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.porcentaje_discapacidad', 'students2_profile_per_year.discapacidad',
                'students2_profile_per_year.disciplina_practica', 'students2_profile_per_year.actividad_artistica', 'students2_profile_per_year.enfermedad',
                'students2_profile_per_year.nombre_contacto_emergencia2', 'students2_profile_per_year.movil_contacto_emergencia2',
                'students2_profile_per_year.con_quien_vive', 'students2_profile_per_year.estado_civil_padres', 'students2_profile_per_year.condicionado', 'C.nombres as nombres_cliente', 'C.apellidos as apellidos_cliente', 'C.cedula_ruc as cedula_ruc_cliente', 'C.correo as correo_cliente', 'C.direccion as direccion_cliente',
                'C.fecha_nacimiento as fecha_nacimiento_cliente', 'C.telefono as telefono_movil_cliente', 'C.telefono_domicilio as telefono_domicilio_cliente', 'C.profesion as profesion_cliente', 'C.lugar_trabajo as lugar_trabajo_cliente', 'C.telefono_trabajo as Telefono_trabajo_cliente', 'C.nacionalidad as nacionalidad_cliente', 'R.ci AS cedula_Representante', 'R.nombres as nombre_representante', 'R.apellidos as apellidos_representante', 'R.sexo as sexo_representante', 'R.fNacimiento as Nacimiento_Representante', 'R.correo as correo_Representante', 'R.movil as Celular_Representante', 'R.bio as biografia_representante', 'R.dDomicilio AS direccion_Representante', 'R.tDomicilio as Telefono_Representante', 'R.url_imagen as url_imagen_representante', 'R.enfermedad as enfermedad_representante', 'R.observacion as observacion_representante', 'R.numero_emergencia as numero_emergencia_representante', 'R.grupo_sanguineo as grupo_sanguineo_representante', 'R.es_representante as es_representante', 'R.parentezco as parentezco_representante', 'R.estudios as estudios_representante', 'R.religion as religion_representante', 'R.profesion as profesion_representante', 'R.lugar_trabajo as lugar_trabajo_representante', 'R.telefono_trabajo as telefono_trabajo_representante',
                \DB::raw('(CASE
                        WHEN R.ex_alumno = "1" THEN "SI"
                        ELSE "NO"
                        END) AS ex_alumno_representante'), 'R.fecha_promocion as fecha_promocion_representante', 'R.fecha_ingreso as fecha_ingreso_representante', 'R.fecha_estado_migratorio as fecha_estado_migratorio_representante', 'R.fecha_exp_pasaporte as fecha_exp_pasaporte_representante', 'R.fecha_caducidad_pasaporte as fecha_caducidad_pasporte_representante', 'R.nacionalidad as nacionalidad_representante', 'M.ci as cedula_Madre', 'M.nombres as nombres_Madre', 'M.apellidos as apellidos_madre', 'M.sexo as sexo_madre', 'M.fNacimiento as fnacimiento_madre', 'M.nacionalidad as nacionalidad_madre', 'M.correo as correo_madre', 'M.movil as movil_madre', 'M.parentezco as parentezco_madre', 'M.bio as bio_madre', 'M.estudios as estudios_madre', 'M.religion as religion_madre', 'M.ciudadDomicilio as ciudadDomicilio_madre', 'M.direccionDomicilio as direccionDomicilio_madre', 'M.telefonoDomicilio as telefonoDomicilio_madre', 'M.ciudadTrabajo as ciudadTrabajo_madre', 'M.direccionTrabajo as direccionTrabajo_madre', 'M.telefonoTrabajo as telefonoTrabajo_madre', 'M.cargoTrabajo as cargoTrabajo_madre', 'M.lugarTrabajo as lugarTrabajo_madre', 'M.fallecido as fallecido_madre', 'M.estado_civil as estado_civil_madre',
                \DB::raw('(CASE
                        WHEN M.autorizadoRetirarEstudiante = "1" THEN "SI"
                        ELSE "NO"
                        END) AS AutorizadoRetirarEstudiante_madre'), 'M.lugarNacimiento as LugarNacimiento_madre', 'M.provincia as provincia_madre', 'M.canton as canton_madre', 'M.parroquia as parroquia_madre', 'M.clinica as clinica_madre', 'M.indicaciones as indicaciones_madre',
                'M.tipoSangre as tipoSangre_Madre', 'M.contactoEmergencia as contactoEmergencia_Madre', 'M.telefonoEmergencia as telefonoemergencia_Madre', 'M.observacionEmergencia as observacionemergencia_Madre', 'M.profesion as profesion_Madre', 'M.ex_alumno as ex_alumno_Madre',
                \DB::raw('(CASE
                        WHEN M.ex_alumno = "1" THEN "SI"
                        ELSE "NO"
                        END) AS ex_alumno_Madre'), 'M.fecha_promocion as fecha_promocion_Madre', 'M.fecha_ingreso_pais as fecha_ingreso_pais_Madre', 'M.fecha_expiracion_pasaporte as fecha_expiracion_pasaporte_Madre', 'M.fecha_caducidad_pasaporte as fecha_caducidad_pasaporte_Madre',
                'P.ci as cedula_padre', 'P.nombres as nombres_padre', 'P.apellidos as apellidos_padre', 'P.sexo as sexo_padre', 'P.fNacimiento as fnacimiento_padre', 'P.nacionalidad as nacionalidad_padre', 'P.correo as correo_padre', 'P.movil as movil_padre', 'P.parentezco as parentezco_padre', 'P.bio as bio_padre', 'P.estudios as estudios_padre', 'P.religion as religion_padre', 'P.ciudadDomicilio as ciudadDomicilio_padre', 'P.direccionDomicilio as direccionDomicilio_padre', 'P.telefonoDomicilio as telefonoDomicilio_padre', 'P.ciudadTrabajo as ciudadTrabajo_padre', 'P.direccionTrabajo as direccionTrabajo_padre', 'P.telefonoTrabajo as telefonoTrabajo_padre', 'P.cargoTrabajo as cargoTrabajo_padre', 'P.lugarTrabajo as lugarTrabajo_padre', 'P.fallecido as fallecido_padre', 'P.estado_civil as estado_civil_padre', 'P.autorizadoRetirarEstudiante as autorizadoRetirarEstudiante_padre',
                \DB::raw('(CASE
                        WHEN P.autorizadoRetirarEstudiante= "1" THEN "SI"
                        ELSE "NO"
                        END) AS autorizadoRetirarEstudiante_padre'), 'P.lugarNacimiento as LugarNacimiento_padre', 'P.provincia as provincia_padre', 'P.canton as canton_padre', 'P.parroquia as parroquia_padre', 'P.clinica as clinica_padre', 'P.indicaciones as indicaciones_padre',
                'P.tipoSangre as tipoSangre_padre', 'P.contactoEmergencia as contactoEmergencia_padre', 'P.telefonoEmergencia as telefonoemergencia_padre', 'P.observacionEmergencia as observacionemergencia_padre', 'P.profesion as profesion_padre',
                \DB::raw('(CASE
                        WHEN P.ex_alumno= "1" THEN "SI"
                        ELSE "NO"
                        END) AS ex_alumno_padre'),
                'P.fecha_promocion as fecha_promocion_Padre', 'P.fecha_ingreso_pais as fecha_ingreso_pais_padre', 'P.fecha_expiracion_pasaporte as fecha_expiracion_pasaporte_padre', 'P.fecha_caducidad_pasaporte as fecha_caducidad_pasaporte_padre')
            ->orderBy('grado')
            ->get();

    }
    public static function getStudentsByCourseSeed($idCurso, $id_periodo)
    {
        return Student2Profile::where('students2_profile_per_year.idCurso', $idCurso)
            ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
            ->select('students2_profile_per_year.id', 'students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso', 'students2.id as idStudent', 'students2_profile_per_year.idPeriodo',
                'students2.fechaNacimiento', 'students2.ci', 'students2_profile_per_year.idRepresentante', 'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil',
                'students2_profile_per_year.created_at', 'students2.sexo', 'students2_profile_per_year.transporte_id', 'students2_profile_per_year.condicionado',
                'students2_profile_per_year.nacionalidad', 'students2_profile_per_year.estado_civil_padres')
            ->orderBy('students2.apellidos')
            ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
            ->where('students2_profile_per_year.idPeriodo', $id_periodo)
            ->where('students2_profile_per_year.retirado', 'NO')
            ->get();
    }

}
