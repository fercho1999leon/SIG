<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Reporte promedios</title>
</head>
@php
	$numeroDeMaterias = count($matters);
@endphp
<body>
	<div style="page-break-after:always;"></div>
	{{-- 1ra hoja --}}
	@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])

	<br>
	<table class="table m-0">
			<tr>
			<td width="50%" class="no-border up">{{ $institution->jornada }}</td>
			<td width="50%" class="no-border up text-right">
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
			</tr>
		</table>
	<table class="table whitespace-no">
		<tr>
			<td width="5" rowspan="3">No.</td>
			<td rowspan="3" class="text-center up">apellidos y nombres </td>
			<td rowspan="3" class="text-center">Promedio General</td>
			@foreach($matters->take(3) as $matter)
				<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
			@endforeach
		</tr>
		<tr>
			@foreach($matters->take(3) as $matter)
			<td rowspan="2" class="text-center">Prom.</td>
				@foreach($unidades_a as $unidad)
				<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
				@endforeach
			@endforeach
		</tr>
		<tr>
			@foreach($matters->take(3) as $matter)
				@foreach($unidades_a as $unidad)
					<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
					@foreach($parcialP[$unidad->id] as $par)
					<td class="text-center">{{$par->identificador}}</td>
					@endforeach
				@endforeach
			@endforeach
		</tr>
		@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
			@foreach($matters->take(3) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
			@endforeach
		</tr>
		@endforeach
	</table>
	<div style="page-break-after:always;"></div>
	@if ($numeroDeMaterias < 8)
		{{-- 2da hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
			<td width="5" rowspan="3">No.</td>
			<td rowspan="3" class="text-center up">apellidos y nombres </td>
			<td rowspan="3" class="text-center">Promedio General</td>
			@foreach($matters->slice(3)->take(4) as $matter)
				<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
			@endforeach
		</tr>
		<tr>
			@foreach($matters->slice(3)->take(4) as $matter)
			<td rowspan="2" class="text-center">Prom.</td>
				@foreach($unidades_a as $unidad)
				<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
				@endforeach
			@endforeach
		</tr>
		<tr>
			@foreach($matters->slice(3)->take(4) as $matter)
				@foreach($unidades_a as $unidad)
					<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
					@foreach($parcialP[$unidad->id] as $par)
					<td class="text-center">{{$par->identificador}}</td>
					@endforeach
				@endforeach
			@endforeach
		</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(3)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
	@elseif ($numeroDeMaterias < 12)
		{{-- 2da hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
			<td width="5" rowspan="3">No.</td>
			<td rowspan="3" class="text-center up">apellidos y nombres </td>
			<td rowspan="3" class="text-center">Promedio General</td>
			@foreach($matters->slice(3)->take(4) as $matter)
				<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
			@endforeach
		</tr>
		<tr>
			@foreach($matters->slice(3)->take(4) as $matter)
			<td rowspan="2" class="text-center">Prom.</td>
				@foreach($unidades_a as $unidad)
				<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
				@endforeach
			@endforeach
		</tr>
		<tr>
			@foreach($matters->slice(3)->take(4) as $matter)
				@foreach($unidades_a as $unidad)
					<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
					@foreach($parcialP[$unidad->id] as $par)
					<td class="text-center">{{$par->identificador}}</td>
					@endforeach
				@endforeach
			@endforeach
		</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(3)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 3ra hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
		<tr>
			<td width="5" rowspan="3">No.</td>
			<td rowspan="3" class="text-center up">apellidos y nombres </td>
			<td rowspan="3" class="text-center">Promedio General</td>
			@foreach($matters->slice(7)->take(4) as $matter)
				<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
			@endforeach
		</tr>
		<tr>
			@foreach($matters->slice(7)->take(4) as $matter)
			<td rowspan="2" class="text-center">Prom.</td>
				@foreach($unidades_a as $unidad)
				<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
				@endforeach
			@endforeach
		</tr>
		<tr>
			@foreach($matters->slice(7)->take(4) as $matter)
				@foreach($unidades_a as $unidad)
					<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
					@foreach($parcialP[$unidad->id] as $par)
					<td class="text-center">{{$par->identificador}}</td>
					@endforeach
				@endforeach
			@endforeach
		</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(7)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
	@elseif($numeroDeMaterias < 17)
		{{-- 2da hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
			<td width="5" rowspan="3">No.</td>
			<td rowspan="3" class="text-center up">apellidos y nombres </td>
			<td rowspan="3" class="text-center">Promedio General</td>
			@foreach($matters->slice(3)->take(4) as $matter)
				<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
			@endforeach
		</tr>
		<tr>
			@foreach($matters->slice(3)->take(4) as $matter)
			<td rowspan="2" class="text-center">Prom.</td>
				@foreach($unidades_a as $unidad)
				<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
				@endforeach
			@endforeach
		</tr>
		<tr>
			@foreach($matters->slice(3)->take(4) as $matter)
				@foreach($unidades_a as $unidad)
					<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
					@foreach($parcialP[$unidad->id] as $par)
					<td class="text-center">{{$par->identificador}}</td>
					@endforeach
				@endforeach
			@endforeach
		</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(3)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 3ra hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
				<td width="5" rowspan="3">No.</td>
				<td rowspan="3" class="text-center up">apellidos y nombres </td>
				<td rowspan="3" class="text-center">Promedio General</td>
				@foreach($matters->slice(7)->take(4) as $matter)
					<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(7)->take(4) as $matter)
				<td rowspan="2" class="text-center">Prom.</td>
					@foreach($unidades_a as $unidad)
					<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
					@endforeach
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(7)->take(4) as $matter)
					@foreach($unidades_a as $unidad)
						<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
						@foreach($parcialP[$unidad->id] as $par)
						<td class="text-center">{{$par->identificador}}</td>
						@endforeach
					@endforeach
				@endforeach
			</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(7)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 4ta hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
				<td width="5" rowspan="3">No.</td>
				<td rowspan="3" class="text-center up">apellidos y nombres </td>
				<td rowspan="3" class="text-center">Promedio General</td>
				@foreach($matters->slice(11)->take(4) as $matter)
					<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(11)->take(4) as $matter)
				<td rowspan="2" class="text-center">Prom.</td>
					@foreach($unidades_a as $unidad)
					<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
					@endforeach
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(11)->take(4) as $matter)
					@foreach($unidades_a as $unidad)
						<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
						@foreach($parcialP[$unidad->id] as $par)
						<td class="text-center">{{$par->identificador}}</td>
						@endforeach
					@endforeach
				@endforeach
			</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(11)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
	@else
		{{-- 2da hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
			<td width="5" rowspan="3">No.</td>
			<td rowspan="3" class="text-center up">apellidos y nombres </td>
			<td rowspan="3" class="text-center">Promedio General</td>
			@foreach($matters->take(3) as $matter)
				<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
			@endforeach
		</tr>
		<tr>
			@foreach($matters->take(3) as $matter)
			<td rowspan="2" class="text-center">Prom.</td>
				@foreach($unidades_a as $unidad)
				<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
				@endforeach
			@endforeach
		</tr>
		<tr>
			@foreach($matters->take(3) as $matter)
				@foreach($unidades_a as $unidad)
					<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
					@foreach($parcialP[$unidad->id] as $par)
					<td class="text-center">{{$par->identificador}}</td>
					@endforeach
				@endforeach
			@endforeach
		</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(3)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 3ra hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
				<td width="5" rowspan="3">No.</td>
				<td rowspan="3" class="text-center up">apellidos y nombres </td>
				<td rowspan="3" class="text-center">Promedio General</td>
				@foreach($matters->slice(11)->take(4) as $matter)
					<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(11)->take(4) as $matter)
				<td rowspan="2" class="text-center">Prom.</td>
					@foreach($unidades_a as $unidad)
					<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
					@endforeach
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(11)->take(4) as $matter)
					@foreach($unidades_a as $unidad)
						<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
						@foreach($parcialP[$unidad->id] as $par)
						<td class="text-center">{{$par->identificador}}</td>
						@endforeach
					@endforeach
				@endforeach
			</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(7)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 4ta hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
				<td width="5" rowspan="3">No.</td>
				<td rowspan="3" class="text-center up">apellidos y nombres </td>
				<td rowspan="3" class="text-center">Promedio General</td>
				@foreach($matters->slice(11)->take(4) as $matter)
					<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(11)->take(4) as $matter)
				<td rowspan="2" class="text-center">Prom.</td>
					@foreach($unidades_a as $unidad)
					<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
					@endforeach
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(11)->take(4) as $matter)
					@foreach($unidades_a as $unidad)
						<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
						@foreach($parcialP[$unidad->id] as $par)
						<td class="text-center">{{$par->identificador}}</td>
						@endforeach
					@endforeach
				@endforeach
			</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(11)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
		{{-- 5ta hoja --}}
		<div style="visibility:hidden">
			@include('partials.encabezados.libreta-formato-horizontal', [
				'titulo' => 'Libreta Anual Promedios',
			])
		</div>
		<br>
		<table class="table whitespace-no">
			<tr>
				<td width="5" rowspan="3">No.</td>
				<td rowspan="3" class="text-center up">apellidos y nombres </td>
				<td rowspan="3" class="text-center">Promedio General</td>
				@foreach($matters->slice(15)->take(4) as $matter)
					<td colspan="{{$num_par+3}}" class="text-center up">{{ $matter->nombre }}</td>
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(15)->take(4) as $matter)
				<td rowspan="2" class="text-center">Prom.</td>
					@foreach($unidades_a as $unidad)
					<td colspan="{{count($parcialP[$unidad->id])+1}}" class="text-center">{{$unidad->nombre}}</td>
					@endforeach
				@endforeach
			</tr>
			<tr>
				@foreach($matters->slice(15)->take(4) as $matter)
					@foreach($unidades_a as $unidad)
						<td class="text-center uppercase">P. {{$unidad->identificador}}</td>
						@foreach($parcialP[$unidad->id] as $par)
						<td class="text-center">{{$par->identificador}}</td>
						@endforeach
					@endforeach
				@endforeach
			</tr>
			@foreach($students as $student)
		<tr>
			<td class="text-center">{{ $loop->iteration }}</td>
			<td class="up">{{ $student->apellidos }} {{ $student->nombres}}</td>
			<td class="text-center">{{ bcdiv($anual[$student->id]->promedioEstudiante, '1', 2) }}</td>
				@foreach($matters->slice(15)->take(4) as $matter)
				@foreach($anual[$student->id]->materias as $datosMateria)
					@if($datosMateria->materiaId == $matter->id )
						<td class="text-center">{{bcdiv($datosMateria->promedioFinal, '1', 2)}}</td>
							@foreach($unidades_a as $unidad)
								@foreach($datosMateria->quimestres as $n_quimestre)
									@if($n_quimestre->indicador == $unidad->identificador)
										<td class="text-center uppercase">{{bcdiv($n_quimestre->promediop, '1', 2)}}</td>
										@foreach($parcialP[$unidad->id] as $par)
											@foreach($n_quimestre->parciales as $n_parciales)
												@if($n_parciales->indicador == $par->identificador)
													<td class="text-center">{{bcdiv($n_parciales->promediop, '1', 2)}}</td>
												@endif
											@endforeach
										@endforeach
									@endif
								@endforeach
							@endforeach
					@endif
				@endforeach
				@endforeach
			</tr>
			@endforeach
		</table>
	@endif
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
</body>

</html>