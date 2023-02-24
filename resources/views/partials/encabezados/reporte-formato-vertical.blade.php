<table class="table">
	<tr>
		<th rowspan="2" style="vertical-align:top !important;" class="no-border" width="10%">
			<div class="header__logo" style="float: left">
				<img width="75" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
			</div>
		</th>
		<th style="height:40px !important" width="80%"></th>
		<th rowspan="2" style="vertical-align:top !important;" class="no-border" width="10%">
			<div class="header__logo" style="float:right">
				<img width="250" src=" {{secure_asset('img/todaunavida.png')}} " alt="">
			</div>
		</th>
	</tr>
	<tr>
		<th class="no-border">
			<div class="header__info text-center">
				<h1>{{ $institution->nombre }}</h1>
				@if ($tipo == 1)
                    <h3 class="up">
                        Acta de calificaciones de recuperación, supletorio, remedial y gracia
                    </h3>
                @endif
				<h3 class="up">Año lectivo: {{$periodo}}  </h3>
				<h3 class="up">
					reporte de promedio
				</h3>
			</div>
		</th>
	</tr>
</table>