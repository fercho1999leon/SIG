<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="float: left">
				<img width="50" src=" {{secure_asset('img/escudo-ecuador.png')}} " alt="">
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				<h1>{{ $institution->nombre }}</h1>
				{{-- <h3>QUIMESTRE {{ $quimestre }} - PARCIAL {{ $n_parcial }}</h3> --}}
				<h3 class="up">Año Lectivo: {{$institution->periodoLectivo}} </h3>
				<h3 class="up">
					{{ $reportName }}
				</h3>
			</div>
		</th>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="float:right">
				<img width="75" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
			</div>
		</th>
	</tr>
</table>