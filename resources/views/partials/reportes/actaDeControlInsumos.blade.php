	<table class="table">
		<tr>
			<th style="vertical-align:top;" class="no-border" width="20%">
				<div class="header__logo" style="text-align:left">
					<img 
						@if(DB::table('institution')->where('id', '1')->first()->logo == null)
							src="{{ secure_asset('img/logo/logo.png') }}"
						@else
							src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"
						@endif 
					alt="" width="70">
				</div>
			</th>
			<th class="no-border" width="60%">
				<div class="header__info text-center">
					<h3>{{ $institution->nombre }}</h3>
					<h3 class="up">acta de control de insumos ({{App\Institution::periodoLectivo()}})</h3>
				</div>
			</th>
			<th class="no-border" width="20%">
			</th>
		</tr>
	</table>
	<table class="table uppercase">
		<tr>
			<td width="50%" class="no-border">Asignatura: {{$materia->nombre}}</td>
			<td width="50%" class="no-border">Grado: {{$materia->curso->grado}} {{$materia->curso->especializacion}} {{$materia->curso->paralelo}}</td>
		</tr>
		<tr>
			<td width="50%" class="no-border">Profesor: {{($materia->user != null ? $materia->user->profile->apellidos." ".$materia->user->profile->nombres : "")}}</td>
			<td width="50%" class="no-border">Quimestre: {{$quimestre}}</td>
		</tr>
		<tr>
			<td class="no-border">Parcial: {{$parcial}}</td>
		</tr>
	</table>
	<table class="table whitespace-no">
		@php
			$insumos = $insumos->where('idMateria', $materia->id);
		@endphp
		<tr>
			<td colspan="2" class="text-center">TODAS LAS ACTIVIDADES SOBRE 10 PUNTOS</td>
			@foreach ($insumos as $insumo)
				@php
					$activiti = $activities->where('idInsumo', $insumo->id)
				@endphp
				<td colspan="{{count($activiti)}}" class="text-center">{{$insumo->nombre}}</td>
			@endforeach
		</tr>
		<tr height="50">
			<td width="1" class="text-center">#</td>
			<td width="5" class="text-center">ESTUDIANTE</td>
			@foreach ($insumos as $insumo)
				@php
				$activiti = $activities->where('idInsumo', $insumo->id)
				@endphp
				@foreach ($activiti as $activitie)
					<td class="text-center">{{$activitie->nombre}}</td>
				@endforeach
			@endforeach
		</tr>
		@foreach ($students->slice($valorInicial-$valor)->take($valor) as $student)
			<tr>
				<td width="1" class="text-center">{{$count++}}</td>
				<td>{{$student->apellidos}} {{$student->nombres}}</td>
				@foreach ($insumos as $insumo)
					@php
					$activiti = $activities->where('idInsumo', $insumo->id)
					@endphp
					@foreach ($activiti as $activitie)
						@php
							$nota = App\Calificacion::where('idActividad', $activitie->id)->where('idEstudiante', $student->id)->first();
						@endphp
						<td class="text-center">{{$nota == null ? "" : $nota->nota}}</td>
					@endforeach
				@endforeach
			</tr>
		@endforeach
	</table>
	<br>
	<br>
	<table class="table">
		<tr>
			<td width="100" class="no-border">
				FIRMA DEL PROFESOR
			</td>
			<td width="200" class="no-border" style="border-bottom:1px solid black !important;">
			</td>
			<td class="no-border"></td>
			<td width="150" class="no-border text-right">
				FIRMA DE LA VICERRECTORA
			</td>
			<td width="200" class="no-border" style="border-bottom:1px solid black !important;">
			</td>
		</tr>
	</table>
	<div style="page-break-after:always;"></div>
