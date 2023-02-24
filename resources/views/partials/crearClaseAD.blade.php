<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="pined-table-responsive">
			<form method="post" action="{{ route('agenda_MisClases_Store', $matter->id) }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<!--Modal(Desactivado)-->
			<div class="agendaEscolar__crearTarea-grid">
				<div>
					<h3>{{ $matter->nombre }}  -  
						@foreach( $courses as $course)
							@if($matter->idCurso==$course->id)
								{{ $course->grado }}  {{ $course->paralelo }}
							@endif
						@endforeach
					</h3>
				</div>
				<div class="agendaEscolar__crearTarea-materia-parcial">
					<input type="hidden" name="parcial" value="{{ $parcial }}">
					<input type="date" class="form-control" name="fecha" id="fecha" step="1">					
				</div>
				<input type="text" class="form-control" placeholder="Nombre.." name="nombre">
				<textarea class="form-control" rows="6" placeholder="Descripción de los detalles de la clase" name="descripcion"></textarea>
				<textarea class="form-control" rows="2" placeholder="Observaciones" name="observacion"></textarea>
				<!-- <input id="input-b3" name="input-b3[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..."> -->
			</div>
			<div class="col-lg-12 text-center" style="margin-top: 10px">
				<input type="reset" class="btn btn-danger btn-lg" value="Cancelar">
				<button type="submit" class="btn btn-primary btn-lg">GUARDAR</button>
			</div>
			</form>
		</div>
	</div>
</div>