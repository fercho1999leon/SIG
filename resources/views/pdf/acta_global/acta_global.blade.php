@php
use App\Http\Controllers\StudentController;
use App\ConfiguracionSistema;
use Carbon\Carbon;
use App\Institution;
use App\RequestUser;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ParcialController;
use App\ALetras;
use App\Http\Controllers\InstitutionController;
$nombreInstituto = str_replace('"', '', InstitutionController::getInstitution()->nombre);
$leheaderstituto = str_replace('"', '', InstitutionController::getInstitution()->lema);
$estudiantes = StudentController::getStudentsByCourse($materia->idCurso);
$number = 1;
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reporte Global</title>
    <link rel="stylesheet" href="{{ secure_asset('css/acta_global/acta_global.css') }}" />
    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>


<body>
    <!--ENCABEZADO LOGO/INSTITUCION-->
    @include('partials.encabezados.reporte_global.reporte_global_encabezado_institution')
    <!--ENCABEZADO TITULAR-->
    @include('partials.encabezados.reporte_global.reporte_global_encabezado_titular')
    <!--ENCABEZADO INFORMATIVO-->
    @include('partials.encabezados.reporte_global.reporte_global_encabezado_informativo')
    <table id="acta_global" class="table table-bordered">
        <thead style="background-color: black;">
            <tr>
                <th class="text-uppercase" width="5%">No.</th>
                <th class="text-uppercase" width="20%">APELLIDOS Y NOMBRES</th>
                <th class="text-uppercase" width="5%">PARCIAL</th>
                <th class="text-uppercase" width="5%">RECUPERACIÓN</th>
                <th class="text-uppercase" width="5%">NOTA FINAL</th>
                <th class="text-uppercase" width="15%">TOTAL EN LETRAS</th>
                <th class="text-uppercase" width="5%">ASISTENCIA</th>
                <th class="text-uppercase" width="15%">OBSERVACIONES</th>
            </tr>
        </thead>
        <tbody class="text-black">
            @php
                $asistenciatotal = App\DailyAssistance
                    ::select(array('*', DB::raw('COUNT(idEstudiante) as asistencia')))
                    ->where('idCurso', $course->id)
                    ->where('idMateria', $materia_id)
                    ->groupBy('idEstudiante')
                    ->get()->max('asistencia');
            @endphp
       
            @foreach($students as $student)
                    
                                <tr>
                                    <th class="text-uppercase">
                                        <strong>{{$loop->iteration}}</strong>
                                    </th>
                                    <th class="text-uppercase">{{$student->apellidos}}, {{$student->nombres}}
                                    </th>
                                    </th>

                                        @php
                                        $std = $data->where('estudianteId', $student->idStudent)->first();
                                        $mats = new \Illuminate\Support\Collection($std->parcial);
                                        $mat = $mats->where('materiaId',  $validar->id)->first();

                                        
                                        @endphp
                                    <th class="text-uppercase">
                                      
                                    {{ bcdiv($mat->promedioInicial, '1', 2) }}
                                    </th>
                                    @php 
                                      //dd($mat);
                                    @endphp
                                    <th class="text-uppercase">
                                        {{ bcdiv($mat->supletorio, '1', 2) }}
                                    </th>
                                    <th class="text-uppercase">
                                        {{ bcdiv($mat->promedioFinal > $mat->supletorio ? $mat->promedioFinal :  $mat->supletorio, '1', 2) }}
                                    </th>
                                    <th class="text-uppercase">
                                        @php
                                        $formatter = new ALetras();
                                       echo $formatter->toMoney(bcdiv($mat->promedioFinal > $mat->supletorio ? $mat->promedioFinal :  $mat->supletorio, '1', 2), 2, '', '');
                                        @endphp
                                    </th>
                                    @php
                                        $asistencia = App\DailyAssistance
                                            ::where('idCurso', $course->id)
                                            ->where('idMateria', $materia_id)
                                            ->where('idEstudiante', $student->idStudent)
                                            //->where('idSchedule', $hora->id)
                                            ->where('estado', 'ASISTIO')
                                            ->get()->count();
                                    @endphp
                                <th class="text-uppercase">
                                    {{$asistencia ? bcdiv(($asistencia*100)/$asistenciatotal, '1', 2).'%' : '-'}}
                                </th>
                                    <th class="text-uppercase">
                                        {{--OBSERVACIONES QUE NO SE AUN--}}
                                    </th>
                                </tr>
                    @endforeach
        </tbody>
    </table>
    <!--FOOTER INFORMATIVO-->
    @include('partials.footers.reporte_global.reporte_global_footer_firmas')
</body>
<script type="text/javascript" src="{{ secure_asset('js/jquery-3.3.js') }}"></script>
<script type="text/javascript" src="{{ secure_asset('js/bootstrap.js') }}"></script>

</html>
