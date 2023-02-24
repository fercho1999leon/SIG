<div class="col-xs-12">
		<div class="agendaEscolar__materiasFechas-grid">
			@forelse($hours as $hour)
				@php
					if ($editar == 'agenda_Docente_editHora') {
						$parametros = [$hour->id, 'fecha='.request('fecha')];
					} else {
						$parametros = ['id' => $hour->id, 'idCurso' => $course->id,'fecha='.request('fecha')];
					}
				@endphp
				@foreach($matters->where('id', $hour->idMateria) as $matter)
					<div class="agendaEscolar__materiasFechas-item">
						<h2 class="agendaEscolar__materiasFechas-materia">
							{{ $matter->nombre }} - {{ $matter->curso->grado }} {{ $matter->curso->especializacion }}
						</h2>
						<div class="agendaEscolar__materiasFechas-fecha d-ib mr-05">
							{{ $hour->fecha}} - {{substr($hour->created_at, 11,5)}} - {{ $hour->nombre }}
						</div>
						<div class="flex justify-between align-content-center"  style="border-left: 2px solid #3c3c3c;">
							<div class="flex align-content-center">
								<a class="mr-2" href="{{ route($editar, $parametros) }}">
									<i class="fa fa-pencil icon__editar"></i>
								</a>
								@if ($hour->adjuntos != null)
									<a class="mr-2" href="{{Storage::url("adjuntos/$hour->adjuntos")}}" download="">
										<img src="{{secure_asset('img/file-download.svg')}}" width="14">
									</a>
								@endif
							</div>
							<div class="agendaEscolar__materiasFechas__subopciones">
								<form action="{{route($eliminar,  [$hour->id, 'fecha='.request('fecha')])}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar?')">
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="icon__eliminar-btn">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</div>
						</div>
					</div>
				@endforeach
			@empty
				<h2 style="grid-column:1/4" class="mt-6 text-center">No hay actividades creadas.</h2>
			@endforelse  
		</div>  
	</div>