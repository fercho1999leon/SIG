<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>{{$nombreReporte}}</title>
</head>
<style>
	.table td,
	.table th {
		font-size: 10pt !important;
	}
</style>

<body>
	<div style="page-break-after:always;"></div>
	<table class="table">
		<thead>
			<tr>
				<th class="no-border" colspan="5">
					<img style="float:left"
						@if(DB::table('institution')->where('id', '1')->first()->logo == null)
							src="{{ secure_asset('img/logo/logo.png') }}"
						@else
							src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
						@endif 
					alt="" width="70">
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">
							{{$nombreReporte}}
						</h3>
						<h3 class="up">Año Lectivo: {{App\Institution::periodoLectivo()}} </h3>
					</div>
				</th>
			</tr>
			<tr>
				<th colspan="2" style="font-size:12pt !important" class="no-border text-left"> {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} </th>
				@if ($tutor != null)
					<th colspan="3" style="font-size:12pt !important" class="no-border text-right">Tutor: {{$tutor->apellidos}} {{$tutor->nombres}} </th>
				@endif
			</tr>
		</thead>
		<tr>
			<td width="5" class="text-center" style="font-size:12pt !important">No.</td>
			<td style="font-size:12pt !important">Apellidos y Nombres</td>
			<td width="100" class="text-center" style="font-size:12pt !important">Atrasos</td>
			<td width="100" class="text-center" style="font-size:12pt !important">Faltas Justificadas</td>
			<td width="100" class="text-center" style="font-size:12pt !important">Faltas Injustificadas</td>
		</tr>
	
			
		@endphp
		@foreach ($students as $student)
	
			<tr>
				<td class="text-center">{{$loop->index+1}}</td>
				<td> {{$student->apellidos}} {{$student->nombres}} </td>
				<td class="text-center">
					@if($parcial == 'q1')
						<br> 
						Q1 <br>
						<div class="reporteAsistenciaAnual__flex">
							<div>
								P1: 0<br>
								P2: 0 <br>
								P3: 0 <br>
							</div>
						</div>
					@elseif($parcial == 'q2')
						<br>
						Q2 <br>
						<div class="reporteAsistenciaAnual__flex">
							<div>
								P1: 0 <br>
								P2: 0 <br>
								P3: 0 <br>
							</div>
						</div>
					@elseif($parcial == 'anual')
						<div class="reporteAsistenciaAnual__seccionAnual">
							<div class="reporteAsistenciaAnual__seccionAnual-quimestre">
								<div class="bold">
									1
								</div>
								<div>
									P1: 0 <br>
									P2: 0 <br>
									P3: 0 <br>
								</div>
							</div>
							<div>
								<div class="bold">
									2
								</div>
								<div>
									P1: 0 <br>
									P2: 0 <br>
									P3: 0 <br>
								</div>
							</div>
						</div>
					@else 
						{{$student->asistenciaParcial($parcial)->atrasos}}
					@endif
				</td>
				<td class="text-center">
					@if($parcial == 'q1')
						<br> 
						Seccion 1 <br>
						<div class="reporteAsistenciaAnual__flex">
							<div>
								P1: 0 <br>
								P2: 0 <br>
								P3: 0 <br>
							</div>
						</div>
					@elseif($parcial == 'q2')
						<br>
						Seccion 2 <br>
						<div class="reporteAsistenciaAnual__flex">
							<div>
								P1: 0 <br>
								P2: 0 <br>
								P3: 0 <br>
							</div>
						</div>
					@elseif($parcial == 'anual')
						<div class="reporteAsistenciaAnual__seccionAnual">
							<div class="reporteAsistenciaAnual__seccionAnual-quimestre">
								<div class="bold">
									1
								</div>
								<div>
									P1: 0 <br>
									P2: 0 <br>
0							</div>
							</div>
							<div>
								<div class="bold">
									2
								</div>
								<div>
									P1: 0 <br>
									P2: 0 <br>
								</div>
							</div>
						</div>
					@else 
						0
					@endif
				</td>
				<td class="text-center">
					@if($parcial == 'q1')
						<br> 
						1 <br>
						<div class="reporteAsistenciaAnual__flex">
							<div>
								P1: 0 <br>
								P2: 0 <br>
0							</div>
						</div>
					@elseif($parcial == 'q2')
						<br>
						2 <br>
						<div class="reporteAsistenciaAnual__flex">
							<div>
								P1: 0<br>
								P2: 0 <br>
							</div>
						</div>
					@elseif($parcial == 'anual')
						<div class="reporteAsistenciaAnual__seccionAnual">
							<div class="reporteAsistenciaAnual__seccionAnual-quimestre">
								<div class="bold">
									1
								</div>
								<div>
									P1: 0 <br>
									P2: 0 <br>
								</div>
							</div>
							<div>
								<div class="bold">
									2
								</div>
								<div>
									P1: 0 <br>
									P2: 0<br>
								</div>
							</div>
						</div>
					@else 
						0
					@endif
				</td>
			</tr>
		@endforeach
	</table>
</body>
</html>