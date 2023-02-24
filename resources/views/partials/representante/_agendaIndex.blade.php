<div class="wrapper wrapper-content">
	<form method="GET">
		<div class="text-center">
			<div class="estudiante__agendaEscolar-select">
				<input class="form-control" name="fecha" type="date" value="{{request('fecha')}}">
				<button type="submit" class="btn btn-primary btn-sm estudiante__agendaEscolar--ir pinedTooltip">
					<img alt="logo" src="{{secure_asset('img/search.svg')}}">
					<span class="pinedTooltipH">CARGAR FECHA</span>
				</button>
			</div>
			<div class="text-center">
				@if ($perfil == 'estudiante')
					<a href="{{route('agendaEstudiante.semanal', 'fecha='.request('fecha'))}}" class="pinedTooltip">
						<img src="{{secure_asset('img/calendar-month.svg')}}" width="40" alt="image">
						<span class="pinedTooltipH">CALENDARIO SEMANAL</span>
					</a>
				@else
					<a href="{{route('hijo_agenda.semanal', [$hijo->idStudent, 'fecha='.request('fecha')])}}" class="pinedTooltip">
						<img src="{{secure_asset('img/calendar-month.svg')}}" width="40" alt="">
						<span class="pinedTooltipH">CALENDARIO SEMANAL</span>
					</a>
				@endif
			</div>
		</div>
	</form>
</div>
<div class="wrapper wrapper-content">
	<div class="actividadesEstudiante-grid">
		@forelse($hours as $hour)
			@foreach($matters->where('id', $hour->idMateria) as $matter)
				<div class="actividadesEstudiante pointer" data-toggle="modal" data-target="#detallesActividad{{$hour->id}}">
					<h2 class="text-center mt-0">
						<img src="{{secure_asset('img/CURSO.png')}}" width="12" alt="">
						{{$matter->nombre}}
					</h2>
					<div class="actividadesEstudiante__footer">
						<div class="transporte__unidad__datos">
							<p class="mb-0"> {{$matter->user->profile->apellidos}} {{$matter->user->profile->nombres}} </p>
							<span>Profesor</span>
						</div>
						<div>
							<a href="" style="visibility: hidden;">
								<img src="{{secure_asset('img/file-download.svg')}}" width="15" alt="">
							</a>
							<a href="" ></a>
						</div>
					</div>
				</div>
				@include('partials.representante._agendaIndex_modal')
			@endforeach
		@empty
			<div class="alert alert-success alert-dismissible" style="grid-column:1/5">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<h3>No hay información para mostrar.</h3>
			</div>
		@endforelse
	</div>
</div>
@section('scripts')
	<script>
		var idActividad = "{{request('actividad')}}"
		if (idActividad) {
			$(document).ready(function() {
				var actividad = $('#detallesActividad'+idActividad)
				actividad.modal('show')
			})
		}
	</script>
@endsection
