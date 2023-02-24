<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Datos Varios</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>

<body class="pdfNominaDeEstudiantesMatriculados">
	@include('partials.encabezados.reporte-institucional', [
		'reportName' => "{$course->grado} {$course->especializacion} {$course->paralelo} - Datos Varios"
		])
	<table class="table">
		<tr>
			<td colspan="6" class="text-center">ESTUDIANTES</td>
			<td colspan="6" class="text-center">REPRESENTANTE</td>
        </tr>
        <tr>
            <td>Nombres</td>
            <td>Apellidos</td>
            <td>Cédula</td>
            <td>Nacionalidad</td>
            <td>Condicionado</td>
            <td>Correo Electrónico</td>
            <td>Número de cédula</td>
            <td>Nombres</td>
            <td>Apellidos</td>
            <td>Estado Civil</td>
            <td>Profesión</td>
            <td>Correo Electrónico</td>
         </tr>
        @foreach ($students as $student)
            <tr>
                <td>{{$student->nombres}}</td>
                <td>{{$student->apellidos}}</td>
                <td>{{$student->ci}}</td>
                <td>{{$student->nacionalidad}}</td>
                <td>{{$student->condicionado ?? '-'}}</td>
                <td>{{$student->student->profile->correo}}</td>
                <td>{{$student->representante->ci}}</td>
                <td>{{$student->representante->nombres}}</td>
                <td>{{$student->representante->apellidos}}</td>
                <td>{{$student->estado_civil_padres}}</td>
                <td>{{$student->representante->profesion}}</td>
                <td>{{$student->representante->correo}}</td>
            </tr>
        @endforeach
	</table>
</body>

</html>