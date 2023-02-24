<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Cuadro de calificaciones</title>
</head>
@php
$n_parcial = "";
$quimestre = "";
switch ($parcial) {
	case "p1q1":
		$n_parcial = "primer";
		$quimestre = "primer";
	break;
	case "p2q1":
		$n_parcial = "segundo";
		$quimestre = "primer";
	break;
	case "p3q1":
		$n_parcial = "tercer";
		$quimestre = "primer";
	break;
	case "p1q2":
		$n_parcial = "primer";
		$quimestre = "segundo";
	break;
	case "p2q2":
		$n_parcial = "segundo";
		$quimestre = "segundo";
	break;
	case "p3q2":
		$n_parcial = "tercer";
		$quimestre = "segundo";
	break;
}


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
<body class="actaCalificacionesParcial">
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
					<h3 class="up">
						 Quimestre {{$nQuimestre}} - parcial {{$nParcial}}
					</h3>
					<h3 class="up">Año Lectivo: {{$periodo}}  </h3>
					<h3 class="up">
						cuadro de calificaciones
					</h3>
				</div>

			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
		<br>
	</table>
	{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}
	<br>
	<br>
	<section class="actaCalificacionesParcial__section">
		<br>
		<br>
		<br>
		<br>
		<table class="table">
			<tr>
				<td class="text-center">No.</td>
				<td class="text-center">NOMBRE</td>
				<td class="text-center no-border">
						<p class="s-calificaciones__materia">
							<span class="up bold">Comportamiento</span>
						</p>
					</td>
				@php
					$promMaterias = [];
				@endphp
				@foreach($matters as $matter)
				@php
					$promMaterias[$matter->id]['mostrar'] = true;
					$promMaterias[$matter->id]['promedio'] = 0;
				@endphp
					<td class="text-center no-border">
						<p class="s-calificaciones__materia">
							<span class="up bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
				<td class="text-center no-border">
						<p class="s-calificaciones__materia">
							<span class="up bold">Promedio</span>
						</p>
					</td>
			</tr>
			@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td class="up">
				{{ $student->apellidos }}, {{ $student->nombres }}
				@if($student->nivelDeIngles!=null)
					<strong>{{$student->nivelDeIngles}}</strong>
				@endif
				</td>
				<td class="text-center">
					@forelse ($student->comportamientos->where('parcial', $parcial) as $comportamiento)
						{{$comportamiento->nota}}
					@empty
						-
					@endforelse
				</td>
				@php
					$promediar = true;
					$prom = 0;
				@endphp
				@foreach($matters as $matter)
				<td class="text-center"
					@if($promedios[$matter->id][$student->id]['promedio']<7)
						style="color:red;"
					@endif
				>

					@if( bcdiv($promedios[$matter->id][$student->id]['promedio'], '1', 2)==0)
						@php
							$promediar = false;
							$promMaterias[$matter->id]['mostrar'] = false;
						@endphp
					@else
						@php
							$prom += bcdiv($promedios[$matter->id][$student->id]['promedio'], '1', 2);
							$promMaterias[$matter->id]['promedio'] += bcdiv($promedios[$matter->id][$student->id]['promedio'], '1', 2);
						@endphp
						@if($matter->nombre == 'PROYECTO')
							@if( $promedios[$matter->id][$student->id]>= 9)
								EX
							@endif
							@if ( $promedios[$matter->id][$student->id]<9 && $promedios[$matter->id][$student->id]>=7)
								MB
							@endif
							@if( $promedios[$matter->id][$student->id]>4 && $promedios[$matter->id][$student->id]<7)
								B
							@endif
							@if( $promedios[$matter->id][$student->id]>=0 && $promedios[$matter->id][$student->id]<4)
								R
							@endif
						@else
						{{ bcdiv($promedios[$matter->id][$student->id]['promedio'], '1', 2) }}
						@endif
					@endif
				</td>
				@endforeach
				<td class="text-center">
				@if($promediar)
					{{ bcdiv($prom/count($matters), '1', 2) }}
				@endif
				</td>
			</tr>
			@endforeach
			<tr>
				<td></td>
				<td>PROMEDIO</td>
				<td></td>
				@foreach($matters as $matter)
					@if($promMaterias[$matter->id]['mostrar'])
					@if($matter->nombre == 'PROYECTO')
							@if( bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)>= 9)
							<td>	EX</td>
							@endif
							@if ( bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)<9 && bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)>=7)
							<td>	MB</td>
							@endif
							@if( bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)>4 && bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)<7)
							<td>	B</td>
							@endif
							@if( bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)>=0 && bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)<4)
							<td>	R</td>
							@endif
						@else
						<td>{{ bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2) }} </td>

						@endif
					@else
					<td></td>
					@endif
				@endforeach
				<td></td>
			</tr>
		</table>
		<table class="table">
			<tr>
				<th class="text-left">
					<h4 class="firma--size m-0">Notas Bajas <span class="actaCalificacionesParcial__notasColor-span2"></span></h4>
				</th>
				<th class="text-right">
					<h4 class="firma--size m-0 text-right">{{ $institution->ciudad }}, {{ $now->format('d/m/Y') }}</h4>
				</th>
			</tr>
		</table>
		<div class="actaCalificacionesParcial__firmas">
			<table class="table">
				<tr>
					<th width="5%"></th>
					<th>
						<div class="">
							<hr>
							<h4 class="firma--size up text-center m-0">{{ $institution->representante1 }}</h4>
							<h4 class="firma--size up text-center m-0">rector</h4>
						</div>
					</th>
					<th width="5%"></th>
					<th>
						<div class="">
							<hr>
							<h4 class="up firma--size text-center m-0">{{ $institution->representante2 }}</h4>
							<h4 class="up firma--size text-center m-0">secretaria</h4>
						</div>
					</th>
					<th width="5%"></th>
				</tr>
			</table>
		</div>
		<br>

	</section>
</body>

</html>