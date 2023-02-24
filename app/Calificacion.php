<?php

namespace App;

use App\Activity;
use App\ConfiguracionSistema;
use App\ParcialPeriodico;
use App\Student2;
use App\Student2Profile;
use App\Supply;
use App\UnidadPeriodica;
use Illuminate\Database\Eloquent\Model;
use Sentinel;

class Calificacion extends Model
{
    protected $table = 'calificacionesactividad';
    protected $guarded = [];

    public function actividad()
    {
        return $this->belongsTo('App\Activity', 'idActividad');
    }

    public function student()
    {
        return $this->belongsTo('App\Student2', 'idEstudiante');
    }

    public function supply()
    {
        return $this->belongsTo('App\Supply', 'idInsumo');
    }

    public static function getPromedioSupply($idMatter, $idCurso, $parcial)
    {
        try {
            $promedios = [];
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
            $insumos = Supply::where(['idMateria' => $idMatter, 'idCurso' => $idCurso])
                ->where('nombre', '!=', 'RECUPERATORIO')
                ->where('nombre', '!=', 'ENSAYO')
                ->where('nombre', '!=', 'EXAMEN QUIMESTRAL')
                ->with('activities', 'calificaciones')
                ->get();
            $students = Student2Profile::getStudentsByCourse($idCurso);
            foreach ($insumos as $insumo) {
                $promedios[$insumo->id] = [];
                foreach ($students as $student) {
                    $actividadesParcial = [];
                    $refuerzo = $insumo->activities()
                        ->where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])
                        ->first();
                    $activities = $insumo->activities()->where(['parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 0])->get();
                    foreach ($activities as $activity) {
                        array_push($actividadesParcial, $activity->id);
                    }
                    $calificaciones = $insumo->calificaciones()->where('idEstudiante', $student->idStudent)
                        ->whereIn('idActividad', $actividadesParcial)->get();
                    $promedio = 0;
                    foreach ($calificaciones as $calificacion) {
                        if ($calificacion->nota != 0) {
                            $promedio = $promedio + $calificacion->nota;
                        } else {
                            if ($PromedioInsumo->valor != 1) {
                                $promedio = 0;
                                break;
                            }
                        }
                    }
                    $ref = 0;
                    if (count($activities) > 0 && $promedio != 0) {
                        if ($refuerzo != null) {
                            $r = $insumo->calificaciones()->where('idEstudiante', $student->idStudent)
                                ->where('idActividad', $refuerzo->id)->first();
                            if ($r != null) {
                                $ref = $r->nota;
                            }
                        }
                        $promedios[$insumo->id][$student->idStudent] = array('promedio' => $promedio / count($activities), 'refuerzo' => $ref);
                    } else {
                        $promedios[$insumo->id][$student->idStudent] = array('promedio' => 0, 'refuerzo' => $ref);
                    }
                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioSupplySinRefuerzo($idMatter, $idCurso, $parcial)
    {
        try {
            $promedios = [];
            $insumos = Supply::where(['idMateria' => $idMatter, 'idCurso' => $idCurso])
                ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')
                ->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();
            $students = Student2::getStudentsByCourse($idCurso);
            foreach ($insumos as $insumo) {
                $promedios[$insumo->id] = [];
                foreach ($students as $student) {
                    $actividadesParcial = [];
                    $activities = Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 0])->get();
                    foreach ($activities as $activity) {
                        array_push($actividadesParcial, $activity->id);
                    }
                    $c = count($activities);
                    $calificaciones = Calificacion::where(['idInsumo' => $insumo->id, 'idEstudiante' => $student->id])->whereIn('idActividad', $actividadesParcial)->get();
                    $promedio = 0;
                    foreach ($calificaciones as $calificacion) {
                        $promedio = $promedio + $calificacion->nota;
                    }
                    if ($c > 0) {
                        $promedios[$insumo->id][$student->id] = array('promedio' => $promedio / $c);
                    } else {
                        $promedios[$insumo->id][$student->id] = array('promedio' => 0);
                    }

                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromediosByStudent($studentId, $parcial, $idCurso)
    {
        try {
            $promedios = [];
            $matters = Matter::getMattersByCourse($idCurso);
            //$students = Student2::find($studentId);
            foreach ($matters as $matter) {
                $insumos = Supply::where(['idMateria' => $matter->id, 'idCurso' => $idCurso])
                    ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->with('activities', 'calificaciones')->get();
                $promedios[$matter->id] = [];

                foreach ($insumos as $insumo) {
                    $actividadesParcial = [];
                    // $activities = Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1])->get();
                    // $refuerzo = Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])->first();

                    $activities = $insumo->activities()->where(['parcial' => $parcial, 'calificado' => 1])->get(); //Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1])->get();
                    $refuerzo = $insumo->activities()->where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])->first(); //Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])->first();

                    foreach ($activities as $activity) {
                        array_push($actividadesParcial, $activity->id);
                    }

                    $calificaciones = $insumo->calificaciones()->where('idEstudiante', $studentId)
                        ->whereIn('idActividad', $actividadesParcial)->get();
                    $promedio = 0;
                    foreach ($calificaciones as $calificacion) {
                        $promedio = $promedio + $calificacion->nota;
                    }
                    $c = count($activities);
                    if ($c > 0) {
                        if ($refuerzo != null) {
                            if (count($calificaciones->where('idActividad', $refuerzo->id)) == 0) {
                                $c--;
                            }
                        }

                        $promedios[$matter->id][$insumo->id] = array('promedio' => $promedio / $c);
                    } else {
                        $promedios[$matter->id][$insumo->id] = array('promedio' => 0);
                    }

                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromediosByStudentSinRefuerzo($studentId, $parcial, $idCurso)
    {
        try {
            $promedios = [];
            $matters = Matter::getMattersByCourse($idCurso);

            $students = Student2::find($studentId);

            foreach ($matters as $matter) {
                $insumos = Supply::where(['idMateria' => $matter->id, 'idCurso' => $idCurso])
                    ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->with('activities', 'calificaciones')->get();
                $promedios[$matter->id] = [];
                foreach ($insumos as $insumo) {
                    $actividadesParcial = [];
                    // $activities = Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1])->get();
                    // $refuerzo = Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])->first();

                    $activities = $insumo->activities()->where(['parcial' => $parcial, 'calificado' => 1])->get(); //Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1])->get();
                    //$refuerzo = $insumo->activities()->where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])->first();  //Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])->first();

                    foreach ($activities as $activity) {
                        array_push($actividadesParcial, $activity->id);
                    }

                    $calificaciones = $insumo->calificaciones()->where('idEstudiante', $studentId)
                        ->whereIn('idActividad', $actividadesParcial)->get();
                    $promedio = 0;
                    foreach ($calificaciones as $calificacion) {
                        $promedio = $promedio + $calificacion->nota;
                    }
                    $c = count($activities);
                    if ($c > 0) {
                        // if($refuerzo != null)
                        //     if( count($calificaciones->where('idActividad', $refuerzo->id)) == 0)
                        //         $c--;
                        $promedios[$matter->id][$insumo->id] = array('promedio' => $promedio / $c);
                    } else {
                        $promedios[$matter->id][$insumo->id] = array('promedio' => 0);
                    }

                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioMatter($idCurso, $parcial)
    {
        try {
            $promedios = [];
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo()->valor;
            $students = Student2::getStudentsByCourse($idCurso);
            $matters = Matter::getMattersByCourse($idCurso);
            foreach ($matters as $matter) {
                $promInsumos = Calificacion::getPromedioSupply($matter->id, $idCurso, $parcial);
                foreach ($students as $student) {
                    $ac = 0;
                    $insumos = Supply::where(['idCurso' => $idCurso, 'idMateria' => $matter->id])
                        ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();

                    $tieneAporte = true;
                    $c_insumos = 0;
                    foreach ($insumos as $insumo) {
                        if ($PromedioInsumo == 1 && $promInsumos[$insumo->id][$student->id]['promedio'] == 0) { //condicion si aplica el insumo activo
                            $c_insumos++;
                        }
                        if ($insumo->es_aporte == true && $promInsumos[$insumo->id][$student->id]['promedio'] == 0) {
                            $tieneAporte = false;
                        } else {
                            $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);
                        }

                    }
                    if (count($insumos) != 0) {
                        if ($tieneAporte) {
                            $value = floatval($ac / (count($insumos) - $c_insumos));
                            $promedios[$matter->id][$student->id]['promedio'] = $value;
                        } else {
                            $promedios[$matter->id][$student->id]['promedio'] = 0;
                        }

                        //$promedios[$matter->id][$student->id]['promedio'] = 5;
                        // if($insumo->nombre=='EVALUACION'){
                        //     if($promInsumos[$insumo->id][$student->id]['promedio']==0){
                        //         $promedios[$matter->id][$student->id]['promedio'] = 0;
                        //     }else{
                        //         $promedios[$matter->id][$student->id]['promedio'] = $value;
                        //     }
                        // }else{

                        // }

                    } else {
                        $promedios[$matter->id][$student->id]['promedio'] = 0.0;
                    }

                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioMatterParcial($materia, $parcial)
    {
        try {
            $promedios = [];
            $matter = Matter::find($materia);
            $PromedioInsumo = ConfiguracionSistema::PromedioInsumo();
            $students = Student2Profile::getStudentsByCourse($matter->idCurso);
            $promInsumos = Calificacion::getPromedioSupply($matter->id, $matter->idCurso, $parcial);
            foreach ($students as $student) {
                $ac = 0;
                $insumos = Supply::where(['idCurso' => $matter->idCurso, 'idMateria' => $matter->id])
                    ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')
                    ->where('nombre', '!=', 'EXAMEN QUIMESTRAL')
                    ->get();
                $refuerzo = [];
                foreach ($insumos as $insumo) {
                    $r = $insumo->activities()
                        ->where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])
                        ->get();
                    $cal = Calificacion::whereIn('idActividad', $r->pluck('id'))->where('idEstudiante', $student->idStudent)->first();
                    if ($cal != null) {
                        array_push($refuerzo, $cal->nota);
                    }
                }
                $c = 0;
                foreach ($insumos as $insumo) {
                    if ($promInsumos[$insumo->id][$student->idStudent]['promedio'] != 0) {
                        $ac += bcdiv($promInsumos[$insumo->id][$student->idStudent]['promedio'], '1', 2);
                        $c++;
                    } else {
                        if ($PromedioInsumo->valor != 1) {
                            $ac = 0;
                            break;
                        }
                    }
                }
                if ($ac != 0) {
                    if (count($refuerzo) != 0) {
                        $ac += array_sum($refuerzo);
                    }
                    if (count($insumos) != 0) {
                        if (count($refuerzo) > 0) {
                            if ($PromedioInsumo->valor != 1) {
                                $value = bcdiv($ac / (count($insumos) + count($refuerzo)), '1', 2);
                                $promedios[$student->idStudent]['promedio'] = $value;
                            } else {
                                $value = bcdiv($ac / ($c + count($refuerzo)), '1', 2);
                                $promedios[$student->idStudent]['promedio'] = $value;
                            }
                        } else {
                            if ($PromedioInsumo->valor != 1) {
                                $value = bcdiv($ac / count($insumos), '1', 2);
                                $promedios[$student->idStudent]['promedio'] = bcdiv($value, '1', 2);
                            } else {
                                $value = bcdiv($ac / $c, '1', 2);
                                $promedios[$student->idStudent]['promedio'] = bcdiv($value, '1', 2);
                            }
                        }
                    } else {
                        $promedios[$student->idStudent]['promedio'] = 0.0;
                    }
                } else {
                    $promedios[$student->idStudent]['promedio'] = 0.0;
                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioMatterParcialSinRefuerzo($materia, $parcial)
    {
        try {
            $promedios = [];

            $matter = Matter::find($materia);
            $students = Student2::getStudentsByCourse($matter->idCurso);

            $promInsumos = Calificacion::getPromedioSupplySinRefuerzo($matter->id, $matter->idCurso, $parcial);
            foreach ($students as $student) {
                $ac = 0;

                $insumos = Supply::where(['idCurso' => $matter->idCurso, 'idMateria' => $matter->id])
                    ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();

                foreach ($insumos as $insumo) {
                    $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);
                }
                if (count($insumos) != 0) {
                    $value = floatval($ac / count($insumos));
                    $promedios[$student->id]['promedio'] = $value;
                } else {
                    $promedios[$student->id]['promedio'] = 0.0;
                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioParcialMateriaConRefuerzo($materia, $parcial)
    {
        try {
            $promedios = [];
            $matter = Matter::find($materia);
            $students = Student2Profile::getStudentsByCourse($matter->idCurso);
            $promInsumos = Calificacion::getPromedioSupply($matter->id, $matter->idCurso, $parcial);
            foreach ($students as $student) {
                $ac = 0;
                $insumos = Supply::where(['idCurso' => $matter->idCurso, 'idMateria' => $matter->id])
                    ->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
                    ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')
                    ->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();
                $act = Activity::whereIn('idInsumo', $insumos->pluck('id'))->where(['refuerzo' => 1, 'parcial' => $parcial])->get();
                $cal = Calificacion::whereIn('idActividad', $act->pluck('id'))->where('idEstudiante', $student->idStudent)->get();
                $faltaEvaluacion = false;
                if (count($cal) != 0) {
                    foreach ($insumos->where('es_aporte', 0) as $insumo) {
                        if ($act->where('idInsumo', $insumo->id)->first() != null) {
                            $nota = $cal->where('idActividad', $act->where('idInsumo', $insumo->id)->first()->id)->first();
                            if ($nota != null) {
                                $ac += floatval($promInsumos[$insumo->id][$student->idStudent]['promedio']) + $nota->nota;
                            } else {
                                $ac += floatval($promInsumos[$insumo->id][$student->idStudent]['promedio']);
                            }
                        } else {
                            $ac += floatval($promInsumos[$insumo->id][$student->idStudent]['promedio']);
                        }
                    }
                } else {
                    foreach ($insumos as $insumo) {
                        $ac += floatval($promInsumos[$insumo->id][$student->idStudent]['promedio']);
                        if ($promInsumos[$insumo->id][$student->idStudent]['promedio'] == 0) {
                            $faltaEvaluacion = true;
                        }
                    }
                }

                if ($faltaEvaluacion) {
                    $promedios[$student->idStudent]['promedio'] = 0.0;
                } else {
                    if (count($insumos) != 0) {
                        if (count($cal) != 0) {
                            $value = floatval($ac / (count($insumos->where('es_aporte', 0)) + count($cal)));
                        } else {
                            $value = floatval($ac / count($insumos));
                        }

                        $promedios[$student->idStudent]['promedio'] = $value;
                    } else {
                        $promedios[$student->idStudent]['promedio'] = 0.0;
                    }
                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioMatterStudent($idCurso, $parcial, $studentId)
    {
        try {
            $promedios = [];

            $student = Student2::find($studentId);
            $matters = Matter::getMattersByCourse($idCurso);
            foreach ($matters as $matter) {
                $promInsumos = Calificacion::getPromedioSupply($matter->id, $idCurso, $parcial);

                $ac = 0;
                $insumos = Supply::where(['idCurso' => $idCurso, 'idMateria' => $matter->id])
                    ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();

                foreach ($insumos as $insumo) {
                    $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);
                }
                if (count($insumos) != 0) {
                    $value = floatval($ac / count($insumos));
                    $promedios[$matter->id][$student->id]['promedio'] = $value;
                } else {
                    $promedios[$matter->id][$student->id]['promedio'] = 0.0;
                }

            }

            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioGeneralMaterias($idCurso, $parcial)
    {
        try {
            $promedios = [];

            $students = Student2::getStudentsByCourse($idCurso);
            $matters = Matter::getMattersByCourse($idCurso);
            foreach ($matters as $matter) {
                $promInsumos = Calificacion::getPromedioSupply($matter->id, $idCurso, $parcial);
                foreach ($students as $student) {
                    $ac = 0;
                    $mostrar = true;
                    $insumos = Supply::where(['idCurso' => $idCurso, 'idMateria' => $matter->id])
                        ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();

                    foreach ($insumos as $insumo) {
                        $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);
                        if ($insumo->nombre == 'EVALUACION' && $promInsumos[$insumo->id][$student->id]['promedio'] == 0) {
                            $mostrar = false;
                        }
                    }
                    if ($mostrar) {
                        if (count($insumos) != 0) {
                            $value = floatval($ac / count($insumos));
                            $promedios[$matter->id][$student->id]['promedio'] = $value;
                        } else {
                            $promedios[$matter->id][$student->id]['promedio'] = 0.0;
                        }
                    } else {
                        //unset($promedios[$matter->id][$student->id]);
                        $students = $students->keyBy('id');
                        $students->forget($student->id);
                    }
                }
            }
            $pg = [];

            foreach ($matters as $m) {
                $pg[$m->id] = 0;
                foreach ($students as $s) {
                    $pg[$m->id] += $promedios[$m->id][$s->id]['promedio'];
                }
            }

            $promedioGeneral = [];
            foreach ($matters as $m) {
                if ($m->area == "LENGUA EXTRANJERA" && $m->nivel != null) {
                    $nivel = "";
                    if ($m->nivel == "INTENSIVO") {
                        $nivel = "Intensivo";
                    } else {
                        $nivel = "Regular";
                    }

                    $promedioGeneral[$m->id] = $pg[$m->id] / count($students->where('nivelDeIngles', $nivel));
                } else {
                    if (count($students) > 0) {
                        $promedioGeneral[$m->id] = $pg[$m->id] / count($students);
                    } else {
                        $promedioGeneral[$m->id] = 0;
                    }

                }

            }

            return $promedioGeneral;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioGeneralMateriasQuimestre($idCurso, $parcial)
    {
        try {
            $promedios = [];

            $students = Student2Profile::getStudentsByCourse($idCurso);
            // dd($students);
            $matters = Matter::getMattersByCourse($idCurso);
            $promedios = Calificacion::getPromedioFinalQuimestreCurso($idCurso, substr($parcial, 2, 2));
            $studentsSinPromedio = [];
            foreach ($matters as $m) {
                $pg[$m->id] = 0;
                $studentsSinPromedio[$m->id] = [];
                foreach ($students as $s) {

                    $pg[$m->id] += $promedios[$m->id][$s->id];
                    if ($promedios[$m->id][$s->id] == 0) {
                        array_push($studentsSinPromedio[$m->id], $s->id);
                    }
                }
            }

            $promedioGeneral = [];
            foreach ($matters as $m) {
                if ($m->area == "LENGUA EXTRANJERA" && $m->nivel != null) {
                    $nivel = "";
                    if ($m->nivel == "INTENSIVO") {
                        $nivel = "Intensivo";
                    } else {
                        $nivel = "Regular";
                    }

                    if (count($students->whereNotIn('id', $studentsSinPromedio[$m->id])) != 0) {
                        $promedioGeneral[$m->id] = $pg[$m->id] / count($students->whereNotIn('id', $studentsSinPromedio[$m->id])->where('nivelDeIngles', $nivel));
                    } else {
                        $promedioGeneral[$m->id] = 0;
                    }

                } else {
                    if (count($students->whereNotIn('id', $studentsSinPromedio[$m->id])) != 0) {
                        $promedioGeneral[$m->id] = $pg[$m->id] / count($students->whereNotIn('id', $studentsSinPromedio[$m->id]));
                    } else {
                        $promedioGeneral[$m->id] = 0;
                    }

                }

            }
            return $promedioGeneral;
        } catch (Exception $e) {
            return null;
        }
    }

    //////////PROMEDIOS GENERALES POR DOCENTE
    public static function getPromedioGeneralMateriasDocente($idDocente, $parcial)
    {

        try {
            $promedios = [];
            $teacher = Administrative::find($idDocente);
            $coursesID = Matter::getMattersByProfessor($teacher->userid)->pluck('idCurso')->toArray();
            $matters = Matter::getMattersByProfessor($teacher->userid);
            $students = Student2::getStudentsByCourse($coursesID);
            $cursos = Course::getCoursesByDocente($teacher->userid)->where('seccion', '!=', 'EI');

            foreach ($cursos as $curso) {
                if ($curso->seccion != 'EI') {
                    $promedios[$curso->id] = Calificacion::getPromedioGeneralMaterias($curso->id, $parcial);
                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioGeneralMateriasQuimestreDocente($idDocente, $parcial)
    {
        try {
            $promedios = [];

            $teacher = Administrative::find($idDocente);
            $coursesID = Matter::getMattersByProfessor($teacher->userid)->pluck('idCurso')->toArray();
            $matters = Matter::getMattersByProfessor($teacher->userid);
            $students = Student2::getStudentsByCourse($coursesID);
            $cursos = Course::getCoursesByDocente($teacher->userid)->where('seccion', '!=', 'EI');
            foreach ($cursos as $course) {
                if ($course->seccion != 'EI') {
                    $calificaciones = Calificacion::getPromedioFinalQuimestreCurso($course->id, substr($parcial, 2, 2));
                    foreach ($matters->where('idCurso', $course->id) as $matter) {
                        $promedios[$course->id][$matter->id] = 0;
                        foreach ($students->where('idCurso', $course->id) as $student) {
                            $promedios[$course->id][$matter->id] += $calificaciones[$matter->id][$student->id];
                        }
                        $promedios[$course->id][$matter->id] = $promedios[$course->id][$matter->id] / count($students->where('idCurso', $course->id));
                    }

                }

            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioGeneralMateriasAnualDocente($idDocente)
    {
        try {
            $promedios = [];

            $teacher = Administrative::find($idDocente);
            $coursesID = Matter::getMattersByProfessor($teacher->userid)->pluck('idCurso')->toArray();
            $matters = Matter::getMattersByProfessor($teacher->userid);
            $students = Student2::getStudentsByCourse($coursesID);
            $cursos = Course::getCoursesByDocente($teacher->userid)->where('seccion', '!=', 'EI');
            foreach ($cursos as $course) {
                if ($course->seccion != 'EI') {
                    $calificaciones = Calificacion::getPromedioFinalQuimestreCurso($course->id, 'q1');
                    $promediosq1 = [];
                    foreach ($matters->where('idCurso', $course->id) as $matter) {
                        $promediosq1[$course->id][$matter->id] = 0;
                        foreach ($students->where('idCurso', $course->id) as $student) {
                            $promediosq1[$course->id][$matter->id] += $calificaciones[$matter->id][$student->id];
                        }
                        $promediosq1[$course->id][$matter->id] = $promediosq1[$course->id][$matter->id] / count($students->where('idCurso', $course->id));
                    }

                    $calificaciones = Calificacion::getPromedioFinalQuimestreCurso($course->id, 'q2');
                    $promediosq2 = [];
                    foreach ($matters->where('idCurso', $course->id) as $matter) {
                        $promediosq2[$course->id][$matter->id] = 0;
                        foreach ($students->where('idCurso', $course->id) as $student) {
                            $promediosq2[$course->id][$matter->id] += $calificaciones[$matter->id][$student->id];
                        }
                        $promediosq2[$course->id][$matter->id] = $promediosq2[$course->id][$matter->id] / count($students->where('idCurso', $course->id));
                    }

                    foreach ($matters->where('idCurso', $course->id) as $matter) {
                        $promedios[$course->id][$matter->id] = ($promediosq1[$course->id][$matter->id] + $promediosq2[$course->id][$matter->id]) / 2;
                    }
                }

            }

            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

/////////////////////////////////////
    public static function getRefuerzosAcademicos($idMatter, $idCurso, $parcial)
    {

        try {
            $promedios = [];
            $insumos = Supply::where(['idMateria' => $idMatter, 'idCurso' => $idCurso])
                ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')
                ->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->where('es_aporte', 0)->get();
            $students = Student2Profile::where('idCurso', $idCurso)->get();

            foreach ($insumos as $insumo) {
                $promedios[$insumo->id] = [];
                foreach ($students as $student) {
                    $actividadesParcial = [];
                    $activities = Activity::where(['idInsumo' => $insumo->id, 'parcial' => $parcial, 'calificado' => 1, 'refuerzo' => 1])->get();

                    foreach ($activities as $activity) {
                        array_push($actividadesParcial, $activity->id);
                    }
                    $c = count($activities);
                    $calificaciones = Calificacion::where(['idInsumo' => $insumo->id, 'idEstudiante' => $student->id])->whereIn('idActividad', $actividadesParcial)->get();
                    $promedio = 0;
                    foreach ($calificaciones as $calificacion) {
                        $promedio = $promedio + $calificacion->nota;
                    }

                    if ($c > 0) {
                        $promedios[$insumo->id][$student->id] = array('promedio' => $promedio / $c);
                    } else {
                        $promedios[$insumo->id][$student->id] = array('promedio' => 0);
                    }

                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioQuimestreEstudianteMateria($materia, $quimestre, $student)
    {
        $matter = Matter::find($materia);
        $supply = Supply::where(['idMateria' => $matter->id, 'nombre' => 'EXAMEN QUIMESTRAL'])->first();
        $student = Student2::find($student);
        $promediosP1 = Calificacion::getPromedioMatterParcial($matter->id, 'p1' . $quimestre);
        $promediosP2 = Calificacion::getPromedioMatterParcial($matter->id, 'p2' . $quimestre);
        $promediosP3 = Calificacion::getPromedioMatterParcial($matter->id, 'p3' . $quimestre);
        $calificaciones = Calificacion::where('idInsumo', $supply->id)->get();
        $promediosTotal = [];

        if ($promediosP1[$student->id]['promedio'] != 0 ||
            $promediosP2[$student->id]['promedio'] != 0 ||
            $promediosP3[$student->id]['promedio'] != 0) {
            $parciales = ($promediosP1[$student->id]['promedio'] + $promediosP2[$student->id]['promedio'] + $promediosP3[$student->id]['promedio']) / 3;
            if ($calificaciones->where('idEstudiante', $student->id)->first() != null) {
                $promediosTotal = ($parciales * (0.8)) + ($calificaciones->where('idEstudiante', $student->id)->first()->nota * 0.2);
            } else {
                $promediosTotal = ($parciales * (0.8));
            }

        } else {
            $promediosTotal = 0;
        }

        return $promediosTotal;
    }

    public static function CuadroDeHonor($curso, $quimestre)
    {
        $unidad = UnidadPeriodica::unidadP()->where('identificador', $quimestre)->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
        $students = Student2::getStudentsByCourse($curso);
        $cuadro = [];
        $matters = Matter::where(['idCurso' => $curso, 'visible' => 1, 'principal' => 1])
            ->orderByRaw("FIELD(area,'LENGUA Y LITERATURA','MATEMÁTICA','CIENCIAS NATURALES','CIENCIAS SOCIALES','EDUCACIÓN CULTURAL Y ARTÍSTICA','EDUCACIÓN FÍSICA','LENGUA EXTRANJERA','COMPUTACIÓN')")
            ->get();
        // dd(count($matters));
        $supplies = Supply::whereIn('idMateria', $matters->pluck('id')->toArray())
            ->where('nombre', 'EXAMEN QUIMESTRAL')->get();
        $calificaciones = Calificacion::whereIn('idInsumo', $supplies->pluck('id')->toArray())->get();
        $promediosP1 = [];
        $promediosP2 = [];
        $promediosP3 = [];
        $division = count($parcialP) - 1;
        $P1 = 0;
        $P2 = 0;
        $P3 = 0;
        $Ex = 0;
        $variable = '';
        foreach ($matters as $matter) {
            foreach ($parcialP as $par) { //creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                switch ($par->identificador) {
                    case 'p1' . $quimestre:
                        $promediosP1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1' . $quimestre);
                        break;
                    case 'p2' . $quimestre:
                        $promediosP2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2' . $quimestre);
                        break;
                    case 'p3' . $quimestre:
                        $promediosP3[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3' . $quimestre);
                        break;
                }
            }
            /*  $promediosP1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p1'.$quimestre);
        $promediosP2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p2'.$quimestre);
        $promediosP3[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id,'p3'.$quimestre);*/
        }
        foreach ($students as $s) {
            $promediosTotal = 0;
            $mostrar = true;
            foreach ($matters as $matter) {
                if ((isset($promediosP1)) && ($promediosP1 != [])) {
                    $P1 = $promediosP1[$matter->id][$s->id]['promedio'];
                    $variable .= '$P1 !=0 ';
                } else {
                    $promediosP1 = [];
                }
                if ((isset($promediosP2)) && ($promediosP2 != [])) {
                    $P2 = $promediosP2[$matter->id][$s->id]['promedio'];
                    $variable .= ' && $P2 !=0 ';
                } else {
                    $promediosP2 = [];
                }
                if ((isset($promediosP3)) && ($promediosP3 != [])) {
                    $P3 = $promediosP3[$matter->id][$s->id]['promedio'];
                    $variable .= ' && $P3 !=0 ';
                } else {
                    $promediosP3 = [];
                }
                if ($variable) { // reemplazar los || por && para que si falta un parcial o examen su promedio salga cero
                    $parciales = bcdiv(($P1 +
                        $P2 +
                        $P3) / $division, '1', 2);
                    $act = Activity::where(['idInsumo' => $supplies->where('idMateria', $matter->id)->first()->id, 'parcial' => $quimestre])->first()->id; //->activities()->get();//->pluck('id')->toArray();
                    $calif = $calificaciones->where('idEstudiante', $s->id)->where('idActividad', $act)->first();
                    if ($calif != null) {
                        $promediosTotal += bcdiv(($parciales * (0.8)) + ($calif->nota * 0.2), '1', 2);
                    } else {
                        $mostrar = false;
                        $promediosTotal += bcdiv(($parciales * (0.8)), '1', 2);
                    }
                } else {
                    $promediosTotal += 0;
                }
            }
            if ($mostrar) {
                $cuadro[$s->id] = bcdiv(($promediosTotal / count($matters)), '1', 2);
            }

        }
        arsort($cuadro);
        $NroEstudiantesCH = ConfiguracionSistema::EstudiantesCuadroHonor();
        $cuadro = array_slice($cuadro, 0, (int) $NroEstudiantesCH->valor, true);

        return $cuadro;
    }

    public static function getPromedioQuimestreEstudiante($quimestre, $id)
    {
        $matters = Matter::getMattersByStudent($id);

        $promediosTotal = 0;
        foreach ($matters as $matter) {
            $supply = Supply::where(['idMateria' => $matter->id, 'nombre' => 'EXAMEN QUIMESTRAL'])->first();
            $student = Student2::find($id);

            if ($student != null) {
                $promediosP1 = Calificacion::getPromedioMatterParcial($matter->id, 'p1' . $quimestre);
                $promediosP2 = Calificacion::getPromedioMatterParcial($matter->id, 'p2' . $quimestre);
                $promediosP3 = Calificacion::getPromedioMatterParcial($matter->id, 'p3' . $quimestre);
                $calificaciones = Calificacion::where('idInsumo', $supply->id)->get();
                if ($promediosP1[$student->id]['promedio'] != 0 ||
                    $promediosP2[$student->id]['promedio'] != 0 ||
                    $promediosP3[$student->id]['promedio'] != 0) {
                    $parciales = ($promediosP1[$student->id]['promedio'] + $promediosP2[$student->id]['promedio'] + $promediosP3[$student->id]['promedio']) / 3;

                    if ($calificaciones->where('idEstudiante', $student->id)->first() != null) {
                        $promediosTotal += ($parciales * (0.8)) + ($calificaciones->where('idEstudiante', $student->id)->first()->nota * 0.2);
                    } else {
                        $promediosTotal += ($parciales * (0.8));
                    }

                } else {
                    $promediosTotal += 0;
                }
            } else {
                $promediosTotal = 0;
            }
        }

        return bcdiv($promediosTotal / count($matters), '1', 2);
    }

    public static function getPromedioTotalQuimestreMateria($materia, $quimestre)
    {
        $unidad = UnidadPeriodica::where('identificador', $quimestre)->first();
        $parcialesP = ParcialPeriodico::parcialP($unidad->id)->where('identificador', '!=', $quimestre);
        $matter = Matter::find($materia);
        $students = Student2Profile::getStudentsByCourse($matter->idCurso);
        $promediosP = [];
        foreach ($parcialesP as $pos) {
            $promediosP[$pos->identificador] = Calificacion::getPromedioMatterParcial($matter->id, $pos->identificador);
        }
        $calificaciones = Calificacion::getExamenesMateria($matter->id, $quimestre);
        $promediosTotal = [];
        $parciales = [];
        foreach ($students as $s) {
            $parciales[$s->idStudent] = 0;
            foreach ($promediosP as $pro) {
                if ($pro[$s->idStudent]['promedio'] != 0) {
                    $parciales[$s->idStudent] += ($pro[$s->idStudent]['promedio']);
                } else {
                    $parciales[$s->idStudent] = 0;
                    $promediosTotal[$s->idStudent] = 0;
                    break;
                }
            }
            if ($parciales[$s->idStudent] != 0) {
                $parciales[$s->idStudent] = bcdiv($parciales[$s->idStudent] / count($promediosP), '1', 2);
                if ($calificaciones[$s->idStudent] != null) {
                    $promediosTotal[$s->idStudent] = bcdiv(($parciales[$s->idStudent] * 0.8) + ($calificaciones[$s->idStudent] * 0.2), '1', 2);
                } else {
                    $promediosTotal[$s->idStudent] = bcdiv($parciales[$s->idStudent] * 0.8, '1', 2);
                }
            }
        }
        return $promediosTotal;
    }

    public static function getPromedioSubMateria($promedios, $materias, $insumos, $nInsumo, $studentID)
    {
        $promedio = 0;
        $total = 0;
        $c = 0;
        foreach ($materias as $m) {
            $id = $insumos->where('nombre', $nInsumo)->where('idMateria', $m)->first()->id;

            if ($promedios[$m][$id][$studentID]['promedio'] != 0) {
                $promedio += $promedios[$m][$id][$studentID]['promedio'];
                $c++;
            }
        }

        if ($c != 0) {
            $total = $promedio / $c;
        }
        return $total;
    }

    public static function getPromedioFinalQuimestreCurso($curso, $quimestre)
    {
        $unidad = UnidadPeriodica::unidadP()->where('identificador', $quimestre)->first();
        $parcialP = ParcialPeriodico::parcialP($unidad->id);
        $matters = Matter::where('idCurso', $curso)->orderBy('nombre')->get();
        $students = Student2Profile::getStudentsByCourse($curso);
        $promediosFinal = [];
        $promediosP1 = [];
        $promediosP2 = [];
        $promediosP3 = [];
        $examenes = [];
        $recuperacion = [];
        $promediosTotal = [];
        foreach ($matters as $matter) {
            $promediosP1[$matter->id] = [];
            $promediosP2[$matter->id] = [];
            $promediosP3[$matter->id] = [];
            foreach ($parcialP as $par) { //creado para hacer la consulta dinamica desde la tabla parciales_periodicos
                switch ($par->identificador) {
                    case 'p1' . $quimestre:
                        $promediosP1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1' . $quimestre);
                        break;
                    case 'p2' . $quimestre:
                        $promediosP2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2' . $quimestre);
                        break;
                    case 'p3' . $quimestre:
                        $promediosP3[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3' . $quimestre);
                        break;
                    case $quimestre:
                        $examenes[$matter->id] = Calificacion::getExamenesMateria($matter->id, $quimestre);
                        $recuperacion[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, $quimestre);
                        break;
                }
            }
            $promediosTotal[$matter->id] = [];
            $promediosFinal[$matter->id] = [];
            $division = count($parcialP) - 1;
            $P1 = 0;
            $P2 = 0;
            $P3 = 0;
            $Ex = 0;
            $variable = '';
            foreach ($students as $s) {
                if ((isset($promediosP1)) && ($promediosP1 != [])) {
                    $P1 = $promediosP1[$matter->id][$s->idStudent]['promedio'];
                    $variable .= '$P1 !=0 ';
                } else {
                    $promediosP1 = [];
                }
                if ((isset($promediosP2)) && ($promediosP2 != [])) {
                    $P2 = $promediosP2[$matter->id][$s->idStudent]['promedio'];
                    $variable .= ' && $P2 !=0 ';
                } else {
                    $promediosP2 = [];
                }
                if ((isset($promediosP3)) && ($promediosP3 != [])) {
                    $P3 = $promediosP3[$matter->id][$s->idStudent]['promedio'];
                    $variable .= ' && $P3 !=0 ';
                } else {
                    $promediosP3 = [];
                }
                if (isset($examenes)) {
                    $Ex = $examenes[$matter->id][$s->idStudent];
                    $variable .= ' && $Ex != 0';
                }
                if ($variable) { // reemplazar los || por && para que si falta un parcial o examen su promedio salga cero
                    $parciales = bcdiv(($P1 +
                        $P2 +
                        $P3) / $division, '1', 2);
                    $promediosTotal[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($examenes[$matter->id][$s->idStudent] * 0.2), '1', 2);
                    $ex = ($examenes[$matter->id][$s->idStudent] < $recuperacion[$matter->id][$s->idStudent]) ? $recuperacion[$matter->id][$s->idStudent] : $examenes[$matter->id][$s->idStudent];
                    $promediosFinal[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotal[$matter->id][$s->idStudent] = 0;
                    $promediosFinal[$matter->id][$s->idStudent] = 0;
                }
            }
        }
        return $promediosFinal;
    }

    public static function getExamenesMateria($idMateria, $quimestre)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'EXAMEN QUIMESTRAL'])->with('calificaciones')->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'parcial' => $quimestre])->first() : null;

        $students = Student2Profile::getStudentsByCourse($matter->idCurso);
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->idStudent)->first() != null) {
                    $examenes[$student->idStudent] = $calificaciones->where('idEstudiante', $student->idStudent)->first()->nota;
                } else {
                    $examenes[$student->idStudent] = 0;
                }

            } else {
                $examenes[$student->idStudent] = 0;
            }

        }

        return $examenes;
    }

    public static function getRecuperacionMateria($idMateria, $quimestre)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'RECUPERATORIO'])->with('calificaciones')->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'parcial' => $quimestre])->first() : null;
        $students = Student2Profile::getStudentsByCourse($matter->idCurso);
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->idStudent)->first() != null) {
                    $examenes[$student->idStudent] = $calificaciones->where('idEstudiante', $student->idStudent)->first()->nota;
                } else {
                    $examenes[$student->idStudent] = 0;
                }

            } else {
                $examenes[$student->idStudent] = 0;
            }

        }

        return $examenes;
    }

    public static function getSupletorioMateria($idMateria)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'RECUPERATORIO'])->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'nombre' => 'SUPLETORIO'])->first() : null;

        $students = Student2Profile::getStudentsByCourse($matter->idCurso);
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->idStudent)->first() != null) {
                    $examenes[$student->idStudent] = $calificaciones->where('idEstudiante', $student->idStudent)->first()->nota;
                } else {
                    $examenes[$student->idStudent] = 0;
                }

            } else {
                $examenes[$student->idStudent] = 0;
            }

        }
        return $examenes;
    }

    public static function getRemedialMateria($idMateria)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'RECUPERATORIO'])->with('calificaciones')->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'nombre' => 'REMEDIAL'])->first() : null;

        $students = Student2Profile::getStudentsByCourse($matter->idCurso);
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->idStudent)->first() != null) {
                    $examenes[$student->idStudent] = $calificaciones->where('idEstudiante', $student->idStudent)->first()->nota;
                } else {
                    $examenes[$student->idStudent] = 0;
                }

            } else {
                $examenes[$student->idStudent] = 0;
            }

        }

        return $examenes;
    }

    public static function getGraciaMateria($idMateria)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'RECUPERATORIO'])->with('calificaciones')->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'nombre' => 'GRACIA'])->first() : null;

        $students = Student2Profile::getStudentsByCourse($matter->idCurso);
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->idStudent)->first() != null) {
                    $examenes[$student->idStudent] = $calificaciones->where('idEstudiante', $student->idStudent)->first()->nota;
                } else {
                    $examenes[$student->idStudent] = 0;
                }

            } else {
                $examenes[$student->idStudent] = 0;
            }

        }
        return $examenes;
    }

    public static function AlumnosNotaFinal($idCurso)
    {
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $curso = Course::find($idCurso);
        $matters = Matter::getMattersAllByCourse($idCurso);
        #calificaciones

        foreach ($matters as $matter) {
            $promediosP1Q1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p1q1');

            $promediosP2Q1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p2q1');
            $promediosP3Q1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p3q1');
            $examenesQ1[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q1');
            $recuperacionQ1[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, 'q1');
            $promediosTotalQ1[$matter->id] = [];
            $promediosFinalQ1[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1Q1[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $promediosP2Q1[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $promediosP3Q1[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $examenesQ1[$matter->id][$s->idStudent] != 0) {
                    $parciales = bcdiv(($promediosP1Q1[$matter->id][$s->idStudent]['promedio'] +
                        $promediosP2Q1[$matter->id][$s->idStudent]['promedio'] +
                        $promediosP3Q1[$matter->id][$s->idStudent]['promedio']) / 3, '1', 2);
                    $promediosTotalQ1[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($examenesQ1[$matter->id][$s->idStudent] * 0.2), '1', 2);
                    $ex = $examenesQ1[$matter->id][$s->idStudent];

                    $promediosFinalQ1[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotalQ1[$matter->id][$s->idStudent] = 0;
                    $promediosFinalQ1[$matter->id][$s->idStudent] = 0;
                }
            }
        }

        foreach ($matters as $matter) {
            $promediosP1Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1q2');
            $promediosP2Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2q2');
            $promediosP3Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3q2');
            $examenesQ2[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q2');
            $recuperacionQ2[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, 'q2');

            $promediosTotalQ2[$matter->id] = [];
            $promediosFinalQ2[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1Q2[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $promediosP2Q2[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $promediosP3Q2[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $examenesQ2[$matter->id][$s->idStudent] != 0) {
                    $parciales = bcdiv(($promediosP1Q2[$matter->id][$s->idStudent]['promedio'] +
                        $promediosP2Q2[$matter->id][$s->idStudent]['promedio'] +
                        $promediosP3Q2[$matter->id][$s->idStudent]['promedio']) / 3, '1', 2);
                    $promediosTotalQ2[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($examenesQ2[$matter->id][$s->idStudent] * 0.2), '1', 2);
                    $ex = $examenesQ2[$matter->id][$s->idStudent];

                    $promediosFinalQ2[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotalQ2[$matter->id][$s->idStudent] = 0;
                    $promediosFinalQ2[$matter->id][$s->idStudent] = 0;
                }
            }
        }

        $promedioGeneral = [];
        $promedioGeneralRecup = [];
        $supletorios = [];
        $remediales = [];
        $gracias = [];
        $studentsNotaFinal = [];
        foreach ($matters as $matter) {
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
            $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
            foreach ($students as $student) {
                if ($promediosTotalQ1[$matter->id][$student->idStudent] > 0 && $promediosTotalQ2[$matter->id][$student->idStudent] > 0) {
                    $promedioGeneral[$matter->id][$student->idStudent] = bcdiv(($promediosTotalQ1[$matter->id][$student->idStudent] + $promediosTotalQ2[$matter->id][$student->idStudent]) / 2, '1', 2);
                    $promedioGeneralRecup[$matter->id][$student->idStudent] = bcdiv(($promediosFinalQ1[$matter->id][$student->idStudent] + $promediosFinalQ2[$matter->id][$student->idStudent]) / 2, '1', 2);

                    if ($promedioGeneralRecup[$matter->id][$student->idStudent] < $supletorios[$matter->id][$student->idStudent]) {
                        $studentsNotaFinal[$matter->id][$student->idStudent] = $supletorios[$matter->id][$student->idStudent];
                    } else if ($promedioGeneralRecup[$matter->id][$student->idStudent] < $remediales[$matter->id][$student->idStudent]) {
                        $studentsNotaFinal[$matter->id][$student->idStudent] = $remediales[$matter->id][$student->idStudent];
                    } else if ($promedioGeneralRecup[$matter->id][$student->idStudent] < $gracias[$matter->id][$student->idStudent]) {
                        $studentsNotaFinal[$matter->id][$student->idStudent] = $gracias[$matter->id][$student->idStudent];
                    } else {
                        $studentsNotaFinal[$matter->id][$student->idStudent] = $promedioGeneralRecup[$matter->id][$student->idStudent];
                    }
                } else {

                    $studentsNotaFinal[$matter->id][$student->idStudent] = 0;
                }
            }
        }
        #endsection
        return $studentsNotaFinal;
    }

    public static function AlumnosNotaFinalSinRecuperaciones($idCurso)
    {
        $students = Student2Profile::getStudentsByCourse($idCurso);
        $curso = Course::find($idCurso);
        $matters = Matter::getMattersAllByCourse($idCurso);
        #calificaciones

        foreach ($matters as $matter) {
            $promediosP1Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1q1');
            $promediosP2Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2q1');
            $promediosP3Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3q1');

            $examenesQ1[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q1');
            $promediosTotalQ1[$matter->id] = [];
            $promediosFinalQ1[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1Q1[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $promediosP2Q1[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $promediosP3Q1[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $examenesQ1[$matter->id][$s->idStudent] != 0) {
                    $parciales = bcdiv(($promediosP1Q1[$matter->id][$s->idStudent]['promedio'] +
                        $promediosP2Q1[$matter->id][$s->idStudent]['promedio'] +
                        $promediosP3Q1[$matter->id][$s->idStudent]['promedio']) / 3, '1', 2);
                    $promediosTotalQ1[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($examenesQ1[$matter->id][$s->idStudent] * 0.2), '1', 2);
                    $ex = $examenesQ1[$matter->id][$s->idStudent];

                    $promediosFinalQ1[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotalQ1[$matter->id][$s->idStudent] = 0;
                    $promediosFinalQ1[$matter->id][$s->idStudent] = 0;
                }
            }
        }

        foreach ($matters as $matter) {
            $promediosP1Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1q2');
            $promediosP2Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2q2');
            $promediosP3Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3q2');
            $examenesQ2[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q2');

            $promediosTotalQ2[$matter->id] = [];
            $promediosFinalQ2[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1Q2[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $promediosP2Q2[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $promediosP3Q2[$matter->id][$s->idStudent]['promedio'] != 0 &&
                    $examenesQ2[$matter->id][$s->idStudent] != 0) {
                    $parciales = bcdiv(($promediosP1Q2[$matter->id][$s->idStudent]['promedio'] +
                        $promediosP2Q2[$matter->id][$s->idStudent]['promedio'] +
                        $promediosP3Q2[$matter->id][$s->idStudent]['promedio']) / 3, '1', 2);
                    $promediosTotalQ2[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($examenesQ2[$matter->id][$s->idStudent] * 0.2), '1', 2);
                    $ex = $examenesQ2[$matter->id][$s->idStudent];

                    $promediosFinalQ2[$matter->id][$s->idStudent] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotalQ2[$matter->id][$s->idStudent] = 0;
                    $promediosFinalQ2[$matter->id][$s->idStudent] = 0;
                }
            }
        }

        $promedioGeneral = [];
        $promedioGeneralRecup = [];
        $supletorios = [];
        $remediales = [];
        $gracias = [];

        $studentsNotaFinal = [];
        foreach ($matters as $matter) {

            $recuperacionQ1[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, 'q1');
            $recuperacionQ2[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, 'q2');

            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
            $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
            foreach ($students as $student) {
                if ($promediosTotalQ1[$matter->id][$student->idStudent] > 0 && $promediosTotalQ2[$matter->id][$student->idStudent] > 0) {

                    $rec = $recuperacionQ1[$matter->id][$student->idStudent] > $recuperacionQ2[$matter->id][$student->idStudent] ? $recuperacionQ1[$matter->id][$student->idStudent] : $recuperacionQ2[$matter->id][$student->idStudent];

                    $pq1t = 0;
                    if ($promediosTotalQ1[$matter->id][$student->idStudent] < $promediosTotalQ2[$matter->id][$student->idStudent] &&
                        $promediosTotalQ1[$matter->id][$student->idStudent] < $rec) {
                        $pq1t = $rec;
                    } else {
                        $pq1t = $promediosTotalQ1[$matter->id][$student->idStudent];
                    }

                    $pq2t = 0;
                    if ($promediosTotalQ2[$matter->id][$student->idStudent] < $promediosTotalQ1[$matter->id][$student->idStudent] &&
                        $promediosTotalQ2[$matter->id][$student->idStudent] < $rec) {
                        $pq2t = $rec;
                    } else {
                        $pq2t = $promediosTotalQ2[$matter->id][$student->idStudent];
                    }

                    $pq1f = 0;
                    if ($promediosFinalQ1[$matter->id][$student->idStudent] < $promediosFinalQ2[$matter->id][$student->idStudent] &&
                        $promediosFinalQ1[$matter->id][$student->idStudent] < $rec) {
                        $pq1f = $rec;
                    } else {
                        $pq1f = $promediosFinalQ1[$matter->id][$student->idStudent];
                    }

                    $pq2f = 0;
                    if ($promediosFinalQ2[$matter->id][$student->idStudent] < $promediosFinalQ1[$matter->id][$student->idStudent] &&
                        $promediosFinalQ2[$matter->id][$student->idStudent] < $rec) {
                        $pq2f = $rec;
                    } else {
                        $pq2f = $promediosFinalQ2[$matter->id][$student->idStudent];
                    }

                    $promedioGeneral[$matter->id][$student->idStudent] = bcdiv(($pq1t + $pq2t) / 2, '1', 2);
                    $promedioGeneralRecup[$matter->id][$student->idStudent] = bcdiv(($pq1f + $pq2f) / 2, '1', 2);

                    $studentsNotaFinal[$matter->id][$student->idStudent] = $promedioGeneralRecup[$matter->id][$student->idStudent];

                } else {
                    $studentsNotaFinal[$matter->id][$student->idStudent] = 0;
                }
            }
        }
        #endsection
        return $studentsNotaFinal;
    }

    public static function getRemedialStudentMateria($idEstudiante, $idMateria)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'RECUPERATORIO'])->with('calificaciones')->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'nombre' => 'REMEDIAL'])->first() : null;

        $students = Student2::where('id', $idEstudiante)->get();
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->id)->first() != null) {
                    $examenes[$student->id] = $calificaciones->where('idEstudiante', $student->id)->first()->nota;
                } else {
                    $examenes[$student->id] = 0;
                }

            } else {
                $examenes[$student->id] = 0;
            }

        }

        return $examenes;
    }

    public static function getGraciaStudentMateria($idEstudiante, $idMateria)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'RECUPERATORIO'])->with('calificaciones')->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'nombre' => 'GRACIA'])->first() : null;

        $students = Student2::where('id', $idEstudiante)->get();
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->id)->first() != null) {
                    $examenes[$student->id] = $calificaciones->where('idEstudiante', $student->id)->first()->nota;
                } else {
                    $examenes[$student->id] = 0;
                }

            } else {
                $examenes[$student->id] = 0;
            }

        }

        return $examenes;
    }

    public static function getSupletorioStudentMateria($idEstudiante, $idMateria)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'RECUPERATORIO'])->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'nombre' => 'SUPLETORIO'])->first() : null;

        $students = Student2::where('id', $idEstudiante)->get();
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->id)->first() != null) {
                    $examenes[$student->id] = $calificaciones->where('idEstudiante', $student->id)->first()->nota;
                } else {
                    $examenes[$student->id] = 0;
                }

            } else {
                $examenes[$student->id] = 0;
            }

        }

        return $examenes;
    }

    public static function getRecuperacionStudentMateria($idMateria, $idEstudiante, $quimestre)
    {
        $examenes = Supply::where(['idMateria' => $idMateria, 'nombre' => 'RECUPERATORIO'])->with('calificaciones')->first();
        $matter = Matter::find($idMateria);
        $activity = ($examenes != null) ? Activity::where(['idInsumo' => $examenes->id, 'parcial' => $quimestre])->first() : null;

        $students = Student2::where('id', $idEstudiante)->get();
        $calificaciones = ($activity != null) ? Calificacion::where('idActividad', $activity->id)->get() : null;
        $examenes = [];
        foreach ($students as $student) {
            if ($calificaciones != null) {
                if ($calificaciones->where('idEstudiante', $student->id)->first() != null) {
                    $examenes[$student->id] = $calificaciones->where('idEstudiante', $student->id)->first()->nota;
                } else {
                    $examenes[$student->id] = 0;
                }

            } else {
                $examenes[$student->id] = 0;
            }

        }

        return $examenes;
    }

    public static function getPromedioGeneralStudent($idEstudiante)
    {
        $students = Student2::where('id', $idEstudiante)->get();
        $curso = Course::find($students->first()->idCurso);
        $matters = Matter::getMattersByStudent($idEstudiante);
        #calificaciones

        foreach ($matters as $matter) {
            $promediosP1Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1q1');

            $promediosP2Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2q1');
            $promediosP3Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3q1');
            $examenesQ1[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q1');
            $recuperacionQ1[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, 'q1');
            $promediosTotalQ1[$matter->id] = [];
            $promediosFinalQ1[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1Q1[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP2Q1[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP3Q1[$matter->id][$s->id]['promedio'] != 0 ||
                    $examenesQ1[$matter->id][$s->id] != 0) {
                    $parciales = bcdiv(($promediosP1Q1[$matter->id][$s->id]['promedio'] +
                        $promediosP2Q1[$matter->id][$s->id]['promedio'] +
                        $promediosP3Q1[$matter->id][$s->id]['promedio']) / 3, '1', 2);
                    $promediosTotalQ1[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($examenesQ1[$matter->id][$s->id] * 0.2), '1', 2);
                    $ex = ($examenesQ1[$matter->id][$s->id] < $recuperacionQ1[$matter->id][$s->id]) ? $recuperacionQ1[$matter->id][$s->id] : $examenesQ1[$matter->id][$s->id];

                    $promediosFinalQ1[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotalQ1[$matter->id][$s->id] = 0;
                    $promediosFinalQ1[$matter->id][$s->id] = 0;
                }
            }
        }

        foreach ($matters as $matter) {
            $promediosP1Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1q2');
            $promediosP2Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2q2');
            $promediosP3Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3q2');
            $examenesQ2[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q2');
            $recuperacionQ2[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, 'q2');

            $promediosTotalQ2[$matter->id] = [];
            $promediosFinalQ2[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1Q2[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP2Q2[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP3Q2[$matter->id][$s->id]['promedio'] != 0 ||
                    $examenesQ2[$matter->id][$s->id] != 0) {
                    $parciales = bcdiv(($promediosP1Q2[$matter->id][$s->id]['promedio'] +
                        $promediosP2Q2[$matter->id][$s->id]['promedio'] +
                        $promediosP3Q2[$matter->id][$s->id]['promedio']) / 3, '1', 2);
                    $promediosTotalQ2[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($examenesQ2[$matter->id][$s->id] * 0.2), '1', 2);
                    $ex = ($examenesQ2[$matter->id][$s->id] < $recuperacionQ2[$matter->id][$s->id]) ? $recuperacionQ2[$matter->id][$s->id] : $examenesQ2[$matter->id][$s->id];

                    $promediosFinalQ2[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotalQ2[$matter->id][$s->id] = 0;
                    $promediosFinalQ2[$matter->id][$s->id] = 0;
                }
            }
        }

        $promedioGeneral = [];
        $promedioGeneralRecup = [];
        $supletorios = [];
        $remediales = [];
        $gracias = [];

        $studentsNotaFinal = [];
        foreach ($matters as $matter) {
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
            $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
            foreach ($students as $student) {
                $promedioGeneral[$matter->id][$student->id] = bcdiv(($promediosTotalQ1[$matter->id][$student->id] + $promediosTotalQ2[$matter->id][$student->id]) / 2, '1', 2);
                $promedioGeneralRecup[$matter->id][$student->id] = bcdiv(($promediosFinalQ1[$matter->id][$student->id] + $promediosFinalQ2[$matter->id][$student->id]) / 2, '1', 2);

                if ($promedioGeneralRecup[$matter->id][$student->id] < $supletorios[$matter->id][$student->id]) {
                    $studentsNotaFinal[$matter->id][$student->id] = $supletorios[$matter->id][$student->id];
                } else if ($promedioGeneralRecup[$matter->id][$student->id] < $remediales[$matter->id][$student->id]) {
                    $studentsNotaFinal[$matter->id][$student->id] = $remediales[$matter->id][$student->id];
                } else if ($promedioGeneralRecup[$matter->id][$student->id] < $gracias[$matter->id][$student->id]) {
                    $studentsNotaFinal[$matter->id][$student->id] = $gracias[$matter->id][$student->id];
                } else {
                    $studentsNotaFinal[$matter->id][$student->id] = $promedioGeneralRecup[$matter->id][$student->id];
                }
            }
        }
        #endsection
        return $studentsNotaFinal;
    }

    public static function getPromedioGeneralStudentMateria($idEstudiante, $idMateria)
    {
        $students = Student2::where('id', $idEstudiante)->get();
        $curso = Course::find($students->first()->idCurso);
        $matters = Matter::where('id', $idMateria);
        #calificaciones

        foreach ($matters as $matter) {
            $promediosP1Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1q1');

            $promediosP2Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2q1');
            $promediosP3Q1[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3q1');
            $examenesQ1[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q1');
            $recuperacionQ1[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, 'q1');
            $promediosTotalQ1[$matter->id] = [];
            $promediosFinalQ1[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1Q1[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP2Q1[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP3Q1[$matter->id][$s->id]['promedio'] != 0 ||
                    $examenesQ1[$matter->id][$s->id] != 0) {
                    $parciales = bcdiv(($promediosP1Q1[$matter->id][$s->id]['promedio'] +
                        $promediosP2Q1[$matter->id][$s->id]['promedio'] +
                        $promediosP3Q1[$matter->id][$s->id]['promedio']) / 3, '1', 2);
                    $promediosTotalQ1[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($examenesQ1[$matter->id][$s->id] * 0.2), '1', 2);
                    $ex = ($examenesQ1[$matter->id][$s->id] < $recuperacionQ1[$matter->id][$s->id]) ? $recuperacionQ1[$matter->id][$s->id] : $examenesQ1[$matter->id][$s->id];

                    $promediosFinalQ1[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotalQ1[$matter->id][$s->id] = 0;
                    $promediosFinalQ1[$matter->id][$s->id] = 0;
                }
            }
        }

        foreach ($matters as $matter) {
            $promediosP1Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p1q2');
            $promediosP2Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p2q2');
            $promediosP3Q2[$matter->id] = Calificacion::getPromedioMatterParcial($matter->id, 'p3q2');
            $examenesQ2[$matter->id] = Calificacion::getExamenesMateria($matter->id, 'q2');
            $recuperacionQ2[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, 'q2');

            $promediosTotalQ2[$matter->id] = [];
            $promediosFinalQ2[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1Q2[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP2Q2[$matter->id][$s->id]['promedio'] != 0 ||
                    $promediosP3Q2[$matter->id][$s->id]['promedio'] != 0 ||
                    $examenesQ2[$matter->id][$s->id] != 0) {
                    $parciales = bcdiv(($promediosP1Q2[$matter->id][$s->id]['promedio'] +
                        $promediosP2Q2[$matter->id][$s->id]['promedio'] +
                        $promediosP3Q2[$matter->id][$s->id]['promedio']) / 3, '1', 2);
                    $promediosTotalQ2[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($examenesQ2[$matter->id][$s->id] * 0.2), '1', 2);
                    $ex = ($examenesQ2[$matter->id][$s->id] < $recuperacionQ2[$matter->id][$s->id]) ? $recuperacionQ2[$matter->id][$s->id] : $examenesQ2[$matter->id][$s->id];

                    $promediosFinalQ2[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotalQ2[$matter->id][$s->id] = 0;
                    $promediosFinalQ2[$matter->id][$s->id] = 0;
                }
            }
        }

        $promedioGeneral = [];
        $promedioGeneralRecup = [];
        $supletorios = [];
        $remediales = [];
        $gracias = [];

        $studentsNotaFinal = [];
        foreach ($matters as $matter) {
            $supletorios[$matter->id] = Calificacion::getSupletorioMateria($matter->id);
            $remediales[$matter->id] = Calificacion::getRemedialMateria($matter->id);
            $gracias[$matter->id] = Calificacion::getGraciaMateria($matter->id);
            foreach ($students as $student) {
                $promedioGeneral[$matter->id][$student->id] = bcdiv(($promediosTotalQ1[$matter->id][$student->id] + $promediosTotalQ2[$matter->id][$student->id]) / 2, '1', 2);
                $promedioGeneralRecup[$matter->id][$student->id] = bcdiv(($promediosFinalQ1[$matter->id][$student->id] + $promediosFinalQ2[$matter->id][$student->id]) / 2, '1', 2);

                if ($promedioGeneralRecup[$matter->id][$student->id] < $supletorios[$matter->id][$student->id]) {
                    $studentsNotaFinal[$matter->id][$student->id] = $supletorios[$matter->id][$student->id];
                } else if ($promedioGeneralRecup[$matter->id][$student->id] < $remediales[$matter->id][$student->id]) {
                    $studentsNotaFinal[$matter->id][$student->id] = $remediales[$matter->id][$student->id];
                } else if ($promedioGeneralRecup[$matter->id][$student->id] < $gracias[$matter->id][$student->id]) {
                    $studentsNotaFinal[$matter->id][$student->id] = $gracias[$matter->id][$student->id];
                } else {
                    $studentsNotaFinal[$matter->id][$student->id] = $promedioGeneralRecup[$matter->id][$student->id];
                }
            }
        }
        #endsection
        return $studentsNotaFinal;
    }

    public static function getPromedioQuimestreStudent($idEstudiante, $quimestre)
    {
        $students = Student2::where('id', $idEstudiante)->get();
        $curso = Course::find($students->first()->idCurso);
        $matters = Matter::getMattersByCourse($curso);
        $promediosFinal = [];
        $promediosP1 = [];
        $promediosP2 = [];
        $promediosP3 = [];
        $examenes = [];
        $recuperacion = [];
        $promediosTotal = [];
        foreach ($matters as $matter) {
            $promediosP1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p1' . $quimestre);
            $promediosP2[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p2' . $quimestre);
            $promediosP3[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p3' . $quimestre);
            $examenes[$matter->id] = Calificacion::getExamenesMateria($matter->id, $quimestre);
            $recuperacion[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, $quimestre);
            $promediosTotal[$matter->id] = [];
            $promediosFinal[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1[$matter->id][$s->id]['promedio'] != 0 &&
                    $promediosP2[$matter->id][$s->id]['promedio'] != 0 &&
                    $promediosP3[$matter->id][$s->id]['promedio'] != 0 &&
                    $examenes[$matter->id][$s->id] != 0) {

                    $parciales = bcdiv(($promediosP1[$matter->id][$s->id]['promedio'] +
                        $promediosP2[$matter->id][$s->id]['promedio'] +
                        $promediosP3[$matter->id][$s->id]['promedio']) / 3, '1', 2);
                    $promediosTotal[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($examenes[$matter->id][$s->id] * 0.2), '1', 2);

                    $ex = ($examenes[$matter->id][$s->id] < $recuperacion[$matter->id][$s->id]) ? $recuperacion[$matter->id][$s->id] : $examenes[$matter->id][$s->id];

                    $promediosFinal[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotal[$matter->id][$s->id] = 0;
                    $promediosFinal[$matter->id][$s->id] = 0;
                }
            }
        }

        return $promediosFinal;
    }

    public static function getPromedioQuimestreStudentMateria($idMateria, $idEstudiante, $quimestre)
    {
        $students = Student2::where('id', $idEstudiante)->get();
        $curso = Course::find($students->first()->idCurso);
        $matters = Matter::where('id', $idMateria);
        $promediosFinal = [];
        $promediosP1 = [];
        $promediosP2 = [];
        $promediosP3 = [];
        $examenes = [];
        $recuperacion = [];
        $promediosTotal = [];
        foreach ($matters as $matter) {
            $promediosP1[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p1' . $quimestre);
            $promediosP2[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p2' . $quimestre);
            $promediosP3[$matter->id] = Calificacion::getPromedioParcialMateriaConRefuerzo($matter->id, 'p3' . $quimestre);
            $examenes[$matter->id] = Calificacion::getExamenesMateria($matter->id, $quimestre);
            $recuperacion[$matter->id] = Calificacion::getRecuperacionMateria($matter->id, $quimestre);
            $promediosTotal[$matter->id] = [];
            $promediosFinal[$matter->id] = [];
            foreach ($students as $s) {
                if ($promediosP1[$matter->id][$s->id]['promedio'] != 0 &&
                    $promediosP2[$matter->id][$s->id]['promedio'] != 0 &&
                    $promediosP3[$matter->id][$s->id]['promedio'] != 0 &&
                    $examenes[$matter->id][$s->id] != 0) {

                    $parciales = bcdiv(($promediosP1[$matter->id][$s->id]['promedio'] +
                        $promediosP2[$matter->id][$s->id]['promedio'] +
                        $promediosP3[$matter->id][$s->id]['promedio']) / 3, '1', 2);
                    $promediosTotal[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($examenes[$matter->id][$s->id] * 0.2), '1', 2);

                    $ex = ($examenes[$matter->id][$s->id] < $recuperacion[$matter->id][$s->id]) ? $recuperacion[$matter->id][$s->id] : $examenes[$matter->id][$s->id];

                    $promediosFinal[$matter->id][$s->id] = bcdiv(($parciales * 0.8) + ($ex * 0.2), '1', 2);
                } else {
                    $promediosTotal[$matter->id][$s->id] = 0;
                    $promediosFinal[$matter->id][$s->id] = 0;
                }
            }
        }

        return $promediosFinal;
    }

    public static function getPromedioParcialStudentMateria($idEstudiante, $parcial, $materia)
    {
        try {
            $promedios = [];

            $matter = Matter::find($materia);
            $students = Student2::where('id', $idEstudiante)->get();

            $promInsumos = Calificacion::getPromedioSupplySinRefuerzo($matter->id, $matter->idCurso, $parcial);
            //
            foreach ($students as $student) {
                $ac = 0;

                $insumos = Supply::where(['idCurso' => $matter->idCurso, 'idMateria' => $matter->id])
                    ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')
                    ->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();

                $act = Activity::whereIn('idInsumo', $insumos->pluck('id'))->where(['refuerzo' => 1, 'parcial' => $parcial])->get();
                $cal = Calificacion::whereIn('idActividad', $act->pluck('id'))->where('idEstudiante', $student->id)->get();
                $faltaEvaluacion = false;
                if (count($cal) != 0) {
                    foreach ($insumos->where('es_aporte', 0) as $insumo) {

                        if ($act->where('idInsumo', $insumo->id)->first() != null) {
                            // $nota = Calificacion::where(['idInsumo' => $insumo->id,
                            //                     'idActividad' => $act->where('idInsumo', $insumo->id)->first()->id,
                            //                     'idEstudiante' => $student->id])
                            //                     ->first();
                            $nota = $cal->where('idActividad', $act->where('idInsumo', $insumo->id)->first()->id)->first();

                            if ($nota != null) {

                                $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']) + $nota->nota;
                            } else {
                                $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);

                            }
                        } else {
                            $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);

                        }
                    }
                } else {
                    foreach ($insumos as $insumo) {
                        $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);
                        if ($promInsumos[$insumo->id][$student->id]['promedio'] == 0) {

                            $faltaEvaluacion = true;
                        }
                    }
                }

                if ($faltaEvaluacion) {
                    $promedios[$student->id]['promedio'] = 0.0;
                } else {
                    if (count($insumos) != 0) {
                        if (count($cal) != 0) {
                            $value = floatval($ac / (count($insumos->where('es_aporte', 0)) + count($cal)));
                        } else {
                            $value = floatval($ac / count($insumos));
                        }

                        $promedios[$student->id]['promedio'] = $value;
                    } else {
                        $promedios[$student->id]['promedio'] = 0.0;
                    }
                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getPromedioParcialStudent($idEstudiante, $parcial)
    {
        try {
            $promedios = [];

            $students = Student2::where('id', $idEstudiante)->get();
            $matter = Matter::getMattersByStudent($students->first()->id);

            $promInsumos = Calificacion::getPromedioSupplySinRefuerzo($matter->id, $matter->idCurso, $parcial);
            //
            foreach ($students as $student) {
                $ac = 0;

                $insumos = Supply::where(['idCurso' => $matter->idCurso, 'idMateria' => $matter->id])
                    ->where('nombre', '!=', 'RECUPERATORIO')->where('nombre', '!=', 'ENSAYO')
                    ->where('nombre', '!=', 'EXAMEN QUIMESTRAL')->get();

                $act = Activity::whereIn('idInsumo', $insumos->pluck('id'))->where(['refuerzo' => 1, 'parcial' => $parcial])->get();
                $cal = Calificacion::whereIn('idActividad', $act->pluck('id'))->where('idEstudiante', $student->id)->get();
                $faltaEvaluacion = false;
                if (count($cal) != 0) {
                    foreach ($insumos->where('es_aporte', 0) as $insumo) {

                        if ($act->where('idInsumo', $insumo->id)->first() != null) {
                            // $nota = Calificacion::where(['idInsumo' => $insumo->id,
                            //                     'idActividad' => $act->where('idInsumo', $insumo->id)->first()->id,
                            //                     'idEstudiante' => $student->id])
                            //                     ->first();
                            $nota = $cal->where('idActividad', $act->where('idInsumo', $insumo->id)->first()->id)->first();

                            if ($nota != null) {

                                $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']) + $nota->nota;
                            } else {
                                $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);

                            }
                        } else {
                            $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);

                        }
                    }
                } else {
                    foreach ($insumos as $insumo) {
                        $ac += floatval($promInsumos[$insumo->id][$student->id]['promedio']);
                        if ($promInsumos[$insumo->id][$student->id]['promedio'] == 0) {

                            $faltaEvaluacion = true;
                        }
                    }
                }

                if ($faltaEvaluacion) {
                    $promedios[$student->id]['promedio'] = 0.0;
                } else {
                    if (count($insumos) != 0) {
                        if (count($cal) != 0) {
                            $value = floatval($ac / (count($insumos->where('es_aporte', 0)) + count($cal)));
                        } else {
                            $value = floatval($ac / count($insumos));
                        }

                        $promedios[$student->id]['promedio'] = $value;
                    } else {
                        $promedios[$student->id]['promedio'] = 0.0;
                    }
                }
            }
            return $promedios;
        } catch (Exception $e) {
            return null;
        }
    }
    public static function notaCualitativa($nota)
    {
        if ($nota >= 9) {
            return 'EX';
        }if ($nota < 9 && $nota >= 7) {
            return 'MB';
        }if ($nota > 4 && $nota < 7) {
            return 'B';
        }if ($nota > 0 && $nota <= 4) {
            return 'R';
        }if ($nota == 0) {
            return '';
        }
    }
    public static function notaCualitativaApr($nota)
    {
        if ($nota >= 9) {
            return 'DAR';
        }if ($nota < 9 && $nota >= 7) {
            return 'AAR';
        }if ($nota > 4 && $nota < 7) {
            return 'PAAR';
        }if ($nota > 0 && $nota <= 4) {
            return 'NAAR';
        }if ($nota == 0) {
            return '';
        }
    }

    public static function nombreCertificados($course)
    {
        switch ($course->grado) {
            case "Inicial 1":
                $educacion = $course->grado . ' - Educacion Inicial "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Inicial 2":
                $educacion = $course->grado . ' - Educacion Inicial "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Primero":
                $educacion = 'Primer' . ' Grado - Educacion General Basica Preparatoria "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Segundo":
                $educacion = $course->grado . ' Grado - Educacion General Basica Elemental "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Tercero":
                $educacion = $course->grado . ' Grado - Educacion General Basica Elemental "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Cuarto":
                $educacion = $course->grado . ' Grado - Educacion General Basica Elemental "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Quinto":
                $educacion = $course->grado . ' Grado - Educacion General Basica Media "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Sexto":
                $educacion = $course->grado . ' Grado - Educacion General Basica Media "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Septimo":
                $educacion = $course->grado . ' Grado - Educacion General Basica Media "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Octavo":
                $educacion = $course->grado . ' Grado - Educacion General Basica Superior "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Noveno":
                $educacion = $course->grado . ' Grado - Educacion General Basica Superior "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Decimo":
                $educacion = $course->grado . ' Grado - Educacion General Basica Superior "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Primero de Bachillerato":
                $educacion = 'Primer Curso de Bachillerato General Unificado "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Segundo de Bachillerato":
                $educacion = 'Segundo Curso de Bachillerato General Unificado "' . $course->paralelo . '"' . $course->especializacion;
                break;
            case "Tercero de Bachillerato":
                $educacion = 'Tercer Curso de Bachillerato General Unificado "' . $course->paralelo . '"' . $course->especializacion;
                break;
        }
        return $educacion;
    }

    public static function nombreCurso($course)
    {
        switch ($course->grado) {
            case "Inicial 1":
                $educacion = $course->grado . ' - Educacion Inicial "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Inicial 2":
                $educacion = $course->grado . ' - Educacion Inicial "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Primero":
                $educacion = 'Primer' . ' Grado - Educacion General Basica Preparatoria "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Segundo":
                $educacion = $course->grado . ' Grado - Educacion General Basica Elemental "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Tercero":
                $educacion = $course->grado . ' Grado - Educacion General Basica Elemental "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Cuarto":
                $educacion = $course->grado . ' Grado - Educacion General Basica Elemental "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Quinto":
                $educacion = $course->grado . ' Grado - Educacion General Basica Media "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Sexto":
                $educacion = $course->grado . ' Grado - Educacion General Basica Media "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Septimo":
                $educacion = $course->grado . ' Grado - Educacion General Basica Media "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Octavo":
                $educacion = $course->grado . ' Grado - Educacion General Basica Superior "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Noveno":
                $educacion = $course->grado . ' Grado - Educacion General Basica Superior "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Decimo":
                $educacion = $course->grado . ' Grado - Educacion General Basica Superior "' . $course->paralelo . '" ' . $course->especializacion;
                break;
            case "Primero de Bachillerato":
                $educacion = 'Primer Curso de Bachillerato General Unificado "' . $course->paralelo . '"';
                break;
            case "Segundo de Bachillerato":
                $educacion = 'Segundo Curso de Bachillerato General Unificado "' . $course->paralelo . '"';
                break;
            case "Tercero de Bachillerato":
                $educacion = 'Tercer Curso de Bachillerato General Unificado "' . $course->paralelo . '"';
                break;
        }
        return $educacion;
    }

    public static function nombreSeccion($course)
    {
        switch ($course->seccion) {
            case "EI":
                $name = "Educación Inicial";
                break;
            case "EGB":
                $name = "Educación General Básica";
                break;
            case "BGU":
                $name = "Bachillerato General Unificado";
                break;
        }return $name != null ? $name : "";
    }

    public static function nombreCursoFactura4($course)
    {
        switch ($course->grado) {
            case "Inicial 1":
                $educacion = $course->grado . ' - ' . $course->paralelo . 'Educacion Inicial';
                break;
            case "Inicial 2":
                $educacion = $course->grado . ' - ' . $course->paralelo . 'Educacion Inicial';
                break;
            case "Primero":
                $educacion = 'Primer Grado' . ' - ' . $course->paralelo . ', Educacion Basica Preparatoria';
                break;
            case "Segundo":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Elemental';
                break;
            case "Tercero":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Elemental';
                break;
            case "Cuarto":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Elemental';
                break;
            case "Quinto":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Media';
                break;
            case "Sexto":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Media';
                break;
            case "Septimo":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Media';
                break;
            case "Octavo":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Superior';
                break;
            case "Noveno":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Superior';
                break;
            case "Decimo":
                $educacion = $course->grado . ' Grado - ' . $course->paralelo . ', Educacion Basica Superior';
                break;
            case "Primero de Bachillerato":
                $educacion = 'Primer Curso de Bachillerato General Unificado "' . $course->paralelo . '"' . $course->especializacion;
                break;
            case "Segundo de Bachillerato":
                $educacion = 'Segundo Curso de Bachillerato General Unificado "' . $course->paralelo . '"' . $course->especializacion;
                break;
            case "Tercero de Bachillerato":
                $educacion = 'Tercer Curso de Bachillerato General Unificado "' . $course->paralelo . '"' . $course->especializacion;
                break;
        }
        return $educacion;
    }

    public static function nombreSeccionDetallada($course)
    {
        $educacion = 'Superior';
        switch ($course->grado) {
            case "Inicial 1":
                $educacion = $course->seccion . " - Educacion Inicial";
                break;
            case "Inicial 2":
                $educacion = $course->seccion . " - Educacion Inicial";
                break;
            case "Primero":
                $educacion = $course->seccion . " - Preparatoria";
                break;
            case "Segundo":
                $educacion = $course->seccion . " - Basica Elemental";
                break;
            case "Tercero":
                $educacion = $course->seccion . " - Basica Elemental";
                break;
            case "Cuarto":
                $educacion = $course->seccion . " - Basica Elemental";
                break;
            case "Quinto":
                $educacion = $course->seccion . " - Basica Media";
                break;
            case "Sexto":
                $educacion = $course->seccion . " - Basica Media";
                break;
            case "Septimo":
                $educacion = $course->seccion . " - Basica Media";
                break;
            case "Octavo":
                $educacion = $course->seccion . " - Basica Superior";
                break;
            case "Noveno":
                $educacion = $course->seccion . " - Basica Superior";
                break;
            case "Decimo":
                $educacion = $course->seccion . " - Basica Superior";
                break;
            case "Primero de Bachillerato":
                $educacion = $course->seccion . " - Bachillerato General Unificado";
                break;
            case "Segundo de Bachillerato":
                $educacion = $course->seccion . " - Bachillerato General Unificado";
                break;
            case "Tercero de Bachillerato":
                $educacion = $course->seccion . " - Bachillerato General Unificado";
                break;
        }
        return $educacion;
    }

    public static function gradoSiguiente($grado)
    {
        switch ($grado) {
            case "Inicial 1":
                $gradoSiguiente = "Inicial 2";
                break;
            case "Inicial 2":
                $gradoSiguiente = "Primer Año de Educación Básica";
                break;
            case "Primero":
                $gradoSiguiente = "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
            case "Segundo":
                $gradoSiguiente = "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
            case "Tercero":
                $gradoSiguiente = "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental";
                break;
            case "Cuarto":
                $gradoSiguiente = "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
            case "Quinto":
                $gradoSiguiente = "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
            case "Sexto":
                $gradoSiguiente = "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media";
                break;
            case "Septimo":
                $gradoSiguiente = "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
            case "Octavo":
                $gradoSiguiente = "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
            case "Noveno":
                $gradoSiguiente = "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior";
                break;
            case "Decimo":
                $gradoSiguiente = "Primer Año de Bachillerato";
                break;
            case "Primero de Bachillerato":
                $gradoSiguiente = "Segundo Año de Bachillerato";
                break;
            case "Segundo de Bachillerato":
                $gradoSiguiente = "Tercer Año de Bachillerato";
                break;
            case "Tercero de Bachillerato":
                $gradoSiguiente = "Culminando la instrucción Secundaria";
                break;
        }
        return $gradoSiguiente;
    }
    public static function gradoSiguienteAdmision($grado)
    {
        switch ($grado) {
            case "Inicial 1":
                $gradoSiguiente = ['nombre' => "Inicial 2", 'buscar' => 'Inicial 2'];
                break;
            case "Inicial 2":
                $gradoSiguiente = ['nombre' => "Primer Año de Educación Básica", 'buscar' => 'Primero'];
                break;
            case "Primero":
                $gradoSiguiente = ['nombre' => "Segundo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental", 'buscar' => 'Segundo'];
                break;
            case "Segundo":
                $gradoSiguiente = ['nombre' => "Tercer Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental", 'buscar' => 'Tercero'];
                break;
            case "Tercero":
                $gradoSiguiente = ['nombre' => "Cuarto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Elemental", 'buscar' => 'Cuarto'];
                break;
            case "Cuarto":
                $gradoSiguiente = ['nombre' => "Quinto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media", 'buscar' => 'Quinto'];
                break;
            case "Quinto":
                $gradoSiguiente = ['nombre' => "Sexto Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media", 'buscar' => 'Sexto'];
                break;
            case "Sexto":
                $gradoSiguiente = ['nombre' => "Septimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Media", 'buscar' => 'Septimo'];
                break;
            case "Septimo":
                $gradoSiguiente = ['nombre' => "Octavo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior", 'buscar' => 'Octavo'];
                break;
            case "Octavo":
                $gradoSiguiente = ['nombre' => "Noveno Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior", 'buscar' => 'Noveno'];
                break;
            case "Noveno":
                $gradoSiguiente = ['nombre' => "Decimo Grado DE EDUCACIÓN GENERAL BÁSICA - Basica Superior", 'buscar' => 'Decimo'];
                break;
            case "Decimo":
                $gradoSiguiente = ['nombre' => "Primer Año de Bachillerato", 'buscar' => 'Primero de Bachillerato'];
                break;
            case "Primero de Bachillerato":
                $gradoSiguiente = ['nombre' => "Segundo Año de Bachillerato", 'buscar' => 'Segundo de Bachillerato'];
                break;
            case "Segundo de Bachillerato":
                $gradoSiguiente = ['nombre' => "Tercer Año de Bachillerato", 'buscar' => 'Tercero de Bachillerato'];
                break;
            case "Tercero de Bachillerato":
                $gradoSiguiente = ['nombre' => "Culminando la instrucción Secundaria", 'buscar' => ''];
                break;
        }
        return $gradoSiguiente;
    }

    public static function notaComportamientoPromedio($idEstudiante, $parcial)
    {
        $comportamientoPorMaterias = comportamientoMateria::where('idStudent', $idEstudiante)->where('parcial', $parcial)->get();
        $suma = 0;
        $c = 0;
        foreach ($comportamientoPorMaterias as $comp) {
            $notaComp = Calificacion::CualitativoaCuantitativo($comp->nota);
            if ($notaComp != 0) {
                $suma += $notaComp;
                $c++;
            }
        }
        $total = bcdiv(($suma / ($c == 0 ? ($c = 1) : $c)), 1, 2);
        $idEstructura = estructuraCualitativa::where('nombre', 'Comportamiento')->first()->id;
        $notapromedio = rangosCualitativo::getCalificacionCualitativa($idEstructura, $total)->nota;
        return $notapromedio;
    }

    public static function CualitativoaCuantitativo($nota)
    {
        if ($nota == 'A') {
            return 10;
        } else if ($nota == 'B') {
            return 9;
        } elseif ($nota == 'C') {
            return 8;
        } else if ($nota == 'D') {
            return 7;
        } else if ($nota == 'E') {
            return 6;
        } else {
            return 0;
        }
    }
}
