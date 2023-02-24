@foreach ($classDay->observacionEstudiantes as $observacion)
	<div class="modal fade" id="crearObservacion{{$observacion->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edición Observación</h4>
				</div>
				<form action="{{route($routeUpdate, [$observacion, 'fecha='.request('fecha')])}}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{method_field('PUT')}}
					<div class="modal-body">
						<div class="mb-1">
							<select class="form-control" name="estudiante" disabled>
								<option value="">{{$observacion->student->apellidos}} {{$observacion->student->nombres}}</option>
							</select>
						</div>
						<div class="mb-6">
							<label for="">Adjunto</label>
							<input type="file" name="adjunto" id="">
							@if ($observacion->adjunto != null)
								<a class="mt-6 btn btn-primary" download="" href="{{Storage::url("adjuntos/$observacion->adjunto")}}">{{$observacion->adjunto}}</a>
							@endif
						</div>
						<textarea placeholder="Escriba una observación del estudiante..." name="estudiante_observacion" class="form-control" rows="4">{{$observacion->observacion}}</textarea>
					</div>
					<input type="hidden" name="idStudent" value="{{$observacion->idEstudiante}}">
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endforeach