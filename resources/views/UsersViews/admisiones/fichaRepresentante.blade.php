
	<h3 class="matricula__matriculacion-title flex flex-column justify-between">
		<span>GENERAL</span>
	</h3>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Cédula</label>
			<input type="text" class="form-control input-sm" name="ci" minlength="10" maxlength="10" placeholder="Ingrese los 10 digitos de la cédula" value="{{old('ci', $data->ci)}}" required>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Nombres</label>
			<input type="text" class="form-control input-sm" name="nombres" minlength="2" maxlength="100" value="{{old('nombres', $data->nombres)}}" required>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Apellidos</label>
			<input type="text" class="form-control input-sm" minlength="2" maxlength="100" name="apellidos" value="{{old('apellidos', $data->apellidos)}}" required>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Sexo</label>
			<select class="form-control input-sm" name="sexo">
				<option {{$data->sexo == 'Masculino' ? 'selected' : ''}} value="Masculino">Masculino</option>
				<option {{$data->sexo == 'Femenino' ? 'selected' : ''}} value="Femenino">Femenino</option>
			</select>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Nacionalidad</label>
			<input type="text" class="form-control input-sm" name="nacionalidad" minlength="2" maxlength="100" value="{{old('nacionalidad', $data->nacionalidad)}}" required>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Fecha de nacimiento</label>
			<input type="date" class="form-control input-sm" name="fNacimiento" value="{{old('fNacimiento', $data->fNacimiento)}}" required>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Telefono Movil</label>
			<input type="text" class="form-control input-sm" name="movil" value="{{old('movil', $data->movil)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Foto</label>
			{{ Form::file('image',array('name'  =>  'image','accept' =>  'image/x-png,image/gif,image/jpeg' ))}}
		</div>
	<h3 class="matricula__matriculacion-title">PROFESIÓN</h3>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Profesión</label>
			<input type="text" class="form-control input-sm" name="profesion" value="{{old('profesion', $data->profesion)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Lugar trabajo</label>
			<input type="text" class="form-control input-sm" name="lugar_trabajo" value="{{old('lugar_trabajo', $data->lugar_trabajo)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Telefono trabajo</label>
			<input type="text" class="form-control input-sm" name="telefono_trabajo" value="{{old('telefono_trabajo', $data->telefono_trabajo)}}">
		</div>
	<h3 class="matricula__matriculacion-title">ADICIONAL</h3>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Ex Alumno</label>
			<div class="matricula__radio-botones">
				<div class="flex items-center">
					<label for="ex_alumno_si">
						Si
					</label>
					<input class="matricula__radio inclusion_radio" type="radio" name="ex_alumno" id="ex_alumno_si" value="Si"
						{{$data->ex_alumno == 1 ? 'checked' : ''}}
					>
				</div>
				<div class="flex items-center matricula__radio-div">
					<label for="ex_alumno_no">
						No
					</label>
					<input class="matricula__radio inclusion_radio" type="radio" name="ex_alumno" id="ex_alumno_no" value="No"
						{{$data->ex_alumno == 0 ? 'checked' : ''}}
					>
				</div>
			</div>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Fecha promoción</label>
			<input type="date" name="fecha_promocion" class="form-control" value="{{old('fecha_promocion', $data->fecha_promocion)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Fecha de ingreso</label>
			<input type="date" name="fecha_ingreso" class="form-control" value="{{old('fecha_ingreso', $data->fecha_ingreso)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Fecha estado migratorio</label>
			<input type="date" name="fecha_estado_migratorio" class="form-control" value="{{old('fecha_estado_migratorio', $data->fecha_estado_migratorio)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Fecha expiración pasaporte</label>
			<input type="date" name="fecha_exp_pasaporte" class="form-control" value="{{old('fecha_exp_pasaporte', $data->fecha_exp_pasaporte)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Fecha caducidad pasaporte</label>
			<input type="date" name="fecha_caducidad_pasaporte" class="form-control" value="{{old('fecha_caducidad_pasaporte', $data->fecha_caducidad_pasaporte)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Biografía</label>
			<textarea class="form-control input-sm" rows="5" name="bio">{{old('bio', $data->bio)}}</textarea>
		</div>
	<h3 class="matricula__matriculacion-title">Domicilio</h3>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Dirección domicilio</label>
			<input type="text" class="form-control input-sm" name="dDomicilio" value="{{old('dDomicilio', $data->dDomicilio)}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Teléfono del domicilio</label>
			<input type="text" class="form-control input-sm" name="tDomicilio" value="{{old('tDomicilio', $data->tDomicilio)}}">
		</div>
	<h3 class="matricula__matriculacion-title">Acceso</h3>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Correo</label>
			<input type="email" class="form-control input-sm" name="correo" value="{{old('correo', $data->correo)}}" required>
		</div>
		<div class="matricula__matriculacion__input" id="ocultar_admision">
			<label for="" class="matricula__matriculacion-label">Contraseña</label>
			<input type="password" class="form-control input-sm" name="password">
		</div>
		<div class="matricula__matriculacion__input" id="ver_admision" style="display: none" >
			<label for=""  class="matricula__matriculacion-label">podrá acceder a la plataforma digitando lo siguiente:
				<p style="color: red;">usuario (correo electrónico)</p>
				<p style="color: red;">contraseña (número de cédula)</p>
				</label>
		</div>
