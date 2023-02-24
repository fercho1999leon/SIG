<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte Agenda</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
@php
	$user = Sentinel::getUser();
	$tutor = App\Administrative::where(['userid' => $user->id, 'cargo' => 'Docente'])->first();

	foreach ($matters as $matter) {
		foreach ($hours as $h) {
			if ($h->idMateria==$matter->id) {
				$parcial = $h->parcial;
				break;
			}
		}
	}
@endphp
<style>
.table td,
.table th {
	font-size: 7pt !important;
}
</style>
<body class="relative">
	<table class="table">
		<thead>
			<tr>
				<th style="vertical-align:top;" class="no-border" width="20%">
					<div class="header__logo" style="text-align:left">
						<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
					</div>
				</th>
				<th class="no-border" width="60%">
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3>AÑO LECTIVO {{$institution->periodoActual->nombre}}</h3>
						<h3 class="up">
								Quimestre {{substr($parcial,3,4)}}- parcial {{substr($parcial,1,1)}}
						</h3>
						<h3 class="up">Agenda Escolar: {{request('fecha')}}</h3>
					</div>
				</th>
				<th class="no-border" width="20%">
				</th>
			</tr>
		</thead>
		<tr>
			<td class="no-border">
				Curso: {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}
			</td>
			@if ($tutor != null)
				<td class="text-right no-border">
					Tutor: {{$tutor->apellidos}} {{$tutor->nombres}}
				</td>
			@endif
		</tr>
		@foreach($matters as $matter)
			@foreach($hours as $h)
				@if($h->idMateria==$matter->id)
					<tr>
						<td colspan="3">
							{{ $matter->nombre }}
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<div>
								<div class="text-center">
									Actividad:
								</div>
								{{$h->nombre}}
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<div>
								<div class="text-center">
									Descripción
								</div>
								{{$h->descripcion}}
							</div>
						</td>
					</tr>							
					@if ($h->observacion != null)
						<tr>
							<td colspan="3">
								<div>
									<div class="text-center">
										Observación
									</div>
									{{$h->observacion}}
								</div>
							</td>
						</tr>
					@endif
					<tr>
						<td colspan="3" class="no-border"></td>
					</tr>
					<tr>
						<td colspan="3">Observaciones</td>
					</tr>
					@foreach ($observaciones->where('idLectionary', $h->id) as $observacion)
						<tr>
							<td colspan="3">{{$observacion->student->apellidos}} {{$observacion->student->nombres}}</td>
						</tr>
						<tr>
							<td colspan="3">{{$observacion->observacion}}</td>
						</tr>
						<tr>
							<td class="no-border"></td>
						</tr>
					@endforeach
					<tr>
						<td class="no-border"></td>
					</tr>
					<tr>
						<td class="no-border"></td>
					</tr>
				@endif
			@endforeach
		@endforeach
	</table>
</body>

</html>