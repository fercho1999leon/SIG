{{ csrf_field() }}
<div class="comportamiento__estudiante-grid">
	<div class="comportamiento__estudiante">
		<h3 class="text-center uppercase">Estudiante</h3>
		<div class="comportamiento__estudiante__form">
			<div>
				<label for="">Calificación</label>
				<select name="nota" class="form-control">
					@foreach ($comportamientoNotas as $comportamiento)
						<option value="{{$comportamiento}}" @if($comportamientoEstudiante != null && $comportamientoEstudiante->parcial == $parcial) {{$comportamientoEstudiante->nota == $comportamiento ? 'selected' : ''}} @endif> {{$comportamiento}} </option>
					@endforeach
				</select>
			</div>
			<div>
				<label for="">Observación o Recomendación</label>
				<textarea  name="observacion" rows="5" class="form-control">@if($comportamientoEstudiante != null && $comportamientoEstudiante->parcial == $parcial){{$comportamientoEstudiante->observacion ?? old('observacion')}}@endif</textarea>
			</div>
		</div>
	</div>
</div>
<div class="text-center mt-1">
	<button class="btn btn-lg btn-primary" type="submit">ACTUALIZAR</button>
</div>