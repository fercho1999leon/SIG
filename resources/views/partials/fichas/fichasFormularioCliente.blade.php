<div class="panel pl-1 pr-1 matricula__matriculacion">
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DATOS BÁSICOS</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Cédula/Pasaporte</label>
				<input type="text" class="form-control input-sm" name="ci" min="10" maxlength="10" value="{{old('ci', $padre->ci)}}" required>
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nombres</label>
				<input type="text" class="form-control input-sm" minlength="2" maxlength="100" name="nombres" value="{{old('nombres' ,$padre->nombres)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Apellidos</label>
				<input type="text" class="form-control input-sm" minlength="2" maxlength="100" name="apellidos" value="{{old('apellidos', $padre->apellidos)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Sexo</label>
				<select class="form-control input-sm" name="sexo">
					<option {{$padre->sexo == 'Masculino' ? 'selected' : ''}} value="Masculino">Masculino</option>
					<option {{$padre->sexo == 'Femenino' ? 'selected' : ''}} value="Femenino">Femenino</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parentezco</label>
				<select class="form-control input-sm" name="parentezco">
					<option value="">Selecciona una opción....</option>
					@foreach (config('pined.parentezcos') as $parentezco)
						<option {{old('parentezco') == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
					@endforeach
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de nacimiento</label>
				<input type="date" class="form-control input-sm" name="fNacimiento" value="{{old('fNacimiento', $padre->fNacimiento)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Estado Civil</label>
				<select class="form-control" name="estado_civil">
					<option value="Soltero(a)">Soltero(a)</option>
					<option value="Casado(a)">Casado(a)</option>
					<option value="Divorciado(a)">Divorciado(a)</option>
					<option value="Viudo(a)">Viudo(a)</option>
					<option value="Union Libre">Unión Libre</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fallecido</label>
				<select class="form-control" name="fallecido">
					<option {{$padre->fallecido == 0 ? 'selected' : ''}} value="No">No</option>
					<option {{$padre->fallecido == 1 ? 'selected' : ''}} value="Si">Si</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Correo</label>
				<input type="email" class="form-control input-sm" name="correo" value="{{old('correo', $padre->correo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Telefono/Móvil</label>
				<input type="text" class="form-control input-sm" name="movil" value="{{old('movil', $padre->movil)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Biografía</label>
				<input type="text" class="form-control input-sm" name="bio" value="{{old('bio', $padre->bio)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Autorizado para retirar estudiante</label>
				<select name="autorizacion_retirar_estudiante" id="" class="form-control">
					<option {{$padre->autorizadoRetirarEstudiante == 1 ? 'selected' : ''}} value="si">Si</option>
					<option {{$padre->autorizadoRetirarEstudiante == 0 ? 'selected' : ''}} value="no">No</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Religión</label>
				<input type="text" class="form-control input-sm" name="religion" maxlength="10" value="{{old('religion', $padre->religion)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DOMICILIO</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ciudad Domicilio</label>
				<input type="text" class="form-control input-sm" name="ciudadDomicilio" maxlength="255" value="{{old('ciudadDomicilio', $padre->ciudadDomicilio)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Dirección Domicilio</label>
				<input type="text" class="form-control input-sm" name="direccionDomicilio" maxlength="255" value="{{old('direccionDomicilio', $padre->direccionDomicilio)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono Domicilio</label>
				<input type="text" class="form-control input-sm" name="telefonoDomicilio" maxlength="100" value="{{old('telefonoDomicilio', $padre->telefonoDomicilio)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">TRABAJO</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ciudad Trabajo:</label>
				<input type="text" class="form-control input-sm" name="ciudadTrabajo" maxlength="255" value="{{old('ciudadTrabajo', $padre->ciudadTrabajo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Dirección Trabajo</label>
				<input type="text" class="form-control input-sm" name="direccionTrabajo" maxlength="255" value="{{old('direccionTrabajo', $padre->direccionTrabajo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono Trabajo</label>
				<input type="text" class="form-control input-sm" name="telefonoTrabajo" maxlength="100" value="{{old('telefonoTrabajo', $padre->telefonoTrabajo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Cargo/Actividad</label>
				<input type="text" class="form-control input-sm" name="cargoTrabajo" maxlength="100" value="{{old('cargoTrabajo', $padre->cargoTrabajo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Lugar Trabajo</label>
				<input type="text" class="form-control input-sm" name="lugarTrabajo" maxlength="255" value="{{old('lugarTrabajo', $padre->lugarTrabajo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Profesión</label>
				<input type="text" class="form-control input-sm" name="profesion" maxlength="255" value="{{old('profesion', $padre->profesion)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ex Alumno</label>
				<select class="form-control input-sm" name="ex_alumno">
					<option value="">Escoje una opción...</option>
					<option {{$padre->ex_alumno === 1 ? 'selected' : ''}} value="Si">Si</option>
					<option {{$padre->ex_alumno === 0 ? 'selected' : ''}} value="No">No</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de promoción</label>
				<input type="date" class="form-control input-sm" name="fecha_promocion" maxlength="255" value="{{old('fecha_promocion', $padre->fecha_promocion)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de ingreso al País</label>
				<input type="date" class="form-control input-sm" name="fecha_ingreso_pais" maxlength="255" value="{{old('fecha_ingreso_pais', $padre->fecha_ingreso_pais)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de expiración pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_expiracion_pasaporte" maxlength="255" value="{{old('fecha_expiracion_pasaporte', $padre->fecha_expiracion_pasaporte)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de caducidad pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_caducidad_pasaporte" maxlength="255" value="{{old('fecha_caducidad_pasaporte', $padre->fecha_caducidad_pasaporte)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">NACIONALIDAD</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nacionalidad:</label>
				<input type="text" name="nacionalidad" class="form-control input-sm" value="{{old('nacionalidad', $padre->nacionalidad)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Lugar de nacimiento:</label>
				<input type="text" name="lugar_nacimiento" class="form-control input-sm" value="{{old('lugarNacimiento', $padre->lugarNacimiento)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Provincia:</label>
				<input type="text" name="provincia" class="form-control input-sm" value="{{old('provincia', $padre->provincia)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Canton:</label>
				<input type="text" name="canton" class="form-control input-sm" value="{{old('canton', $padre->canton)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parroquia:</label>
				<input type="text" name="parroquia" class="form-control input-sm" value="{{old('parroquia', $padre->parroquia)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">INSTRUCCION</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Estudios:</label>
				<input type="text" name="estudios" class="form-control input-sm" value="{{old('estudios', $padre->estudios)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DATOS MÉDICOS</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Clínica:</label>
				<input type="text" name="clinica" class="form-control input-sm" value="{{old('clinica', $padre->clinica)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Indicaciones:</label>
				<input type="text" name="indicaciones" class="form-control input-sm" value="{{old('indicaciones', $padre->indicaciones)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo de sangre:</label>
				<select name="tipo_sangre" class="form-control">
					@foreach (config('pined.tipo_de_sangre') as $tipo_sangre)
						<option {{old('tipo_sangre') === $tipo_sangre ? 'selected' : ''}} value="{{$tipo_sangre}}">{{$tipo_sangre}}</option>
					@endforeach
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Contacto de Emergencia:</label>
				<input type="text" name="contacto_emergencia" class="form-control input-sm" value="{{old('contactoEmergencia', $padre->contactoEmergencia)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Telefono de emergencia:</label>
				<input type="text" name="telefono_emergencia" class="form-control input-sm" value="{{old('telefonoEmergencia', $padre->telefonoEmergencia)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Observación(Emergencia):</label>
				<textarea class="form-control input-sm"  name="observacion_emergencia" rows="4" cols="50">{{old('observacionEmergencia', $padre->observacionEmergencia)}}</textarea>
			</div>
		</div>
	</div>
	<div class="text-right">
		<input type="submit" class="mb-1 btn btn-primary btn-lg" value="{{$btn}}">
	</div>
</div>
