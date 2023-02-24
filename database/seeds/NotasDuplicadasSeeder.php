<?php
use Illuminate\Database\Seeder;
use App\PeriodoLectivo;
use App\Course;
use App\Matter;
use App\Student2Profile;
use App\Student2;
use App\Calificacion;
use App\Supply;
use App\Activity;

class NotasDuplicadasSeeder extends Seeder{
    public function run(){

        $periodo = PeriodoLectivo::whereNombre('2020-2021')->first();
        $cursos = Course::where('idPeriodo', $periodo->id)->get();
        
        foreach ($cursos as $curso) {
            $estudiantes = Student2Profile::where('students2_profile_per_year.idCurso', $curso->id)
                ->join('students2', 'students2_profile_per_year.idStudent', '=', 'students2.id')
                ->select('students2_profile_per_year.id','students2.apellidos', 'students2.nombres', 'students2_profile_per_year.idCurso', 'students2.id as idStudent', 'students2_profile_per_year.idPeriodo',
                    'students2.fechaNacimiento', 'students2.ci', 'students2_profile_per_year.idRepresentante', 'students2_profile_per_year.direccion_domicilio', 'students2_profile_per_year.telefono_movil',
                    'students2_profile_per_year.created_at', 'students2.sexo', 'students2_profile_per_year.transporte_id', 'students2_profile_per_year.condicionado',
                    'students2_profile_per_year.nacionalidad', 'students2_profile_per_year.estado_civil_padres')
                ->orderBy('students2.apellidos')
                ->where('students2_profile_per_year.tipo_matricula', '!=', 'Pre Matricula')
                ->where('students2_profile_per_year.idPeriodo', $periodo->id)
                ->where('students2_profile_per_year.retirado', 'NO')
                ->get();

            if ($curso->seccion != "EI" && $curso->grado != "Primero"){
                $materias = Matter::where('idCurso', $curso->id)->get();
                foreach ($materias as $materia) {
                    $insumos = Supply::where('idMateria', $materia->id)->where('nombre','!=','EXAMEN QUIMESTRAL')->where('nombre','!=','RECUPERATORIO')->get();
                    foreach ($insumos as $insumo) {
                        $actividades = Activity::where('idInsumo', $insumo->id)->get();
                        foreach ($actividades as $actividad) {
                            foreach ($estudiantes as $estudiante) {
                                $calificaciones = Calificacion::where('idActividad', $actividad->id)->where('idEstudiante',$estudiante->id)->get();
                                if (count($calificaciones) >1 ){
                                    $calificaciones->first()->delete();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}