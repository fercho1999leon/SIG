<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Lista de Cotejo</title>
</head>
<style>
	.table td,
	.table th {
		font-size: 8pt !important;
	}
</style>
<body>
	<table class="table">
		<tr>
			<th style="vertical-align:top;" class="no-border" width="20%">
				<div class="header__logo" style="text-align:left">
					<img 
						@if(DB::table('institution')->where('id', '1')->first()->logo == null)
							src="{{ secure_asset('img/logo/logo.png') }}"
						@else
							src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
						@endif 
					alt="" width="70">
				</div>
			</th>
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
					<h3 class="up">Año Lectivo: {{$institution->periodoActual->nombre}} </h3>
					<h3 class="up">
						Lista de cotejo
					</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="no-border">{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}</td>
			<td class="no-border">Fecha: {{$fecha}}</td>
		</tr>
		<tr>
			<td class="no-border">{{strtoupper($materia->nombre)}}</td>
			<td class="no-border">Profesor: {{$profesor->apellidos}} {{$profesor->nombres}}</td>
		</tr>
	</table>
	<table class="table">
		<tbody>
			<tr>
				<td rowspan="2" width="5" class="text-center">#</td>
				<td rowspan="2" class="text-center">ESTUDIANTES</td>
				@foreach ($destrezas->take($takeInicial) as $destreza)
					<td colspan="3" width="5" class="text-center">{{$destreza->nombre}}</td>
				@endforeach
			</tr>
			<tr>
				@foreach ($destrezas->take($takeInicial) as $destreza)
					<td class="text-center">I</td>
					<td class="text-center">EP</td>
					<td class="text-center">A</td>
				@endforeach
			</tr>
			@foreach ($students as $student)
				<tr>
					<td class="text-center">{{$i++}}</td>
					<td>{{$student->apellidos}} {{$student->nombres}}</td>
					@foreach ($destrezas->take($takeInicial) as $destreza)
						@php
							$calificaciones = json_decode($destreza->calificacion);
							foreach ($calificaciones as $idStudent => $nota) {
								if ((int)$idStudent === $student->id) {
									$calificacion = $nota;
								}
							}
						@endphp
						<td class="text-center">
							{{$calificacion == 'I' ? 'I' : ''}}
						</td>
						<td class="text-center">
							{{$calificacion == 'EP' ? 'EP' : ''}}
						</td>
						<td class="text-center">
							{{$calificacion == 'A' ? 'A' : ''}}
						</td>
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
	@if ($numeroDeDestrezas > $takeInicial)
		<div style="page-break-after:always;"></div>
	@endif
	@if ($numeroDeDestrezas > $takeInicial)
		@php
			$i = 1;
		@endphp
		@for ($index = $takeInicial; $index < $numeroDeDestrezas; $index += $take)
			<table class="table">
				<tbody>
					<tr>
						<td rowspan="2" width="5" class="text-center">#</td>
						@foreach ($destrezas->slice($index)->take($take) as $destreza)
							<td colspan="3" width="5" class="text-center">{{$destreza->nombre}}</td>
						@endforeach
					</tr>
					<tr>
						@foreach ($destrezas->slice($index)->take($take) as $destreza)
							<td class="text-center">I</td>
							<td class="text-center">EP</td>
							<td class="text-center">A</td>
						@endforeach
					</tr>
					@foreach ($students as $student)
						<tr>
							<td class="text-center">{{$i++}}</td>
							@foreach ($destrezas->slice($index)->take($take) as $destreza)
								@php
									$calificaciones = json_decode($destreza->calificacion);
									foreach ($calificaciones as $idStudent => $nota) {
										if ((int)$idStudent === $student->id) {
											$calificacion = $nota;
										}
									}
								@endphp
								<td class="text-center">
									{{$calificacion == 'I' ? 'I' : ''}}
								</td>
								<td class="text-center">
									{{$calificacion == 'EP' ? 'EP' : ''}}
								</td>
								<td class="text-center">
									{{$calificacion == 'A' ? 'A' : ''}}
								</td>
							@endforeach
						</tr>
					@endforeach
				</tbody>
			</table>
			<div style="page-break-after:always;"></div>
		@endfor
	@endif
</body>
</html>