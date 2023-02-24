<div class="matricula__matriculacion-block">
	<h3 class="matricula__matriculacion-title">DATOS</h3>
	<div>
		<div class="matricula__matriculacion__input">
			<label class="matricula__matriculacion-label">Nombres Completos</label>
			<input name="nombres" type="text" class="form-control" value="{{old('nombres',$user->nombres)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label class="matricula__matriculacion-label">Telefono Domicilio</label>
			<input name="telefono_domicilio" type="text" class="form-control" value="{{old('telefono_domicilio',$user->telefono_domicilio)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label class="matricula__matriculacion-label">Telefono Celular</label>
			<input name="telefono_celular" type="text" class="form-control" value="{{old('telefono_celular',$user->telefono_celular)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label class="matricula__matriculacion-label">Dirección</label>
			<input name="direccion" type="text" class="form-control" value="{{old('direccion',$user->direccion)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label class="matricula__matriculacion-label">Ciudad</label>
			<input name="ciudad" type="text" class="form-control" value="{{old('ciudad',$user->ciudad)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label class="matricula__matriculacion-label">Seleccione uno o varios estudiantes</label>
			<select class="form-control estudiantes" name="students[]" multiple="multiple">
				@foreach ($students as $student)
					<option
					@foreach ($user->estudiantesAutorizados->pluck('id') as $id)
						{{$id === $student->idStudent ? 'selected' : ''}}
					@endforeach
					 value="{{$student->idStudent}}">{{$student->apellidos}} {{$student->nombres}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>