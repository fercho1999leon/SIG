<?php
use App\PeriodoLectivo;
use App\UnidadPeriodica;
use App\ParcialPeriodico;
use App\Course;
use App\Matter;
use App\Supply;
use App\Activity;
use App\Deber;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class organizarCarpetasTareasSeeder extends Seeder
{
    public function run()
    {

        $idPeriodo = PeriodoLectivo::where('nombre', '2020-2021')->first()->id;
        $unidades = UnidadPeriodica::where('idPeriodo', $idPeriodo)->where('activo', 1)->get();
        $parciales = ParcialPeriodico::whereIn('idUnidad', $unidades->pluck('id'))->where('activo', 1)->get();
        $cursos = Course::where('idPeriodo', $idPeriodo)->get();
        $c=0;

        foreach ($cursos as $curso) {

            $materias = Matter::where('idPeriodo', $idPeriodo)->where('idCurso' , $curso->id)->get();

            foreach ($materias as $materia) {

                $insumos = Supply::where('idMateria' , $materia->id)->get();

                foreach ($insumos as $insumo) {

                    foreach ($parciales as $parcial) {

                        $actividades = Activity::where('idInsumo' , $insumo->id)->where('parcial', $parcial->identificador)->get();

                        foreach ($actividades as $actividad) {

                            $deberes = Deber::where('idactividad' , $actividad->id)->get();

                            foreach ($deberes as $deber) {

                                if ( $deber->adjunto != null && Storage::disk('public')->exists('deberes_adjuntos/'.$deber->adjunto) ){

                                    Storage::disk('public')->move('deberes_adjuntos/'.$deber->adjunto,

                                        'deberes_adjuntos/curso_'.$curso->id.
                                        '/'.substr($materia->nombre, 0 ,25).
                                        '/parcial_'.$actividad->parcial.
                                        '/Insumo_'.$insumo->id.
                                        '/'.substr($actividad->nombre, 0 ,25).
                                        '/'.$deber->adjunto
                                    );
                                    $c++;
                                }
                            }
                        }
                    }
                }
            }
        }
        echo ($c);
    }
}
