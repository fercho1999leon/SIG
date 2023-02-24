<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Cuadro de calificaciones</title>
</head>
<style>
	.table td
	.table th {
		font-size: 7pt !important;
	}
</style>
@php
$n_parcial = "";
$quimestre = "";
$t_q ='';
$P_c = 0;
$prom_total=0;
$prom_t= true;
switch ($parcial) {
	case "p1q1":
		$n_parcial = "primer";
		$quimestre = "primer";
		$t_q = 'q1';
	break;
	case "p2q1":
		$n_parcial = "segundo";
		$quimestre = "primer";
		$t_q = 'q1';
	break;
	case "p3q1":
		$n_parcial = "tercer";
		$quimestre = "primer";
		$t_q = 'q1';
	break;
	case "p1q2":
		$n_parcial = "primer";
		$quimestre = "segundo";
		$t_q = 'q2';
	break;
	case "p2q2":
		$n_parcial = "segundo";
		$quimestre = "segundo";
		$t_q = 'q2';
	break;
	case "p3q2":
		$n_parcial = "tercer";
		$quimestre = "segundo";
		$t_q = 'q2';
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
					<h3 class="up">Año Lectivo: {{$periodo->nombre}} </h3>
					<h3 class="up">
						 Quimestre {{$nQuimestre}}
					</h3>
					<h3 class="up">
						cuadro de calificaciones
					</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<br>
	<section class="actaCalificacionesParcial__section">
		<div>
			<h4 class="m-0 up d-ib mr-1">
            	{{ $course->grado }} {{ $course->paralelo }}  {{ $course->especializacion }}
			</h4>
			<h4 class="m-0 up d-ib mr-1">Tutor(A):
			@if($tutor != null)
				{{ $tutor->apellidos }}, {{ $tutor->nombres }}
			@endif
			</h4>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table class="table mb-0">
			<tr>
				<td class="text-center">No.</td>
				<td class="text-center">NOMBRE</td>
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="uppercase bold">Comportamiento</span>
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
							<span class="uppercase bold">{{ $matter->nombre }}</span>
						</p>
					</td>
				@endforeach
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="uppercase bold">Promedio</span>
					</p>
				</td>
				@foreach($matters2 as $matter2)
					<td class="text-center no-border">
						<p class="s-calificaciones__materia">
							<span class="uppercase bold">{{ $matter2->nombre }}</span>
						</p>
					</td>
				@endforeach
			</tr>
			@foreach($students as $student)
			<tr>
				<td class="text-center">{{ $loop->iteration }}</td>
				<td class="uppercase">
				{{ $student->apellidos }}, {{ $student->nombres }}
				@if($student->nivelDeIngles!=null)
					<strong>{{$student->nivelDeIngles}}</strong>
				@endif
				</td>
				<td class="text-center">
					@forelse($student->comportamientos->where('parcial',$t_q) as $comportamiento)
							{{$comportamiento->nota}}
						@empty
							-
						@endforelse
				</td>
				@php
					$promediar = true;
					$prom = 0;
					$promediar_C = true;
					$prom_C = 0;
				@endphp
				@foreach($matters as $matter)
				<td class="text-center"
					@if($promedios[$matter->id][$student->id]<7)
						style="color:red;"
					@endif
				>


					@if( bcdiv($promedios[$matter->id][$student->id], '1', 2)==0)
						@php
							$promediar = false;
							$prom_t = false;
							$promMaterias[$matter->id]['mostrar'] = false;

						@endphp
					@else
						@php
							$prom += bcdiv($promedios[$matter->id][$student->id], '1', 2);
							$promMaterias[$matter->id]['promedio'] += bcdiv($promedios[$matter->id][$student->id], '1', 2);
						@endphp
						@if($matter->nombre == 'PROYECTO' || $matter->nombre == 'PROYECTOS ESCOLARES')
						@php
						$notacualitativa = App\Calificacion::notaCualitativa($promedios[$matter->id][$student->id]);
						@endphp
							{{$notacualitativa}}
						@else
						{{ bcdiv($promedios[$matter->id][$student->id], '1', 2) }}
						@endif
					@endif
				</td>
				@endforeach
				<td class="text-center">
				@if($promediar)
					{{ bcdiv($prom/count($matters), '1', 2) }}
				@endif
				</td>
				@foreach($matters2 as $matter2)
				@if( bcdiv($promedios[$matter2->id][$student->id], '1', 2)==0)
						@php
							$promediar_C = false;
						@endphp
					@else
						@if($matter2->nombre == 'PROYECTO' || $matter2->nombre == 'PROYECTOS ESCOLARES')
						@php
						$P_c += bcdiv($promedios[$matter2->id][$student->id], '1', 2);
						$notacualitativa = App\Calificacion::notaCualitativa($promedios[$matter2->id][$student->id]);
						@endphp
					<td class="text-center">
					{{$notacualitativa}}
				</td>
				@endif
				@endif
				@endforeach
			</tr>
			@endforeach
			<tr>
				<td></td>
				<td>PROMEDIO</td>
				<td></td>
				@foreach($matters as $matter)
					@if($promMaterias[$matter->id]['mostrar'])
						@if($matter->nombre == 'PROYECTO' || $matter->nombre == 'PROYECTOS ESCOLARES')
							@if( bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)>= 9)
								<td class="text-center">EX</td>
							@endif
							@if ( bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)<9 && bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)>=7)
								<td class="text-center">MB</td>
							@endif
							@if( bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)>4 && bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)<7)
								<td class="text-center">B</td>
							@endif
							@if( bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)>=0 && bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2)<4)
								<td class="text-center">R</td>
							@endif
						@else
						@php
						if(bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2) == 0){
								$prom_t = false;
						}
						$prom_total += bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2);
						@endphp
							<td class="text-center">{{ bcdiv($promMaterias[$matter->id]['promedio']/count($students), '1', 2) }} </td>
						@endif
					@else
					<td></td>
					@endif
				@endforeach
				<td class="text-center">
				@if($prom_t)
				{{bcdiv($prom_total/count($matters), '1', 2)}}
				@endif
				</td>
				<td class="text-center">
				@if($promediar_C)
				{{App\Calificacion::notaCualitativa(bcdiv($P_c/count($students), '1', 2))}}
				@endif
				</td>
			</tr>
		</table>
		<div class="actaCalificacionesParcial__footer mb-2">
			<table class="table">
				<tr>
					<th>
						<h4 class="m-0 text-left">Notas Bajas <span class="actaCalificacionesParcial__notasColor-span2"></span></h4>
					</th>
					<th>
						<h4 class="m-0 text-right">{{ $institution->ciudad }}, {{ $now->format('d/m/Y') }}</h4>
					</th>
				</tr>
			</table>
		</div>
		<table class="table">
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{ $institution->representante1 }}</h4>
				<h4 class="firma--size m-0 uppercase text-center">rector</h4>
			</th>
			<th width="10%"></th>
			<th>
				<hr style="border:1px solid black;">
				<h4 class="firma--size m-0 uppercase text-center">{{ $institution->representante2 }}</h4>
				<h4 class="firma--size m-0 uppercase text-center">secretaria</h4>
			</th>
			<th width="10%"></th>
		</table>
	</section>
</body>

</html>