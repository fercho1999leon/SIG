<table class="table">
	<tr>
		<th style="vertical-align:top;" class="no-border" width="20%">
		</th>
		<th class="no-border" width="60%">
			<div class="header__info text-center">
				<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}" @endif width="90" alt="" >
				<h3>{{ $institution->nombre }}</h3>
				<h3 class="up">AÑO LECTIVO {{$institution->periodoLectivo}} </h3>
				<h3 class="up">
					{{ $reportName }}
				</h3>
			</div>
		</th>
		<th class="no-border" width="20%">
		</th>
	</tr>
</table>