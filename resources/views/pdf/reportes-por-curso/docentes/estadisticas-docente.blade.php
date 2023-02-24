<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Estadísticas por Docente</title>
	<link rel="stylesheet" href="{{secure_asset('css/print.css')}}" media="print">
	<link rel="stylesheet" href="{{secure_asset('css/print.css')}}">
	<link rel="stylesheet" href="{{secure_asset('css/no-print.css')}}">
</head>
<style>
	@page {
		size: A4 landscape;
	}
</style>
 @php

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
						<h3 class="up">Año Lectivo: {{$periodo}}  </h3>
						<h3 class="up"> {{ $tituloParcial }} </h3>
						<h3 class="up">
							Estadísticas
						</h3>
					</div>
				</th>
				<th class="no-border" width="20%">
				</th>
			</tr>
		</table>
		<br>
		<br>
		<div class="estadisticaParcial__gridGraficos">
			<div>
				<table class="table">
					<tr>
						<td class="text-center">No.</td>
						<td class="uppercase">materia</td>
						<td class="uppercase">prom</td>
					</tr>
					@php 
					$total = 0;					
					$c = 0;
					$mostrar = true;
					@endphp					
						@foreach($matters as $matter)
							@php
							$c++;
							$curso = $courses->where('id', $matter->idCurso)->first()->grado." ".$courses->where('id', $matter->idCurso)->first()->especializacion." ".$courses->where('id', $matter->idCurso)->first()->paralelo;
							@endphp
						<tr>
							@foreach ($calificaciones as $calificacion)
							@if ($calificacion->materiaId == $matter->id)
							<td class="text-center">{{ $c }}</td>
							<td class="uppercase">{{ $matter->nombre }} - {{ $curso }}</td>
							<td class="text-center">
										@php
											$total += bcdiv($calificacion->promedioFinal,1 ,2 ); 
											if($notas[$matter->idCurso][$matter->id] == 0)
												$mostrar = false;
										@endphp
										@if ($mostrar)
											{{ bcdiv($calificacion->promedioFinal,1 ,2) }}																					
										@endif
									@endif
								@endforeach
							</td>							
						</tr>
						@endforeach					
					<tr>
						<td></td>
						<td class="uppercase">promedio global</td>
						@if(count($matters) !=0 && $mostrar)
						<td class="text-center">{{ bcdiv(($total / count($matters)),1,2)  }}</td>
						@else
						<td class="text-center">-</td>
						@endif
					</tr>
				</table>
			</div>
			<div>
				<canvas id="myChart" width="90%"></canvas>
			</div>
		</div>
	</main>
	<script src="{{secure_asset('js/chart.js')}}"></script>
	<script>
		Chart.defaults.global.defaultFontSize = 10;
		var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: 
						[
							
							@foreach($matters as $matter)
								
								@foreach ($calificaciones as $calificacion)
										@if ($calificacion->materiaId == $matter->id)												
											@php 
												$curso = $matter->curso->grado." ".$matter->curso->paralelo;
												if(strlen($curso)>20 )
													$curso = substr($curso,0,20)."...";
											@endphp							
										@endif
									@endforeach
							"{{ $matter->nombre }} - {{ $curso }}", 
							@endforeach
							],
						datasets: [{
							data: [
								
									@foreach($matters as $matter)
										@foreach ($calificaciones as $calificacion)
											@if ($calificacion->materiaId == $matter->id)												
												{{ bcdiv($calificacion->promedioFinal,1 ,2) }},										
											@endif
										@endforeach
									@endforeach
								
								],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)',
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)',
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						animation: {
							onComplete: function () {
								var ctx = this.chart.ctx;
								ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
								ctx.fillStyle = "black";
								ctx.textAlign = 'center';
								ctx.textBaseline = 'bottom';
								this.data.datasets.forEach(function (dataset)
								{
									for (var i = 0; i < dataset.data.length; i++) {
										for(var key in dataset._meta)
										{
											var model = dataset._meta[key].data[i]._model;
											ctx.fillText(dataset.data[i], model.x, model.y - 5);
										}
									}
								});
							}
						},
						scales: {
							xAxes: [{
								display: true,
								scaleLabel: {
									display: true,
									labelString: 'Materias'
								},
								ticks: {
									autoSkip: false
								}
							}],
							yAxes: [{
								display: true,
								scaleLabel: {
									display: true,
									labelString: 'Promedio'
								}
							}]
						},
						legend: {
							display: false 
						},
						layout: {
							padding: {
								left: 0,
								right: 0,
								top: 25,
								bottom: 25
							}
						}
					}
				});

	</script>
</body>

</html>