<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="10%">
		</th>
		<th class="no-border" width="80%">
			<div class="header__info text-center">
				<img width="75" src=" {{secure_asset('img/logo-ministerio.png')}} " alt="">
				<h1>{{ $institution->nombre }}</h1>
				<h3 class="up">Certificado pase de año</h3>
				<h3 class="up">Año Lectivo: {{$institution->periodoLectivo}} </h3>
			</div>
		</th>
		<th style="vertical-align:top;" class="no-border" width="10%">
		</th>
	</tr>
</table>