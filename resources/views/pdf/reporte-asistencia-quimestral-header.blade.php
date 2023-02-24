<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>header</title>
</head>
<style>
	.table td,
	.table th {
		font-size: 6pt !important;
	}
</style>
<body>
	<table class="table">
		<tr>
			<h1>header etc</h1>
			{{-- <th style="vertical-align:top;" class="no-border" width="20%">
				<div class="header__logo" style="text-align:left">
					<img 
						@if(DB::table('institution')->where('id', '1')->first()->logo == null)
							src="{{ secure_asset('img/logo/logo.png') }}"
						@else
							src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
						@endif 
					alt="" width="70">
				</div>
			</th>
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
					<h3 class="up">
							{{$nombreReporte}}
					</h3>
					<h3 class="up">Año Lectivo: {{$institution->periodoActual->nombre}} </h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th> --}}
		</tr>
	</table>
</body>
</html>