<div  id="creacionPerfilCliente" style="display:none">
	<h3 class="matricula__matriculacion-title">Cliente <br>
		<small class="lowercase">Por favor, ingresa los datos restante para crear el usuario <strong>cliente.</strong></small>
	</h3>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Parentezco</label>
			<select name="parentezco_cliente" class="form-control input-sm">
				<option value="">Selecciona una opción...</option>
				@foreach (config('pined.parentezcos') as $parentezco)
					<option {{old('parentezco_cliente') == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
				@endforeach
			</select>
		</div>
</div>
<div id="creacionPerfilPadre" style="display:none">
	<h3 class="matricula__matriculacion-title">Padre/Madre <br>
		<small class="lowercase">Por favor, ingresa los datos restante para crear el usuario <strong>padre o madre.</strong></small>
	</h3>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Parentezco</label>
			<select name="parentezco_padre" class="form-control input-sm">
				<option value="">Selecciona una opción...</option>
				@foreach (config('pined.parentezcos') as $parentezco)
					<option {{old('parentezco_padre') == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
				@endforeach
			</select>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Estado Civil</label>
			<select class="form-control" name="estado_civil">
				<option value="">Escoja un estado...</option>
				@foreach (['Soltero(a)', 'Casado(a)', 'Divorciado(a)', 'Viudo(a)', 'Union Libre'] as $estado)
					<option {{old('estado_civil') === $estado ? 'selected' : ''}} value="{{$estado}}">{{$estado}}</option>
				@endforeach
			</select>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Fallecido</label>
			<select class="form-control" name="fallecido">
				<option {{old('fallecido') === 'No' ? 'selected' : ''}} value="No">No</option>
				<option {{old('fallecido') === 'Si' ? 'selected' : ''}} value="Si">Si</option>
			</select>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Autorizado para retirar estudiante</label>
			<select name="autorizacion_retirar_estudiante" id="" class="form-control">
				<option {{old('autorizacion_retirar_estudiante') === 'Si' ? 'selected' : ''}} value="Si">Si</option>
				<option {{old('autorizacion_retirar_estudiante') === 'No' ? 'selected' : ''}} value="No">No</option>
			</select>
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Religión</label>
			<input type="text" class="form-control input-sm" name="religion" maxlength="100" value="{{old('religion')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Ciudad Domicilio</label>
			<input type="text" class="form-control input-sm" name="ciudadDomicilio" maxlength="255" value="{{old('ciudadDomicilio')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Ciudad Trabajo:</label>
			<input type="text" class="form-control input-sm" name="ciudadTrabajo" maxlength="255" value="{{old('ciudadTrabajo')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Dirección Trabajo</label>
			<input type="text" class="form-control input-sm" name="direccionTrabajo" maxlength="255" value="{{old('direccionTrabajo')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Cargo/Actividad</label>
			<input type="text" class="form-control input-sm" name="cargoTrabajo" maxlength="100" value="{{old('cargoTrabajo')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Lugar de nacimiento:</label>
			<input type="text" name="lugar_nacimiento" class="form-control input-sm" value="{{old('lugar_nacimiento')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Provincia:</label>
			<input type="text" name="provincia" class="form-control input-sm" value="{{old('provincia')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Canton:</label>
			<input type="text" name="canton" class="form-control input-sm" value="{{old('canton')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Parroquia:</label>
			<input type="text" name="parroquia" class="form-control input-sm" value="{{old('parroquia')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Estudios:</label>
			<input type="text" name="estudios" class="form-control input-sm" value="{{old('estudios')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Clínica:</label>
			<input type="text" name="clinica" class="form-control input-sm" value="{{old('clinica')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Indicaciones:</label>
			<input type="text" name="indicaciones" class="form-control input-sm" value="{{old('indicaciones')}}">
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
			<input type="text" name="contacto_emergencia" class="form-control input-sm" value="{{old('contacto_emergencia')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Telefono de emergencia:</label>
			<input type="text" name="telefono_emergencia" class="form-control input-sm" value="{{old('telefono_emergencia')}}">
		</div>
		<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Observación(Emergencia):</label>
			<textarea class="form-control input-sm"  name="observacion_emergencia" rows="4" cols="50">{{old('observacion_emergencia')}}</textarea>
		</div>
</div>
