<div class="panel pl-8 pr-8 matricula__matriculacion">
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DATOS BÁSICOS</h3>
	</div>
	<div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo Identificacion<span class="valorError">*</span></label>
				<select class="form-control" name="ci" id="ci" onchange="ShowSelected();" required>
					<!--<option>Seleccione</option>-->
					<option value="1" {{($data->identificacion) == 1 ? 'selected' : ''}}>Cédula</option>
					<option value="2" {{($data->identificacion) == 2 ? 'selected' : ''}}>Pasaporte</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label" id="cedula_pasaporte">Cédula/Pasaporte<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="n_identificacion" minlength="9" maxlength="10" placeholder="Ingrese los 10 digitos de la cédula" value="{{old('ci', $data->ci)}}" required>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nombres <span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="nombres" minlength="2" maxlength="200" placeholder="Nombres del estudiante" value="{{old('nombres', $data->nombres)}}" required>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Apellidos<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="apellidos" minlength="2" maxlength="200" placeholder="Apellidos del Estudiante" value="{{old('apellidos', $data->apellidos)}}" required>
			</div>
			
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Sexo</label>
				<select class="form-control input-sm" name="sexo" id="sexo" required>
					<!--<option>Seleccione</option>-->
					<option value="1" {{$dataProfile->sexo == '1' ? 'selected' : ''}}>Hombre</option>
					<option value="2" {{$dataProfile->sexo == '2' ? 'selected' : ''}}>Mujer</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Genero</label>
				<select class="form-control input-sm" name="genero" id="genero" required>
					<!--<option>Seleccione</option>-->
					<option value="1" {{$dataProfile->genero == '1' ? 'selected' : ''}}>Masculino</option>
					<option value="2" {{$dataProfile->genero == '2' ? 'selected' : ''}}>Femenino</option>
				</select>
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de nacimiento<span class="valorError">*</span></label>
				<input type="date" class="form-control input-sm" name="fechaNacimiento" value="{{old('fechaNacimiento', $data->fechaNacimiento)}}" required>
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Celular</label>
				<input type="text" class="form-control input-sm" name="celular_estudiante" placeholder="Celular del estudiante" value="{{old('celular_estudiante', $dataProfile->celular)}}">
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Estado Civil</label>
				<select class="form-control input-sm" name="Estado_Civil" required>
					<!--<option>Seleccione</option>-->
					<option value="1" {{$dataProfile->estado_civil == '1' ? 'selected' : ''}}>Soltero/a</option>
					<option value="2" {{$dataProfile->estado_civil == '2' ? 'selected' : ''}}>Casado/a</option>
					<option value="3" {{$dataProfile->estado_civil == '3' ? 'selected' : ''}}>Divorciado/a</option>
					<option value="4" {{$dataProfile->estado_civil == '4' ? 'selected' : ''}}>Unión Libre</option>
					<option value="5" {{$dataProfile->estado_civil == '5' ? 'selected' : ''}}>Viudo/a</option>
				</select>
			</div>
			<div class="col-lg-6 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Correo Electronico Personal</label>
				<input type="email" class="form-control input-sm" name="correo_personal" placeholder="Correo Electronico" value="{{old('correo_personal', $data->correoElectronico)}}">
			</div>


		</div>
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">DATOS MEDICOS</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipos Sangre</label>
				<select class="form-control input-sm" name="Tipos_Sangre" required>
					<!--<option>Seleccione</option>-->
					<option value="1" {{$dataProfile->tipos_de_sangre == '1' ? 'selected' : ''}}>A+</option>
					<option value="2" {{$dataProfile->tipos_de_sangre == '2' ? 'selected' : ''}}>A-</option>
					<option value="3" {{$dataProfile->tipos_de_sangre == '3' ? 'selected' : ''}}>B+</option>
					<option value="4" {{$dataProfile->tipos_de_sangre == '4' ? 'selected' : ''}}>B-</option>
					<option value="5" {{$dataProfile->tipos_de_sangre == '5' ? 'selected' : ''}}>AB+</option>
					<option value="6" {{$dataProfile->tipos_de_sangre == '6' ? 'selected' : ''}}>AB-</option>
					<option value="7" {{$dataProfile->tipos_de_sangre == '7' ? 'selected' : ''}}>O+</option>
					<option value="8" {{$dataProfile->tipos_de_sangre == '8' ? 'selected' : ''}}>O-</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tiene Discapacidad</label>
				<select class="form-control input-sm" name="Tiene_Discapacidad" id="tiene_discapacidad" required>
					<!--<option>Seleccione</option>-->
					<option value="1" {{$dataProfile->tienes_discapacidad == '1' ? 'selected' : ''}}>Si</option>
					<option value="2" {{$dataProfile->tienes_discapacidad == '2' ? 'selected' : ''}}>No</option>
				</select>
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nro.Carnet CONADIS<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="Carnet_CONADIS" id="Carnet_CONADIS" minlength="2" maxlength="100" placeholder="Carnet CONADIS" value="{{old('carnet', $dataProfile->carnet_conadis)}}">
				<input type="hidden" name="Carnet_CONADIS_2" value="NA">
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Porcentaje de Discapacidad</label>
				<input type="text" class="form-control input-sm" name="porcentaje_discapacidad" id="porcentaje_discapacidad" placeholder="Ingrese la identificación del carnet" value="{{old('numero_carnet', $dataProfile->porcentaje_discapacidad)}}">
				<input type="hidden" name="NUMERO_CARNET_2" value="NA">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo discapacidad</label>
				<select class="form-control input-sm" name="Tipo_discapacidad" id="Tipo_discapacidad" required>
					<!--<option>Seleccione</option>-->
					<option value='1' {{$dataProfile->tipo_discapacidad == '1' ? 'selected' : ''}}>intelectual</option>
					<option value='2' {{$dataProfile->tipo_discapacidad == '2' ? 'selected' : ''}}>Física</option>
					<option value='3' {{$dataProfile->tipo_discapacidad == '3' ? 'selected' : ''}}>Visual</option>
					<option value='4' {{$dataProfile->tipo_discapacidad == '4' ? 'selected' : ''}}>Auditiva</option>
					<option value='5' {{$dataProfile->tipo_discapacidad == '5' ? 'selected' : ''}}>Mental</option>
					<option value='6' {{$dataProfile->tipo_discapacidad == '6' ? 'selected' : ''}}>Otra</option>
					<option value='7' {{$dataProfile->tipo_discapacidad == '7' ? 'selected' : ''}}>no aplica</option>
				</select>
				<input type="hidden" name="Tipo_discapacidad2" id="Tipo_discapacidad2" value="7">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo de enfermedad catastrófica </label>
				<select class="form-control input-sm" name="Tipo_enfermedad_catastrófica" id="Tipo_enfermedad_catastrófica" required>
					<!--<option>Seleccione</option>-->
					<option value='1' {{$dataProfile->tipo_de_enfermedad_catastrofica == '1' ? 'selected' : ''}}>Cancer</option>
					<option value='2' {{$dataProfile->tipo_de_enfermedad_catastrofica == '2' ? 'selected' : ''}}>Tumor Cerebral</option>
					<option value='3' {{$dataProfile->tipo_de_enfermedad_catastrofica == '3' ? 'selected' : ''}}>Quemaduras Graves</option>
					<option value='4' {{$dataProfile->tipo_de_enfermedad_catastrofica == '4' ? 'selected' : ''}}>Insuficiencia Renal</option>
					<option value='5' {{$dataProfile->tipo_de_enfermedad_catastrofica == '5' ? 'selected' : ''}}>Otros</option>
					<option value='6' {{$dataProfile->tipo_de_enfermedad_catastrofica == '6' ? 'selected' : ''}}>no aplica</option>
				</select>
				<input type="hidden" name="Tipo_enfermedad_catastróficaResp2" id="Tipo_enfermedad_catastróficaResp2" value="6">
			</div>


		</div>

		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">NACIONALIDAD</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Pais Nacimiento</label>
				<select class="form-control input-sm" name="pais" id="pais_nacimiento">
					<!--<option>Seleccione</option>-->
					@foreach ($paises as $item)
					<option value="{{$item->id}}" {{$data->nacionalidad == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Etnia Estudiante</label>
				<select class="form-control input-sm" name="Etnia_Estudiante" id="Etnia_Estudiante">
					<!--<option>Seleccione</option>-->
					<option value="1" {{$dataProfile->Etnia_estudiante == '1' ? 'selected' : ''}}>Indígena</option>
					<option value="2" {{$dataProfile->Etnia_estudiante == '2' ? 'selected' : ''}}>Afroecuatoriano</option>
					<option value="3" {{$dataProfile->Etnia_estudiante == '3' ? 'selected' : ''}}>Negro</option>
					<option value="4" {{$dataProfile->Etnia_estudiante == '4' ? 'selected' : ''}}>Mulato</option>
					<option value="5" {{$dataProfile->Etnia_estudiante == '5' ? 'selected' : ''}}>Montuvio</option>
					<option value="6" {{$dataProfile->Etnia_estudiante == '6' ? 'selected' : ''}}>Mestizo</option>
					<option value="7" {{$dataProfile->Etnia_estudiante == '7' ? 'selected' : ''}}>Blanco</option>
					<option value="8" {{$dataProfile->Etnia_estudiante == '8' ? 'selected' : ''}}>Otro</option>
					<option value="9" {{$dataProfile->Etnia_estudiante == '9' ? 'selected' : ''}}>No registra</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Pueblo Y Nacionalidad</label>
				<select class="form-control input-sm" name="pueblo_nacionalidad" id="pueblo_nacionalidad" required>
					<!--<option>Seleccione</option>-->
					@foreach ($pueblos_nacionalidades as $item)
					<option value="{{$item->id}}" {{$dataProfile->pueblo_nacionalidad == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de ingreso al País</label>
				<input type="date" class="form-control input-sm" name="fecha_ingreso_pais" id="fecha_ingreso_pais" value="{{old('fecha_ingreso_pais', $dataProfile->fecha_ingreso_pais)}}">
				<input type="hidden" name="fecha_ingreso_pais2" id="fecha_ingreso_pais2" value="NA">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de expiración pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_expiracion_pasaporte" id="fecha_expiracion_pasaporteDT" value="{{old('fecha_expiracion_pasaporte', $dataProfile->fecha_expiracion_pasaporte)}}">
				<input type="hidden" name="fecha_ingreso_pais2" id="fecha_expiracion_pasaporte" value="NA">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de caducidad pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_caducidad_pasaporte" id="fecha_caducidad_pasaporteDT" value="{{old('fecha_caducidad_pasaporte', $dataProfile->fecha_caducidad_pasaporte)}}">
				<input type="hidden" name="fecha_ingreso_pais2" id="fecha_caducidad_pasaporte" value="NA">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Provincia de Nacimiento</label>
				<select class="form-control input-sm" name="provincia_nacimiento" id="provincia_nacimiento">
					<!--<option>Seleccione</option>-->
					@foreach ($provincias as $item)
					<option value="{{$item->id}}" {{$dataProfile->provincia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Canton de Nacimiento</label>
				<select class="form-control input-sm" name="canton_nacimiento" id="canton_nacimiento">
					<!--<option>Seleccione</option>-->
					@foreach ($cantones as $item)
					<option value="{{$item->id}}" {{$dataProfile->canton == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
		</div>

		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INFORMACIÓN DE RESIDENCIA</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Pais Recidencia</label>
				<select class="form-control input-sm" name="pais_recidencia" id="pais_recidencia">
					<!--<option>Seleccione</option>-->
					@foreach ($paises as $item)
					<option value="{{$item->id}}" {{$dataProfile->pais_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Provincia de Recidencia</label>
				<select class="form-control input-sm" name="provincia_recidencia" id="provincia_recidencia">
					<!--<option>Seleccione</option>-->
					@foreach ($provincias as $item)
					<option value="{{$item->id}}" {{$dataProfile->provincia_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Canton de Recidencia</label>
				<select class="form-control input-sm" name="canton_recidencia" id="canton_recidencia">
					<!--<option>Seleccione</option>-->
					@foreach ($cantones as $item)
					<option value="{{$item->id}}" {{$dataProfile->canton_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ciudad de Recidencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="ciudad" maxlength="100" placeholder="Ciudad de Recidencia del estudiante" value="{{old('direccion', $dataProfile->ciudad_domicilio)}}" required>
			</div>
			<div class="col-lg-12 matricula__matriculacion__input">
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Dirección Domicilio<span class="valorError">*</span></label>
					<input type="text" class="form-control input-sm" name="direccion" maxlength="100" placeholder="Direccion del domicilio del estudiante" value="{{old('direccion', $dataProfile->direccion_domicilio)}}" required>
				</div>
			</div>
		</div>
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INFORMACIÓN DE ACADEMICA</h3>
		</div>
		<div class="row">

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo De Colegio</label>
				<select class="form-control input-sm" name="tipoColegioId" required>
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->tipoColegioId == '1' ? 'selected' : ''}}>Fiscal</option>
					<option value='2' {{$data->tipoColegioId == '2' ? 'selected' : ''}}>Fiscomisional</option>
					<option value='3' {{$data->tipoColegioId == '3' ? 'selected' : ''}}>Particular</option>
					<option value='4' {{$data->tipoColegioId == '4' ? 'selected' : ''}}>Auditiva</option>
					<option value='5' {{$data->tipoColegioId == '5' ? 'selected' : ''}}>Municipal</option>
					<option value='6' {{$data->tipoColegioId == '6' ? 'selected' : ''}}>Extranjero</option>
					<option value='7' {{$data->tipoColegioId == '7' ? 'selected' : ''}}>no Registra</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Modalidad De La Carrera</label>
				<select class="form-control input-sm" name="modalidadCarrera" required>
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->modalidadCarrera == '1' ? 'selected' : ''}}>Presencial</option>
					<option value='2' {{$data->modalidadCarrera == '2' ? 'selected' : ''}}>Semi-Presencial</option>
					<option value='3' {{$data->modalidadCarrera == '3' ? 'selected' : ''}}>Distancia</option>
					<option value='4' {{$data->modalidadCarrera == '4' ? 'selected' : ''}}>Dual</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Jornada De La Carrera</label>
				<select class="form-control input-sm" name="jornadaCarrera" required>
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->jornadaCarrera == '1' ? 'selected' : ''}}>Matutina</option>
					<option value='2' {{$data->jornadaCarrera == '2' ? 'selected' : ''}}>Vespertina</option>
					<option value='3' {{$data->jornadaCarrera == '3' ? 'selected' : ''}}>Nocturna</option>
					<option value='4' {{$data->jornadaCarrera == '4' ? 'selected' : ''}}>Intensiva</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

				<label for="" class="matricula__matriculacion-label">Fecha De Inicio De La Carrera</label>
				<input type="date" class="form-control input-sm" name="fechaInicioCarrera" value="{{old('fechaNacimiento', $data->fechaInicioCarrera)}}">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha De Matriculacion </label>
				<input type="date" class="form-control input-sm" name="fecha_matriculacion" value="{{old('fechaNacimiento', $data->fecha_matriculacion)}}">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo De Matricula</label>
				<select class="form-control input-sm" name="tipo_matricula" required>
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->matricula == '1' ? 'selected' : ''}}>Ordinaria</option>
					<option value='2' {{$data->matricula == '2' ? 'selected' : ''}}>Extraordinaria</option>
					<option value='3' {{$data->matricula == '3' ? 'selected' : ''}}>Especial</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">nivel academico</label>
				<select class="form-control input-sm" name="nivelAcademicoQueCursa" required>
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->nivelAcademicoQueCursa == '1' ? 'selected' : ''}}>1ro</option>
					<option value='2' {{$data->nivelAcademicoQueCursa == '2' ? 'selected' : ''}}>2do</option>
					<option value='3' {{$data->nivelAcademicoQueCursa == '3' ? 'selected' : ''}}>3ro</option>
					<option value='4' {{$data->nivelAcademicoQueCursa == '4' ? 'selected' : ''}}>4to</option>
					<option value='5' {{$data->nivelAcademicoQueCursa == '5' ? 'selected' : ''}}>5to</option>
					<option value='6' {{$data->nivelAcademicoQueCursa == '6' ? 'selected' : ''}}>6to</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">duracion del periodo academico</label>
				<input type="text" class="form-control input-sm" name="duracionPeriodoAcademico" maxlength="100" placeholder="duracion del periodo academico" value="{{old('apellidos', $data->duracionPeriodoAcademico)}}">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">ha repetido almenos una materia</label>
				<select class="form-control input-sm" name="haRepetidoAlMenosUnaMateria">
					<!--<option>Seleccione</option>-->
					<option value="1" {{$data->haRepetidoAlMenosUnaMateria == '1' ? 'selected' : ''}}>Si</option>
					<option value="2" {{$data->haRepetidoAlMenosUnaMateria == '2' ? 'selected' : ''}}>No</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ha Perdido la gratuidad</label>
				<select class="form-control input-sm" name="haPerdidoLaGratuidad">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->haPerdidoLaGratuidad == '1' ? 'selected' : ''}}>Si</option>
					<option value='2' {{$data->haPerdidoLaGratuidad == '2' ? 'selected' : ''}}>No</option>
					<option value='3' {{$data->haPerdidoLaGratuidad == '3' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Realizo Practicas pre profesionales </label>
				<select class="form-control input-sm" name="haRealizadoPracticasPreprofesionales" id="haRealizadoPracticasPreprofesionales">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->haRealizadoPracticasPreprofesionales == '1' ? 'selected' : ''}}>Si</option>
					<option value='2' {{$data->haRealizadoPracticasPreprofesionales == '2' ? 'selected' : ''}}>No </option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">sector economico donde realizo las practicas pre profesionales</label>
				<select class="form-control input-sm" name="sectorEconomicoPracticaProfesional" id="sectorEconomicoPracticaProfesional">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->sectorEconomicoPracticaProfesional == '1' ? 'selected' : ''}}>Agricultura, ganaderia, silvicultura y pesca</option>
					<option value='2' {{$data->sectorEconomicoPracticaProfesional == '2' ? 'selected' : ''}}>Explotacion de minas y canteras</option>
					<option value='3' {{$data->sectorEconomicoPracticaProfesional == '3' ? 'selected' : ''}}>Industrias manofactureras</option>
					<option value='4' {{$data->sectorEconomicoPracticaProfesional == '4' ? 'selected' : ''}}>Suministro de electricidad, gas vapor y aire acondicionado</option>
					<option value='5' {{$data->sectorEconomicoPracticaProfesional == '5' ? 'selected' : ''}}>Distribucion de agua; alcantarillado, gestion de desechos y actividades de sanamiento </option>
					<option value='6' {{$data->sectorEconomicoPracticaProfesional == '6' ? 'selected' : ''}}>Construccion</option>
					<option value='7' {{$data->sectorEconomicoPracticaProfesional == '7' ? 'selected' : ''}}>Comercio al por mayor y menor reparacion de vehiculos automoteres y motocicletas</option>
					<option value='9' {{$data->sectorEconomicoPracticaProfesional == '9' ? 'selected' : ''}}>Transporte y almacenamiento</option>
					<option value='10' {{$data->sectorEconomicoPracticaProfesional == '10' ? 'selected' : ''}}>Actividades de alojamiento y de servicios de comidas</option>
					<option value='11' {{$data->sectorEconomicoPracticaProfesional == '11' ? 'selected' : ''}}>Informacion y comunicacion</option>
					<option value='12' {{$data->sectorEconomicoPracticaProfesional == '12' ? 'selected' : ''}}>Actividades financieras y de seguros</option>
					<option value='13' {{$data->sectorEconomicoPracticaProfesional == '13' ? 'selected' : ''}}>Actividadesde inmobiliarias</option>
					<option value='14' {{$data->sectorEconomicoPracticaProfesional == '14' ? 'selected' : ''}}>Actividades profesionales, cientificas y tecnicas</option>
					<option value='15' {{$data->sectorEconomicoPracticaProfesional == '15' ? 'selected' : ''}}>Actividades de servicios asministrativos y de apoyo</option>
					<option value='16' {{$data->sectorEconomicoPracticaProfesional == '16' ? 'selected' : ''}}>Administracion publica y defensa; planes de seguridad social de afiliacion obligartoria</option>
					<option value='17' {{$data->sectorEconomicoPracticaProfesional == '17' ? 'selected' : ''}}>Enseñanza</option>
					<option value='18' {{$data->sectorEconomicoPracticaProfesional == '18' ? 'selected' : ''}}>Actividades de atencion de la salud humana y de asistencia social </option>
					<option value='19' {{$data->sectorEconomicoPracticaProfesional == '19' ? 'selected' : ''}}>Artes, entretenimiento y recreacion</option>
					<option value='20' {{$data->sectorEconomicoPracticaProfesional == '20' ? 'selected' : ''}}>Otras actividades de servicios</option>
					<option value='21' {{$data->sectorEconomicoPracticaProfesional == '21' ? 'selected' : ''}}>Actividades de los hogares como productores de vienes y servicios para uso propio</option>
					<option value='22' {{$data->sectorEconomicoPracticaProfesional == '22' ? 'selected' : ''}}>No aplica</option>


				</select>
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">horas de la ultima practica pre profesional que realizo<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="nroHorasPracticasPreprofesionalesPorPeriodo" id="nroHorasPracticasPreprofesionalesPorPeriodo" maxlength="100" placeholder="duracion del periodo academico" value="{{old('apellidos', $data->nroHorasPracticasPreprofesionalesPorPeriodo)}}">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo De institusion donde realizo las practicas pre profesionales</label>
				<select class="form-control input-sm" name="entornoInstitucionalPracticasProfesionales" id="entornoInstitucionalPracticasProfesionales">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->entornoInstitucionalPracticasProfesionales == '1' ? 'selected' : ''}}>Publica</option>
					<option value='2' {{$data->entornoInstitucionalPracticasProfesionales == '2' ? 'selected' : ''}}>Privada</option>
					<option value='3' {{$data->entornoInstitucionalPracticasProfesionales == '3' ? 'selected' : ''}}>ONG</option>
					<option value='4' {{$data->entornoInstitucionalPracticasProfesionales == '4' ? 'selected' : ''}}>Otro</option>
					<option value='5' {{$data->entornoInstitucionalPracticasProfesionales == '5' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">ha participado durante el periodo de un proyecto de vinculacion social </label>
				<select class="form-control input-sm" name="participaEnProyectoVinculacionSociedad" id="participaEnProyectoVinculacionSociedad">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->participaEnProyectoVinculacionSociedad == '1' ? 'selected' : ''}}>Si</option>
					<option value='2' {{$data->participaEnProyectoVinculacionSociedad == '2' ? 'selected' : ''}}>No</option>
					<option value='3' {{$data->participaEnProyectoVinculacionSociedad == '3' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">alcance del proyecto de vinculacion con la sociedad </label>
				<select class="form-control input-sm" name="tipoAlcanceProyectoVinculacionId" id="tipoAlcanceProyectoVinculacionId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->tipoAlcanceProyectoVinculacionId == '1' ? 'selected' : ''}}>Nacional</option>
					<option value='2' {{$data->tipoAlcanceProyectoVinculacionId == '2' ? 'selected' : ''}}>Provincial</option>
					<option value='3' {{$data->tipoAlcanceProyectoVinculacionId == '3' ? 'selected' : ''}}>Cantonal</option>
					<option value='4' {{$data->tipoAlcanceProyectoVinculacionId == '4' ? 'selected' : ''}}>Parroquial</option>
					<option value='5' {{$data->tipoAlcanceProyectoVinculacionId == '5' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>

		</div>
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INFORMACIÓN DE SOCIO ECONOMICA</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">recibe pension diferenciada</label>
				<select class="form-control input-sm" name="recibePensionDiferenciada" id="recibePensionDiferenciada">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->recibePensionDiferenciada == '1' ? 'selected' : ''}}>Si</option>
					<option value='2' {{$data->recibePensionDiferenciada == '2' ? 'selected' : ''}}>No</option>
					<option value='3' {{$data->recibePensionDiferenciada == '3' ? 'selected' : ''}}>No Aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">ocupacion</label>
				<select class="form-control input-sm" name="estudianteocupacionId" id="estudianteocupacionId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->estudianteocupacionId == '1' ? 'selected' : ''}}>Solo estudia</option>
					<option value='2' {{$data->estudianteocupacionId == '2' ? 'selected' : ''}}>Trabaja y Estudia </option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">ingresos estudiante</label>
				<select class="form-control input-sm" name="ingresosestudianteId" id="ingresosestudianteId" required>
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->ingresosestudianteId == '1' ? 'selected' : ''}}>Financiar sus estudios</option>
					<option value='2' {{$data->ingresosestudianteId == '2' ? 'selected' : ''}}>Para mantener a su hogar </option>
					<option value='3' {{$data->ingresosestudianteId == '3' ? 'selected' : ''}}>Gastos personales</option>
					<option value='4' {{$data->ingresosestudianteId == '4' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Su familia recibe bono de desarrollo humano </label>
				<select class="form-control input-sm" name="bonodesarrolloId" id="bonodesarrolloId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->bonodesarrolloId == '1' ? 'selected' : ''}}>Si</option>
					<option value='2' {{$data->bonodesarrolloId == '2' ? 'selected' : ''}}>No </option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">ingresos del hogar<span></label>
				<input type="text" class="form-control input-sm" name="ingresoTotalHogar" id="ingresoTotalHogar" maxlength="100" placeholder="ingrese un valor" value="{{old('direccion', $data->ingresoTotalHogar)}}" required>

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">numero de miembros del hogar<span></label>
				<input type="text" class="form-control input-sm" name="cantidadMiembrosHogar" id="cantidadMiembrosHogar" maxlength="100" placeholder="ingrese un valor" value="{{old('direccion', $data->cantidadMiembrosHogar)}}">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">nivel de formacion del padre</label>
				<select class="form-control input-sm" name="nivelFormacionPadre" id="nivelFormacionPadre">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->nivelFormacionPadre == '1' ? 'selected' : ''}}>Centro de alfabetizacion</option>
					<option value='2' {{$data->nivelFormacionPadre == '2' ? 'selected' : ''}}>Jardin de infantes</option>
					<option value='3' {{$data->nivelFormacionPadre == '3' ? 'selected' : ''}}>Primaria</option>
					<option value='4' {{$data->nivelFormacionPadre == '4' ? 'selected' : ''}}>Educacion basica</option>
					<option value='5' {{$data->nivelFormacionPadre == '5' ? 'selected' : ''}}>Secundaria</option>
					<option value='6' {{$data->nivelFormacionPadre == '6' ? 'selected' : ''}}>Educacion media</option>
					<option value='7' {{$data->nivelFormacionPadre == '7' ? 'selected' : ''}}>Superior no universitaria</option>
					<option value='8' {{$data->nivelFormacionPadre == '8' ? 'selected' : ''}}>Superior universitaria</option>
					<option value='9' {{$data->nivelFormacionPadre == '9' ? 'selected' : ''}}>Posgrado</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">nivel de formacion de la madre</label>
				<select class="form-control input-sm" name="nivelFormacionMadre" id="nivelFormacionMadre">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->nivelFormacionMadre == '1' ? 'selected' : ''}}>Centro de alfabetizacion</option>
					<option value='2' {{$data->nivelFormacionMadre == '2' ? 'selected' : ''}}>Jardin de infantes</option>
					<option value='3' {{$data->nivelFormacionMadre == '3' ? 'selected' : ''}}>Primaria</option>
					<option value='4' {{$data->nivelFormacionMadre == '4' ? 'selected' : ''}}>Educacion basica</option>
					<option value='5' {{$data->nivelFormacionMadre == '5' ? 'selected' : ''}}>Secundaria</option>
					<option value='6' {{$data->nivelFormacionMadre == '6' ? 'selected' : ''}}>Educacion media</option>
					<option value='7' {{$data->nivelFormacionMadre == '7' ? 'selected' : ''}}>Superior no universitaria</option>
					<option value='8' {{$data->nivelFormacionMadre == '8' ? 'selected' : ''}}>Superior universitaria</option>
					<option value='9' {{$data->nivelFormacionMadre == '9' ? 'selected' : ''}}>Posgrado</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo de vivienda</label>
				<select class="form-control js-example-basic-single" name="tipo_ivienda" id="tipo_ivienda" class="form-control">
					<!--<option>Seleccione</option>-->
					@foreach($tipo_vivienda as $key => $tip)
					<option value="{{ $tip }}" {{$data->tipoVivienda == $tip ? 'selected' : ''}}> {{ $tip }} </option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Domicilio Telefono</label>
				<input type="text" class="form-control input-sm" name="telefono" id="telefono" minlength="8" maxlength="10" placeholder="Teléfonos de la residencia o movil del estudiante" value="{{old('telefono', $data->telefono)}}">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>


		</div>
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">SECCION BECAS</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">tipo de beca que recibe </label>
				<select class="form-control input-sm" name="tipoBecaId" id="tipoBecaId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->tipoBecaId == '1' ? 'selected' : ''}}>Total</option>
					<option value='2' {{$data->tipoBecaId == '2' ? 'selected' : ''}}>Parcial</option>
					<option value='3' {{$data->tipoBecaId == '3' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">primera razon de la beca </label>
				<select class="form-control input-sm" name="primeraRazonBecaId" id="primeraRazonBecaId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->primeraRazonBecaId == '1' ? 'selected' : ''}}>Socioeconomica</option>
					<option value='2' {{$data->primeraRazonBecaId == '2' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">segunda razon de la beca </label>
				<select class="form-control input-sm" name="segundaRazonBecaId" id="segundaRazonBecaId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->segundaRazonBecaId == '1' ? 'selected' : ''}}>Excelencia academica</option>
					<option value='2' {{$data->segundaRazonBecaId == '2' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">tercera razon de la beca</label>
				<select class="form-control input-sm" name="terceraRazonBecaId" id="terceraRazonBecaId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->terceraRazonBecaId == '1' ? 'selected' : ''}}>Deportiva</option>
					<option value='2' {{$data->terceraRazonBecaId == '2' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">cuarta razon de la beca</label>
				<select class="form-control input-sm" name="cuartaRazonBecaId" id="cuartaRazonBecaId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->cuartaRazonBecaId == '1' ? 'selected' : ''}}>Pueblos y nacionalidades</option>
					<option value='2' {{$data->cuartaRazonBecaId == '2' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">quinta razon de la beca </label>
				<select class="form-control input-sm" name="quintaRazonBecaId" id="quintaRazonBecaId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->quintaRazonBecaId == '1' ? 'selected' : ''}}>Discapacidad</option>
					<option value='2' {{$data->quintaRazonBecaId == '2' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Sexta razon de la beca </label>
				<select class="form-control input-sm" name="sextaRazonBecaId" id="sextaRazonBecaId">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->sextaRazonBecaId == '1' ? 'selected' : ''}}>Otra</option>
					<option value='2' {{$data->sextaRazonBecaId == '2' ? 'selected' : ''}}>No aplica</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">porcentaje de la beca que cubre el valor del arancel<span class="valorError"></span></label>

				<select class="form-control input-sm" name="porcientoBecaCoberturaArancel" id="porcientoBecaCoberturaArancel">
					@foreach ($bod as $item)
						<option value='{{$item->valor}}' {{$data->porcientoBecaCoberturaArancel == $item->valor ? 'selected' : ''}}>{{$item->nombre}}</option>
					@endforeach
				</select>

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">porcentaje de la beca que cubre la manutencion<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="porcientoBecaCoberturaManuntencion" id="porcientoBecaCoberturaManuntencion" maxlength="100" placeholder="ingrese un valor" value="{{old('apellidos', $data->porcientoBecaCoberturaManuntencion)}}">

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">tipo de financiamiento de la beca</label>
				<select class="form-control input-sm" name="financiamientoBeca" id="financiamientoBeca">
					<!--<option>Seleccione</option>-->
					<option value='1' {{$data->financiamientoBeca == '1' ? 'selected' : ''}}>Fondos propios</option>
					<option value='2' {{$data->financiamientoBeca == '2' ? 'selected' : ''}}>Transferencia del estado</option>
					<option value='3' {{$data->financiamientoBeca == '3' ? 'selected' : ''}}>Donaciones</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">valor del monto de la ayuda economica<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="montoAyudaEconomica" id="montoAyudaEconomica" maxlength="100" placeholder="ingrese un valor" value="{{old('apellidos', $data->montoAyudaEconomica)}}">
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">valor del monto de credito educativo<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="montoCreditoEducativo" id="montoCreditoEducativo" maxlength="100" placeholder="ingrese un valor" value="{{old('apellidos', $data->montoCreditoEducativo)}}">

			</div>

			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>


		</div>
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">CONTACTOS DE EMERGENCIA</h3>
		</div>
		<div class="row">
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Primer Contacto Emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="contactoEmergencia" minlength="3" maxlength="100" placeholder="Nombres y Apellidos del contacto de emergencia" value="{{old('contactoEmergencia', $dataProfile->nombre_contacto_emergencia)}}">
			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono del contacto de emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="telefonoEmergencia" minlength="9" maxlength="10" placeholder="Teléfono del contacto para emergencias" value="{{old('telefonoEmergencia', $dataProfile->movil_contacto_emergencia)}}">

			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parentezco<span class="valorError">*</span></label>
				<select class="form-control" name="parentezco_contacto_emergencia">
					<option value="">Seleccione un parentezco...</option>
					@foreach (config('pined.parentezcos') as $parentezco)
					<option {{old('parentezco_contacto_emergencia') == $parentezco ? 'selected' : ''}} {{$dataProfile->parentezco_contacto_emergencia == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
					@endforeach

				</select>
			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Segundo Contacto Emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="contactoEmergencia2" minlength="3" maxlength="100" placeholder="Nombres y Apellidos del contacto de emergencia" value="{{old('contactoEmergencia', $dataProfile->nombre_contacto_emergencia2)}}">

			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono del contacto de emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="telefonoEmergencia2" minlength="9" maxlength="10" placeholder="Teléfono del contacto para emergencias" value="{{old('telefonoEmergencia', $dataProfile->movil_contacto_emergencia2)}}">

			</div>
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parentezco<span class="valorError">*</span></label>
				<select class="form-control" name="parentezco_contacto_emergencia2">
					<option value="">Seleccione un parentezco...</option>
					@foreach (config('pined.parentezcos') as $parentezco)
					<option {{old('parentezco_contacto_emergencia2') == $parentezco ? 'selected' : ''}} {{$dataProfile->parentezco_contacto_emergencia == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
					@endforeach
				</select>

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
		</div>
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INSTITUCIÓN ANTERIOR</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Institución Anterior</label>
				<input type="text" class="form-control input-sm" name="institucionAnterior" placeholder="Institución anterior, en caso que exista" value="{{old('institucionAnterior', $data->institucionAnterior)}}">

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Razones por el cambio</label>
				<input type="text" class="form-control input-sm" name="razon_Cambio" minlength="3" maxlength="250" placeholder="Razones de cambio, si existio" value="{{old('razonCambio', $data->razonCambio)}}">

			</div>
			<div class="col-lg-6 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Observaciones</label>
				<textarea class="form-control input-sm" name="observaciones" rows="4" cols="50">{{old('observaciones', $data->observaciones)}}</textarea>

			</div>
		</div>
		@if ($acceso == true)
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">ACCESO</h3>
		</div>
		<div class="row">
			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Correo</label>
				<input type="email" class="form-control input-sm" name="correo" placeholder="Correo del estudiante" value="{{old('correo', $data->profile->correo)}}">
			</div>

			<div class="col-lg-4 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Contraseña</label>
				<input type="text" class="form-control input-sm" name="password" placeholder="Contraseña..." value="">

			</div>



		</div>
		@endif
		@if ($configuracionPago->valor == '1')

		@else
		<input type="hidden" name="beca" value="0">
		<div></div>
		@endif

		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">PERIODO ACTUAL</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Bloqueo</label>
				<select class="form-control input-sm" name="bloqueado">
					<option default>Seleccione</option>
					<option value=1 {{ ($data->bloqueado == 1 ) ? ' selected' : '' }}>Bloqueado</option>
					<option value=0 {{ ($data->bloqueado == 0 ) ? ' selected' : '' }}>Desbloqueado</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo Bloqueo</label>
				<select id="tipo_bloqueo" class="form-control estudiantes" name="tipo_bloqueo[]" multiple="multiple">
					@foreach ($tipo_bloqueos as $bloqueo)
					<option @foreach ($dataProfile->bloqueos as $data_bloqueo)
						@if ($data_bloqueo->id == $bloqueo->id)
						selected
						@endif
						@endforeach
						value="{{$bloqueo->id}}">{{$bloqueo->nombre}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Actualizar desde admisión</label>
				<div class="matricula__radio-botones">
					<div class="flex items-center">
						<label for="condicionado_si">
							Si
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="actDesdeAdmisiones" id="actDesdeAdmisiones_si" value="0" @if ($dataProfile->actDesdeAdmisiones != null)
						{{$dataProfile->actDesdeAdmisiones == '0' ? 'checked' : ''}}
						@else
						checked
						@endif
						>
					</div>
					<div class="flex items-center matricula__radio-div">
						<label for="actDesdeAdmisiones_no">
							No
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="actDesdeAdmisiones" id="actDesdeAdmisiones_no" value="1" @if ($dataProfile->actDesdeAdmisiones != null)
						{{$dataProfile->actDesdeAdmisiones == '1' ? 'checked' : ''}}
						@endif
						>
					</div>
				</div>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo de matricula</label>
				<select id="estado_matricula" class="form-control input-sm" name="matricula">
					<option default>Seleccione</option>
					@if ($dataProfile->tipo_matricula == 'Pre Matricula')
					<option value="Pre Matricula" {{ 'Pre Matricula' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Pre-Matricula</option>
					@endif
					@if ($dataProfile->tipo_matricula == null)
					<option value="Pre Matricula" {{ 'Pre Matricula' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Pre-Matricula</option>
					@endif
					<option value="Ordinaria" {{ 'Ordinaria' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Ordinaria</option>
					<option value="Extraordinaria" {{ 'Extraordinaria' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Extraordinaria</option>
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Condicionado</label>
				<div class="matricula__radio-botones">
					<div class="flex items-center">
						<label for="condicionado_si">
							Si
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="condicionado" id="condicionado_si" value="Si" @if ($dataProfile->condicionado != null)
						{{$dataProfile->condicionado == 'Si' ? 'checked' : ''}}
						@endif
						>
					</div>
					<div class="flex items-center matricula__radio-div">
						<label for="condicionado_no">
							No
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="condicionado" id="condicionado_no" value="No" @if ($dataProfile->condicionado != null)
						{{$dataProfile->condicionado == 'No' ? 'checked' : ''}}
						@else
						checked
						@endif
						>
					</div>
				</div>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Carrera<span class="valorError">*</span></label>
				<select class="form-control input-sm" name="curso" id="matricula-curso">
					@foreach($careers as $career)
					<option value="{{ $career['id']}}" {{ $curso->id_career == $career['id'] ? 'selected' : '' }}>{{ $career ['nombre'] }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="matricula-paralelo" class="matricula__matriculacion-label">Paralelo<span class="valorError">*</span></label>
				<select class="form-control input-sm" name="paralelo" id="matricula-paralelo">
					<option value="" hidden></option>
					@foreach($courses as $cours)
						<option value="{{$cours['id']}}" hidden idCarrer="{{$cours['id_career']}}" {{$cours->id == $curso->id ? 'selected' : ''}}>{{ $cours ['paralelo'] }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				@if ($numeroMatricula == true)
				<label for="" class="matricula__matriculacion-label">Numero de Matricula</label>
				<input type="text" class="form-control input-sm" name="numeroMatricula" value="{{$dataProfile->numero_matriculacion ?? '-'}}">

				@endif
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				@if ($retirado == true)
				<label for="" class="matricula__matriculacion-label">Retirado</label>
				<select class="form-control input-sm" name="retirado">
					<option value="SI" {{$dataProfile->retirado == 'SI' ? 'selected' : ''}}>SI</option>
					<option value="NO" {{$dataProfile->retirado == 'NO' ? 'selected' : ''}}>NO</option>
				</select>
				@endif
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Observación del estudiante retirado</label>
				<textarea name="observacion_retirado" id="" cols="30" rows="5" class="form-control">{{old('observacion_retirado', $dataProfile->observacion_retirado)}}</textarea>

			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">documentos informacion</label>
				<textarea name="documentos_informacion" cols="30" rows="5" class="form-control">{{old('documentos_informacion', $dataProfile->documentos_informacion)}}</textarea>

			</div>

			<div class="col-lg-3 matricula__matriculacion__input">

			</div>
		</div>
	</div>










	<div class="text-right">
		@if($cxc == '' || $cxc == null)
			@if ($dataProfile->idCurso == !null && $configuracionTransporte->valor == '1')
				<input id="btn-matricular-estudiante" type="submit" class="mb-1 btn btn-primary btn-lg" value="{{$buttonCXC}}">
				<input type="hidden" name="cxcCrear" id="cxcCrear" value="1">
				<input type="hidden" name="cxcCrearID" id="cxcCrearID" value="{{$dataProfile->idStudent}}">
			@endif
		@endif

		@if($cxc != null)
		<!--
		@if ($dataProfile->idCurso == !null && $configuracionTransporte->valor == '1')
		
			<input 
			id="btn-matricular-estudiante"
			type="submit"
			class="mb-1 btn btn-primary btn-lg" 
			value="{{$button}}">
	</div>
			<input type="hidden" name="cxcCrear" style="display: none" id="cxcCrear" value="2">
			<input type="hidden" name="cxcCrearID" style="display: none" id="cxcCrearID" value="{{$dataProfile->idStudent}}">
		@endif	-->
		@endif


		<input id="btn-matricular-estudiante" type="submit" class="mb-1 btn btn-primary btn-lg" value="{{$button}}">
	</div>
	<div>
		@if ($reporte_pagos == true || $data == !false)
		<div class="dropdown">
			<button class="bg-none border-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img class="w-8" src="{{secure_asset('img/file-download.svg')}}" alt="">
			</button>
			<div class="dropdown-menu calificaciones__dropDown p-4" aria-labelledby="dropdownMenuButton" style="left: 6px; top: -103px; width: 277px;">
				<div class="calificaciones__dropDown-grid">
					@if (!$crear)
					<!--a href="{{route('hojaDeVida', $data->id)}}" class="calificaciones__dropDown__item-link">
					Hoja de vida
				</a>
				<a href="{{route('cerMatricula', $data->id)}}" class="calificaciones__dropDown__item-link">
					Certificado de Matrícula
				</a>
				<a href="{{route('certificadoAsistencia', $data->id)}}" class="calificaciones__dropDown__item-link">
					Certificado de Asistencia
				</a>
				<a href="{{route('certificadoEconomico', $data)}}" class="calificaciones__dropDown__item-link">
					Certificado Económico
				</a> -->
					@endif
					<a href="{{route('reporte.informacionPersonalMatricula', $data->id)}}" class="calificaciones__dropDown__item-link">
						Ficha de Datos
					</a>
					@if (!$crear)
					<!--  a href="{{route('reporte.actaDeMatricula', $data->id)}}" class="calificaciones__dropDown__item-link">
					Acta de Matrícula
				</a>
				<a href="{{route('reporte.solicitudDeMatricula', $data->id)}}" class="calificaciones__dropDown__item-link">
					Solicitud de matrícula
				</a>
				<a href="{{route('reporte.pagareConVencimiento', $data->id)}}" class="calificaciones__dropDown__item-link">
					Pagaré
				</a>
				<a href="{{route('reporte.noAceptacionDelSeguro', $data->id)}}" class="calificaciones__dropDown__item-link">
					No aceptación del seguro
				</a>
				<a href="{{route('reporte.autorizacionFotosVideos', $data->id)}}" class="calificaciones__dropDown__item-link">
					No Autorización de toma de Fotos y Videos
				</a>
				<a href="{{route('reporte.prestacionServiciosEducacionales', $data->id)}}" class="calificaciones__dropDown__item-link">
					Contrato de Servicios
				</a>
				<a href="{{route('reporte.registroDeIngresoYSalidaDeEstudiantes', $data->id)}}" class="calificaciones__dropDown__item-link">
					Autorización de Movilización
				</a> -->
					@endif
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
</div>

<script>
	/*Funcion para cambiar el label de cedula y pasaporte*/
	function ShowSelected() {
		/* Para obtener el valor */
		var cod = document.getElementById("ci").value;
		var txt = document.getElementById("cedula_pasaporte").value;
		/* Para obtener el texto */
		var combo = document.getElementById("ci");
		if (combo.options[combo.selectedIndex].value == 1) {
			document.getElementById('cedula_pasaporte').innerText = "Cedula *";
		} else if (combo.options[combo.selectedIndex].value == 2) {
			document.getElementById('cedula_pasaporte').innerText = "Pasaporte *";
		} else {
			document.getElementById('cedula_pasaporte').innerText = "Cedula / Pasaporte *";
		}
	}
	/*Funcionalidad para cambiar el geenera al seleccionar un sexo*/
	$('#sexo').change(function(e) {
		sexo();
	});
	$('#sexo').ready(function(e) {
		sexo();
	});
	const sexo = () =>{
		if ($(this).val() == "1") {
			$('#genero option[value=1]').attr("selected", true);
		} else {
			$('#genero option[value=2]').attr("selected", true);

		}
	}
	/*Funcion al escoger el pueblo y nacinalidad*/
	$('#Etnia_Estudiante').ready(function(e) {
		etniaestudiante();
	});
	$('#Etnia_Estudiante').change(function(e) {
		etniaestudiante();
	});
	const etniaestudiante = () => {
		if ($(this).val() == "1") {
			$('#pueblo_nacionalidad option[value=""]').attr("selected", true);
		} else {
			$('#pueblo_nacionalidad option[value=34]').attr("selected", true);

		}
	}

	/*Desabilitadar los campos al seleccionar NO tiene discapacidad */
	
	$('#tiene_discapacidad').ready(function(e) {
		tienediscapacidad();
	});
	$('#tiene_discapacidad').change(function(e) {
		tienediscapacidad();
	});

	const tienediscapacidad = () => {
		if ($('#tiene_discapacidad').val() === "1") {
			$('#Carnet_CONADIS').prop("disabled", false);
			$('#porcentaje_discapacidad').prop("disabled", false);
			$('#Tipo_discapacidad').prop("disabled", false);
			$('#Tipo_discapacidad option[value=""]').attr("selected", true);
			$('#Tipo_enfermedad_catastrófica').prop("disabled", false);
			$('#Tipo_enfermedad_catastrófica option[value=""]').attr("selected", true);

		} else {
			$('#Carnet_CONADIS').prop("disabled", true).attr("value", "NA");
			$('#porcentaje_discapacidad').prop("disabled", true).attr("value", "NA");
			$('#Tipo_discapacidad option[value=7]').attr("selected", true);
			$('#Tipo_discapacidad ').prop("disabled", true);
			$('#Tipo_enfermedad_catastrófica option[value=6]').attr("selected", true);
			$('#Tipo_enfermedad_catastrófica ').prop("disabled", true);
		}
	}


	/*Desabilitadar los campos al seleccionar un pais diferente a Ecuador */
	$('#pais_nacimiento').ready(function(e) {
		paisnacimiento();
	});
	$('#pais_nacimiento').change(function(e) {
		paisnacimiento();
	});

	const paisnacimiento = () => {
		if ($('#pais_nacimiento').val() === "56") {
			$('#fecha_ingreso_pais').prop("disabled", true);
			$('#fecha_expiracion_pasaporteDT').prop("disabled", true);
			$('#fecha_caducidad_pasaporteDT').prop("disabled", true);
			$('#provincia_nacimiento').prop("disabled", false);
			$('#canton_nacimiento').prop("disabled", false);


		} else {
			$('#fecha_ingreso_pais').prop("disabled", false);
			$('#fecha_expiracion_pasaporteDT').prop("disabled", false);
			$('#fecha_caducidad_pasaporteDT').prop("disabled", false);
			$('#provincia_nacimiento').prop("disabled", true);
			$('#canton_nacimiento').prop("disabled", true);
			//$('#fecha_expiracion_pasaporte').prop("disabled", true).attr("value","NA");
		}
	}

	$('#pais_recidencia').change(function(e) {
		paisresidencia();
	});
	$('#pais_recidencia').ready(function(e) {
		paisresidencia();
	});
	
	const paisresidencia = () =>{
		if ($('#pais_recidencia') === "56") {
			$('#provincia_recidencia').prop("disabled", false);
			$('#canton_recidencia').prop("disabled", false);


		} else {
			$('#provincia_recidencia').prop("disabled", true);
			$('#canton_recidencia').prop("disabled", true);
			//$('#fecha_expiracion_pasaporte').prop("disabled", true).attr("value","NA");
		}
	}

	$('#haRealizadoPracticasPreprofesionales').ready(function(e) {
		haRealizadoPracticasPreprofesionales();
	});

	$('#haRealizadoPracticasPreprofesionales').change(function(e) {
		haRealizadoPracticasPreprofesionales();
	});
	
	const haRealizadoPracticasPreprofesionales = () =>{
		if ($('#haRealizadoPracticasPreprofesionales').val() === "1") {
			$('#sectorEconomicoPracticaProfesional').prop("disabled", false);
			$('#nroHorasPracticasPreprofesionalesPorPeriodo').prop("disabled", false);
			$('#entornoInstitucionalPracticasProfesionales').prop("disabled", false);


		} else {
			$('#sectorEconomicoPracticaProfesional').prop("disabled", true);
			$('#nroHorasPracticasPreprofesionalesPorPeriodo').prop("disabled", true);
			$('#entornoInstitucionalPracticasProfesionales').prop("disabled", true);
		}
	}

	$('#participaEnProyectoVinculacionSociedad').change(function(e) {
		participaEnProyectoVinculacionSociedad();
	});
	$('#participaEnProyectoVinculacionSociedad').ready(function(e) {
		participaEnProyectoVinculacionSociedad();
	});
	
	const participaEnProyectoVinculacionSociedad = () => {
		if ($('#participaEnProyectoVinculacionSociedad').val() === "1") {
			$('#tipoAlcanceProyectoVinculacionId').prop("disabled", false);

		} else {
			$('#tipoAlcanceProyectoVinculacionId').prop("disabled", true);

		}
	}

	$('#tipoBecaId').ready(function(e) {
		tipoBecaId();
	});
	$('#tipoBecaId').change(function(e) {
		tipoBecaId();
	});

	const tipoBecaId = () =>{
		if ($('#tipoBecaId').val() === "1" || $('#tipoBecaId').val() === "2") {
			$('#primeraRazonBecaId').prop("disabled", false);
			$('#segundaRazonBecaId').prop("disabled", false);
			$('#terceraRazonBecaId').prop("disabled", false);
			$('#cuartaRazonBecaId').prop("disabled", false);
			$('#quintaRazonBecaId').prop("disabled", false);
			$('#sextaRazonBecaId').prop("disabled", false);
			$('#porcientoBecaCoberturaArancel').prop("disabled", false);
			$('#porcientoBecaCoberturaManuntencion').prop("disabled", false);
			$('#financiamientoBeca').prop("disabled", false);
			$('#montoAyudaEconomica').prop("disabled", false);
			$('#montoCreditoEducativo').prop("disabled", false);


		} else {
			$('#primeraRazonBecaId').prop("disabled", true).attr("value", "2");
			$('#segundaRazonBecaId').prop("disabled", true).attr("value", "2");
			$('#terceraRazonBecaId').prop("disabled", true).attr("value", "2");
			$('#cuartaRazonBecaId').prop("disabled", true).attr("value", "2");
			$('#quintaRazonBecaId').prop("disabled", true).attr("value", "2");
			$('#sextaRazonBecaId').prop("disabled", true).attr("value", "2");
			$('#porcientoBecaCoberturaArancel').prop("disabled", true).attr("value", "NA");
			$('#porcientoBecaCoberturaManuntencion').prop("disabled", true).attr("value", "NA");
			$('#financiamientoBeca').prop("disabled", true).attr("value", "NA");
			$('#montoAyudaEconomica').prop("disabled", true).attr("value", "NA");
			$('#montoCreditoEducativo').prop("disabled", true).attr("value", "NA");
		}
	}
	var queryString = window.location.search;
	var urlParams = new URLSearchParams(queryString);
	var id_curso = urlParams.get('idCarrera');
	var idCursoCombo = document.getElementById('matricula-curso').value;

	document.ready = document.getElementById("matricula-curso").value = id_curso;
</script>

<script>
	$('#matricula-curso').change(function() {
		for(let i = 0 ; i < $('#matricula-paralelo')[0].length ; i++){
			if($(($('#matricula-paralelo')[0])[i]).attr('idcarrer') === $(this).val()){
				$(($('#matricula-paralelo')[0])[i]).prop('hidden', false);
			}else{
				$(($('#matricula-paralelo')[0])[i]).prop('hidden', true);
			}
		}
	});
</script>