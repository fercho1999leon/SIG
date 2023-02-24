<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Certificado Matricula</title>
        <link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
    </head>
    <body>
        <main>
            @foreach ($students as $stud)
                @php
                    $student = App\Student2Profile::find($stud->id);
                    $fechaMatricula = App\Fechas::fechaMatricula($student->fecha_matriculacion ?? $student->created_at);
                @endphp
                <div class="container" style="padding: 40px;">
                    @include('partials.encabezados.reporte-formato-vertical-matricula', [ 'institucion' =>$institution, 'tipo' => 1 ])
                    <br><br><br>
                    <table style="font-size: 11pt !important;">
                        <tr style="text-transform: lowercase !important">
                            <td class="up"  width="25%"><strong>Año Lectivo</strong></td>
                            <td style="text-transform: capitalize !important"  width="35%">{{$periodo->nombre}}</td>
                            <td class="up" width="20%"><strong>N° de Matricula:</strong></td>
                            <td style="text-transform: capitalize !important"  width="20%">{{$student->numero_matriculacion}}</td>
                        </tr>
                        <tr>
                            <td class="up" width="30%"><strong>Nivel Educación:</strong></td>
                            <td style="text-transform: capitalize !important">{{$educacion}} {{$course->especializacion}}</td>
                        </tr>
                        <tr>
                            <td class="up"><strong>Curso Paralelo:</strong></td>
                            <td style="text-transform: capitalize !important">{{ $course->grado }} {{ $course->paralelo }}</td>
                        </tr>
                        <tr>
                            <td class="up"><strong>Fecha de Matricula:</strong></td>
                            <td colspan="3">{{$institution->ciudad}} {{ strtolower($fechaMatricula) }}</td>
                        </tr>
                    </table>
                    <br><br><br>
                    <div class="row">
                        <div class="col-xs-12 certificado__descripcion">
                            <p style="line-height: 2.3; font-size: 13pt !important;">
                                Los subscritos, {{ $institution->cargo1 }} y {{ $institution->cargo2 }}, certifican que 
                                @if($student->sexo == "Masculino") el @else la @endif estudiante
                            </p>
                            <p style="line-height: 2.3; font-size: 13pt !important;" class="text-center">
                                <strong class="uppercase">{{ $stud->apellidos }} {{ $stud->nombres }}</strong>
                            </p>
                            <p style="line-height: 2.3; font-size: 13pt !important;">
                                Previo al cumplimiento de los requisitos legales
                                , se matriculó en el curso indicado según consta en los registros de matriculas que reposan en esta institución
                            </p>

                        </div>
                    </div>
                    <br><br><br><br><br><br><br>
                    <div class="row">
                        <div class="col-xs-6 p-0 text-center ">
                            <hr class="certificado__hr">
                            <p class="uppercase" style=" font-size: 9pt !important;">
                                <strong>{{ $institution->representante1 }} <br>{{ $institution->cargo1 }}</strong>
                            </p>
                        </div>
                        <div class="col-xs-6 p-0 text-center">
                            <hr class="certificado__hr">
                            <p class="uppercase" style=" font-size: 9pt !important;">
                                <strong>{{ $institution->representante2 }} <br>{{ $institution->cargo2 }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div style="page-break-after:always;"></div>
            @endforeach
        </main>
    </body>
</html>