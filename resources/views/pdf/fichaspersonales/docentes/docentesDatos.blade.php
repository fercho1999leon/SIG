<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte Docentes</title>
</head>

<body>
	@include('partials.encabezados.reporte-institucional', ['reportName' => 'Listado de Docentes'])
	<table class="table">
		<tr class="bgDark">
			<td width="5" class="text-center">#</td>
			<td class="">Cédula</td>
			<td class="">Apellidos</td>
			<td class="">Nombres</td>
			<td class="">Correo</td>
			<td class="text-center">Curso</td>
		</tr>
		@foreach ($docentes as $docente)
			<tr>
				<td>{{$count++}}</td>
				<td>{{$docente->ci}}</td>
				<td>{{$docente->apellidos}}</td>
				<td>{{$docente->nombres}}</td>
				<td>{{$docente->correo}}</td>
				<td>
					@foreach ($courses->where('idProfesor', $docente->id) as $course)
						{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
						<span style="display:none">
							{{$tutores++}}
						</span>
					@endforeach
				</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="4">Total Tutores: {{$tutores}} </td>
		</tr>
	</table>
</body>

</html>