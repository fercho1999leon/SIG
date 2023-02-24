<div class="mb-6">
		<label for="" class="text-base">Fecha</label>
		<input name="fecha" type="date" class="form-control" value="{{old('fecha', $docente->fecha)}}">
	</div>
	<div class="sm:flex">
		<div class="mb-6 w100 sm:mr-6">
			<label for="" class="text-base">Hora de inicio</label>
			<input name="hora_inicio" type="time" class="form-control" value="{{old('hora_inicio',$docente->hora_inicio)}}">
		</div>
		<div class="mb-6 w100">
			<label for="" class="text-base">Hora fin</label>
			<input name="hora_fin" type="time" class="form-control" value="{{old('hora_fin', $docente->hora_fin)}}">
		</div>
	</div>
	<div class="sm:flex">
		<div class="mb-6 w100 sm:mr-6">
			<label for="" class="text-base">Asignatura</label>
			<select id="asignaturas" name="asignatura" id="" class="form-control">
				<option data-grado="" value="">Seleccione una materia...</option>
				@foreach ($materias as $materia)
					<option {{$materia->id == $docente->idAsignatura ? 'selected' : ''}} value="{{$materia->id}}" data-grado="{{$materia->curso->grado}} @if($materia->curso->especializacion != null){{$materia->curso->especializacion}}@endif {{$materia->curso->paralelo}}">{{$materia->nombre}}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-6 w100">
			<label for="" class="invisible">-</label>
			<input disabled class="grado form-control" type="text" value="{{$docente->grado}}">
			<input class="grado" type="hidden" name="grado" value="{{$docente->grado}}">
		</div>
	</div>
	<div class="mb-6">
		<label for="" class="text-base">Tema</label>
		<textarea name="tema" id="" cols="30" rows="4" class="form-control">{{old('tema', $docente->tema)}}</textarea>
	</div>
	<div class="mb-6">
		<label for="" class="text-base">Objetivo</label>
		<textarea name="objetivo" id="" cols="30" rows="4" class="form-control">{{old('objetivo', $docente->objetivo)}}</textarea>
	</div>
	<div class="mb-6">
		<label for="" class="text-base">Observaciones</label>
		<textarea name="observaciones" id="editor1" cols="30" rows="10" class="form-control aulica">{{old('observaciones', $docente->observaciones)}}</textarea>
	</div>
	<div class="mb-6">
		<label for="" class="text-base">Recomendaciones</label>
		<textarea name="recomendaciones" id="editor2" cols="30" rows="10" class="form-control aulica">{{old('recomendaciones', $docente->recomendaciones)}}</textarea>
	</div>
	<div class="text-right flex">
		<div class="flex align-items-center ml-auto bg-gray-200 px-4 py-2 rounded-full">
			<label for="guardar" class="pointer mb-0 mr-2">Marque esta casilla si solo desea FINALIZAR el documento</label>
			<input class="" value="true" type="checkbox" name="status" id="guardar" {{$docente->status == 1 ? 'checked' : ''}} >
		</div>
	</div>
	<input type="hidden" name="observacionId" value="{{$docente->observacionId}}">
	<div class="text-right mt-6">
		<button type="submit" class="btn btn-primary" id="submit">GUARDAR</button>
	</div>