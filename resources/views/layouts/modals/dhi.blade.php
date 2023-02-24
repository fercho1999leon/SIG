<div class="modal-dialog" role="document">
	<form action="{{route('dhi.store.parcial', [$parcial,$course])}}" method="POST">
		{{ csrf_field() }}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel" class="uppercase">Curso {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}</h4>
			</div>
			<div class="modal-body">
				<label class="flex">{{$habilidad}}</label>
				<select name="habilidad" class="form-control mb-4">
					<option value="">Seleccione una opción...</option>
					<option {{$subject[$parcial] == 'POSITIVA' ? 'selected' : ''}} value="POSITIVA">POSITIVA</option>
					<option {{$subject[$parcial] == 'MEDIA' ? 'selected' : ''}} value="MEDIA">MEDIA</option>
					<option {{$subject[$parcial] == 'CRITICA' ? 'selected' : ''}} value="CRITICA">CRÍTICA</option>
				</select>
				<label for="">Observación...</label>
				<textarea class="form-control" name="observacion" id="" cols="30" rows="5">{{$subject->observacion}}</textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	</form>
</div>

