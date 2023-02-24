<form method="post" action="{{ route('administrativos_update_post', $data->id) }}" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row wrapper white-bg">
	    <div class="col-lg-12">
	        <h2 class="title-page">{{$data->cargo}}:
	            <small class="uppercase">{{$data->nombres}} {{$data->apellidos}}</small>
	        </h2>
	    </div>
	</div>
	<div class="panel mt-1 pl-1 pr-1 matricula__matriculacion">
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">General</h3>
			<div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Cédula/Pasaporte</label>
					<input type="text" class="form-control input-sm" name="ci" min="10" maxlength="10" value="{{$data->ci}}" required>
				</div>
				<div></div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Apellidos</label>
					<input type="text" class="form-control input-sm" minlength="2" maxlength="100" name="apellidos"  value="{{$data->apellidos}}" required>
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Nombres</label>
					<input type="text" class="form-control input-sm" name="nombres" minlength="2" maxlength="100" value="{{$data->nombres}}" required>
				</div>
				
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Sexo</label>
					<select class="form-control input-sm" name="sexo">
						<option value="1" {{$data->sexo == "1" ? 'selected' : ''}} >Hombre</option>
						<option value="2" {{$data->sexo == "2" ? 'selected' : ''}}>Mujer</option>
					</select>
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Genero</label>
					<select class="form-control input-sm" name="genero">
						<option value="1" {{$data->sexo == "1" ? 'selected' : ''}} >Masculino</option>
						<option value="2" {{$data->sexo == "2" ? 'selected' : ''}}>Femenino</option>
					</select>
				</div>
				<div class="matricula__matriculacion__input">		
					<label for="" class="matricula__matriculacion-label">Estado Civil</label>
					<select class="form-control input-sm" name="estadocivilId" required>
					<option value="1" {{$data->estadocivilId == '1' ? 'selected' : ''}}>Soltero/a</option>
					<option value="2" {{$data->estadocivilId == '2' ? 'selected' : ''}}>Casado/a</option>
					<option value="3" {{$data->estadocivilId == '3' ? 'selected' : ''}}>Divorciado/a</option>
					<option value="4" {{$data->estadocivilId == '4' ? 'selected' : ''}}>Unión Libre</option>
					<option value="5" {{$data->estadocivilId == '5' ? 'selected' : ''}}>Viudo/a</option>
					</select>	
            </div>
				
				
				
				{{--<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Foto</label>
					{{ Form::file('image',array('name'  =>  'image','accept' =>  'image/x-png,image/gif,image/jpeg' ))}}
				</div>--}}


				<div class="matricula__matriculacion__input">	
                       			 	<label for="" class="matricula__matriculacion-label">Etnia</label>
									<select class="form-control input-sm" name="etniaId" >
										<option value="1" {{$data->etniaId == '1' ? 'selected' : ''}}>Indígena</option>
										<option value="2" {{$data->etniaId == '2' ? 'selected' : ''}}>Afroecuatoriano</option>
										<option value="3" {{$data->etniaId == '3' ? 'selected' : ''}}>Negro</option>
										<option value="4" {{$data->etniaId == '4' ? 'selected' : ''}}>Mulato</option>
										<option value="5" {{$data->etniaId == '5' ? 'selected' : ''}}>Montuvio</option>
										<option value="6" {{$data->etniaId == '6' ? 'selected' : ''}}>Mestizo</option>
										<option value="7" {{$data->etniaId == '7' ? 'selected' : ''}}>Blanco</option>
										<option value="8" {{$data->etniaId == '8' ? 'selected' : ''}}>Otro</option>
										<option value="9" {{$data->etniaId == '9' ? 'selected' : ''}}>No registra</option>
									</select>	
                </div>
				<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Pueblo Y Nacionalidad</label>
									<select class="form-control input-sm" name="pueblo_nacionalidadId" >
										<option value='1' {{$data->pueblo_nacionalidadId == '1' ? 'selected' : ''}}>Kichwa</option>
										<option value='2' {{$data->pueblo_nacionalidadId == '2' ? 'selected' : ''}}>Awá</option>
										<option value='3' {{$data->pueblo_nacionalidadId == '3' ? 'selected' : ''}}>Chachi</option>
										<option value='4' {{$data->pueblo_nacionalidadId == '4' ? 'selected' : ''}}>Épera</option>
										<option value='5' {{$data->pueblo_nacionalidadId == '5' ? 'selected' : ''}}>Tsáchila</option>
										<option value='6' {{$data->pueblo_nacionalidadId == '6' ? 'selected' : ''}}>Achuar</option>
										<option value='7' {{$data->pueblo_nacionalidadId == '7' ? 'selected' : ''}}>Cofán</option>
										<option value='8' {{$data->pueblo_nacionalidadId == '8' ? 'selected' : ''}}>Secoya</option>
										<option value='9' {{$data->pueblo_nacionalidadId == '9' ? 'selected' : ''}}>Shiwiar</option>
										<option value='10' {{$data->pueblo_nacionalidadId == '10' ? 'selected' : ''}}>Shuar</option>
										<option value='1' {{$data->pueblo_nacionalidadId == '11' ? 'selected' : ''}}>Waorani</option>
										<option value='12' {{$data->pueblo_nacionalidadId == '12' ? 'selected' : ''}}>Sápara</option>
										<option value='13' {{$data->pueblo_nacionalidadId == '13' ? 'selected' : ''}}>Andoa</option>
										<option value='14' {{$data->pueblo_nacionalidadId == '14' ? 'selected' : ''}}>Siona</option>
										<option value='15 ' {{$data->pueblo_nacionalidadId == '15' ? 'selected' : ''}}>Huancavilca </option>
										<option value='16' {{$data->pueblo_nacionalidadId == '16' ? 'selected' : ''}}>Manta</option>
										<option value='17 ' {{$data->pueblo_nacionalidadId == '17' ? 'selected' : ''}}>Palta </option>
										<option value='18' {{$data->pueblo_nacionalidadId == '18' ? 'selected' : ''}}>Chibuleo</option>
										<option value='19' {{$data->pueblo_nacionalidadId == '19' ? 'selected' : ''}}>Kañari</option>
										<option value='20' {{$data->pueblo_nacionalidadId == '20' ? 'selected' : ''}}>Karanki</option>
										<option value='21' {{$data->pueblo_nacionalidadId == '21' ? 'selected' : ''}}>Kayampi</option>
										<option value='22' {{$data->pueblo_nacionalidadId == '22' ? 'selected' : ''}}>Kisapincha</option>
										<option value='23' {{$data->pueblo_nacionalidadId == '23' ? 'selected' : ''}}>Kitu-Kara</option>
										<option value='24' {{$data->pueblo_nacionalidadId == '24' ? 'selected' : ''}}>Natabuela</option>
										<option value='25' {{$data->pueblo_nacionalidadId == '25' ? 'selected' : ''}}>Otavalo</option>
										<option value='26' {{$data->pueblo_nacionalidadId == '26' ? 'selected' : ''}}>Panzaleo</option>
										<option value='27' {{$data->pueblo_nacionalidadId == '27' ? 'selected' : ''}}>Puruhá</option>
										<option value='28' {{$data->pueblo_nacionalidadId == '28' ? 'selected' : ''}}>Salasaca</option>
										<option value='29' {{$data->pueblo_nacionalidadId == '29' ? 'selected' : ''}}>Saraguro</option>
										<option value='30' {{$data->pueblo_nacionalidadId == '30' ? 'selected' : ''}}>Tomabela</option>
										<option value='31' {{$data->pueblo_nacionalidadId == '31' ? 'selected' : ''}}>Waranka</option>
										<option value='32' {{$data->pueblo_nacionalidadId == '32' ? 'selected' : ''}}>Quijos</option>
										<option value='33' {{$data->pueblo_nacionalidadId == '33' ? 'selected' : ''}}>Pasto</option>
										<option value='34' {{$data->pueblo_nacionalidadId == '34' ? 'selected' : ''}}>No Aplica</option>
									
										<select>
								</div> 
								
								
								<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Provincia Donde Sufraga</label>
									<select class="form-control input-sm" name="provinciaSufragio" >
										<option value='1'>AZUAY</option>
										<option value='2'>BOLIVAR</option>
										<option value='3'>CAÑAR</option>
										<option value='4'>CARCHI</option>
										<option value='5'>COTOPAXI</option>
										<option value='6'>CHIMBORAZO</option>
										<option value='7'>EL ORO</option>
										<option value='8'>ESMERALDAS</option>
										<option value='9'>GUAYAS</option>
										<option value='10'>IMBABURA</option>
										<option value='11'>LOJA</option>
										<option value='12'>LOS RIOS</option>
										<option value='13'>MANABI</option>
										<option value='14'>MORONA SANTIAGO</option>
										<option value='15'>NAPO</option>
										<option value='16'>PASTAZA</option>
										<option value='17'>PICHINCHA</option>
										<option value='18'>TUNGURAHUA</option>
										<option value='19'>ZAMORA CHINCHIPE</option>
										<option value='20'>GALAPAGOS</option>
										<option value='21'>SUCUMBIOS</option>
										<option value='22'>ORELLANA</option>
										<option value='23'>SANTO DOMINGO DE LOS TSACHILAS</option>
										<option value='24'>SANTA ELENA</option>
										<option value='90'>ZONAS EN ESTUDIO</option>
									</select>	
								</div>
								
								<!--<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Telefono Movil</label>
								<input type="number" class="form-control input-sm" name="movil" placeholder="909090909" value="{{$data->movil}}">
								</div>-->
								<div class="matricula__matriculacion__input">
									<label for="" class="matricula__matriculacion-label">Telefono Movil</label>
									<input type="text" class="form-control input-sm" name="movil" value="{{$data->movil}}">
								</div>
								<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Correo Electronico</label>
								<input type="email" class="form-control input-sm" name="correo" placeholder="correo@correo.com" value="{{$data->correo}}" >
								</div>
								<div class="matricula__matriculacion__input">
                            <label for="" class="matricula__matriculacion-label">Tiene Discapacidad</label>
								<select class="form-control input-sm"  id="discapacidad"name="discapacidad"  onchange="carg(this);">
									
								<option value="1" {{$data->discapacidad == '1' ? 'selected' : ''}}>Si</option>
								<option value="2" {{$data->discapacidad == '2' ? 'selected' : ''}}>No</option>
								
							</select>	
							</div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Tipo discapacidad</label>
								<select class="form-control input-sm" id="tipoDiscapacidad"name="tipoDiscapacidad" >
									<option value='1' {{$data->tipoDiscapacidad == '1' ? 'selected' : ''}}>intelectual</option>
									<option value='2' {{$data->tipoDiscapacidad == '2' ? 'selected' : ''}}>Física</option>
									<option value='3' {{$data->tipoDiscapacidad == '3' ? 'selected' : ''}}>Visual</option>
									<option value='4' {{$data->tipoDiscapacidad == '4' ? 'selected' : ''}}>Auditiva</option>
									<option value='5' {{$data->tipoDiscapacidad == '5' ? 'selected' : ''}}>Mental</option>
									<option value='6' {{$data->tipoDiscapacidad == '6' ? 'selected' : ''}}>Otra</option>
									<option value='7' {{$data->tipoDiscapacidad == '7' ? 'selected' : ''}}>no aplica</option>
								</select>
							</div>
							<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Porcentaje de Discapacidad<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" id="porcentaje_discapacidad"name="porcentaje_discapacidad" minlength="2" maxlength="100" placeholder="En caso de no Tener escribir NA" value="{{$data->porcentajeDiscapacidad}}" >
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nro.Carnet CONADIS<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" id="numCarnetDiscapacidad"name="numCarnetDiscapacidad" minlength="2" maxlength="100" placeholder="Carnet CONADIS" value="{{$data->numCarnetDiscapacidad}}" >
			</div>	
			<div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Tipo de enfermedad catastrófica </label>
				<select class="form-control input-sm" id="tipoEnfermedadCatastrofica"name="tipoEnfermedadCatastrofica" >
					<option value='1' {{$data->tipoEnfermedadCatastrofica == '1' ? 'selected' : ''}}>Cancer</option>
					<option value='2' {{$data->tipoEnfermedadCatastrofica == '2' ? 'selected' : ''}}>Tumor Cerebral</option>
					<option value='3' {{$data->tipoEnfermedadCatastrofica == '3' ? 'selected' : ''}}>Quemaduras Graves</option>
					<option value='4' {{$data->tipoEnfermedadCatastrofica == '4' ? 'selected' : ''}}>Insuficiencia Renal</option>
					<option value='5' {{$data->tipoEnfermedadCatastrofica == '5' ? 'selected' : ''}}>Otros</option>
					<option value='6' {{$data->tipoEnfermedadCatastrofica == '6' ? 'selected' : ''}}>no aplica</option>
				</select>
			</div>
            {{--<div class="matricula__matriculacion__input">
						<label for="" class="matricula__matriculacion-label">Fecha de nacimiento</label>
						<input type="date" class="form-control input-sm" name="fNacimiento" value="{{$data->fNacimiento}}" required>
			</div>--}}
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de Nacimiento</label>
				<input type="date" class="form-control" name="fNacimiento" value="{{$data->fNacimiento}}" required>
			</div>
			<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Pais Nacionalidad</label>
					<select class="form-control input-sm" name="paisNacionalidadId" required>					
					<option value='	1	 '>	Afganistán	</option>
					<option value='	2	 '>	Albania	</option>
					<option value='	3	 '>	Alemania	</option>
					<option value='	4	 '>	Andorra	</option>
					<option value='	5	 '>	Angola	</option>
					<option value='	6	 '>	Anguila	</option>
					<option value='	7	 '>	Antigua y Barbuda	</option>
					<option value='	8	 '>	Arabia Saudita	</option>
					<option value='	9	 '>	Argelia	</option>
					<option value='	10	 '>	Argentina	</option>
					<option value='	11	 '>	Armenia	</option>
					<option value='	12	 '>	Aruba	</option>
					<option value='	13	 '>	Australia	</option>
					<option value='	14	 '>	Austria	</option>
					<option value='	15	 '>	Azerbaiyán	</option>
					<option value='	16	 '>	Bahamas	</option>
					<option value='	17	 '>	Bahrein	</option>
					<option value='	18	 '>	Bangladesh	</option>
					<option value='	19	 '>	Barbados	</option>
					<option value='	20	 '>	Bélgica	</option>
					<option value='	21	 '>	Belice	</option>
					<option value='	22	 '>	Benin	</option>
					<option value='	23	 '>	Bermudas	</option>
					<option value='	24	 '>	Bielorrusia	</option>
					<option value='	25	 '>	Bolivia	</option>
					<option value='	26	 '>	Bonaire, San Eustaquio y Saba	</option>
					<option value='	27	 '>	Bosnia y Herzegovina	</option>
					<option value='	28	 '>	Botswana	</option>
					<option value='	29	 '>	Brasil	</option>
					<option value='	30	 '>	Brunei Darussalam	</option>
					<option value='	31	 '>	Bulgaria	</option>
					<option value='	32	 '>	Burkina Faso	</option>
					<option value='	33	 '>	Burundi	</option>
					<option value='	34	 '>	Bután	</option>
					<option value='	35	 '>	Cabo Verde	</option>
					<option value='	36	 '>	Camboya	</option>
					<option value='	37	 '>	Camerún	</option>
					<option value='	38	 '>	Canada	</option>
					<option value='	39	 '>	Chad	</option>
					<option value='	40	 '>	Chile	</option>
					<option value='	41	 '>	China	</option>
					<option value='	42	 '>	Chipre	</option>
					<option value='	43	 '>	Colombia	</option>
					<option value='	44	 '>	Comoras	</option>
					<option value='	45	 '>	Congo	</option>
					<option value='	46	 '>	Corea del Norte	</option>
					<option value='	47	 '>	Corea del Sur	</option>
					<option value='	48	 '>	Costa de Marfil	</option>
					<option value='	49	 '>	Costa Rica	</option>
					<option value='	50	 '>	Croacia	</option>
					<option value='	51	 '>	Cuba	</option>
					<option value='	52	 '>	Curaçao	</option>
					<option value='	53	 '>	Dinamarca	</option>
					<option value='	54	 '>	Djibouti	</option>
					<option value='	55	 '>	Dominica	</option>
					<option value='	56	 ' selected="selected" >	Ecuador	</option>
					<option value='	57	 '>	Egipto	</option>
					<option value='	58	 '>	El Salvador	</option>
					<option value='	59	 '>	El Vaticano	</option>
					<option value='	60	 '>	Emiratos Árabes Unidos	</option>
					<option value='	61	 '>	Eritrea	</option>
					<option value='	62	 '>	Eslovaquia	</option>
					<option value='	63	 '>	Eslovenia	</option>
					<option value='	64	 '>	España	</option>
					<option value='	65	 '>	Estado de Palestina	</option>
					<option value='	66	 '>	Estados Unidos de América	</option>
					<option value='	67	 '>	Estonia	</option>
					<option value='	68	 '>	Etiopía	</option>
					<option value='	69	 '>	Fiyi	</option>
					<option value='	70	 '>	Filipinas	</option>
					<option value='	71	 '>	Finlandia	</option>
					<option value='	72	 '>	Francia	</option>
					<option value='	73	 '>	Gabón	</option>
					<option value='	74	 '>	Gambia	</option>
					<option value='	75	 '>	Georgia	</option>
					<option value='	76	 '>	Ghana	</option>
					<option value='	77	 '>	Gibraltar	</option>
					<option value='	78	 '>	Granada	</option>
					<option value='	79	 '>	Grecia	</option>
					<option value='	80	 '>	Groenlandia	</option>
					<option value='	81	 '>	Guadalupe	</option>
					<option value='	82	 '>	Guam	</option>
					<option value='	83	 '>	Guatemala	</option>
					<option value='	84	 '>	Guayana francesa	</option>
					<option value='	85	 '>	Guernsey	</option>
					<option value='	86	 '>	Guinea	</option>
					<option value='	87	 '>	Guinea Ecuatorial	</option>
					<option value='	88	 '>	Guinea-Bissau	</option>
					<option value='	89	 '>	Guyana	</option>
					<option value='	90	 '>	Haití	</option>
					<option value='	91	 '>	Honduras	</option>
					<option value='	92	 '>	Hong Kong	</option>
					<option value='	93	 '>	Hungría	</option>
					<option value='	94	 '>	India	</option>
					<option value='	95	 '>	Indonesia	</option>
					<option value='	96	 '>	Irak	</option>
					<option value='	97	 '>	Irán	</option>
					<option value='	98	 '>	Irlanda	</option>
					<option value='	99	 '>	Isla de Man	</option>
					<option value='	100	 '>	Isla Norfolk	</option>
					<option value='	101	 '>	Islandia	</option>
					<option value='	102	 '>	Islas Åland	</option>
					<option value='	103	 '>	Islas Caimán	</option>
					<option value='	104	 '>	Islas Cook	</option>
					<option value='	106	 '>	Islas Feroe	</option>
					<option value='	107	 '>	Islas Malvinas (Falkland)	</option>
					<option value='	108	 '>	Islas Marianas del Norte	</option>
					<option value='	109	 '>	Islas Marshall	</option>
					<option value='	110	 '>	Islas Salomón	</option>
					<option value='	111	 '>	Islas Turcas y Caicos	</option>
					<option value='	112	 '>	Islas Vírgenes Americanas	</option>
					<option value='	113	 '>	Islas Vírgenes Británicas	</option>
					<option value='	114	 '>	Islas Wallis y Futuna	</option>
					<option value='	115	 '>	Israel	</option>
					<option value='	116	 '>	Italia	</option>
					<option value='	117	 '>	Jamaica	</option>
					<option value='	118	 '>	Japón	</option>
					<option value='	119	 '>	Jersey	</option>
					<option value='	120	 '>	Jordania	</option>
					<option value='	121	 '>	Kazajstán	</option>
					<option value='	122	 '>	Kenya	</option>
					<option value='	123	 '>	Kirguistán	</option>
					<option value='	124	 '>	Kiribati	</option>
					<option value='	125	 '>	Kuwait	</option>
					<option value='	126	 '>	La ex República Yugoslava de Macedonia	</option>
					<option value='	127	 '>	Lesoto	</option>
					<option value='	128	 '>	Letonia	</option>
					<option value='	129	 '>	Líbano	</option>
					<option value='	130	 '>	Liberia	</option>
					<option value='	131	 '>	Libia	</option>
					<option value='	132	 '>	Liechtenstein	</option>
					<option value='	133	 '>	Lituania	</option>
					<option value='	134	 '>	Luxemburgo	</option>
					<option value='	135	 '>	Macao	</option>
					<option value='	136	 '>	Madagascar	</option>
					<option value='	137	 '>	Malasia	</option>
					<option value='	138	 '>	Malaui	</option>
					<option value='	139	 '>	Maldivas	</option>
					<option value='	140	 '>	Malí	</option>
					<option value='	141	 '>	Malta	</option>
					<option value='	142	 '>	Marruecos	</option>
					<option value='	143	 '>	Martinica	</option>
					<option value='	144	 '>	Mauricio	</option>
					<option value='	145	 '>	Mauritania	</option>
					<option value='	146	 '>	Mayotte	</option>
					<option value='	147	 '>	México	</option>
					<option value='	148	 '>	Micronesia	</option>
					<option value='	149	 '>	Mónaco	</option>
					<option value='	150	 '>	Mongolia	</option>
					<option value='	151	 '>	Montenegro	</option>
					<option value='	152	 '>	Montserrat	</option>
					<option value='	153	 '>	Mozambique	</option>
					<option value='	154	 '>	Myanmar	</option>
					<option value='	155	 '>	Namibia	</option>
					<option value='	156	 '>	Nauru	</option>
					<option value='	157	 '>	Nepal	</option>
					<option value='	158	 '>	Nicaragua	</option>
					<option value='	159	 '>	Níger	</option>
					<option value='	160	 '>	Nigeria	</option>
					<option value='	161	 '>	Niue	</option>
					<option value='	162	 '>	Noruega	</option>
					<option value='	163	 '>	Nueva Caledonia	</option>
					<option value='	164	 '>	Nueva Zelanda	</option>
					<option value='	165	 '>	Omán	</option>
					<option value='	166	 '>	Países Bajos	</option>
					<option value='	167	 '>	Pakistán	</option>
					<option value='	168	 '>	Palau	</option>
					<option value='	169	 '>	Panamá	</option>
					<option value='	170	 '>	Papúa Nueva Guinea	</option>
					<option value='	171	 '>	Paraguay	</option>
					<option value='	172	 '>	Perú	</option>
					<option value='	173	 '>	Pitcairn	</option>
					<option value='	174	 '>	Polinesia francés	</option>
					<option value='	175	 '>	Polonia	</option>
					<option value='	176	 '>	Portugal	</option>
					<option value='	177	 '>	Puerto Rico	</option>
					<option value='	178	 '>	Qatar	</option>
					<option value='	179	 '>	Reino Unido de Gran Bretaña e Irlanda del Norte	</option>
					<option value='	180	 '>	República Árabe Siria	</option>
					<option value='	181	 '>	República Centroafricana	</option>
					<option value='	182	 '>	República Checa	</option>
					<option value='	183	 '>	República de Moldavia	</option>
					<option value='	184	 '>	República Democrática del Congo	</option>
					<option value='	185	 '>	República Democrática Popular Lao	</option>
					<option value='	186	 '>	República Dominicana	</option>
					<option value='	187	 '>	República Unida de Tanzania	</option>
					<option value='	188	 '>	Réunion	</option>
					<option value='	189	 '>	Rumania	</option>
					<option value='	190	 '>	Rusia	</option>
					<option value='	191	 '>	Rwanda	</option>
					<option value='	192	 '>	Sáhara Occidental	</option>
					<option value='	193	 '>	Saint-Barthélemy	</option>
					<option value='	194	 '>	Saint-Martin	</option>
					<option value='	195	 '>	Samoa	</option>
					<option value='	196	 '>	Samoa Americana	</option>
					<option value='	197	 '>	San Cristóbal y Nieves	</option>
					<option value='	198	 '>	San Marino	</option>
					<option value='	199	 '>	San Pedro y Miquelón	</option>
					<option value='	200	 '>	San Vicente y las Granadinas	</option>
					<option value='	201	 '>	Santa Elena	</option>
					<option value='	202	 '>	Santa Lucía	</option>
					<option value='	203	 '>	Santo Tomé y Príncipe	</option>
					<option value='	205	 '>	Senegal	</option>
					<option value='	206	 '>	Serbia	</option>
					<option value='	207	 '>	Seychelles	</option>
					<option value='	208	 '>	Sierra Leona	</option>
					<option value='	209	 '>	Singapur	</option>
					<option value='	210	 '>	Sint Maarten	</option>
					<option value='	211	 '>	Somalia	</option>
					<option value='	212	 '>	Sri Lanka	</option>
					<option value='	213	 '>	Sudáfrica	</option>
					<option value='	214	 '>	Sudán	</option>
					<option value='	215	 '>	Sudán del Sur	</option>
					<option value='	216	 '>	Suecia	</option>
					<option value='	217	 '>	Suiza	</option>
					<option value='	218	 '>	Suriname	</option>
					<option value='	219	 '>	Svalbard y Jan Mayen	</option>
					<option value='	220	 '>	Swazilandia	</option>
					<option value='	221	 '>	Tailandia	</option>
					<option value='	222	 '>	Tayikistán	</option>
					<option value='	223	 '>	Timor-Leste	</option>
					<option value='	224	 '>	Togo	</option>
					<option value='	225	 '>	Tokelau	</option>
					<option value='	226	 '>	Tonga	</option>
					<option value='	227	 '>	Trinidad y Tobago	</option>
					<option value='	228	 '>	Túnez	</option>
					<option value='	229	 '>	Turkmenistán	</option>
					<option value='	230	 '>	Turquía	</option>
					<option value='	231	 '>	Tuvalu	</option>
					<option value='	232	 '>	Ucrania	</option>
					<option value='	233	 '>	Uganda	</option>
					<option value='	234	 '>	Uruguay	</option>
					<option value='	235	 '>	Uzbekistán	</option>
					<option value='	236	 '>	Vanuatu	</option>
					<option value='	237	 '>	Venezuela	</option>
					<option value='	238	 '>	Viet Nam	</option>
					<option value='	239	 '>	Yemen	</option>
					<option value='	240	 '>	Zambia	</option>
					<option value='	241	 '>	Zimbabwe	</option>
					<option value='	242	 '>	Antártida	</option>
					<option value='	243	 '>	Isla Bouvet	</option>
					<option value='	244	 '>	Territorio Británico de la Océano Índico	</option>
					<option value='	245	 '>	Taiwán	</option>
					<option value='	246	 '>	Isla de Navidad	</option>
					<option value='	247	 '>	Islas Cocos	</option>
					<option value='	248	 '>	Georgia del sur y las islas sandwich del sur	</option>
					<option value='	249	 '>	Territorios Australes Franceses	</option>
					<option value='	999	 '>	No registra	</option>
		
					</select>
			</div>
			@if($tipo_usuario == 'Docente')

				<div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Nivel De Formacion Del Docente</label>
				<select class="form-control input-sm" name="nivelFormacion" >
					<option value='1' {{$data->nivelFormacion == '1' ? 'selected' : ''}}>Nivel Técnico</option>
					<option value='2' {{$data->nivelFormacion == '2' ? 'selected' : ''}}>Nivel Tecnológico</option>
					<option value='3' {{$data->nivelFormacion == '3' ? 'selected' : ''}}>Tercer Nivel</option>
					<option value='4' {{$data->nivelFormacion == '4' ? 'selected' : ''}}>Especialidad</option>
					<option value='5' {{$data->nivelFormacion == '5' ? 'selected' : ''}}>Especialidad Médica u odo</option>
					<option value='6' {{$data->nivelFormacion == '6' ? 'selected' : ''}}>Maestría</option>
                    <option value='7' {{$data->nivelFormacion == '7' ? 'selected' : ''}}>PhD</option>
				</select>
				</div>
				@endif
                <div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Fecha de ingreso a la institucion</label>
								<input type="date" class="form-control input-sm" name="fechaIngresoIES" value="{{$data->fechaIngresoIES}}" >
				</div>
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Fecha de salida a la institucion</label>
								<input type="date" class="form-control input-sm" name="fechaSalidaIES" value="{{$data->fechaSalidaIES}}" >
								
				</div>
				<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Relacion laboral Con La Institucion</label>
				<select class="form-control input-sm" name="relacionLaboralIESId" >
					<option value='1' {{$data->relacionLaboralIESId == '1' ? 'selected' : ''}}>Contrato Con Relacion De Dependencia</option>
					<option value='2' {{$data->relacionLaboralIESId == '2' ? 'selected' : ''}}>Contrato Sin Relacion De Dependencia</option>
					<option value='3' {{$data->relacionLaboralIESId == '3' ? 'selected' : ''}}>Nombramiento Provicional</option>
					<option value='4' {{$data->relacionLaboralIESId == '4' ? 'selected' : ''}}>Nombramiento Definitivo</option>
					<option value='5' {{$data->relacionLaboralIESId == '5' ? 'selected' : ''}}>Comision De Servicios </option>
					
				</select>
				</div>
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Ingreso a la institucion por concurso</label>
								<select class="form-control input-sm" name="ingresoConConcursoMeritos">
									<option value="1">Si</option>
									<option value="2">No</option>
								</select>
                </div>
				@if($tipo_usuario == 'Docente')
				<div class="matricula__matriculacion__input">
                        <label for="" class="matricula__matriculacion-label">escalafon del docente </label>
						<select class="form-control input-sm" name="escalafonDocenteId" >
							<option value='1' {{$data->escalafonDocenteId == '1' ? 'selected' : ''}}>Titular Principal</option>
							<option value='2' {{$data->escalafonDocenteId == '2' ? 'selected' : ''}}>Titular Agregado</option>
							<option value='3' {{$data->escalafonDocenteId == '3' ? 'selected' : ''}}>Titular Auxiliar</option>
							<option value='4' {{$data->escalafonDocenteId == '4' ? 'selected' : ''}}>Ocasional</option>
							<option value='5' {{$data->escalafonDocenteId == '5' ? 'selected' : ''}}>Honorario</option>
							<option value='6' {{$data->escalafonDocenteId == '6' ? 'selected' : ''}}>Invitado</option>
						</select>
				</div>
				@endif        
				<div class="matricula__matriculacion__input">
                        <label for="" class="matricula__matriculacion-label">Cargo Directivo</label>
						<select class="form-control input-sm" name="cargoDirectivoId" >
							<option value='1' {{$data->cargoDirectivoId == '1' ? 'selected' : ''}}>Rector</option>
							<option value='2' {{$data->cargoDirectivoId == '2' ? 'selected' : ''}}>Vicerector</option>
							<option value='3' {{$data->cargoDirectivoId == '3' ? 'selected' : ''}}>Secretario</option>
							<option value='4' {{$data->cargoDirectivoId == '4' ? 'selected' : ''}}>Tesorero</option>
							<option value='5' {{$data->cargoDirectivoId == '5' ? 'selected' : ''}}>Conserje</option>
							<option value='6' {{$data->cargoDirectivoId == '6' ? 'selected' : ''}}>No Aplica</option>
						</select>
				</div> 
				@if($tipo_usuario == 'Docente') 
				<div class="matricula__matriculacion__input">
                        <label for="" class="matricula__matriculacion-label">Tiempo de dedicación </label>
						<select class="form-control input-sm" name="tiempoDedicacionId" >
							<option value='1' {{$data->tiempoDedicacionId == '1' ? 'selected' : ''}}>Exclusiva o Completa</option>
							<option value='2' {{$data->tiempoDedicacionId == '2' ? 'selected' : ''}}>Semi Exlusiva o a Medio Tiempo</option>
							<option value='3' {{$data->tiempoDedicacionId == '3' ? 'selected' : ''}}>Tiempo Parcial</option>
							
						</select>
				</div> 
				@endif
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Salario Mensual</label>
								<input type="text" class="form-control input-sm" name="salarioMensual"  placeholder="$" value="{{$data->salarioMensual}}" >
				</div>	

				@if($tipo_usuario == 'Docente')

				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Asignaturas por Docente</label>
								<input type="text" class="form-control input-sm" name="nroasignaturasdocente"  placeholder="Cantidad de Asignaturas" value="{{$data->nroasignaturasdocente}}" >
				</div>
				@endif
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Horas Laborables por Semana en Carrera</label>
								<input type="text" class="form-control input-sm" name="nroHorasLaborablesSemanaEnCarreraPrograma"  placeholder="Número de Horas" value="{{$data->nroHorasLaborablesSemanaEnCarreraPrograma}}" >
				</div>
				@if($tipo_usuario == 'Docente')
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Horas Clases por Semana en Carrera</label>
								<input type="text" class="form-control input-sm" name="nroHorasClaseSemanaCarreraPrograma"  placeholder="Número de Horas" value="{{$data->nroHorasClaseSemanaCarreraPrograma}}" >
				</div>
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Horas de Investigación por Semana en Carrera</label>
								<input type="text" class="form-control input-sm" name="nroHorasInvestigacionSemanaCarreraPrograma"  placeholder="Número de Horas" value="{{$data->nroHorasInvestigacionSemanaCarreraPrograma}}" >
				</div>
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Horas Administrativas por Semana en Carrera</label>
								<input type="text" class="form-control input-sm" name="nroHorasAdministrativasSemanaCarreraPrograma"  placeholder="Número de Horas" value="{{$data->nroHorasAdministrativasSemanaCarreraPrograma}}" >
				</div>
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Horas de Otras Actividades por Semana en Carrera</label>
								<input type="text" class="form-control input-sm" name="nroHorasOtrasActividadesSemanaCarreraPrograma"  placeholder="Número de Horas" value="{{$data->nroHorasAdministrativasSemanaCarreraPrograma}}" >
				</div>
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Horas de Vinculación con la Sociedad</label>
								<input type="text" class="form-control input-sm" name="nroHorasVinculacionSociedad"  placeholder="Número de Horas" value="{{$data->nroHorasVinculacionSociedad}}" >
				</div>


				{{-- @if ($perfil === 'Docente') --}}
					{{--<div class="matricula__matriculacion__input" style="display:none">
						<label for="" class="matricula__matriculacion-label">¿Este usuario tambien es representante?</label>
						<div class="flex justify-content-between">
							<input style="width:35px; height:40px" class="form-control text-left" type="checkbox" name="es_representante" value="true" ? {{$data->es_representante == 1 ? 'checked' : ''}}>
							<div></div>
						</div>
					</div>--}}
				{{-- @endif --}}
			</div>
		</div>
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">Adicional</h3>
			<div>
				{{--<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Biografía</label>
					<textarea class="form-control input-sm" rows="5" name="bio">{{$data->bio}}</textarea>
				</div>--}}
				<div class="row">
					<div class="col-md-6">
					<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Es Docente del Área Técnica</label>
								<select class="form-control input-sm" name="docenciaTecnicoSuperior">
									<option value="1" {{$data->docenciaTecnicoSuperior == '1' ? 'selected' : ''}}>Si</option>
									<option value="2" {{$data->docenciaTecnicoSuperior == '2' ? 'selected' : ''}}>No</option>
								</select>
                	</div>
					</div>
					<div class="col-md-6">
					<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Es Docente Tecnologico</label>
								<select class="form-control input-sm" name="docenciaTecnologico">
									<option value="1" {{$data->docenciaTecnologico == '1' ? 'selected' : ''}}>Si</option>
									<option value="2" {{$data->docenciaTecnologico == '2' ? 'selected' : ''}}>No</option>
								</select>
                	</div>
					</div>
					
				</div>
				
					<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Esta en Periodo Sabatico</label>
								<select class="form-control input-sm" id="estaEnPeriodoSabatico"name="estaEnPeriodoSabatico" onchange="carg2(this)";>
									<option value="1" {{$data->estaEnPeriodoSabatico == '1' ? 'selected' : ''}}>Si</option>
									<option value="2" {{$data->estaEnPeriodoSabatico == '2' ? 'selected' : ''}}>No</option>
								</select>
                	</div>
					<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Fecha de Inicio del Año Sabatico</label>
								<input type="date" class="form-control input-sm" id="fechaInicioPeriodoSabatico"name="fechaInicioPeriodoSabatico" value="{{$data->fechaInicioPeriodoSabatico}}" >
                	</div>
					<div class="matricula__matriculacion__input">
							<label for="" class="matricula__matriculacion-label">Esta Cursando un Nivel de Estudio</label>
							<select class="form-control input-sm" name="estaCursandoEstudiosId" id="estaCursandoEstudiosId" onchange="carg3(this)";>
								<option value='1' {{$data->estaCursandoEstudiosId == '1' ? 'selected' : ''}}>Nivel Técnico</option>
								<option value='2' {{$data->estaCursandoEstudiosId == '2' ? 'selected' : ''}}>Nivel Tecnológico</option>
								<option value='3' {{$data->estaCursandoEstudiosId == '3' ? 'selected' : ''}}>Tercer Nivel</option>
								<option value='4' {{$data->estaCursandoEstudiosId == '4' ? 'selected' : ''}}>Especialidad</option>
								<option value='5' {{$data->estaCursandoEstudiosId == '5' ? 'selected' : ''}}>Especialidad Médica u odo</option>
								<option value='6' {{$data->estaCursandoEstudiosId == '6' ? 'selected' : ''}}>Maestría</option>
								<option value='7' {{$data->estaCursandoEstudiosId == '7' ? 'selected' : ''}}>PhD</option>
								<option value='8' {{$data->estaCursandoEstudiosId == '8' ? 'selected' : ''}}>No Aplica</option>
							</select>
                	</div>
					<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Institución Donde Cursa los Estudios Superiores</label>
								<input type="text" class="form-control input-sm" name="institucionDondeCursaEstudios" placeholder="" value="{{$data->institucionDondeCursaEstudios}}" id="institucionDondeCursaEstudios">
					</div>
					<div class="matricula__matriculacion__input">
						<label for="" class="matricula__matriculacion-label">Pais De Estudios</label>
						<select class="form-control input-sm" name="paisEstudiosId" id="paisEstudiosId" >					
					<option value='	1	 '>	Afganistán	</option>
					<option value='	2	 '>	Albania	</option>
					<option value='	3	 '>	Alemania	</option>
					<option value='	4	 '>	Andorra	</option>
					<option value='	5	 '>	Angola	</option>
					<option value='	6	 '>	Anguila	</option>
					<option value='	7	 '>	Antigua y Barbuda	</option>
					<option value='	8	 '>	Arabia Saudita	</option>
					<option value='	9	 '>	Argelia	</option>
					<option value='	10	 '>	Argentina	</option>
					<option value='	11	 '>	Armenia	</option>
					<option value='	12	 '>	Aruba	</option>
					<option value='	13	 '>	Australia	</option>
					<option value='	14	 '>	Austria	</option>
					<option value='	15	 '>	Azerbaiyán	</option>
					<option value='	16	 '>	Bahamas	</option>
					<option value='	17	 '>	Bahrein	</option>
					<option value='	18	 '>	Bangladesh	</option>
					<option value='	19	 '>	Barbados	</option>
					<option value='	20	 '>	Bélgica	</option>
					<option value='	21	 '>	Belice	</option>
					<option value='	22	 '>	Benin	</option>
					<option value='	23	 '>	Bermudas	</option>
					<option value='	24	 '>	Bielorrusia	</option>
					<option value='	25	 '>	Bolivia	</option>
					<option value='	26	 '>	Bonaire, San Eustaquio y Saba	</option>
					<option value='	27	 '>	Bosnia y Herzegovina	</option>
					<option value='	28	 '>	Botswana	</option>
					<option value='	29	 '>	Brasil	</option>
					<option value='	30	 '>	Brunei Darussalam	</option>
					<option value='	31	 '>	Bulgaria	</option>
					<option value='	32	 '>	Burkina Faso	</option>
					<option value='	33	 '>	Burundi	</option>
					<option value='	34	 '>	Bután	</option>
					<option value='	35	 '>	Cabo Verde	</option>
					<option value='	36	 '>	Camboya	</option>
					<option value='	37	 '>	Camerún	</option>
					<option value='	38	 '>	Canada	</option>
					<option value='	39	 '>	Chad	</option>
					<option value='	40	 '>	Chile	</option>
					<option value='	41	 '>	China	</option>
					<option value='	42	 '>	Chipre	</option>
					<option value='	43	 '>	Colombia	</option>
					<option value='	44	 '>	Comoras	</option>
					<option value='	45	 '>	Congo	</option>
					<option value='	46	 '>	Corea del Norte	</option>
					<option value='	47	 '>	Corea del Sur	</option>
					<option value='	48	 '>	Costa de Marfil	</option>
					<option value='	49	 '>	Costa Rica	</option>
					<option value='	50	 '>	Croacia	</option>
					<option value='	51	 '>	Cuba	</option>
					<option value='	52	 '>	Curaçao	</option>
					<option value='	53	 '>	Dinamarca	</option>
					<option value='	54	 '>	Djibouti	</option>
					<option value='	55	 '>	Dominica	</option>
					<option value='	56	 ' selected="selected" >	Ecuador	</option>
					<option value='	57	 '>	Egipto	</option>
					<option value='	58	 '>	El Salvador	</option>
					<option value='	59	 '>	El Vaticano	</option>
					<option value='	60	 '>	Emiratos Árabes Unidos	</option>
					<option value='	61	 '>	Eritrea	</option>
					<option value='	62	 '>	Eslovaquia	</option>
					<option value='	63	 '>	Eslovenia	</option>
					<option value='	64	 '>	España	</option>
					<option value='	65	 '>	Estado de Palestina	</option>
					<option value='	66	 '>	Estados Unidos de América	</option>
					<option value='	67	 '>	Estonia	</option>
					<option value='	68	 '>	Etiopía	</option>
					<option value='	69	 '>	Fiyi	</option>
					<option value='	70	 '>	Filipinas	</option>
					<option value='	71	 '>	Finlandia	</option>
					<option value='	72	 '>	Francia	</option>
					<option value='	73	 '>	Gabón	</option>
					<option value='	74	 '>	Gambia	</option>
					<option value='	75	 '>	Georgia	</option>
					<option value='	76	 '>	Ghana	</option>
					<option value='	77	 '>	Gibraltar	</option>
					<option value='	78	 '>	Granada	</option>
					<option value='	79	 '>	Grecia	</option>
					<option value='	80	 '>	Groenlandia	</option>
					<option value='	81	 '>	Guadalupe	</option>
					<option value='	82	 '>	Guam	</option>
					<option value='	83	 '>	Guatemala	</option>
					<option value='	84	 '>	Guayana francesa	</option>
					<option value='	85	 '>	Guernsey	</option>
					<option value='	86	 '>	Guinea	</option>
					<option value='	87	 '>	Guinea Ecuatorial	</option>
					<option value='	88	 '>	Guinea-Bissau	</option>
					<option value='	89	 '>	Guyana	</option>
					<option value='	90	 '>	Haití	</option>
					<option value='	91	 '>	Honduras	</option>
					<option value='	92	 '>	Hong Kong	</option>
					<option value='	93	 '>	Hungría	</option>
					<option value='	94	 '>	India	</option>
					<option value='	95	 '>	Indonesia	</option>
					<option value='	96	 '>	Irak	</option>
					<option value='	97	 '>	Irán	</option>
					<option value='	98	 '>	Irlanda	</option>
					<option value='	99	 '>	Isla de Man	</option>
					<option value='	100	 '>	Isla Norfolk	</option>
					<option value='	101	 '>	Islandia	</option>
					<option value='	102	 '>	Islas Åland	</option>
					<option value='	103	 '>	Islas Caimán	</option>
					<option value='	104	 '>	Islas Cook	</option>
					<option value='	106	 '>	Islas Feroe	</option>
					<option value='	107	 '>	Islas Malvinas (Falkland)	</option>
					<option value='	108	 '>	Islas Marianas del Norte	</option>
					<option value='	109	 '>	Islas Marshall	</option>
					<option value='	110	 '>	Islas Salomón	</option>
					<option value='	111	 '>	Islas Turcas y Caicos	</option>
					<option value='	112	 '>	Islas Vírgenes Americanas	</option>
					<option value='	113	 '>	Islas Vírgenes Británicas	</option>
					<option value='	114	 '>	Islas Wallis y Futuna	</option>
					<option value='	115	 '>	Israel	</option>
					<option value='	116	 '>	Italia	</option>
					<option value='	117	 '>	Jamaica	</option>
					<option value='	118	 '>	Japón	</option>
					<option value='	119	 '>	Jersey	</option>
					<option value='	120	 '>	Jordania	</option>
					<option value='	121	 '>	Kazajstán	</option>
					<option value='	122	 '>	Kenya	</option>
					<option value='	123	 '>	Kirguistán	</option>
					<option value='	124	 '>	Kiribati	</option>
					<option value='	125	 '>	Kuwait	</option>
					<option value='	126	 '>	La ex República Yugoslava de Macedonia	</option>
					<option value='	127	 '>	Lesoto	</option>
					<option value='	128	 '>	Letonia	</option>
					<option value='	129	 '>	Líbano	</option>
					<option value='	130	 '>	Liberia	</option>
					<option value='	131	 '>	Libia	</option>
					<option value='	132	 '>	Liechtenstein	</option>
					<option value='	133	 '>	Lituania	</option>
					<option value='	134	 '>	Luxemburgo	</option>
					<option value='	135	 '>	Macao	</option>
					<option value='	136	 '>	Madagascar	</option>
					<option value='	137	 '>	Malasia	</option>
					<option value='	138	 '>	Malaui	</option>
					<option value='	139	 '>	Maldivas	</option>
					<option value='	140	 '>	Malí	</option>
					<option value='	141	 '>	Malta	</option>
					<option value='	142	 '>	Marruecos	</option>
					<option value='	143	 '>	Martinica	</option>
					<option value='	144	 '>	Mauricio	</option>
					<option value='	145	 '>	Mauritania	</option>
					<option value='	146	 '>	Mayotte	</option>
					<option value='	147	 '>	México	</option>
					<option value='	148	 '>	Micronesia	</option>
					<option value='	149	 '>	Mónaco	</option>
					<option value='	150	 '>	Mongolia	</option>
					<option value='	151	 '>	Montenegro	</option>
					<option value='	152	 '>	Montserrat	</option>
					<option value='	153	 '>	Mozambique	</option>
					<option value='	154	 '>	Myanmar	</option>
					<option value='	155	 '>	Namibia	</option>
					<option value='	156	 '>	Nauru	</option>
					<option value='	157	 '>	Nepal	</option>
					<option value='	158	 '>	Nicaragua	</option>
					<option value='	159	 '>	Níger	</option>
					<option value='	160	 '>	Nigeria	</option>
					<option value='	161	 '>	Niue	</option>
					<option value='	162	 '>	Noruega	</option>
					<option value='	163	 '>	Nueva Caledonia	</option>
					<option value='	164	 '>	Nueva Zelanda	</option>
					<option value='	165	 '>	Omán	</option>
					<option value='	166	 '>	Países Bajos	</option>
					<option value='	167	 '>	Pakistán	</option>
					<option value='	168	 '>	Palau	</option>
					<option value='	169	 '>	Panamá	</option>
					<option value='	170	 '>	Papúa Nueva Guinea	</option>
					<option value='	171	 '>	Paraguay	</option>
					<option value='	172	 '>	Perú	</option>
					<option value='	173	 '>	Pitcairn	</option>
					<option value='	174	 '>	Polinesia francés	</option>
					<option value='	175	 '>	Polonia	</option>
					<option value='	176	 '>	Portugal	</option>
					<option value='	177	 '>	Puerto Rico	</option>
					<option value='	178	 '>	Qatar	</option>
					<option value='	179	 '>	Reino Unido de Gran Bretaña e Irlanda del Norte	</option>
					<option value='	180	 '>	República Árabe Siria	</option>
					<option value='	181	 '>	República Centroafricana	</option>
					<option value='	182	 '>	República Checa	</option>
					<option value='	183	 '>	República de Moldavia	</option>
					<option value='	184	 '>	República Democrática del Congo	</option>
					<option value='	185	 '>	República Democrática Popular Lao	</option>
					<option value='	186	 '>	República Dominicana	</option>
					<option value='	187	 '>	República Unida de Tanzania	</option>
					<option value='	188	 '>	Réunion	</option>
					<option value='	189	 '>	Rumania	</option>
					<option value='	190	 '>	Rusia	</option>
					<option value='	191	 '>	Rwanda	</option>
					<option value='	192	 '>	Sáhara Occidental	</option>
					<option value='	193	 '>	Saint-Barthélemy	</option>
					<option value='	194	 '>	Saint-Martin	</option>
					<option value='	195	 '>	Samoa	</option>
					<option value='	196	 '>	Samoa Americana	</option>
					<option value='	197	 '>	San Cristóbal y Nieves	</option>
					<option value='	198	 '>	San Marino	</option>
					<option value='	199	 '>	San Pedro y Miquelón	</option>
					<option value='	200	 '>	San Vicente y las Granadinas	</option>
					<option value='	201	 '>	Santa Elena	</option>
					<option value='	202	 '>	Santa Lucía	</option>
					<option value='	203	 '>	Santo Tomé y Príncipe	</option>
					<option value='	205	 '>	Senegal	</option>
					<option value='	206	 '>	Serbia	</option>
					<option value='	207	 '>	Seychelles	</option>
					<option value='	208	 '>	Sierra Leona	</option>
					<option value='	209	 '>	Singapur	</option>
					<option value='	210	 '>	Sint Maarten	</option>
					<option value='	211	 '>	Somalia	</option>
					<option value='	212	 '>	Sri Lanka	</option>
					<option value='	213	 '>	Sudáfrica	</option>
					<option value='	214	 '>	Sudán	</option>
					<option value='	215	 '>	Sudán del Sur	</option>
					<option value='	216	 '>	Suecia	</option>
					<option value='	217	 '>	Suiza	</option>
					<option value='	218	 '>	Suriname	</option>
					<option value='	219	 '>	Svalbard y Jan Mayen	</option>
					<option value='	220	 '>	Swazilandia	</option>
					<option value='	221	 '>	Tailandia	</option>
					<option value='	222	 '>	Tayikistán	</option>
					<option value='	223	 '>	Timor-Leste	</option>
					<option value='	224	 '>	Togo	</option>
					<option value='	225	 '>	Tokelau	</option>
					<option value='	226	 '>	Tonga	</option>
					<option value='	227	 '>	Trinidad y Tobago	</option>
					<option value='	228	 '>	Túnez	</option>
					<option value='	229	 '>	Turkmenistán	</option>
					<option value='	230	 '>	Turquía	</option>
					<option value='	231	 '>	Tuvalu	</option>
					<option value='	232	 '>	Ucrania	</option>
					<option value='	233	 '>	Uganda	</option>
					<option value='	234	 '>	Uruguay	</option>
					<option value='	235	 '>	Uzbekistán	</option>
					<option value='	236	 '>	Vanuatu	</option>
					<option value='	237	 '>	Venezuela	</option>
					<option value='	238	 '>	Viet Nam	</option>
					<option value='	239	 '>	Yemen	</option>
					<option value='	240	 '>	Zambia	</option>
					<option value='	241	 '>	Zimbabwe	</option>
					<option value='	242	 '>	Antártida	</option>
					<option value='	243	 '>	Isla Bouvet	</option>
					<option value='	244	 '>	Territorio Británico de la Océano Índico	</option>
					<option value='	245	 '>	Taiwán	</option>
					<option value='	246	 '>	Isla de Navidad	</option>
					<option value='	247	 '>	Islas Cocos	</option>
					<option value='	248	 '>	Georgia del sur y las islas sandwich del sur	</option>
					<option value='	249	 '>	Territorios Australes Franceses	</option>
					<option value='	999	 '>	No registra	</option>		
					</select>
				</div>
				<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Titulo a Obtener</label>
								<input type="text" class="form-control input-sm" name="tituloAObtener" id="tituloAObtener"placeholder="Lcdo. Ing. Msc. PhD. Otro" value="{{$data->tituloAObtener}}" >
				</div>
				<div class="matricula__matriculacion__input">
							<label for="" class="matricula__matriculacion-label">Tipo de Financiamiento de la Beca</label>
							<select class="form-control input-sm" name="financiamientoBecaId" id="financiamientoBecaId">
								<option value='1' {{$data->financiamientoBecaId == '1' ? 'selected' : ''}}>IES</option>
								<option value='2' {{$data->financiamientoBecaId == '2' ? 'selected' : ''}}>SENESCYT</option>
								<option value='3' {{$data->financiamientoBecaId == '3' ? 'selected' : ''}}>OTRO</option>
								<option value='4' {{$data->financiamientoBecaId == '4' ? 'selected' : ''}}>TRANSFERENCIA DEL ESTADO</option>
								<option value='5' {{$data->financiamientoBecaId == '5' ? 'selected' : ''}}>NO APLICA</option>
							</select>
                	</div>
				<div class="row">
					<div class="col-md-4">
					<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Recibe Beca</label>
								<select class="form-control input-sm" name="poseeBecaId" id="poseeBecaId">
									<option value="1" {{$data->poseeBecaId == '1' ? 'selected' : ''}}>Si</option>
									<option value="2" {{$data->poseeBecaId == '2' ? 'selected' : ''}}>No</option>
									<option value="3" {{$data->poseeBecaId == '3' ? 'selected' : ''}}>No Aplica</option>
								</select>
                	</div>
					</div>
					<div class="col-md-4">
					<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Tipo de Beca</label>
								<select class="form-control input-sm" name="tipoBecaId" id="tipoBecaId">
									<option value="1" {{$data->tipoBecaId == '1' ? 'selected' : ''}}>Total</option>
									<option value="2" {{$data->tipoBecaId == '2' ? 'selected' : ''}}>Parcial</option>
									<option value="3" {{$data->tipoBecaId == '3' ? 'selected' : ''}}>No Aplica</option>
								</select>
                	</div>
					</div>
					<div class="col-md-4">
					<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Monto de la Beca</label>
								<input type="text" class="form-control input-sm" id="montoBeca"name="montoBeca" placeholder="$" value="{{$data->montoBeca}}" >
                	</div>
					</div>
					
					<input type="hidden" name="nombreUnidadAcademica" value="" >
					<!--<input type="hidden" name="nroasignaturasdocente" value="" >
					<input type="hidden" name="nroHorasLaborablesSemanaEnCarreraPrograma" value="" >
					<input type="hidden" name="nroHorasClaseSemanaCarreraPrograma" value="" >
					<input type="hidden" name="nroHorasInvestigacionSemanaCarreraPrograma" value="" >
					<input type="hidden" name="nroHorasAdministrativasSemanaCarreraPrograma" value="" >
					<input type="hidden" name="nroHorasOtrasActividadesSemanaCarreraPrograma" value="" >
					<input type="hidden" name="nroHorasVinculacionSociedad" value="" >-->
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Realiza Publicaciones en Revistas</label>
								<select class="form-control input-sm" name="pubRevistasCienInIndexadasId">
									<option value="1" {{$data->pubRevistasCienInIndexadasId == '1' ? 'selected' : ''}}>Si</option>
									<option value="2" {{$data->pubRevistasCienInIndexadasId == '2' ? 'selected' : ''}}>No</option>
								</select>	
                	</div>
					<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Cantidad de Publicaciones Cientificas</label>
								<input type="number" class="form-control input-sm" name="numPubRevistasCientifIndexadas" placeholder="0" value="{{$data->numPubRevistasCientifIndexadas}}" >
                	</div>
			</div>
			
		</div>
		@endif
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">Domicilio</h3>
			<div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Dirección del domicilio</label>
					<input type="text" class="form-control input-sm" name="dDomicilio" value="{{$data->dDomicilio}}">
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Teléfono del domicilio</label>
					<input type="text" class="form-control input-sm" name="tDomicilio" value="{{$data->tDomicilio}}">
				</div>
			</div>
		</div>

		

		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">Acceso</h3>
			<div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Correo</label>
					<input type="email" class="form-control input-sm" name="correo" value="{{$data->correo}}" >
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Contraseña</label>
					<input type="password" class="form-control " name="password">
				</div>
			</div>
		</div>
		<div class="text-right">
			<input type="submit" class="mb-1 btn btn-primary btn-lg" value="ACTUALIZAR">
		</div>
	</div>
</form>