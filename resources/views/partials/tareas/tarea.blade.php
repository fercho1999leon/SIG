<div class="col-xs-12">
	<div class="panel panel-default">
		<div class="pined-table-responsive">
			<table id="{{$idTable}}" class="s-calificaciones-tareas s-calificaciones--trGris w100 tableNotificaciones" style="width:100%">

				<thead>

					<tr>@if ($MostrarMensaje == true)
						<td colspan="6" style="color: red"><h3>MENSAJE: SOLO SE PUEDE ADJUNTAR 1 ARCHIVO HASTA 5 MB POR CADA TAREA</h3></td>
						@endif
					</tr>

					<tr class="table__bgBlue">
						<td></td>
						<td width="180">Materia</td>
						<td>Actividad</td>
						<td>Finaliza(AAAA-MM-DD)</td>
						<td>Adjunto</td>
						@if ($subirTareas == true)
							<td>Subir Tarea</td>
						@endif
					</tr>
				</thead>
				@foreach ($activities as $tarea)
                    @php
						$deber = $deberes->where('idActividad', $tarea->id)
							->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)
							->first();
					@endphp
					<tr>
						<td>
							<a class="detalleActividad" href="{{route($route, [$tarea->id, $tarea->materiaId, $tarea->insumoId])}}" style="display:inline-block;width:20px;">
								<img src="{{secure_asset('img/circleMore.svg')}}">
							</a>
						</td>
						<td class="uppercase bold">
							{{ $tarea->materia }}</span>
						</td>
						<td>
							{{ $tarea->insumo }} -
							{{ $tarea->actividad }}
						</td>
						<td>
							{{$tarea->fechaEntrega}}
						</td>
						<td>
							@if($deber != null)
							@php
							$datos_Actividad = App\Activity::findOrFail($tarea->id);
							$carpeta = 'public/deberes_adjuntos/curso_'.$course->id.'/'.substr($tarea->materia, 0 ,25).'/parcial_'.$datos_Actividad->parcial.'/Insumo_'.$tarea->insumoId.'/'.substr($datos_Actividad->nombre, 0 ,25);
							@endphp
								<a href="{{Storage::url("$carpeta/$deber->adjunto")}}" download>
									{{ substr($deber->adjunto,0,25) }}{{strlen($deber->adjunto) > 25 ? '...' : ''}}
								</a>
							@endif
						</td>
						@if ($subirTareas == true)
							<input type="hidden" name="idProfesor[{{ $tarea->id}}]" value="{{ $tarea->idDocente}}">
							<td>
								<div class="estudiante__subirTarea">
									@if($deber != null)
										@if ($tarea->fechaEntrega >= $today)
											@if ($deber->enviado == 0)
												<input id="input-b2" type="file" class="file" data-show-preview="false" name="tareas_adjuntos[{{ $tarea->id}}]">
											@endif
										@else
											@if ($deber->bloqueo == 0)
												<input id="input-b2" type="file" class="file" data-show-preview="false" name="tareas_adjuntos[{{ $tarea->id}}]">
											@endif
										@endif
									@endif
								</div>
							</td>
						@endif
						<input id="activityID" type="hidden" name="activityID" value="{{$tarea->id}}">
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>