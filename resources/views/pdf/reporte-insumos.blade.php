<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Reporte Insumos</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
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
						Informe de actividades realizadas {{$parcial}}
					</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table">
	@foreach ($materias as $materia)
		<tr>
			<td class="no-border">
				<table class="table">
					<tr>
						<td class="no-border">{{$materia->curso->grado}} {{$materia->curso->especializacion}} {{$materia->curso->paralelo}}</td>
						<td class="no-border text-right">{{$docente->apellidos}} {{$docente->nombres}}</td>
					</tr>
					<tr>
						<td class="no-border">{{$materia->nombre}}</td>
						<td class="no-border text-right">{{$fecha}}</td>
					</tr>
				</table>
				<table class="table">
					<tr>
						<td class="text-center" width="5">#</td>
						<td class="text-center" width="5">INSUMO</td>
						<td class="text-center uppercase" width="5">actividades creadas</td>
						<td class="text-center uppercase" width="5">actividades recibidas</td>
						<td class="text-center uppercase" width="5">actividades pendientes</td>
					</tr>
					@foreach ($materia->supplies()->where('es_aporte', 0)->get() as $insumo)
						@if ($insumo->nombre !== 'RECUPERATORIO' && $insumo->nombre !== 'EXAMEN QUIMESTRAL')
							<tr>
								<td class="text-center">{{$i++}}</td>
								<td>{{$insumo->nombre}}</td>
								<td class="text-center">
									@php
										$actividades = count($insumo->activities()->where(['parcial' => $parcial, 'refuerzo' => 0])->get());
										$totalActividades += $actividades;
									@endphp
									{{count($insumo->activities()->where(['parcial' => $parcial, 'refuerzo' => 0])->get())}}
								</td>
								<td class="text-center">
									@php
										foreach ($insumo->activities()->where(['parcial' => $parcial, 'refuerzo' => 0])->get() as $actividad) {
											$recibidas = $actividad->califications()->where('nota', '!=', 0)->get();
											$st = 0;
											foreach ($recibidas as $nota) {
												if ($nota->student->retirado == 'NO') {
													$st++;
												}
											}
											$totalActividadesRecibidas += $st;
											$totalR += $st;
										}
									@endphp
									{{$totalActividadesRecibidas}}
								</td>
								<td class="text-center">
									@php
										$totalActividadesRecibidas = 0;
										$s = 0;
										$students2 = App\Student2::where(['idCurso' => $materia->curso->id, 'retirado' => 'NO', 'matricula' => 'Ordinaria'])->orderBy('apellidos', 'ASC')->get();
										foreach ($insumo->activities()->where(['parcial' => $parcial, 'refuerzo' => 0])->get() as $actividad) {
											$s++;
											$recibidas =$actividad->califications()->where('nota', '!=', 0)->get();
											$st = 0;
											foreach ($recibidas as $nota) {
												if ($nota->student->retirado == 'NO') {
													$st++;
												}
											}
											$totalActividadesRecibidas += $st;
										}
										$totalStudents = count($students2) * $s;
										$totalActividadesPendientes = $totalStudents - $totalActividadesRecibidas;
									@endphp
									{{$totalActividadesPendientes}}
								</td>
							</tr>
							@php
								$totalP += $totalActividadesPendientes;
								$totalActividadesRecibidas = 0;
								$totalActividadesPendientes = 0;
							@endphp
						@endif
					@endforeach
					<tr>
						<td class="no-border" colspan="5">
							<span style="visibility: hidden">-</span>
						</td>
					</tr>
					<tr>
						<td class="no-border" colspan="2"></td>
						<td class="text-center">{{$totalActividades}}</td>
						<td class="text-center">{{$totalR}}</td>
						<td class="text-center">{{$totalP}}</td>
					</tr>
				</table>
				@php
					$i = 1;
					$totalActividades = 0;
					$totalActividadesRecibidas = 0;
					$totalActividadesPendientes = 0;
					$totalR = 0;
					$totalP = 0;
				@endphp
				<br>
				<br>
			</td>
		</tr>
	@endforeach
	</table>
	<p class="bold">NOTA: Al realizar el conteo del número de actividades se excluye las materias y no se considera el insumo EVALUACIÓN/APORTE</p>
</body>
</html>