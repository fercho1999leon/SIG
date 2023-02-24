<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Estudiantes por genero</title>
</head>
<style>
	.table td,
	.table th {
		font-size: 8pt !important;
	}
</style>
<body>
	<table class="table">
		<thead>
			<tr>
				<th colspan="2" style="vertical-align:top;" class="no-border">
					<div class="header__logo" style="text-align:left">
						<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
					</div>
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">Año Lectivo: {{App\Institution::periodoLectivo()}}  </h3>
						<h3 class="up">
							{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} - Estudiantes por genero
						</h3>
					</div>
				</th>
			</tr>
		</thead>
		<tr>
			<td class="text-right no-border" colspan="2">
				Tutor: 
				@if ($course->tutor != null)
					{{$course->tutor->apellidos}} {{$course->tutor->nombres}}
				@endif
			</td>
		</tr>
		<tr>
			<td colspan="2">FEMENINO</td>
		</tr>
		<tr>
			<td width="5" class="text-center">#</td>
			<td>APELLIDOS Y NOMBRES</td>
		</tr>
		@foreach ($students->where('sexo', 'Femenino') as $student)
			<tr>
				<td width="5" class="text-center">{{$loop->index+1}}</td>
				<td>{{$student->apellidos}} {{$student->nombres}} </td>
			</tr>
		@endforeach
	</table>
	@php
		$count = 1;
	@endphp
	<table class="table">
		<tr>
			<td colspan="2">MASCULINO</td>
		</tr>
		<tr>
			<td width="5" class="text-center">#</td>
			<td>APELLIDOS Y NOMBRES</td>
		</tr>
		@foreach ($students->where('sexo', 'Masculino') as $student)
			<tr>
				<td class="text-center">{{$count++}}</td>
				<td>{{$student->apellidos}} {{$student->nombres}}</td>
			</tr>
		@endforeach
	</table>
</body>
</html>