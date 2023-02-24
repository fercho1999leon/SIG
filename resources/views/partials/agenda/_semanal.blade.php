<div class="col-xs-12 mt-2">
	<form method="get" class="">
		<div class="flex justify-between">
			<div class="flex">
				<input type="date" class="form-control" name="fecha" id="" value="{{request('fecha')}}">
				<button class="ml-4 btn btn-primary" type="submit">Buscar</button>
			</div>
			<div>
				@if ($admin == !true)
					<a 
						@if ($perfil === 'estudiante')
							href="{{route('agendaEstudiante', 'fecha='.request('fecha'))}}" 
						@elseif($perfil === 'representante')
							href="{{ route('hijo_agenda', [$hijo->idStudent, 'fecha='.request('fecha')]) }}"
						@endif
						class="btn btn-primary" 
					type="submit">Agenda Diaria</a>
				@endif
			</div>
		</div>
	</form>
</div>
<div class="pt-6 pb-6 mt-6 bg-white rounded">
	<h2 class="text-center mt-0 mb-0">
		Horario de Clases
	</h2>
</div>
<table class="s-calificaciones mt-4 bg-white w-full">
	<tr class="table__bgBlue">
		<td width="5" class="text-center">#</td>
		<td class="text-center">Materia</td>
		<td class="text-center">Actividad</td>
		<td class="text-center">Fecha</td>
		<td colspan="2" class="text-center">Acciones</td>
	</tr>
	@forelse ($hours as $hour)
		@foreach($matters->where('id', $hour->idMateria) as $matter)
			<tr>
				<td class="text-center">{{$i++}}</td>
				<td>{{ $matter->nombre }}</td>
				<td>
					<div class="flex justify-content-between">
						<div>
							{{ $hour->nombre }}
						</div>
						<div class="flex">
							<span class="{{count($hour->observaciones) == 0 ? 'hidden' : 'actividad__numeroDeObservaciones'}} mr-4">
								{{count($hour->observaciones)}}
							</span>
							<span>
								@if ($hour->adjuntos != null)
									<a class="mr-2" href="{{Storage::url("adjuntos/$hour->adjuntos")}}" download="">
										<img src="{{secure_asset('img/file-download.svg')}}" width="14">
									</a>
								@endif
							</span>
						</div>
					</div>
				</td>
				<td width="200" class="text-center">{{ $hour->fecha}} - {{substr($hour->created_at, 11,5)}}</td>
				@if ($admin == true)
					<td width="5" class="text-center">
						<a class="mr-2" 
							@if ($perfil == 'docente')
								href="{{ route('agenda_Docente_editHora', [$hour->id, $course->id,'fecha='.request('fecha'), 'semanal=1']) }}"
							@else
								href="{{ route('editClaseAdministrador',[$hour->id, $course->id,'fecha='.request('fecha'), 'semanal=1']) }}"
							@endif
							>
							<i class="fa fa-pencil icon__editar"></i>
						</a>
					</td>
					<td width="5" class="text-center">
						<form 
							@if ($admin == true && $perfil == '')
								action="{{route('destroyClaseAdministrador', 
								[$hour->id, 'fecha='.request('fecha')])}}" 
							@else
								action="{{route('agenda_Docente_deleteHora', 
								[$hour->id, 'fecha='.request('fecha')])}}" 
							@endif
							method="post" 
							class="icon__eliminar-form form-delete" 
							onclick="return confirm('¿Seguro desea eliminar?')">
							<input name="_method" type="hidden" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="submit" class="icon__eliminar-btn">
								<i class="fa fa-trash"></i>
							</button>
						</form>
					</td>
				@else
					<td colspan="2" width="5" class="text-center">
						<a href="" data-toggle="modal" data-target="#detallesActividad{{$hour->id}}">
							<i class="fa fa-eye a-fa-download__matricula mr-1"></i>
						</a>
					</td>
				@endif
			</tr>
			@include('partials.representante._agendaIndex_modal')
		@endforeach
	@empty
		<tr>
			<td colspan="4" class="text-center">
				<h3 class="">
					No existen actividades en esta semana.
				</h3>
			</td>
		</tr>
	@endforelse
</table>