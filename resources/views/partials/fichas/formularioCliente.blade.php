<div class="panel p-4 matricula__matriculacion">
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DATOS FACTURACIÓN</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Numero de identificacion</label>
				<input type="text" name="cedula_ruc" placeholder="Cédula o Ruc"class="form-control" value="{{old('cedula_ruc', $cliente->cedula_ruc)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nombres</label>
				<input type="text" name="nombres" class="form-control" value="{{old('nombres', $cliente->nombres)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Apellidos</label>
				<input type="text" name="apellidos" class="form-control" value="{{old('apellidos', $cliente->apellidos)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Correo</label>
				<input type="text" name="correo" class="form-control" value="{{old('correo', $cliente->correo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Celular Movil</label>
				<input type="text" name="telefono" class="form-control" value="{{old('telefono', $cliente->telefono)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Dirección</label>
				<input type="text" name="direccion" class="form-control" value="{{old('direccion', $cliente->direccion)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parentezco</label>
				<select name="parentezco" class="form-control input-sm">
					<option value="">Selecciona una opción...</option>
					@foreach (config('pined.parentezcos') as $parentezco)
						<option {{old('parentezco') == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
					@endforeach
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha Nacimiento</label>
				<input type="date" name="fecha_nacimiento" class="form-control" value="{{old('fecha_nacimiento', $cliente->fecha_nacimiento)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Telefono Domicilio</label>
				<input type="text" name="telefono_domicilio" class="form-control" value="{{old('telefono_domicilio', $cliente->telefono_domicilio)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Profesión</label>
				<input type="text" name="profesion" class="form-control" value="{{old('profesion', $cliente->profesion)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Lugar de trabajo</label>
				<input type="text" name="lugar_trabajo" class="form-control" value="{{old('lugar_trabajo', $cliente->lugar_trabajo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Telefono del trabajo</label>
				<input type="text" name="telefono_trabajo" class="form-control" value="{{old('telefono_trabajo', $cliente->telefono_trabajo)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">nacionalidad</label>
				<input type="text" name="nacionalidad" class="form-control" value="{{old('nacionalidad', $cliente->nacionalidad)}}">
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block" id="creacionPerfilRepresentante" style="display:none">
		<h3 class="matricula__matriculacion-title">Representante <br>
			<small class="lowercase">Por favor, ingresa los datos restante para crear el usuario <strong>representante.</strong></small>
		</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Sexo</label>
				<select class="form-control input-sm" name="sexo">
					@foreach (['Masculino', 'Femenino'] as $genero)
						<option {{old('sexo') === $genero ? 'selected' : ''}} value="{{$genero}}">{{$genero}}</option>
					@endforeach
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Foto</label>
				{{ Form::file('image',array('name'  =>  'image','accept' =>  'image/x-png,image/gif,image/jpeg' ))}}
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ex Alumno</label>
				<div class="matricula__radio-botones">
					<div class="flex items-center">
						<label for="ex_alumno_si">
							Si
						</label>
						<input {{old('ex_alumno_representante') === 'Si' ? 'checked' : ''}} class="matricula__radio inclusion_radio" type="radio" name="ex_alumno_representante" id="ex_alumno_si" value="Si">
					</div>
					<div class="flex items-center matricula__radio-div">
						<label for="ex_alumno_no">
							No
						</label>
						<input {{old('ex_alumno_representante') === 'No' ? 'checked' : ''}} class="matricula__radio inclusion_radio" type="radio" name="ex_alumno_representante" id="ex_alumno_no" value="No">
					</div>
				</div>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha promoción</label>
				<input type="date" name="fecha_promocion_representante" class="form-control" value="{{old('fecha_promocion_representante')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de ingreso</label>
				<input type="date" name="fecha_ingreso_representante" class="form-control" value="{{old('fecha_ingreso_representante')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha estado migratorio</label>
				<input type="date" name="fecha_estado_migratorio" class="form-control" value="{{old('fecha_estado_migratorio')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha expiración pasaporte</label>
				<input type="date" name="fecha_exp_pasaporte" class="form-control" value="{{old('fecha_exp_pasaporte')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha caducidad pasaporte</label>
				<input type="date" name="fecha_caducidad_pasaporte_representante" class="form-control" value="{{old('fecha_caducidad_pasaporte_representante')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Biografía</label>
				<textarea class="form-control input-sm" rows="5" name="bio_representante">{{old('bio')}}</textarea>
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block" id="creacionPerfilPadre" style="display:none">
		<h3 class="matricula__matriculacion-title">Padre/Madre <br>
			<small class="lowercase">Por favor, ingresa los datos restante para crear el usuario <strong>padre o madre.</strong></small>
		</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Sexo</label>
				<select class="form-control input-sm" name="sexo">
					@foreach (['Masculino', 'Femenino'] as $genero)
						<option {{old('sexo') === $genero ? 'selected' : ''}} value="{{$genero}}">{{$genero}}</option>
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
				<label for="" class="matricula__matriculacion-label">Biografía</label>
				<input type="text" class="form-control input-sm" name="bio_padre" value="{{old('bio')}}">
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
				<label for="" class="matricula__matriculacion-label">Dirección Trabajo</label>
				<input type="text" class="form-control input-sm" name="direccionTrabajo" maxlength="255" value="{{old('direccionTrabajo')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ciudad Trabajo:</label>
				<input type="text" class="form-control input-sm" name="ciudadTrabajo" maxlength="255" value="{{old('ciudadTrabajo')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Cargo/Actividad</label>
				<input type="text" class="form-control input-sm" name="cargoTrabajo" maxlength="100" value="{{old('cargoTrabajo')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ex Alumno</label>
				<select class="form-control input-sm" name="ex_alumno_padre">
					<option value="">Escoje una opción...</option>
					<option {{old('ex_alumno_padre') == 'Si' ? 'selected' : ''}} value="Si">Si</option>
					<option {{old('ex_alumno_padre') == 'No' ? 'selected' : ''}} value="No">No</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de promoción</label>
				<input type="date" class="form-control input-sm" name="fecha_promocion_padre" maxlength="255" value="{{old('fecha_promocion_padre')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de ingreso al País</label>
				<input type="date" class="form-control input-sm" name="fecha_ingreso_padre" maxlength="255" value="{{old('fecha_ingreso_padre')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de expiración pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_expiracion_pasaporte" maxlength="255" value="{{old('fecha_expiracion_pasaporte')}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de caducidad pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_caducidad_pasaporte_padre" maxlength="255" value="{{old('fecha_caducidad_pasaporte_padre')}}">
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
	</div>
	<div class="flex flex-col lg:flex-row lg:justify-between">
		<div style="{{$btn === 'Actualizar Cliente' ? 'visibility:hidden' : 'display:block'}}">
			<div class="flex flex-column mt-4">
				<span class="text-xl mb-3 flex items-center" style="font-size:16px">
					<label class="font-light mb-0" for="representante">¿Este usuario tambien es el representante?</label>
					<input id="representante" class="mt-0" type="checkbox" name="crearRepresentante" style="margin-left:5px">
				</span>
				<span class="text-xl mb-3 flex items-center" style="font-size:16px">
					<label class="font-light mb-0" for="padre">¿Este usuario tambien es el padre de familia?</label>
					<input id="padre" class="mt-0" type="checkbox" name="crearPadre" style="margin-left:5px">
				</span>
			</div>
		</div>
		<div>
			<div class="text-right">
				<button type="submit" class="mb-1 btn btn-primary btn-lg">{{$btn}}</button>
			</div>
		</div>
	</div>
</div>
