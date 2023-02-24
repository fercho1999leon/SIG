<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Calificaciones pendientes examen</title>
</head>
@php
switch ($quimestre){
	case "q1":
		$quimestre = 1;
	break;
	case "q2":
		$quimestre = 2;
	break;
}
@endphp
<body class="actaCalificacionesParcial" style="position:relative">
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
					<h3 class="up">Año Lectivo: {{$periodo}}  </h3>
					<h3 class="up"> Quimestre {{$quimestre}} </h3>
					<h3 class="up">
						Calificaciones pendientes
					</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}
	<br>
	<table class="table">
		<tr height="140" class="bgDark">
			<td width="5" class="bold" >NO.</td>
			<td class="text-center up bold">Apellidos y nombres</td>
			@foreach($matters as $matter)
			<td class="text-center no-border" width="35">
				<p class="s-calificaciones__materia ">
					<span class="up actaDeCalificacionesRecuperacion__1 bold" style="right: 35pt">{{ $matter->nombre }}</span>
				</p>
			</td>
			@endforeach
		</tr>
		@foreach($students as $student)

		@php
		$exPend = false;

		foreach($matters as $matter){
			if($promedios[$matter->id][$student->id] == 0){
				$exPend = true;
				break;
			}
		}
		@endphp

		@if($exPend)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres }}</td>
			@foreach($matters as $matter)
				<td class="text-center">
				@if($promedios[$matter->id][$student->id] == 0)
					X
				@endif
				</td>
			@endforeach
		</tr>
		@endif
		@endforeach
	</table>
</body>

</html>