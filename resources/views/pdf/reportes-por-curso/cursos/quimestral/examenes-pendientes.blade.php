<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Examenes Pendientes</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
@php
$n_parcial = "";

switch ($quimestre){
	case "p1q1":
		$n_parcial = "1";
		$quimestre = "1";
	break;
	case "p2q1":
		$n_parcial = "2";
		$quimestre = "1";
	break;
	case "p3q1":
		$n_parcial = "3";
		$quimestre = "1";
	break;
	case "p1q2":
		$n_parcial = "1";
		$quimestre = "2";
	break;
	case "p2q2":
		$n_parcial = "2";
		$quimestre = "2";
	break;
	case "p3q2":
		$n_parcial = "3";
		$quimestre = "2";
	break;

}
@endphp
<body>
	<main>
		@foreach($matters as $matter)
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
						<h3 class="up"> Quimestre {{$quimestre}} - Parcial {{$n_parcial}} </h3>
						<h3 class="up">Año Lectivo: {{$periodo}}  </h3>
						<h3 class="up">
							reporte general
						</h3>
					</div>
				</th>
				<th class="no-border" width="20%">
				</th>
			</tr>
		</table>
		<table>
			<tr>
				<td class="no-border up">{{ $curso->grado }} {{ $curso->paralelo }} {{ $curso->especializacion }}</td>
			</tr>
			<tr>
				<td class="no-border up">{{$matter->nombre}}</td>
			</tr>
		</table>
		<table class="table">
			<tr class="bgDark">
				<td class="text-center">No.</td>
				<td>Estudiante</td>
				@foreach($parcialP as $par )
				<td class="text-center">{{$par->nombre}}</td>
				@endforeach
				<td class="text-center">
					<span class="actaCalificaciones__act">Prom. Quimestral</span>
				</td>
			</tr>
			@foreach($students as $student)
			@if($examenes[$matter->id][$student->id] == 0 && isset($promediosFinal[$matter->id][$student->id]))
				<tr>
					@php
						$c = 0;
					@endphp

					<td class="text-center">{{$loop->iteration}}</td>
					<td class="whitespace-no">
						{{ $student->apellidos}} {{ $student->nombres }}
					</td>
					@foreach($parcialP as $par )
						@php
						$P_promediosparcial=0;
						switch ($par->identificador) {
						case 'p1'.$quimestre:
						$promediosparcial = $promediosP1[$matter->id][$student->id]['promedio'];
						break;
						case 'p2'.$quimestre:
						$promediosparcial = $promediosP2[$matter->id][$student->id]['promedio'];
						break;
						case 'p3'.$quimestre:
						$promediosparcial = $promediosP3[$matter->id][$student->id]['promedio'];
						break;
						case $quimestre:
						$ver_promedio4 ='';
						$promediosparcial = $examenes[$matter->id][$student->id];
						break;
						}
						@endphp
						<td class="text-center">{{ bcdiv($promediosparcial,'1',2)==0 ? '': bcdiv($promediosparcial,'1',2) }}</td>
						@endforeach
						<td class="text-center">
						@if ($promediosFinal[$matter->id][$student->id] == 0)
						@endif
					</td>
				</tr>
			@endif
			@endforeach
		</table>
		<div style="page-break-after:always;"></div>
		@endforeach
	</main>
</body>

</html>