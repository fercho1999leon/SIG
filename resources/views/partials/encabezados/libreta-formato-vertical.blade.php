<table class="table m-0">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="20%">
			<div class="header__logo" style="text-align:left">
				<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" @endif width="70" alt="" >
			</div>
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				<h3>{{ $institution->nombre }}</h3>
				<h3 class="up">Año Lectivo: {{$periodo}} </h3>
				<h3 class="up">
					@if ($seccion == 'EI')
						@if ($n_parcial != '')
							QUIMESTRE {{$quimestre}} - PARCIAL {{$n_parcial}}
						@else
							Quimestre {{$quimestre}}
						@endif
					@else
						@if ($n_parcial != '')
							QUIMESTRE {{$nQuimestre}} - PARCIAL {{$n_parcial}}
						@else
							@if($quimestre=='1')
								Libreta de calificaciones del Primer Quimestre
							@else
								Libreta de calificaciones del Segundo Quimestre
							@endif
						@endif
					@endif
				</h3>
				<h3 class="up">
					{{ $reportName }}
				</h3>
			</div>
		</th>
		<th class="no-border" width="20%">
		</th>
	</tr>
</table>