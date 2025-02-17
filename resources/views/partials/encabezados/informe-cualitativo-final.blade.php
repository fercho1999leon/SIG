<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="float: left">
				<img 
					@if(DB::table('institution')->where('id', '1')->first()->logo == null)                    
						src="{{ secure_asset('img/logo/logo.png') }}"
					@else   
						src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"  width="70"                                 
					@endif 
				alt="" width="70">
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				@if( $informe=='Anual_Cualitativo' )
					<h1>{{ $institution->nombre }}</h1>
					<h3 class="uppercase h2">REPORTE ANUAL DE APRENDIZAJE {{$periodo}} </h3>
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