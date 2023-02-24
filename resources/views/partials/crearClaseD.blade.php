<!--Modal(Desactivado)-->
<div class="agendaEscolar__crearTarea-grid">
	<div>
		<h3>
			{{ $matter->nombre }}  -  
			@foreach( $courses as $course)
				@if($matter->idCurso==$course->id)
					{{ $course->grado }}  {{ $course->paralelo }}  {{ $course->especializacion }}
				@endif
			@endforeach
		</h3>
	</div>
	<div class="agendaEscolar__crearTarea-materia-parcial">
		<input type="date" class="form-control" name="fecha" id="fecha" step="1" value="{{request('fecha')}}">					
	</div>
	<input type="text" class="form-control" placeholder="Nombre.." name="nombre">
	<textarea class="form-control" rows="6" placeholder="Descripción de los detalles de la clase" name="descripcion"></textarea>
	<input type="text" class="form-control" placeholder="Link video.." name="linkVideo">
	<textarea class="form-control" rows="2" placeholder="Observaciones" name="observacion"></textarea>
	<div>
		<span class="nuevoMensaje__adjuntos-aviso">(Solo se puede adjuntar 1 archivo hasta 5 Mb)</span>
		<input type="file" name="adjunto">
	</div>
</div>
<div class="col-lg-12 text-center" style="margin-top: 10px">
	<input type="reset" class="btn btn-danger btn-lg" value="Cancelar">
	<button type="submit" class="btn btn-primary btn-lg uppercase">GUARDAR</button>
</div>
