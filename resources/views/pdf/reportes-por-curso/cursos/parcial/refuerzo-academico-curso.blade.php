<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Refuerzo Academico</title>
		<link rel="stylesheet" href="{{secure_asset('css/pdf/pdf.css') }}">
	</head>
	<style>
	</style>
	@php
		$n_parcial = "";
		$quimestre = "";
		switch ($parcial){
			case "p1q1":$n_parcial = "1";$quimestre = "1";break;
			case "p2q1":$n_parcial = "2";$quimestre = "1";break;
			case "p3q1":$n_parcial = "3";$quimestre = "1";break;
			case "p1q2":$n_parcial = "1";$quimestre = "2";break;
			case "p2q2":$n_parcial = "2";$quimestre = "2";break;
			case "p3q2":$n_parcial = "3";$quimestre = "2";break;
		}
	@endphp
	<body>
		<main>
			@foreach($matters as $matter)
				@if( count($students->whereIn('id',$studentsID[$matter->id])) != 0 )
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
									<h3 class="up">Quimestre {{$quimestre}} - parcial {{$n_parcial}}</h3>
									<h3 class="up">Año Lectivo: {{$periodo}}  </h3>
									<h3 class="up">Refuerzo académico</h3>
								</div>
							</th>
							<th class="no-border" width="20%"></th>
						</tr>
					</table>
					<br>
					<br>
					<table class="table">
						<tr>
							<th>
								<h3 class="m-0 uppercase text-left">nivel:
									@if($course->seccion == "EI")
										Educación inicial
									@elseif($course->seccion == "EGB")
										Educación general básica
									@else($course->seccion == "BGU")
										Bachillerato general unificado
									@endif
								</h3>
							</th>
							<th class="text-right">
								<h3 class="m-0 uppercase">fecha: {{ $now->format('d/m/Y') }}</h3>
							</th>
						</tr>
						<tr>
							<th>
								<h3 class="m-0 uppercase text-left">{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}</h3>
							</th>
						</tr>
						<tr>
							<th>
								<h3 class="m-0 uppercase text-left">asignatura: {{ $matter->nombre }}</h3>
							</th>
							<th>
								<h3 class="m-0 uppercase text-right">profesor: {{ $teacher[$matter->id]!= null ? $teacher[$matter->id]->apellidos: ''  }} {{ $teacher[$matter->id] != null ? $teacher[$matter->id]->nombres : '' }}</h3>
							</th>
						</tr>
					</table>
					<br>
					<br>
					<br>
					<br>
					<br>
					<table class="table">
						<tr>
							<td class="text-center uppercase">nombre</td>
							@foreach($supplies->where('idMateria', $matter->id) as $supply)
								<td class="text-center no-border" width="20">
									<p class="s-calificaciones__materia">
										<span class="up bold">{{ $supply->nombre}}</span>
									</p>
								</td>
							@endforeach
							<td colspan="{{count($supplies->where('idMateria', $matter->id)->where('es_aporte', 0))}}" class="text-center no-border">
								<p class="s-calificaciones__materia">
									<span class="up bold">recuperación academica</span>
								</p>
							</td>
							<td colspan="2" class="text-center no-border" width="40">
								<p class="s-calificaciones__materia">
									<span class="up bold">nota parcial</span>
								</p>
							</td>
						</tr>
						<tr>
							<td></td>
							@foreach($supplies->where('idMateria', $matter->id) as $supply)
								<td class="uppercase text-center">n</td>
							@endforeach
							@foreach($supplies->where('idMateria', $matter->id)->where('es_aporte', 0) as $supply)
								<td class="text-center">
									RA{{$ra_i++}}
								</td>
							@endforeach
							<td class="text-center" width="80">PI</td>
							<td class="text-center" width="80">PG</td>
						</tr>
						@foreach($students->whereIn('id',$studentsID[$matter->id]) as $student)
						<tr>
							@php
								$pi = 0;
								$pg = 0;
							@endphp
							<td>{{ $student->apellidos }} {{ $student->nombres }}</td>

							@foreach($supplies->where('idMateria', $matter->id) as $supply)
								<td class="text-center">{{  bcdiv($promedios[$matter->id][$supply->id][$student->id]['promedio'], '1', 2) }}</td>
								@php
									$pi = 0;
									$pg = 0;
									foreach($data as $d){
										if($d->estudiante->ID == $student->id){
											$p = new \Illuminate\Support\Collection($d->parcial);
											$prom = $p->where('materiaId', $matter->id)->first();
											$pi = $prom->promedioInicial;
											$pg = $prom->promedioFinal;
										}
									}
								@endphp
							@endforeach
							@foreach($supplies->where('idMateria', $matter->id)->where('es_aporte', 0) as $supply)
								<td class="text-center">
									@if($refuerzos[$matter->id][$supply->id][$student->id]['promedio']>0 )
										{{  bcdiv($refuerzos[$matter->id][$supply->id][$student->id]['promedio'], '1', 2) }}
									@endif
								</td>
							@endforeach

							<td class="text-center">
							@if($pi != 0)
								{{ bcdiv(($pi), '1', 2) }}
							@else
								0
							@endif
							</td>

							<td class="text-center">
								@if($pg != 0 && $pg != $pi)
									{{ bcdiv(($pg), '1', 2) }}
								@else

								@endif
							</td>
						</tr>
						@endforeach
					</table>
					<div class="firmas-grid">
						<div class="firmas-item">
							<div class="firmas-hr"></div>
							<h3 style="font-size: 15px">Fecha de entrega:</h3>
						</div>
					</div>
					<div style="page-break-after:always;"></div>
				@endif
			@endforeach
		</main>
	</body>
</html>