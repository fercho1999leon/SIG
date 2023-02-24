<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Certificado Asistencia</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
</head>
<body>
	<main>
	<table class="table" >
	<tr style="display: none">
		<th style="vertical-align:top;" class="no-border" width="30%">
			<div class="header__logo" style="float: left">
				<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" @endif width="150" alt="" >
			</div>
		</th>
		<th class="no-border" width="40%">
			<div class="header__info text-center">
				<h3 style="font-size: 20px !important;">{{ $institution->nombre }}</h3>
			</div>
		</th>
		<th class="no-border" width="30%">
		</th>
	</tr>
</table>
<div style="padding-top: 150px !important;"></div><!--div para darle epacio superior y se puedan usar las hojas menbreteadas-->
			<div class="row" style=" padding: 50px">
				<div class="col-xs-12">
					<p class="text-center" style="font-size: 20px !important;"><strong class="uppercase">CERTIFICADO DE ASISTENCIA:</strong></p>
					<br>
					<p class="text-center" style="font-size: 20px !important;"><span class="uppercase">Año lectivo: {{$periodo}}</span></p>
					<br>
					<p style="font-size: 20px !important; text-align: justify; ">A petición de la parte interesada y por disposición del Rectorado de la <span class="uppercase">{{ $institution->nombre }}</span> Certifico que @if($student->sexo == "Masculino") el alumno @else la alumna @endif:</p>
					<br>
					<p style="font-size: 20px !important;" class="text-center">
						<strong class="uppercase">{{ $student->nombres }} {{ $student->apellidos }}</strong>
					</p>
					<br>
					<p style="font-size: 20px !important;">
						del <span class="uppercase">{{ $educacion}}.</span>
					</p>
					<br>
					<p style="font-size: 20px !important; text-align: justify;">
						Se encuentra @if($student->sexo == "Masculino") matriculado @else matriculada @endif en el presente periodo lectivo y su asistencia a clases es normal. Es todo lo que podemos certificar en honor a la verdad y remitiéndome a los libros que reposan en los archivos del plantel Autorizamos el peticionario dar del presente certificado el uso que sea conveniente.
					</p>
					<br>
					<p class="text-right" style="font-size: 20px !important;">{{ $institution->ciudad }}, {{ $hoy }}</p>
					<br>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase" style="font-size: 17px !important;">
					<strong>{{ $institution->representante1 }} <br> RECTOR</strong>
					</p>
				</div>
				<div class="col-xs-6 p-0 text-center">
					<hr class="certificado__hr">
					<p class="uppercase" style="font-size: 17px !important;" >
					<strong>{{ $institution->representante2 }} <br> secretaria general</strong>
					</p>
				</div>
			</div>
			<br>
			<br>
			<div class="row" style="display: none">
				<div class="col-xs-12">
					<p class="text-center" style="font-size: 17px !important;">
					<strong>	Dirección: {{ $institution->direccion }} Teléfonos: {{ $institution->telefonos }}</strong>
					</p>
				</div>
			</div>
		</div>
	</main>
</body>

</html>