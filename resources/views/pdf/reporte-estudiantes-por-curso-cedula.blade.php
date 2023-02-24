<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte de estudiantes con cédula</title>
</head>
<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top;" class="no-border" width="20%">
				<div class="header__logo" style="text-align:left">
					<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
				</div>
			</th>
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
					<h3 class="up">Año Lectivo: {{App\Institution::periodoLectivo()}}  </h3>
					<h3 class="up">
						{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} - Reporte de estudiantes con cédula
					</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="text-center" width="5">No.</td>
			<td class="text-center">Estudiante</td>
			<td class="text-center">Cédula</td>
			@if (request('varios') != 0)
				<td class="text-center">Fecha Nacimiento</td>
				<td class="text-center">Edad a la Fecha</td>
			@endif
		</tr>
		@foreach ($students as $student)
			<tr>
				<td class="text-center">{{$i++}}</td>
				<td>{{$student->apellidos}} {{$student->nombres}}</td>
				<td class="text-center">{{$student->ci}}</td>
				@if (request('varios') != 0)
					<td class="text-center">{{$student->fechaNacimiento}}</td>
					<td class="text-center">{{$students_ef[$student->id]}}</td>
				@endif
			</tr>
		@endforeach
	</table>
</body>
</html>