<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="float: left">
				<img width="50" src=" {{secure_asset('img/escudo-ecuador.png')}} " alt="">
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				@if( $informe=='Anual_Cualitativo' )
					<h1>{{ $institution->nombre }}</h1>
					<h3 class="uppercase h2">REPORTE ANUAL DE APRENDIZAJE {{$institution->periodoLectivo}} </h3>
					<h3 class="uppercase h2">{{ $course->grado }} - {{ $course->paralelo }}</h3>
					<p><small class="bold uppercase">{{$institution->ciudad}} - Ecuador</small></p>
				@else
					<h1>REPÚBLICA DEL ECUADOR<br>MINISTERIO DE EDUCACIÓN</h1>
					<h1 class="uppercase">INFORME CUALITATIVO FINAL DE EDUCACIÓN 
						@if( $course->grado=='Primero')
							GENERAL BÁSICA
							<br>
							Nivel Preparatoria: Primer Grado
						@else
							INICIAL
							<br>
							SUBNIVEL
							{{ $course->grado }} {{ $course->paralelo }}
						@endif
					</h1>	
				@endif
			</div>
		</th>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="float:right">
				<img width="250" src=" {{secure_asset('img/todaunavida.png')}} " alt="">
			</div>
		</th>
	</tr>
</table>