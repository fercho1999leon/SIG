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
				<h3>
					@if($course->grado=='Segundo') 
						Segundo Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Tercero') 
						Tercer Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Cuarto') 
						Cuarto Grado de Educacion General Elemental
					@endif
					@if($course->grado=='Quinto') 
						Quinto Grado de Educacion General Media
					@endif
					@if($course->grado=='Sexto') 
						Sexto Grado de Educacion General Media
					@endif
					@if($course->grado=='Septimo') 
						Septimo Grado de Educacion General Media
					@endif
					@if($course->grado=='Octavo') 
						Octavo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Noveno') 
						Noveno Grado de Educacion General Superior
					@endif
					@if($course->grado=='Decimo') 
						Decimo Grado de Educacion General Superior
					@endif
					@if($course->grado=='Primero de Bachillerato')
						Primer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Segundo de Bachillerato')
						Segundo Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					@if($course->grado=='Tercero de Bachillerato')
						Tercer Año de Bachillerato General Unificado {{ $course->especializacion }}
					@endif
					{{ $course->paralelo }} 
				</h3> 
				<h3 class="up">Año Lectivo: {{$institution->periodoActual->nombre}}  </h3>
			</div>
		</th>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="float:right">
				<img width="250" src=" {{secure_asset('img/todaunavida.png')}} " alt="">
			</div>
		</th>
	</tr>
</table>