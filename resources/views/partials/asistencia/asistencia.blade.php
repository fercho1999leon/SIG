<div class="asistenciaDocente">
		<form class="asistenciaDocente__generar" id="frmGenerar">
			<input id="fecha" name="fecha" type="date" class="form-control" value="{{ $fecha }}" required>
			@if($schedules != null && !$errors->any() )
			<select name="schedule" id="schedule" class="form-control" required>
				@foreach ($schedules as $schedule)
					<option value="{{ $schedule->id }}">{{ substr($schedule->horaInicio,0,5) }} - {{ substr($schedule->horaFin,0,5) }}</option>
				@endforeach
			</select>
			@endif
			<button class="btn btn-blue" id="btnGenerar" type="submit">GENERAR</button>
		</form>
		@if($fecha != null && $daySchedule != null && !$errors->any() ) 
		<div class="asistenciaDocente__table">
			<div class="pined-table-responsive p-0">
				<form action="{{ route('postAsistencia') }}" method="POST">
					<input type="hidden" style="visibility:hidden;height:0px;" value="{{ $course->id}}" name="idCurso">
					<input type="hidden" style="visibility:hidden;height:0px;" value="{{ $daySchedule }}" name="idSchedule">
					<input type="hidden" style="visibility:hidden;height:0px;" value="{{ $materia->id }}" name="idMateria">
					<input type="hidden" style="visibility:hidden;height:0px;" value="{{ $fecha }}" name="fecha">
					<input name="_method" type="hidden" value="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="p-1 white-bg">
						<table class="s-calificaciones white-bg w100">
							<tr class="table__bgBlue">
								<td class="p-1">ESTUDIANTES</td>
								<td class="text-center">ESTADO</td>
								<td>OBSERVACIÓN</td>
							</tr>
							@foreach($students as $student)
							<input type="hidden" style="visibility:hidden;height:0px;" value="{{ $student->id }}" name="idEstudiante[]">
							@php
								$asistencia = $asistencias->where('idEstudiante', $student->id)->first();
							@endphp
							@if($asistencia != null)
								<input type="hidden" style="visibility:hidden;" value="{{ $asistencia->id }}" name="idAsistencia[]">
								<tr>
									<td>{{ $student->apellidos }} {{ $student->nombres }}</td>
									<td>
										<select name="estado[]" id="" class="form-control">
											<option value="ASISTIO" {{ $asistencia->estado == 'ASISTIO' ? 'selected' : '' }}>Asistio</option>
											<option value="NO ASISTIO" {{ $asistencia->estado == 'NO ASISTIO' ? 'selected' : '' }}>No Asistio</option>
											<option value="ATRASADO" {{ $asistencia->estado == 'ATRASADO' ? 'selected' : '' }}>Atrasado</option>
										</select>
									</td>
									<td>
										<textarea name="observacion[]" cols="30" rows="2" class="form-control">{{ $asistencia->observacion }}</textarea>
									</td>
								</tr>
							@else
								<input type="text" style="visibility:hidden;" value="" name="idAsistencia[]">
								<tr>
								<td>{{ $student->apellidos }} {{ $student->nombres }}</td>
									<td>
										<select name="estado[]" id="" class="form-control">
											<option value="ASISTIO">Asistio</option>
											<option value="NO ASISTIO">No Asistio</option>
											<option value="ATRASADO">Atrasado</option>
										</select>
									</td>
									<td>
										<textarea name="observacion[]" cols="30" rows="2" class="form-control"></textarea>
									</td>
								</tr>
							@endif
							@endforeach
						</table>
						<div class="text-center mt-1">
							<input type="submit" value="Guardar" class="btn btn-lg btn-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
		@endif
	</div>
	
	@section('scripts')
		<script>
			$('#frmGenerar').submit( function(e) {
				e.preventDefault()
				route = "{{ route('asistencia-materia',[ 'idMateria' => $materia->id, 'idCurso' => $course->id]) }}";
				route+= "?fecha="+ $('#fecha').val();
				if( $('#schedule').val() != null)
					route+= "&schedule="+  $('#schedule').val()
				window.location.href = route;
			})
		</script>
	@endsection