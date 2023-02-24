<div class="agendaEscolar__crearTarea-grid">
	<div>
		<h3>{{ $matter->nombre }}  -
			@foreach( $courses as $course)
				@if($matter->idCurso==$course->id)
					{{ $course->grado }} {{ $course->paralelo }} {{ $course->especializacion }}
				@endif
			@endforeach
		</h3>
	</div>
	<div class="agendaEscolar__crearTarea-materia-parcial">
		<input type="text" class="form-control" readonly='readonly' value="FECHA DE CREACIÓN: {{ $classDay->created_at}}">
		<input type="date" class="form-control" name="fecha" id="fecha" step="1" value="{{request('fecha')}}">
	</div>
	<input type="text" class="form-control" placeholder="Nombre.." name="nombre" value="{{old('nombre', $classDay->nombre ?? '')}}">
	<textarea class="form-control" rows="6" placeholder="Descripción de los detalles de la clase" name="descripcion">{{old('descripcion', $classDay->descripcion ?? '')}}</textarea>
	<input type="text" class="form-control" placeholder="Link video..." name="linkVideo" value="{{old('linkVideo', $classDay->linkVideo ?? '')}}">
	<textarea class="form-control" rows="2" placeholder="Observaciones" name="observacion">{{old('observacion', $classDay->observacion ?? '')}}</textarea>
	<div>
		@if ($btn == 'Actualizar')
			@if ($classDay->adjuntos != null)
				<div>
					<a download href="{{Storage::url("adjuntos/$classDay->adjuntos")}}" class="btn btn-primary">{{$classDay->adjuntos}}</a>
				</div>
			@endif
		@endif
		<span class="nuevoMensaje__adjuntos-aviso">(Solo se puede adjuntar 1 archivo hasta 5 Mb)</span>
		<input type="file" name="adjunto">
	</div>
</div>
<div class="col-lg-12 text-center" style="margin-top: 10px">
	<input type="reset" class="btn btn-danger btn-lg" value="Cancelar">
	<button type="submit" class="btn btn-primary btn-lg">{{$btn}}</button>
</div>