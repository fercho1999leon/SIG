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
$pormedio_total_curso =0;
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
				@foreach($area_pos as $Ap)
						@php
						$mat_fij = $matters->where('nombreArea',$Ap->nombre)->sortBy('posicion');
						@endphp
						@if($mat_fij!= null)
							@foreach($mat_fij as $matter)
							@php
								$mostrar[$matter->id]['mostrar'] = true;
								$promMaterias[$matter->id]['promedio'] = 0;
							@endphp
								<td class="text-center no-border">
									<p class="s-calificaciones__materia">
										<span class="uppercase bold">{{ $matter->nombre }}</span>
									</p>
								</td>
							@endforeach
						@endif
				@endforeach
				<td class="text-center no-border">
					<p class="s-calificaciones__materia">
						<span class="uppercase bold">Promedio</span>
					</p>
				</td>
				@foreach($area_pos as $Ap)
					@php
					$mat_Ext = $matters2->where('nombreArea',$Ap->nombre)->sortBy('posicion');
					@endphp
					@if($mat_Ext!= null)
						@foreach($mat_Ext as $matter2)
						@php
						$mostrar[$matter2->id]['mostrar'] = true;
						$promMaterias_me[$matter2->id]['promedio'] =0;
						@endphp
							<td class="text-center no-border">
								<p class="s-calificaciones__materia">
									<span class="uppercase bold">{{ $matter2->nombre }}</span>
								</p>
							</td>
						@endforeach
					@endif
				@endforeach
			</tr>
			@foreach($students as $student)
			@php
			$visualizar_promedio= true;
			$prom_total_materia= 0;
			@endphp
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
					@foreach($area_pos as $Ap)
						@php
						$mat_fij = $matters->where('nombreArea',$Ap->nombre)->sortBy('posicion');
						@endphp
						@if($mat_fij!= null)
							@foreach($mat_fij as $mp)
							@php
							$final=0;
							$c_p =0;
							$prom_materia=0;
							$visualizar=true;
							$final_ex =0;
							@endphp
							@foreach($parcialP as $par)
							@if($par->identificador =='q1' || $par->identificador =='q2')
							@if($examenes[$mp->id][$student->id] ==0 && $PromedioInsumo == 0)
									@php
									//$visualizar=false;
									$mostrar[$mp->id]['mostrar'] = false;
									@endphp
									@else
									@php
									$final_ex = bcdiv($examenes[$mp->id][$student->id], '1', 2)*0.20;
									@endphp
									@endif
								@else
										@php
										$dat_notas = new \Illuminate\Support\Collection($promedios[$par->identificador]);

										@endphp
										@foreach ($dat_notas as $key =>$notas)
										@if($notas->alumno->ID == $student->id)
										@foreach($dat_notas[$key]->materias as $dat)
										@if($dat->materiaId == $mp->id)
										@if($dat->promedioFinal ==0 && $PromedioInsumo == 0)
										@php
										$visualizar=false;
										$visualizar_promedio=false;
										$mostrar[$matter->id]['mostrar'] = false;
										@endphp
										@endif
										@php
										$c_p++;
										$final +=$dat->promedioFinal;
										@endphp
										@endif
										@endforeach
										@endif
										@endforeach

							@endif
							@endforeach
							@php
							$prom_materia_parciales = bcdiv(bcdiv(($final / $c_p), '1', 2)*0.80, '1', 2 );
							$prom_materia = $prom_materia_parciales + $final_ex;
							$prom_total_materia+= $prom_materia;
							$promMaterias[$mp->id]['promedio'] +=bcdiv($prom_materia, '1', 2);
							@endphp
							@if($visualizar)
							<td @if($prom_materia < 7 && $notasMenores == "1")
											style="color:red;"
										@endif
							>{{bcdiv($prom_materia, '1', 2)}}</td>
							@else
							<td></td>
							@endif
							@endforeach
						@endif
					@endforeach
					@if($visualizar_promedio)
					<td @if($prom_total_materia/count($matters) < 7 && $notasMenores == "1")
									style="color:red;"
								@endif
					>{{bcdiv($prom_total_materia/count($matters), '1', 2)}}</td>
					@php
					$pormedio_total_curso +=bcdiv($prom_total_materia/count($matters), '1', 2);
					@endphp
					@else
					<td></td>
					@endif
					@foreach($area_pos as $Ap)
						@php
						$mat_Ext = $matters2->where('nombreArea',$Ap->nombre)->sortBy('posicion');
						@endphp
						@if($mat_Ext!= null)
							@foreach($mat_Ext as $me)
								@php
								$final_me[$me->id] =0;
								$c_p_me =0;
								$prom_materia_me=0;
								@endphp
										@foreach($parcialP as $par)
											@if($par->identificador =='q1' || $par->identificador =='q2')
													@php
													$final_ex_me = bcdiv($examenes[$me->id][$student->id], '1', 2)*0.20;
													@endphp
													@else
														@php
														$dat_notas = new \Illuminate\Support\Collection($promedios[$par->identificador]);
														@endphp
															@foreach ($dat_notas as $key =>$notas)
																@if($notas->alumno->ID == $student->id)
																	@foreach($dat_notas[$key]->materias as $dat)
																		@if($dat->materiaId == $me->id)
																			@if($dat->promedioFinal ==0 && $PromedioInsumo == 0)
																			@php
																			$visualizar=false;
																			@endphp
																			@endif
																		@php
																		$c_p_me++;
																		$final_me[$me->id] +=$dat->promedioFinal;
																		@endphp
																		@endif
																	@endforeach
																@endif
															@endforeach
											@endif
										@endforeach
									@php
									$prom_materia_parciales_me = ($final_me[$me->id] / $c_p_me)*0.80;
									$prom_materia_me = $prom_materia_parciales_me + $final_ex_me;
									$promMaterias_me[$me->id]['promedio'] +=bcdiv($prom_materia_me, '1', 2);
									@endphp
									<td @if($prom_materia_me < 7 && $notasMenores == "1")
													style="color:red;"
										@endif
									>
										@if($me->nombre =='PROYECTO'|| $me->nombre =='PROYECTOS ESCOLARES' || $me->nombre =='PROYECTO ESCOLAR')
										{{App\Calificacion::notaCualitativa($prom_materia_me)}}
										@else{{bcdiv($prom_materia_me, '1', 2)}}
										@endif</td>
							@endforeach
					@endif
				@endforeach
			</tr>
		@endforeach
			<tr>
				<td></td>
				<td>PROMEDIOS FINALES</td>
				<td></td>
				@foreach($area_pos as $Ap)
						@php
						$mat_fij = $matters->where('nombreArea',$Ap->nombre)->sortBy('posicion');
						@endphp
						@if($mat_fij!= null)
							@foreach($mat_fij as $matter)
							@if($mostrar[$matter->id]['mostrar'])
							<td>{{bcdiv($promMaterias[$matter->id]['promedio'] / count($students), '1', 2)}}</td>
							@else
							<td></td>
							@endif
							@endforeach
						@endif
					@endforeach
						@if($visualizar_promedio)
						<td>{{bcdiv($pormedio_total_curso / count($students), '1', 2)}}</td>
						@else
						<td></td>
						@endif
					@foreach($area_pos as $Ap)
							@php
							$mat_Ext = $matters2->where('nombreArea',$Ap->nombre)->sortBy('posicion');
							@endphp
							@if($mat_Ext!= null)
								@foreach($mat_Ext as $me)
								<td>
									@if($me->nombre =='PROYECTO'||$me->nombre =='PROYECTOS ESCOLARES' || $me->nombre =='PROYECTO ESCOLAR')
									{{App\Calificacion::notaCualitativa($promMaterias_me[$me->id]['promedio'] /count($students))}}
									@else{{bcdiv($promMaterias_me[$me->id]['promedio'] /count($students), '1', 2)}}
									@endif</td>
								@endforeach
							@endif
					@endforeach
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