<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Pagos por curso Detallado</title>
</head>
<body>
    @include('partials.encabezados.reporte-institucional', ['reportName' => $reportName])
    <table class="table m-0">
        <tr>
            <th class="text-left uppercase" width="10%">
                <div class="header__info">
                    <h2>Curso:</h2>
                    <h2>Especializacion:</h2>
                    <h2>Jornada:</h2>
                </div>
            </th>
            <th class="text-left uppercase" width="60%">
                <div class="header__info">
                    <h2>{{ $nombreCurso }}</h2>
                    <h2>{{ $especializacion }}</h2>
                    <h2>{{ $institution->jornada }}</h2>
                </div>
            </th>
        </tr>
    </table>
    <table class="table">
        <tr>
            @php $totalEstudiantes = 0; @endphp
            <td width="2%">#</td>
            <td class="text-center bold uppercase" width = 20%>Alumno (a)</td>
            <td class="text-center bold">ACTIVO</td>
            <td class="text-center bold">RETIRADO</td>
            <td class="text-center bold">HASTA</td>
            <td class="text-center bold">DETALLE DE DEUDA</td>
        </tr>
        @foreach ($students as $student)
            @php
                $pagos = $student->student()->first()->pagos()->get();
                $pagos = $pagos->where('estado', 'PENDIENTE');
                $total = 0;
                $c = 0;
                foreach ($pagos as $pago) {
                    $total += App\Payment::calcularDescuentoEstudiante($student->idStudent, $pago->pago()->first()->id);
                }
                $totalEstudiantes += $total;
            @endphp
            <tr>
                <td class="text-center" width = "2%">{{ $loop->iteration }}</td>
                <td class="text-left bold uppercase" width = 20%>{{ $student->student()->first()->apellidos }} {{ $student->student()->first()->nombres }}</td>
                <td class="text-right" width = 10%>{{ ( $total==0 ? "" : '$ '.$total) }}</td>
                <td width = 20%> {{ $student->observacion_retirado }} </td>
                <td width = "7%"></td>
                <td width = 40%>
                    @foreach ($pagos as $pago)
                        @php $c++; @endphp
                        {{ $pago->pago()->first()->descripcion }} @if ( count($pagos)>1 && count($pagos)!=$c ) , @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>
    <table class="table" style="border: hidden">
        <tr>
            <td style="border: hidden" class="text-center" width="2%" ></td>
            <td style="border: hidden" class="uppercase" width = 20%></td>
            <td style="border: hidden; font-size: 12px !important;" class="text-right" width = 10%> {{ '$ '.$totalEstudiantes }} </td>
            <td style="border: hidden" width = 20%></td>
            <td style="border: hidden" width = "7%" ></td>
            <td style="border: hidden; font-size: 12px !important;" class="text-center" width = 40%>Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ '$ '.$totalEstudiantes }} </td>
        </tr>
        <tr>
            <td style="border: hidden" class="text-center" width="2%" ></td>
            <td style="border: hidden" class="uppercase" width = 20%></td>
            <td style="border: hidden" colspan="4" class="text-right" width = 10%> <hr style="border:1px solid black;"> </td>
        </tr>
    </table>
    <br><br>
    <table width = "100%">
        <tr >
            <td width = "20%">
                <table >
                    <tr>
                        <td style="border: hidden" class="text-right" width = 10%> <hr style="border:1px solid black;"> </td>
                    </tr>
                    <tr>
                        <td style="border: hidden; font-size: 12px !important;" class="text-center bold uppercase" width = 60%>Firma de recepción</td>
                    </tr>
                </table>
            </td>
            <td width = "100%" >
                <table border="1px" width = "100%" height="50%" rowspan="6">
                    <tr>
                        <td colspan="5" rowspan="6"  style="border: hidden; font-size: 12px !important;" class="text-left bold uppercase">Comentarios: </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>