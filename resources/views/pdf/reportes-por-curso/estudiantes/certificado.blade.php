<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado Matricula</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
h3 {
	line-height: 2;
	font-size: 12pt;
}
 p {
	 font-size: 12pt;
 }
</style>
<body>
	<main>
        @foreach ($students as $student)
            @php $fechaMatricula = App\Fechas::fechaMatricula($student->fecha_matriculacion ?? $student->created_at); @endphp
            <div class="container">
                @include('partials.encabezados.certificados-estudiantiles', [
                    'reportName' => 'Certificado de Matrícula'
                ])
                <br>
                <div class="row">
                    <div class="col-xs-12 certificado__descripcion">
                        <p style="line-height: 2.3; font-size: 16pt !important;" class="text-center">CERTIFICO:</p>
                        <p style="line-height: 2.3;"> Que @if($student->sexo == "Masculino") el @else la @endif estudiante <strong class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</strong> con matricula {{$student->numero_matriculacion}} ha sido @if($student->sexo == "Masculino") matriculado @else matriculada @endif en <span class="uppercase bold"> {{ $course->grado }} {{$course->especializacion}} {{ $course->paralelo }},</span> jornada: {{ $institution->jornada }} de este plantel con fecha {{ $fechaMatricula }}, previo el cumplimiento de los requisitos legales y reglamentos. </p>
                        <p style="line-height: 2.3;">{{ $institution->ciudad }}, {{ $hoy }}</p>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br><br><br>
                <div class="row">
                    <div class="col-xs-6 p-0 text-center ">
                        <hr class="certificado__hr">
                        <p class="uppercase">
                            {{ $institution->representante1 }} <br> {{ $institution->cargo1 }}
                        </p> 
                    </div>
                    <div class="col-xs-6 p-0 text-center">
                        <hr class="certificado__hr">
                        <p class="uppercase">
                        {{ $institution->representante2 }} <br> {{ $institution->cargo2 }}
                        </p> 
                    </div>
                </div>
            </div>
            <div style="page-break-after:always;"></div>
        @endforeach
	</main>
</body>

</html>