<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Cuadro de honor</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
@php
$nParcial = "";
$nQuimestre = "";

switch($parcial){
	case "p1q1":
	$nParcial = "1";
	$nQuimestre = "1";
	break;
	case "p2q1":
	$nParcial = "2";
	$nQuimestre = "1";
	break;
	case "p3q1":
	$nParcial = "3";
	$nQuimestre = "1";
	break;
	case "p1q2":
	$nParcial = "1";
	$nQuimestre = "2";
	break;
	case "p2q2":
	$nParcial = "2";
	$nQuimestre = "2";
	break;
	case "p3q2":
	$nParcial = "3";
	$nQuimestre = "2";
	break;

}
@endphp
<body>
	<main>
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
						<h3 class="up"> Quimestre {{$nQuimestre}} </h3>
						<h3 class="up">Año Lectivo: {{$periodo}}  </h3>
						<h3 class="up">
							cuadro de honor
						</h3>
					</div>
				</th>
				<th class="no-border" width="20%">
				</th>
			</tr>
		</table>
		<br>
		<table class="w100">
			<tr>
				<td class="text-left uppercase">
					Nivel: <span class="uppercase">{{ $educacion }}</span>
				</td>
				<td class="text-right uppercase">
					Fecha: {{ $now->format('d/m/Y') }}
				</td>
			</tr>
		</table>
		<table class="w100">
			<tr>
				<td class="no-border uppercase">{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}</td>
			</tr>
		</table>
		<table class="table">
			<tr>
				<td class="text-center">No.</td>
				<td class="text-center">ESTUDIANTE</td>
				<td class="text-center">PROM.</td>
				<td class="text-center">EQUIV.</td>
				<td class="text-center">COMPORTAMIENTO</td>
			</tr>
			@foreach($students as $student)
				@php
				$equiv = "";
					if($cuadro[$student->id]>9){
						$equiv = "DAR";
					}else if($cuadro[$student->id]>=7 && $cuadro[$student->id]<9){
						$equiv = "AAR";
					}else if($cuadro[$student->id]>=4 && $cuadro[$student->id]<7){
						$equiv = "PAAR";
					}else {
						$equiv = "NAAR";
					}
				@endphp
				<tr>
					<td class="text-center"> {{ $loop->iteration }} </td>
					<td class="uppercase">{{ $student->apellidos }} {{ $student->nombres }}</td>
					<td class="text-center">{{ $cuadro[$student->id] }}</td>
					<td class="text-center uppercase">{{ $equiv }}</td>
					<td class="text-center uppercase">
						@foreach ($comportamientos->where('idStudent', $student->id) as $comportamiento)
							{{$comportamiento->nota}}
						@endforeach
					</td>
				</tr>
			@endforeach

		</table>
	</main>
</body>

</html>