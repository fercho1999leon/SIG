<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nómina de estudianes matriculados</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>

<body class="pdfNominaDeEstudiantesMatriculados">
	@include('partials.encabezados.reporte-institucional', [
		'reportName' => 'Nómina Estudiantil'
		])
	<table class="table">
		<tr>
			<td class="uppercase no-border">Curso: {{ $curso->grado }} {{ $curso->paralelo }} - {{ $curso->especializacion }}
			</td>
		</tr>
		<tr>
			<td class="uppercase no-border">Tutor(a):
				@if($tutor != null)
					{{ $tutor->nombres }} {{ $tutor->apellidos }}
				@endif
			</td>
		</tr>
		<tr>
			<td class="uppercase no-border">Fecha: {{ $fechaA }}</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="text-center uppercase">No.</td>
			<td class="text-center uppercase">estudiante</td>
			<td class="text-center uppercase">telefonos</td>
			<td class="text-center uppercase">telefono representante</td>
			<td class="text-center uppercase">domicilio</td>
			<td class="text-center uppercase">representante</td>
		</tr>
		@foreach($estudiantes as $student)
			<tr>
				<td class="text-center">{{ $count++ }}</td>
				<td>{{ $student->apellidos }} {{ $student->nombres }}</td>
				<td class="text-center">{{ $student->telefono_movil }}</td>
				<td class="text-center">{{ $student->representante->movil }}</td>
				<td class="text-center">{{ $student->direccion_domicilio }}</td>
				<td class="text-center">
					{{$student->representante->apellidos}} {{$student->representante->nombres}}
				</td>
			</tr>
		@endforeach
	</table>
</body>

</html>