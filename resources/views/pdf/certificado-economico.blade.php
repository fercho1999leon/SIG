<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado Matricula</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<style>
h3 {
	line-height: 2;
	font-size: 12pt;
}
 p {
	 font-size: 12pt;
 }
</style>
<body>
	<main>
		<div class="container">
			<table class="table">
				<tr>
					<th style="vertical-align:top;" class="no-border" width="20%">
					</th>
					<th class="no-border" width="60%">
						<div class="header__info text-center">
							<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" @endif width="90" alt="" >
							<h3>{{ $institution->nombre }}</h3>
							<h3 class="up">Certificado Económico</h3>
							<h3 class="up">AÑO LECTIVO {{App\Institution::periodoLectivo()}} </h3>
						</div>
					</th>
					<th class="no-border" width="20%">
					</th>
				</tr>
			</table>
			<br>
			<div class="row">
				<div class="col-xs-12 certificado__descripcion">
					<p style="line-height: 2.3; font-size: 16pt !important;" class="text-center">CERTIFICO:</p>
					<p style="line-height: 2.3;">
						Que {{$student->sexo == 'Masculino' ? 'el' : 'la'}} estudiante <strong>{{$student->apellidos}} {{$student->nombres}},</strong> matriculado con fecha 
							@if ($student->fecha_matriculacion != null)
								{{$student->fecha_matriculacion->format('d/m/Y')}}, en 
							@else
								{!!'<strong></strong>'!!}, en 
							@endif
							<span class="uppercase">{{$student->course->grado}} {{$student->course->especializacion}}, Paralelo: {{$student->course->paralelo}}, JORNADA: {{ $institution->jornada }}</span> de este Plantel, a la fecha {!!$pagosPendientes->isNotEmpty() ? '<strong>Si</strong>' : '<strong>No</strong>'!!} registra valores pendientes de pago. <br>
						@if ($pagosPendientes->isNotEmpty())
							<strong>Por un monto de: US$ {{$totalPagoPendiente}}</strong> 
						@endif
					</p>
					<p style="line-height: 2.3;">El portador puede hacer uso de este documento según sus intereses.</p>
					<p style="line-height: 2.3;">{{$institution->ciudad}}, {{$fecha}}</p>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-xs-6 p-0 text-center ">
					<hr class="certificado__hr">
					<p class="uppercase">
						<br> Colectora
					</p> 
				</div>
				<div class="col-xs-6 p-0 text-center" style="visibility: hidden">
					<hr class="certificado__hr">
					<p class="uppercase">
					{{ $institution->representante2 }} <br> secretaria general
					</p> 
				</div>
			</div>
		</div>
	</main>
</body>

</html>