<input type="hidden" name="fecha" value="{{request('fecha')}}">
<div class="p-1 white-bg">
	<table class="s-calificaciones white-bg w100">
		<tr class="table__bgBlue">
			<td class="p-1">ESTUDIANTES</td>
			<td class="text-center">ESTADO</td>
			<td>OBSERVACIÓN</td>
        </tr>
		
		@foreach($students->sortBy('apellidos') as $student)
				<input type="hidden" name="idStudents[]" value="{{$student->id}}">
				<tr style="display:none" class="trEstudiantes">
					<td>{{$student->apellidos}} {{$student->nombres}}</td>
					<td>
						<select name="estado[]" id="" class="form-control" required>
							<option {{$student->estado == 'ASISTIO'? 'selected' : 'selected'}} value="ASISTIO" >Asistio</option>
							<option {{$student->estado == 'NO ASISTIO'? 'selected' : ''}} value="NO ASISTIO">No Asistio</option>
							<option {{$student->estado == 'ATRASADO' ? 'selected' : ''}} value="ATRASADO" >Atrasado</option>
						</select>
					</td>
					<td>
						<textarea name="observacion[]" cols="30" rows="2" class="form-control">{{$student->observacion ?? ''}}</textarea>
					</td>
				</tr>
			
			<input type="hidden" name="asistenciaId[]" value="{{$student->asistenciaId}}">
		@endforeach
	</table>
	<div class="text-center mt-1">
		@if (request('schedule'))
			<input id="btn-submit" type="submit" value="{{$asistencia->isEmpty() ? 'Crear Asistencia' : 'Actualizar Asistencia'}}" class="btn btn-lg btn-primary">
		@endif
	</div>
</div>