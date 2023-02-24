<div class="panel pl-8 pr-8 matricula__matriculacion">
	<div class="matricula__matriculacion-block">
	<h3 class="matricula__matriculacion-title">DATOS BÁSICOS</h3>
	</div>
	<div > 
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Celular</label>
				<input type="text" class="form-control input-sm" name="celular_estudiante" placeholder="Celular del estudiante" value="{{old('celular_estudiante', $dataProfile->celular)}}">	
			</div>

			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Estado Civil</label>
				<select class="form-control input-sm" name="Estado_Civil" >
					<option > Seleccione</option>
					<option value="1" {{$dataProfile->estado_civil == '1' ? 'selected' : ''}}>Soltero/a</option>
					<option value="2" {{$dataProfile->estado_civil == '2' ? 'selected' : ''}}>Casado/a</option>
					<option value="3" {{$dataProfile->estado_civil == '3' ? 'selected' : ''}}>Divorciado/a</option>
					<option value="4" {{$dataProfile->estado_civil == '4' ? 'selected' : ''}}>Unión Libre</option>
					<option value="5" {{$dataProfile->estado_civil == '5' ? 'selected' : ''}}>Viudo/a</option>
				</select>	
			</div>
			
			<div class="col-lg-6 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Correo Electronico Personal</label>
				<input type="email" class="form-control input-sm" name="correo_personal" placeholder="Celular del estudiante" value="{{old('celular_estudiante', $data->facturacion_correo)}}">		
			</div>
			
	
		</div>
		

		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">NACIONALIDAD</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Etnia Estudiante</label>
				<select class="form-control input-sm" name="Etnia_Estudiante" id="Etnia_Estudiante">
					<option value="default"> Seleccione </option>
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
				<select class="form-control input-sm" name="pueblo_nacionalidad" id="pueblo_nacionalidad">
					<option value=""> Seleccione </option>
					@foreach ($pueblos_nacionalidades as $item)
					<option value="{{$item->id}}" {{$dataProfile->pueblo_nacionalidad == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			
		</div>

		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INFORMACIÓN DE RESIDENCIA</h3>
		</div>
		<div class="row">
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Pais Recidencia</label>
				<select class="form-control input-sm" name="pais_recidencia" id="pais_recidencia">
					<option value=""> Seleccione </option>
					@foreach ($paises as $item)
					<option value="{{$item->id}}" {{$dataProfile->pais_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Provincia de Recidencia</label>
				<select class="form-control input-sm" name="provincia_recidencia" id="provincia_recidencia">
					<option value=""> Seleccione </option>
					@foreach ($provincias as $item)
					<option value="{{$item->id}}" {{$dataProfile->provincia_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Canton de Recidencia</label>
				<select class="form-control input-sm" name="canton_recidencia" id="canton_recidencia">
					<option value=""> Seleccione </option>
					@foreach ($cantones as $item)
					<option value="{{$item->id}}" {{$dataProfile->canton_residencia == $item->id ? 'selected' : ''}}>{{$item->etiqueta}}</option>
					@endforeach
				</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ciudad de Recidencia<span class="valorError">*</span></label>
					<input type="text" class="form-control input-sm" name="ciudad"  maxlength="100" placeholder="Ciudad de Recidencia del estudiante" value="{{old('direccion', $dataProfile->ciudad_domicilio)}}" required>
			</div>
			<div class="col-lg-12 matricula__matriculacion__input">
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Dirección Domicilio<span class="valorError">*</span></label>
					<input type="text" class="form-control input-sm" name="direccion"  maxlength="100" placeholder="Direccion del domicilio del estudiante" value="{{old('direccion', $dataProfile->direccion_domicilio)}}" required>
			</div>
			</div>
		</div>	
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">INFORMACIÓN DE ACADEMICA</h3>
		</div>
		<div class="row">

			
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Realizo Practicas pre profesionales </label>
				<select class="form-control input-sm" name="haRealizadoPracticasPreprofesionales" id="haRealizadoPracticasPreprofesionales">
					<option default>Seleccione</option>
					<option value='1' {{$data->haRealizadoPracticasPreprofesionales == '1' ? 'selected' : ''}}>Si</option>
					<option value='2' {{$data->haRealizadoPracticasPreprofesionales == '2' ? 'selected' : ''}}>No </option>
					</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">sector economico donde realizo las practicas pre profesionales</label>
				<select class="form-control input-sm" name="sectorEconomicoPracticaProfesional" id="sectorEconomicoPracticaProfesional">
					<option default>Seleccione</option>
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
                    <option value='16'{{$data->sectorEconomicoPracticaProfesional == '16' ? 'selected' : ''}}>Administracion publica y defensa; planes de seguridad social de afiliacion obligartoria</option>
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
				<input type="text" class="form-control input-sm" name="nroHorasPracticasPreprofesionalesPorPeriodo" id="nroHorasPracticasPreprofesionalesPorPeriodo" maxlength="100" placeholder="duracion del periodo academico" value="{{old('apellidos', $data->nroHorasPracticasPreprofesionalesPorPeriodo)}}" >
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo De institusion donde realizo las practicas pre profesionales</label>
				<select class="form-control input-sm" name="entornoInstitucionalPracticasProfesionales" id="entornoInstitucionalPracticasProfesionales">
					<option default>Seleccione</option>
					<option value='1' {{$data->entornoInstitucionalPracticasProfesionales == '1' ? 'selected' : ''}}>Publica</option>
					<option value='2' {{$data->entornoInstitucionalPracticasProfesionales == '2' ? 'selected' : ''}}>Privada</option>
					<option value='3' {{$data->entornoInstitucionalPracticasProfesionales == '3' ? 'selected' : ''}}>ONG</option>
					<option value='4' {{$data->entornoInstitucionalPracticasProfesionales == '4' ? 'selected' : ''}}>Otro</option>
					<option value='5' {{$data->entornoInstitucionalPracticasProfesionales == '5' ? 'selected' : ''}}>No aplica</option>
					</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">ha participado durante el periodo de un proyecto de vinculacion social  </label>
				<select class="form-control input-sm" name="participaEnProyectoVinculacionSociedad" id="participaEnProyectoVinculacionSociedad" >
					<option default>Seleccione</option>
					<option value='1' {{$data->participaEnProyectoVinculacionSociedad == '1' ? 'selected' : ''}}>Si</option>
					<option value='2' {{$data->participaEnProyectoVinculacionSociedad == '2' ? 'selected' : ''}}>No</option>
					<option value='3' {{$data->participaEnProyectoVinculacionSociedad == '3' ? 'selected' : ''}}>No aplica</option>
					</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">alcance del proyecto de vinculacion con la sociedad </label>
				<select class="form-control input-sm" name="tipoAlcanceProyectoVinculacionId" id="tipoAlcanceProyectoVinculacionId">
					<option default>Seleccione</option>
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
				<label for="" class="matricula__matriculacion-label">ocupacion</label>
				<select class="form-control input-sm" name="estudianteocupacionId" id="estudianteocupacionId" >
					<option default>Seleccione</option>
					<option value='1' {{$data->estudianteocupacionId == '1' ? 'selected' : ''}}>Solo estudia</option>
					<option value='2' {{$data->estudianteocupacionId == '2' ? 'selected' : ''}}>Trabaja y Estudia </option>
					</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">ingresos estudiante</label>
				<select class="form-control input-sm" name="ingresosestudianteId"  id="ingresosestudianteId">
					<option default>Seleccione</option>
					<option value='1' {{$data->ingresosestudianteId == '1' ? 'selected' : ''}}>Financiar sus estudios</option>
					<option value='2' {{$data->ingresosestudianteId == '2' ? 'selected' : ''}}>Para mantener a su hogar </option>
					<option value='3' {{$data->ingresosestudianteId == '3' ? 'selected' : ''}}>Gastos personales</option>
					<option value='4' {{$data->ingresosestudianteId == '4' ? 'selected' : ''}}>No aplica</option>
					</select>	
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Su familia recibe bono de desarrollo humano </label>
				<select class="form-control input-sm" name="bonodesarrolloId" id="bonodesarrolloId">
					<option default>Seleccione</option>
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
				<input type="text" class="form-control input-sm" name="cantidadMiembrosHogar" id="cantidadMiembrosHogar" maxlength="100" placeholder="ingrese un valor" value="{{old('direccion', $data->cantidadMiembrosHogar)}}" >
			</div>
			<div class="col-lg-3 matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">nivel de formacion del padre</label>
				<select class="form-control input-sm" name="nivelFormacionPadre" id="nivelFormacionPadre">
					<option default>Seleccione</option>
					<option value='1'  {{$data->nivelFormacionPadre == '1' ? 'selected' : ''}}>Centro de alfabetizacion</option>
					<option value='2'  {{$data->nivelFormacionPadre == '2' ? 'selected' : ''}}>Jardin de infantes</option>
					<option value='3'  {{$data->nivelFormacionPadre == '3' ? 'selected' : ''}}>Primaria</option>
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
					<option default>Seleccione</option>
					<option value='1'  {{$data->nivelFormacionMadre == '1' ? 'selected' : ''}}>Centro de alfabetizacion</option>
					<option value='2'  {{$data->nivelFormacionMadre == '2' ? 'selected' : ''}}>Jardin de infantes</option>
					<option value='3'  {{$data->nivelFormacionMadre == '3' ? 'selected' : ''}}>Primaria</option>
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
					<option default>Seleccione</option>
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
		<input 
			id="btn-matricular-estudiante"
			type="submit"
			class="mb-1 btn btn-primary btn-lg" 
			value="{{$button}}">
	</div>

</div>
</div>
	
	<script>
		/*Funcion para cambiar el label de cedula y pasaporte*/
	function ShowSelected() { /* Para obtener el valor */
		var cod = document.getElementById("ci").value;
		var txt = document.getElementById("cedula_pasaporte").value;  
		/* Para obtener el texto */
		var combo = document.getElementById("ci");
		if(combo.options[combo.selectedIndex].value == 1){
			document.getElementById('cedula_pasaporte').innerText = "Cedula *";
		}else if(combo.options[combo.selectedIndex].value == 2){
			document.getElementById('cedula_pasaporte').innerText = "Pasaporte *";
		}else{
			document.getElementById('cedula_pasaporte').innerText = "Cedula / Pasaporte *";
		}
	}
	/*Funcionalidad para cambiar el geenera al seleccionar un sexo*/
	
	$(document).ready(function() {
    $('#sexo').change(function(e) {
        if ($(this).val() == "1") {
			$('#genero option[value=1]').attr("selected",true);
        }else{
			$('#genero option[value=2]').attr("selected",true);
			
		}
    })
	});

		/*Funcion al escoger el pueblo y nacinalidad*/
		$(document).ready(function() {
    $('#Etnia_Estudiante').change(function(e) {
        if ($(this).val() == "1") {
			$('#pueblo_nacionalidad option[value=""]').attr("selected",true);
        }else{
			$('#pueblo_nacionalidad option[value=34]').attr("selected",true);
			
		}
    })
	});

	/*Desabilitadar los campos al seleccionar NO tiene discapacidad */
	$(document).ready(function() {
    $('#tiene_discapacidad').change(function(e) {
        if ($(this).val() === "1") {
			$('#Carnet_CONADIS').prop("disabled", false);
			$('#porcentaje_discapacidad').prop("disabled", false);
			$('#Tipo_discapacidad').prop("disabled", false);
			$('#Tipo_discapacidad option[value=""]').attr("selected",true);
			$('#Tipo_enfermedad_catastrófica').prop("disabled", false);
			$('#Tipo_enfermedad_catastrófica option[value=""]').attr("selected",true);
			
        } else {
			$('#Carnet_CONADIS').prop("disabled", true).attr("value","NA");
			$('#porcentaje_discapacidad').prop("disabled", true).attr("value","NA");
            $('#Tipo_discapacidad option[value=7]').attr("selected",true);
			$('#Tipo_discapacidad ').prop("disabled", true);
			$('#Tipo_enfermedad_catastrófica option[value=6]').attr("selected",true);
			$('#Tipo_enfermedad_catastrófica ').prop("disabled", true);

			
        }
    })
	});

	/*Desabilitadar los campos al seleccionar un pais diferente a Ecuador */
	$(document).ready(function() {
    $('#pais_nacimiento').change(function(e) {
        if ($(this).val() === "56") {
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
    })
	});


	$(document).ready(function() {
    $('#pais_recidencia').change(function(e) {
        if ($(this).val() === "56") {	
			$('#provincia_recidencia').prop("disabled", false);
			$('#canton_recidencia').prop("disabled", false);
			
			
        } else {
			$('#provincia_recidencia').prop("disabled", true);
			$('#canton_recidencia').prop("disabled", true);
			//$('#fecha_expiracion_pasaporte').prop("disabled", true).attr("value","NA");
        }
    })
	});
	$(document).ready(function() {
    $('#haRealizadoPracticasPreprofesionales').change(function(e) {
        if ($(this).val() === "1") {	
			$('#sectorEconomicoPracticaProfesional').prop("disabled", false);
			$('#nroHorasPracticasPreprofesionalesPorPeriodo').prop("disabled", false);
			$('#entornoInstitucionalPracticasProfesionales').prop("disabled", false);
			
			
        } else {
			$('#sectorEconomicoPracticaProfesional').prop("disabled", true);
			$('#nroHorasPracticasPreprofesionalesPorPeriodo').prop("disabled", true);
			$('#entornoInstitucionalPracticasProfesionales').prop("disabled", true);
        }
    })
	});

	$(document).ready(function() {
    $('#participaEnProyectoVinculacionSociedad').change(function(e) {
        if ($(this).val() === "1") {	
			$('#tipoAlcanceProyectoVinculacionId').prop("disabled", false);
						
        } else {
			$('#tipoAlcanceProyectoVinculacionId').prop("disabled", true);
			
        }
    })
	});

	
	$(document).ready(function() {
    $('#tipoBecaId').change(function(e) {
        if ($(this).val() === "1" || $(this).val() === "2") {	
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
			$('#primeraRazonBecaId').prop("disabled", true).attr("value","2");
			$('#segundaRazonBecaId').prop("disabled", true).attr("value","2");
			$('#terceraRazonBecaId').prop("disabled", true).attr("value","2");
			$('#cuartaRazonBecaId').prop("disabled", true).attr("value","2");
			$('#quintaRazonBecaId').prop("disabled", true).attr("value","2");
			$('#sextaRazonBecaId').prop("disabled", true).attr("value","2");
			$('#porcientoBecaCoberturaArancel').prop("disabled", true).attr("value","NA");
			$('#porcientoBecaCoberturaManuntencion').prop("disabled", true).attr("value","NA");
			$('#financiamientoBeca').prop("disabled", true).attr("value","NA");
			$('#montoAyudaEconomica').prop("disabled", true).attr("value","NA");
			$('#montoCreditoEducativo').prop("disabled", true).attr("value","NA");
			
        }
    })
	});


	var queryString = window.location.search;
	var urlParams = new URLSearchParams(queryString);
	var id_curso = urlParams.get('idCarrera');
	var idCursoCombo = document.getElementById('matricula-curso').value;
	
	document.ready = document.getElementById("matricula-curso").value = id_curso;
	
	

</script>