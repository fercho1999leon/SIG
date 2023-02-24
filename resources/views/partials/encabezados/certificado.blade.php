<table class="table m-0">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="50%">
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
		<th style="vertical-align:top;" class="no-border" width="50%">
			<div class="header__logo" style="float:right">
				<img width="250" src=" {{secure_asset('img/todaunavida.png')}} " alt="">
			</div>
		</th>
	</tr>
</table>
<table class="table">
	<tr>
		<th class="no-border">
			<div class="header__certificadoPromocion">
				<p>Coordinación Zonal {{$institution->coordinacionZonal}}</p>
				<p>Distrito Educativo {{$institution->distrito}} {{$institution->parroquia}} </p>
				<p>{{ $institution->nombre }}</p>
				<p>
					Certificado de {{$reportName}}
				</p>
				<p>Año Lectivo: {{App\Institution::periodoLectivo()}} </p>
				<p>Jornada: {{$institution->jornada}} </p>
			</div>
		</th>
	</tr>
</table>