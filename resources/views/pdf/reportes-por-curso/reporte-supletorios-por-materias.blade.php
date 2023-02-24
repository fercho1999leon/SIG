<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte Supletorio por Materia</title>
</head>

<body class="actaCalificacionesParcial" style="position:relative">
	<table class="table">
		<tr>
			<th style="vertical-align:top" class="no-border" width="17.5%">
				<div class="header__logo" style="float: left">
					<img width="80" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
				</div>
			</th>
			<th class="no-border" width="67.5%">
				<div class="header__info text-center">
					<h3 class="m-0 h1 uppercase"> {{$institution->nombre}} </h3>
					<h4 class="m-0 bold uppercase"><small>{{$institution->direccion}}</small></h4>
					<h4 class="m-0 bold uppercase"><small> Codigo Amie: {{$institution->codigoAmie}} </small></h4>
					<h4 class="m-0 bold uppercase"><small> {{$institution->ciudad}} - Ecuador </small> </h4>
				</div>
			</th>
			<th class="no-border" width="15%">
			</th>
		</tr>
	</table>	
	@foreach($matters as $matter)
	<table class="table  whitespace-no">
		<tr>
			<td colspan="2" class="no-border up text-left">
				@if($course->grado=='Segundo') 
						Segundo Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Tercero') 
						Tercer Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Cuarto') 
						Cuarto Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Quinto') 
						Quinto Grado de Educacion General Media
					@endif
					@if($course->grado=='Sexto') 
						Sexto Grado de Educacion General Media
					@endif
					@if($course->grado=='Septimo') 
						Septimo Grado de Educacion General Media
					@endif
					@if($course->grado=='Octavo') 
						Octavo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Noveno') 
						Noveno Grado de Educacion General Superior
					@endif
					@if($course->grado=='Decimo') 
						Decimo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Primero de Bachillerato')
						Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Segundo de Bachillerato')
						Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Tercero de Bachillerato')
						Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif

					{{ $course->paralelo }}
			</td>
			<td colspan="3" class="no-border up text-right">
				{{ $matter->nombre }}
			</td>
		</tr>
	</table>
		
		<table class="table whitespace-no">
			<tr class="bgDark">
				<td width="5">No.</td>
				<td class="text-center up">apellidos y nombres </td>
				<td class="text-center">P.Q </td>
				<td class="text-center">SUP</td>
				<td class="text-center up">P.F</td>
			</tr>
			@foreach ($students as $student)
				@if( isset( $promediosFinales[$matter->id][$student->id]) && $promediosFinales[$matter->id][$student->id] < 7)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td> {{ $student->apellidos }} {{ $student->nombres}}</td>
					<td class="text-center">{{ $promediosAnuales[$matter->id][$student->id] }}</td>
					<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $supletorios[$matter->id][$student->id] }}</td>
					<td class="text-center">{{ $supletorios[$matter->id][$student->id] == 0 ? "" : $promediosFinales[$matter->id][$student->id] }}</td>
				</tr>
				@endif
			@endforeach
		</table>			
		
	@endforeach
	<br>
	<br>
	<br>
	<table class="table">
		<tr>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante1}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo1}}</h4>
			</th>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->representante2}}</h4>
				<h4 class="firma--size m-0 uppercase text-center">{{$institution->cargo2 }}</h4>
			</th>
			<th width="10%"></th>
		</tr>
	</table>

	<div style="page-break-after:always;"></div>
	<table class="table whitespace-no">
		
	</table>
</body>
</html>