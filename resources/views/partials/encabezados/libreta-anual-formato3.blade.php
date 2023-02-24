<table class="table" style="line-height:10px;">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="5%">
			<div class="header__logo" style="float: left">
				<img
					@if(DB::table('institution')->where('id', '1')->first()->logo == null)
						src="{{ secure_asset('img/logo/logo.png') }}"
					@else
						src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"  width="40"
					@endif
				alt="" width="70">
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-left">
				@if( $informe=='Anual_Cualitativo' )
					<h1>{{ $institution->nombre }}</h1>
					<h3 class="uppercase h2">REPORTE ANUAL DE APRENDIZAJE {{$periodo}} </h3>
					<h3 class="uppercase h2">{{ $course->grado }} - {{ $course->paralelo }}</h3>
					<p><small class="bold uppercase">{{$institution->ciudad}} - Ecuador</small></p>
					</div>
					</th>
					<th style="vertical-align:top;" class="no-border" width="20%">
					<div class="header__logo" style="float:right">
					<img width="250" src=" {{secure_asset('img/todaunavida.png')}} " alt="">
					</div>
					</th>
				@else
				    @php
                        $educacion = \App\Calificacion::nombreCertificados($course);
				    @endphp
					<h3 class="uppercase h2" style="font-size: 10px; important: !;">BOLETÍN DE CALIFICACIONES</h3>
					<h3 class="uppercase h2" style="font-size: 10px; important: !;">{{$tipo}}</h3>
					<h3 class="uppercase h2" style="font-size: 10px; important: !;">{{$educacion}}</h3>
					<h3 class="uppercase h2" style="font-size: 10px; important: !;">{{$nombre}}</h3>
                    <h3 class="uppercase h2" style="font-size: 10px; important: !;">AÑO LECTIVO: {{$periodo}} </h3>
                @endif
            </div>
		</th>
	</tr>
</table>