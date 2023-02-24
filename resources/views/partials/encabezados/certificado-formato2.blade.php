<table class="table m-0">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="50%">
			<div class="header__logo" style="float:left">
				<img src="{{ secure_asset('img/top1.jpg') }}" alt="" width="200">
			</div>
		</th>
		<th style="vertical-align:top;" class="no-border" width="50%">
			<div class="header__logo" style="float:right">
				<img width="250" src=" {{secure_asset('img/top2.jpg')}} " alt="">
			</div>
		</th>
	</tr>
</table>
<table class="table">
	@php
		if ( $institution->cargo1 == 'Rector' || $institution->cargo1 == 'RECTOR' || $institution->cargo1 == 'DIRECTOR' || $institution->cargo1 == 'Director'){
			$articulo = 'El ';
		}else {
			$articulo = 'La ';
		}
	@endphp
	<tr>
		<th class="no-border">
			<div>
                <p> <span class="bold uppercase">CODIGO AMIE</span> : {{$institution->codigoAmie}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="bold uppercase">Año Lectivo</span> : {{App\Institution::periodoLectivo()}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="bold uppercase">REGIMEN</span> : {{ App\periodoLectivo::where('id', Sentinel::getUser()->idPeriodoLectivo)->first()->regimen }} </p><br>
                <p class="text-center" style="font-size: 20px; line-height: 2.5">  <span class="bold uppercase"> Certificado de promoción </span></p>
				<p class="text-left"> {{$articulo}} {{ $institution->cargo1 }}  de la institución educativa:</p>
                <p class="text-center" style="font-size: 20px; line-height: 1.5"> <span class="bold uppercase"> {{ $institution->nombre }} </span></p>
			</div>
		</th>
	</tr>
</table>