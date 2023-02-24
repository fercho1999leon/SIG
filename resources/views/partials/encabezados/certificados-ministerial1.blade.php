<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="10%">
			<div class="header__logo" style="float: left">
				<img width="50" src=" {{secure_asset('img/escudo-ecuador.png')}} " alt="">
			</div>
		</th>
		<th class="no-border" width="80%">
			<div class="header__info text-center">
				<h4 class="m-0 up">Coordinación Zonal {{$institution->coordinacionZonal}}</h4>
				<h4 class="m-0 up">Distrito Educativo {{$institution->distrito}} </h4>
				<h4 class="m-0 h1">{{ $institution->nombre }}</h4>
				<h4 class="m-0 up">
					{{ $reportName }}
				</h4>
				<h4 class="m-0">Año Lectivo: {{$institution->periodoLectivo}} </h4>
				<h4 class="m-0">Jornada: {{$institution->jornada}} </h4>
			</div>
		</th>
		<th style="vertical-align:top;" class="no-border" width="10%">
			<div class="header__logo" style="float:right">
				<img width="75" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
			</div>
		</th>
	</tr>
</table>