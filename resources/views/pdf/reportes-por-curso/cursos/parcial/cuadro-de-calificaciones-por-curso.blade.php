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
$t_promedios = 0;
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
					@foreach($matters2 as $matter2)
					@php
					$promMaterias2[$matter2->id]['promedio'] = 0;
					@endphp
					<td class="text-center no-border">
						<p class="s-calificaciones__materia">
							<span class="up bold">{{ $matter2->nombre }}</span>
						</p>
					</td>
					@endforeach
			</tr>
			@foreach($data->sortBy('apellidos') as $datoStudiantes)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td class="up">
				{{ $datoStudiantes->apellidos }}, {{ $datoStudiantes->nombres }}
				</td>
				<td class="up">
					@foreach($students as $st)
					@if($st->id == $datoStudiantes->estudianteId)
					@forelse ($st->comportamientos->where('parcial', $parcial) as $comportamiento)
						{{$comportamiento->nota}}
					@empty
						-
					@endforelse
					@endif
					@endforeach
				</td>
				@php
				$sum_prom=0;
			$dat_notas = new \Illuminate\Support\Collection($datoStudiantes->parcial);
			@endphp
				@foreach($matters as $matter)

					<td class="up"
						@foreach($dat_notas as $promedios)
						@if($promedios->materiaId == $matter->id)

						@if($promedios->promedioFinal<7 && $notasMenores==1)
						style="color:red;"
					@endif
					>
						{{bcdiv($promedios->promedioFinal, '1', 2)}}
						@php
						$promMaterias[$matter->id]['promedio'] += bcdiv($promedios->promedioFinal, '1', 2);
						$sum_prom += bcdiv($promedios->promedioFinal, '1', 2);
						@endphp
						@endif
						@endforeach
					</td>
				@endforeach
				<td class="up"
					@if(bcdiv($sum_prom/ count($matters), '1', 2) <7 && $notasMenores==1)
						style="color:red;"
					@endif
					>
					{{bcdiv($sum_prom/ count($matters), '1', 2)}}
					@php
					$t_promedios += bcdiv($sum_prom/ count($matters), '1', 2);
					@endphp
				</td>
				@foreach($matters2 as $matter2)
					<td class="up"
					@foreach($dat_notas as $promedios)
						@if($promedios->materiaId == $matter2->id)
						@if($promedios->promedioFinal<7 && $notasMenores==1)
						style="color:red;"
						@endif
						>	@if($matter2->nombre =='PROYECTO' || $matter2->nombre =='PROYECTOS ESCOLARES' )
						{{App\Calificacion::notaCualitativa($promedios->promedioFinal)}}
						@else
						{{bcdiv($promedios->promedioFinal, '1', 2)}}
						@endif
						@php
						$promMaterias2[$matter2->id]['promedio']+= bcdiv($promedios->promedioFinal, '1', 2);
						@endphp
						@endif
					@endforeach

					</td>
				@endforeach
				</tr>
				@endforeach
				<tr>
					<td class="up"></td>
					<td class="up"> Promedios Generales</td>
					<td class="up"></td>
					@foreach($matters as $matter)
					<td class="up">{{bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)}}</td>
					@endforeach
					<td class="up">{{bcdiv($t_promedios/count($students), '1', 2)}}</td>
					@foreach($matters2 as $matter2)
					<td class="up">
					@if($matter2->nombre =='PROYECTO' || $matter2->nombre =='PROYECTOS ESCOLARES' )
						{{App\Calificacion::notaCualitativa($promMaterias2[$matter2->id]['promedio']/count($students))}}
						@else
						{{bcdiv($promMaterias2[$matter2->id]['promedio']/count($students), '1', 2)}}
						@endif
					</td>
					@endforeach
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