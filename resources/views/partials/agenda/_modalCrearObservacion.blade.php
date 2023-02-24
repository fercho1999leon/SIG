<div class="modal fade" id="crearObservacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Crear Observación</h4>
			</div>
			<form action="{{route($route, [$classDay, 'fecha='.request('fecha')])}}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="mb-1">
						<select class="form-control" name="estudiante">
							@foreach ($students as $student)
								<option value="{{$student->id}}">{{$student->apellidos}} {{$student->nombres}}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-6">
						<label for="">Adjunto</label>
						<input type="file" name="adjunto" id="">
					</div>
					<textarea placeholder="Escriba una observación del estudiante..." name="estudiante_observacion" class="form-control" rows="4"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>