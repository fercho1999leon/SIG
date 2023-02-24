
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nombres <span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="Nombres" minlength="2" maxlength="100" placeholder="Nombres del estudiante" value="{{old('nombres', $data->nombres)}}" >
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Apellidos<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="Apellidos" minlength="2" maxlength="100" placeholder="Apellidos del Estudiante" value="{{old('apellidos', $data->apellidos)}}" >
			</div>
			<div class="matricula__matriculacion__input"> 
				<label for="" class="matricula__matriculacion-label">Sexo</label>
				<select class="form-control input-sm" name="sexo" required>
					<option value="Masculino" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Hombre</option>
					<option value="Femenino" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Mujer</option>
				</select>	
				<label for="" class="matricula__matriculacion-label">Genero</label>
				<select class="form-control input-sm" name="genero" required>
					<option value="Masculino" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Masculino</option>
					<option value="Femenino" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Femenino</option>
				</select>
				<label for="" class="matricula__matriculacion-label">Estado Civil</label>
				<select class="form-control input-sm" name="Estado_Civil" required>
					<option value="1" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Soltero/a</option>
					<option value="2" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Casado/a</option>
					<option value="3" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Divorciado/a</option>
					<option value="4" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Unión Libre</option>
					<option value="5" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Viudo/a</option>
				</select>	
				<label for="" class="matricula__ma
				triculacion-label">Etnia Estudiante</label>
				<select class="form-control input-sm" name="Etnia Estudiante" required>
					<option value="1" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Indígena</option>
					<option value="2" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Afroecuatoriano</option>
					<option value="3" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Negro</option>
					<option value="4" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Mulato</option>
					<option value="5" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Montuvio</option>
					<option value="6" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Mestizo</option>
					<option value="7" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Blanco</option>
					<option value="8" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>Otro</option>
					<option value="9" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>No registra</option>
				</select>	
				<h3 class="matricula__matriculacion-title">DATOS MÉDICOS</h3>
				<label for="" class="matricula__matriculacion-label">Tipos Sangre</label>
				<select class="form-control input-sm" name="Tipos Sangre" required>
					<option value="1" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>A+</option>
					<option value="2" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>A-</option>
					<option value="3" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>B+</option>
					<option value="4" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>B-</option>
					<option value="5" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>AB+</option>
					<option value="6" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>AB-</option>
					<option value="7" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>O+</option>
					<option value="8" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>O-</option>			
				</select>
				
			
				<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Nro.Carnet CONADIS<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="Carnet CONADIS" minlength="2" maxlength="100" placeholder="Carnet CONADIS" value="{{old('carnet', $data->carnet)}}">
			</div>
				<label for="" class="matricula__matriculacion-label">Tiene Discapacidad</label>
				<select class="form-control input-sm" name="Tiene Discapacidad" required>
					<option value="1" {{$data->sexo == 'Masculino' ? 'selected' : ''}}>Si</option>
					<option value="2" {{$data->sexo == 'Femenino' ? 'selected' : ''}}>No</option>
				</select>	
				<label for="" class="matricula__matriculacion-label">Tipo discapacidad</label>
				<select class="form-control input-sm" name="Tipo discapacidad" required>
					<option id='1'>intelectual</option>
					<option id='2'>Física</option>
					<option id='3'>Visual</option>
					<option id='4'>Auditiva</option>
					<option id='5'>Mental</option>
					<option id='6'>Otra</option>
					<option id='7'>no aplica</option>
				</select>	
				<label for="" class="matricula__matriculacion-label">Tipo de enfermedad catastrófica </label>
				<select class="form-control input-sm" name="Tipo de enfermedad catastrófica " required>
					<option id='1'>Cancer</option>
					<option id='2'>Tumor Cerebral</option>
					<option id='3'>Quemaduras Graves</option>
					<option id='4'>Insuficiencia Renal</option>
					<option id='5'>Otros</option>
					<option id='6'>no aplica</option>
				</select>
				<h3 class="matricula__matriculacion-title">NACIONALIDAD</h3>
		<div>	
			<div>
				<label for="" class="matricula__matriculacion-label">Pais</label>
				<select class="form-control input-sm" name="pais" required>					
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
		</div>	
		<div>	
				<label for="" class="matricula__matriculacion-label">Pueblo Y Nacionalidad</label>
				<select class="form-control input-sm" name="pueblo_nacionalidad" required>
					<option value='1'>Kichwa</option>
										<option value='2'>Awá</option>
										<option value='3'>Chachi</option>
										<option value='4'>Épera</option>
										<option value='5'>Tsáchila</option>
										<option value='6'>Achuar</option>
										<option value='7'>Cofán</option>
										<option value='8'>Secoya</option>
										<option value='9'>Shiwiar</option>
										<option value='10'>Shuar</option>
										<option value='1'>Waorani</option>
										<option value='12'>Sápara</option>
										<option value='13'>Andoa</option>
										<option value='14'>Siona</option>
										<option value='15 '>Huancavilca </option>
										<option value='16'>Manta</option>
										<option value='17 '>Palta </option>
										<option value='18'>Chibuleo</option>
										<option value='19'>Kañari</option>
										<option value='20'>Karanki</option>
										<option value='21'>Kayampi</option>
										<option value='22'>Kisapincha</option>
										<option value='23'>Kitu-Kara</option>
										<option value='24'>Natabuela</option>
										<option value='25'>Otavalo</option>
										<option value='26'>Panzaleo</option>
										<option value='27'>Puruhá</option>
										<option value='28'>Salasaca</option>
										<option value='29'>Saraguro</option>
										<option value='30'>Tomabela</option>
										<option value='31'>Waranka</option>
										<option value='32'>Quijos</option>
										<option value='33'>Pasto</option>
										<option value='34'>No Aplica</option>
				<select>
				
				<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de ingreso al País</label>
				<input type="date" class="form-control input-sm" name="fecha_ingreso_pais" value="{{old('fecha_ingreso_pais', $dataProfile->fecha_ingreso_pais)}}">
			</div>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de expiración pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_expiracion_pasaporte" value="{{old('fecha_expiracion_pasaporte', $dataProfile->fecha_expiracion_pasaporte)}}">
			</div>
		</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha de caducidad pasaporte</label>
				<input type="date" class="form-control input-sm" name="fecha_caducidad_pasaporte" value="{{old('fecha_caducidad_pasaporte', $dataProfile->fecha_caducidad_pasaporte)}}">
			</div>	
		<div></div>
				<label for="" class="matricula__matriculacion-label">Provincia</label>
					<select class="form-control input-sm" name="provincia" required>
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
                        <option value='25'>ZONAS EN ESTUDIO</option>
					</select>	
				<label for="" class="matricula__matriculacion-label">Cantón</label>
					<select class="form-control input-sm" name="canton" required>
					<option value='0108'>SANTA ISABEL</option>
                        <option value='0104'>NABON</option>
                        <option value='0102'>GIRON</option>
                        <option value='0107'>SAN FERNANDO</option>
                        <option value='0106'>PUCARA</option>
                        <option value='0109'>SIGSIG</option>
                        <option value='0115'>CAMILO PONCE ENRIQUEZ</option>
                        <option value='0111'>CHORDELEG</option>
                        <option value='0103'>GUALACEO</option>
                        <option value='0101'>CUENCA</option>
                        <option value='0113'>SEVILLA DE ORO</option>
                        <option value='0112'>EL PAN</option>
                        <option value='0114'>GUACHAPALA</option>
                        <option value='0105'>PAUTE</option>
                        <option value='0202'>CHILLANES</option>
                        <option value='0205'>SAN MIGUEL</option>
                        <option value='0203'>CHIMBO</option>
                        <option value='0206'>CALUMA</option>
                        <option value='0201'>GUARANDA</option>
                        <option value='0204'>ECHEANDIA</option>
                        <option value='0207'>LAS NAVES</option>
                        <option value='0306'>DELEG</option>
                        <option value='0301'>AZOGUES</option>
                        <option value='0302'>BIBLIAN</option>
                        <option value='0303'>CAÑAR</option>
                        <option value='0305'>EL TAMBO</option>
                        <option value='0307'>SUSCAL</option>
                        <option value='0304'>LA TRONCAL</option>
                        <option value='0402'>BOLIVAR</option>
                        <option value='0404'>MIRA</option>
                        <option value='0405'>MONTUFAR</option>
                        <option value='0406'>SAN PEDRO DE HUACA</option>
                        <option value='0406'>ESPEJO</option>
                        <option value='0401'>TULCAN</option>
                        <option value='0503'>PANGUA</option>
                        <option value='0505'>SALCEDO</option>
                        <option value='0504'>PUJILI</option>
                        <option value='0501'>LATACUNGA</option>
                        <option value='506'>SAQUISILI</option>
                        <option value='502'>LA MANA</option>
                        <option value='SIGCHOS'>SIGCHOS</option>
                        <option value='CHUNCHI'>CHUNCHI</option>
                        <option value='CUMANDA'>CUMANDA</option>
                        <option value='ALAUSI'>ALAUSI</option>
                        <option value='PALLATANGA'>PALLATANGA</option>
                        <option value='GUAMOTE'>GUAMOTE</option>
                        <option value='CHAMBO'>CHAMBO</option>
                        <option value='COLTA'>COLTA</option>
                        <option value='RIOBAMBA'>RIOBAMBA</option>
                        <option value='GUANO'>GUANO</option>
                        <option value='PENIPE'>PENIPE</option>
                        <option value='MARCABELI'>MARCABELI</option>
                        <option value='BALSAS'>BALSAS</option>
                        <option value='LAS LAJAS'>LAS LAJAS</option>
                        <option value='PORTOVELO'>PORTOVELO</option>
                        <option value='ZARUMA'>ZARUMA</option>
                        <option value='PIÑAS'>PIÑAS</option>
                        <option value='ATAHUALPA'>ATAHUALPA</option>
                        <option value='HUAQUILLAS'>HUAQUILLAS</option>
                        <option value='ARENILLAS'>ARENILLAS</option>
                        <option value='SANTA ROSA'>SANTA ROSA</option>
                        <option value='CHILLA'>CHILLA</option>
                        <option value='PASAJE'>PASAJE</option>
                        <option value='MACHALA'>MACHALA</option>
                        <option value='EL GUABO'>EL GUABO</option>
                        <option value='QUININDE'>QUININDE</option>
                        <option value='MUISNE'>MUISNE</option>
                        <option value='ATACAMES'>ATACAMES</option>
                        <option value='ESMERALDAS'>ESMERALDAS</option>
                        <option value='RIOVERDE'>RIOVERDE</option>
                        <option value='ELOY ALFARO'>ELOY ALFARO</option>
                        <option value='SAN LORENZO'>SAN LORENZO</option>
                        <option value='GUAYAQUIL'>GUAYAQUIL</option>
                        <option value='ALFREDO BAQUERIZO MORENO (JUJAN)'>ALFREDO BAQUERIZO MORENO (JUJAN)</option>
                        <option value='BALAO'>BALAO</option>
                        <option value='BALZAR'>BALZAR</option>
                        <option value='COLIMES'>COLIMES</option>
                        <option value='DAULE'>DAULE</option>
                        <option value='DURAN'>DURAN</option>
                        <option value='EL EMPALME'>EL EMPALME</option>
                        <option value='EL TRIUNFO'>EL TRIUNFO</option>
                        <option value='MILAGRO'>MILAGRO</option>
                        <option value='NARANJAL'>NARANJAL</option>
                        <option value='NARANJITO'>NARANJITO</option>
                        <option value='PALESTINA'>PALESTINA</option>
                        <option value='PEDRO CARBO'>PEDRO CARBO</option>
                        <option value='SAMBORONDON'>SAMBORONDON</option>
                        <option value='SANTA LUCIA'>SANTA LUCIA</option>
                        <option value='URBINA JADO'>URBINA JADO</option>
                        <option value='YAGUACHI'>YAGUACHI</option>
                        <option value='PLAYAS'>PLAYAS</option>
                        <option value='SIMON BOLIVAR'>SIMON BOLIVAR</option>
                        <option value='CORONEL MARCELINO MARIDUEÑA'>CORONEL MARCELINO MARIDUEÑA</option>
                        <option value='LOMAS DE SARGENTILLO'>LOMAS DE SARGENTILLO</option>
                        <option value='NOBOL'>NOBOL</option>
                        <option value='GENERAL  ANTONIO ELIZALDE'>GENERAL  ANTONIO ELIZALDE</option>
                        <option value='ISIDRO AYORA'>ISIDRO AYORA</option>
                        <option value='OTAVALO'>OTAVALO</option>
                        <option value='COTACACHI'>COTACACHI</option>
                        <option value='ANTONIO ANTE'>ANTONIO ANTE</option>
                        <option value='PIMAMPIRO'>PIMAMPIRO</option>
                        <option value='SAN MIGUEL DE URCUQUI'>SAN MIGUEL DE URCUQUI</option>
                        <option value='IBARRA'>IBARRA</option>
                        <option value='ESPINDOLA'>ESPINDOLA</option>
                        <option value='QUILANGA'>QUILANGA</option>
                        <option value='ZAPOTILLO'>ZAPOTILLO</option>
                        <option value='MACARA'>MACARA</option>
                        <option value='GONZANAMA'>GONZANAMA</option>
                        <option value='CALVAS'>CALVAS</option>
                        <option value='SOZORANGA'>SOZORANGA</option>
                        <option value='PINDAL'>PINDAL</option>
                        <option value='CELICA'>CELICA</option>
                        <option value='PALTAS'>PALTAS</option>
                        <option value='OLMEDO'>OLMEDO</option>
                        <option value='CATAMAYO'>CATAMAYO</option>
                        <option value='PUYANGO'>PUYANGO</option>
                        <option value='LOJA'>LOJA</option>
                        <option value='CHAGUARPAMBA'>CHAGUARPAMBA</option>
                        <option value='SARAGURO'>SARAGURO</option>
                        <option value='BABAHOYO'>BABAHOYO</option>
                        <option value='BABA'>BABA</option>
                        <option value='MONTALVO'>MONTALVO</option>
                        <option value='PUEBLOVIEJO'>PUEBLOVIEJO</option>
                        <option value='QUEVEDO'>QUEVEDO</option>
                        <option value='URDANETA'>URDANETA</option>
                        <option value='VENTANAS'>VENTANAS</option>
                        <option value='VINCES'>VINCES</option>
                        <option value='PALENQUE'>PALENQUE</option>
                        <option value='BUENA FE'>BUENA FE</option>
                        <option value='VALENCIA'>VALENCIA</option>
                        <option value='MOCACHE'>MOCACHE</option>
                        <option value='QUINSALOMA'>QUINSALOMA</option>
                        <option value='PUERTO LOPEZ'>PUERTO LOPEZ</option>
                        <option value='PAJAN'>PAJAN</option>
                        <option value='OLMEDO'>OLMEDO</option>
                        <option value='24 DE MAYO'>24 DE MAYO</option>
                        <option value='JIPIJAPA'>JIPIJAPA</option>
                        <option value='SANTA ANA'>SANTA ANA</option>
                        <option value='MONTECRISTI'>MONTECRISTI</option>
                        <option value='MANTA'>MANTA</option>
                        <option value='JARAMIJO'>JARAMIJO</option>
                        <option value='PORTOVIEJO'>PORTOVIEJO</option>
                        <option value='JUNIN'>JUNIN</option>
                        <option value='ROCAFUERTE'>ROCAFUERTE</option>
                        <option value='BOLIVAR'>BOLIVAR</option>
                        <option value='PICHINCHA'>PICHINCHA</option>
                        <option value='TOSAGUA'>TOSAGUA</option>
                        <option value='SUCRE'>SUCRE</option>
                        <option value='CHONE'>CHONE</option>
                        <option value='SAN VICENTE'>SAN VICENTE</option>
                        <option value='EL CARMEN'>EL CARMEN</option>
                        <option value='FLAVIO ALFARO'>FLAVIO ALFARO</option>
                        <option value='JAMA'>JAMA</option>
                        <option value='PEDERNALES'>PEDERNALES</option>
                        <option value='GUALAQUIZA'>GUALAQUIZA</option>
                        <option value='SAN JUAN BOSCO'>SAN JUAN BOSCO</option>
                        <option value='LIMON INDANZA'>LIMON INDANZA</option>
                        <option value='TIWINTZA'>TIWINTZA</option>
                        <option value='LOGROÑO'>LOGROÑO</option>
                        <option value='SANTIAGO'>SANTIAGO</option>
                        <option value='SUCUA'>SUCUA</option>
                        <option value='MORONA'>MORONA</option>
                        <option value='TAISHA'>TAISHA</option>
                        <option value='HUAMBOYA'>HUAMBOYA</option>
                        <option value='PALORA'>PALORA</option>
                        <option value='PABLO SEXTO'>PABLO SEXTO</option>
                        <option value='CARLOS JULIO AROSEMENA TOLA'>CARLOS JULIO AROSEMENA TOLA</option>
                        <option value='TENA'>TENA</option>
                        <option value='ARCHIDONA'>ARCHIDONA</option>
                        <option value='QUIJOS'>QUIJOS</option>
                        <option value='EL CHACO'>EL CHACO</option>
                        <option value='PASTAZA'>PASTAZA</option>
                        <option value='MERA'>MERA</option>
                        <option value='SANTA CLARA'>SANTA CLARA</option>
                        <option value='ARAJUNO'>ARAJUNO</option>
                        <option value='MEJIA'>MEJIA</option>
                        <option value='RUMIÑAHUI'>RUMIÑAHUI</option>
                        <option value='DISTRITO METROPOLITANO DE QUITO'>DISTRITO METROPOLITANO DE QUITO</option>
                        <option value='CAYAMBE'>CAYAMBE</option>
                        <option value='SAN MIGUEL DE LOS BANCOS'>SAN MIGUEL DE LOS BANCOS</option>
                        <option value='PEDRO MONCAYO'>PEDRO MONCAYO</option>
                        <option value='PEDRO VICENTE MALDONADO'>PEDRO VICENTE MALDONADO</option>
                        <option value='PUERTO QUITO'>PUERTO QUITO</option>
                        <option value='MOCHA'>MOCHA</option>
                        <option value='QUERO'>QUERO</option>
                        <option value='BAÑOS DE AGUA SANTA'>BAÑOS DE AGUA SANTA</option>
                        <option value='CEVALLOS'>CEVALLOS</option>
                        <option value='TISALEO'>TISALEO</option>
                        <option value='PATATE'>PATATE</option>
                        <option value='PELILEO'>PELILEO</option>
                        <option value='AMBATO'>AMBATO</option>
                        <option value='PILLARO'>PILLARO</option>
                        <option value='CHINCHIPE'>CHINCHIPE</option>
                        <option value='PALANDA'>PALANDA</option>
                        <option value='ZAMORA'>ZAMORA</option>
                        <option value='NANGARITZA'>NANGARITZA</option>
                        <option value='PAQUISHA'>PAQUISHA</option>
                        <option value='CENTINELA DEL CONDOR'>CENTINELA DEL CONDOR</option>
                        <option value='YANTZAZA'>YANTZAZA</option>
                        <option value='EL PANGUI'>EL PANGUI</option>
                        <option value='YACUAMBI'>YACUAMBI</option>
                        <option value='SAN CRISTOBAL'>SAN CRISTOBAL</option>
                        <option value='SANTA CRUZ'>SANTA CRUZ</option>
                        <option value='ISABELA'>ISABELA</option>
                        <option value='CUYABENO'>CUYABENO</option>
                        <option value='SHUSHUFINDI'>SHUSHUFINDI</option>
                        <option value='GONZALO PIZARRO'>GONZALO PIZARRO</option>
                        <option value='LAGO AGRIO'>LAGO AGRIO</option>
                        <option value='PUTUMAYO'>PUTUMAYO</option>
                        <option value='CASCALES'>CASCALES</option>
                        <option value='SUCUMBIOS'>SUCUMBIOS</option>
                        <option value='AGUARICO'>AGUARICO</option>
                        <option value='LORETO'>LORETO</option>
                        <option value='ORELLANA'>ORELLANA</option>
                        <option value='LA JOYA DE LOS SACHAS'>LA JOYA DE LOS SACHAS</option>
                        <option value='SANTO DOMINGO'>SANTO DOMINGO</option>
                        <option value='LA CONCORDIA'>LA CONCORDIA</option>
                        <option value='2402'>LA LIBERTAD</option>
                        <option value='2403'>SALINAS</option>
                        <option value='2401'>SANTA ELENA</option>
                        <option value='9007'>ABDON CALDERON</option>
                        <option value='9004'>EL PIEDRERO</option>
                        <option value='9006'>JUVAL</option>
                        <option value='9005'>SANTA ROSA DE AGUA CLARA</option>
                        <option value='9008'>MATILDE ESTHER</option>
                        <option value='9001'>LAS GOLONDRINAS</option>

					</select>	

					<label for="" class="matricula__matriculacion-label">Pais Residencia</label>
				<select class="form-control input-sm" name="pais_residencia" required>					
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

				<label for="" class="matricula__matriculacion-label">Provincia Residencia</label>
					<select class="form-control input-sm" name="provincia_residencia" required>
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
                        <option value='25'>ZONAS EN ESTUDIO</option>
					</select>	
				<label for="" class="matricula__matriculacion-label">Cantón Residencia</label>
					<select class="form-control input-sm" name="canton_residencia" required>
					<option value='0108'>SANTA ISABEL</option>
                        <option value='0104'>NABON</option>
                        <option value='0102'>GIRON</option>
                        <option value='0107'>SAN FERNANDO</option>
                        <option value='0106'>PUCARA</option>
                        <option value='0109'>SIGSIG</option>
                        <option value='0115'>CAMILO PONCE ENRIQUEZ</option>
                        <option value='0111'>CHORDELEG</option>
                        <option value='0103'>GUALACEO</option>
                        <option value='0101'>CUENCA</option>
                        <option value='0113'>SEVILLA DE ORO</option>
                        <option value='0112'>EL PAN</option>
                        <option value='0114'>GUACHAPALA</option>
                        <option value='0105'>PAUTE</option>
                        <option value='0202'>CHILLANES</option>
                        <option value='0205'>SAN MIGUEL</option>
                        <option value='0203'>CHIMBO</option>
                        <option value='0206'>CALUMA</option>
                        <option value='0201'>GUARANDA</option>
                        <option value='0204'>ECHEANDIA</option>
                        <option value='0207'>LAS NAVES</option>
                        <option value='0306'>DELEG</option>
                        <option value='0301'>AZOGUES</option>
                        <option value='0302'>BIBLIAN</option>
                        <option value='0303'>CAÑAR</option>
                        <option value='0305'>EL TAMBO</option>
                        <option value='0307'>SUSCAL</option>
                        <option value='0304'>LA TRONCAL</option>
                        <option value='0402'>BOLIVAR</option>
                        <option value='0404'>MIRA</option>
                        <option value='0405'>MONTUFAR</option>
                        <option value='0406'>SAN PEDRO DE HUACA</option>
                        <option value='0406'>ESPEJO</option>
                        <option value='0401'>TULCAN</option>
                        <option value='0503'>PANGUA</option>
                        <option value='0505'>SALCEDO</option>
                        <option value='0504'>PUJILI</option>
                        <option value='0501'>LATACUNGA</option>
                        <option value='506'>SAQUISILI</option>
                        <option value='502'>LA MANA</option>
                        <option value='SIGCHOS'>SIGCHOS</option>
                        <option value='CHUNCHI'>CHUNCHI</option>
                        <option value='CUMANDA'>CUMANDA</option>
                        <option value='ALAUSI'>ALAUSI</option>
                        <option value='PALLATANGA'>PALLATANGA</option>
                        <option value='GUAMOTE'>GUAMOTE</option>
                        <option value='CHAMBO'>CHAMBO</option>
                        <option value='COLTA'>COLTA</option>
                        <option value='RIOBAMBA'>RIOBAMBA</option>
                        <option value='GUANO'>GUANO</option>
                        <option value='PENIPE'>PENIPE</option>
                        <option value='MARCABELI'>MARCABELI</option>
                        <option value='BALSAS'>BALSAS</option>
                        <option value='LAS LAJAS'>LAS LAJAS</option>
                        <option value='PORTOVELO'>PORTOVELO</option>
                        <option value='ZARUMA'>ZARUMA</option>
                        <option value='PIÑAS'>PIÑAS</option>
                        <option value='ATAHUALPA'>ATAHUALPA</option>
                        <option value='HUAQUILLAS'>HUAQUILLAS</option>
                        <option value='ARENILLAS'>ARENILLAS</option>
                        <option value='SANTA ROSA'>SANTA ROSA</option>
                        <option value='CHILLA'>CHILLA</option>
                        <option value='PASAJE'>PASAJE</option>
                        <option value='MACHALA'>MACHALA</option>
                        <option value='EL GUABO'>EL GUABO</option>
                        <option value='QUININDE'>QUININDE</option>
                        <option value='MUISNE'>MUISNE</option>
                        <option value='ATACAMES'>ATACAMES</option>
                        <option value='ESMERALDAS'>ESMERALDAS</option>
                        <option value='RIOVERDE'>RIOVERDE</option>
                        <option value='ELOY ALFARO'>ELOY ALFARO</option>
                        <option value='SAN LORENZO'>SAN LORENZO</option>
                        <option value='GUAYAQUIL'>GUAYAQUIL</option>
                        <option value='ALFREDO BAQUERIZO MORENO (JUJAN)'>ALFREDO BAQUERIZO MORENO (JUJAN)</option>
                        <option value='BALAO'>BALAO</option>
                        <option value='BALZAR'>BALZAR</option>
                        <option value='COLIMES'>COLIMES</option>
                        <option value='DAULE'>DAULE</option>
                        <option value='DURAN'>DURAN</option>
                        <option value='EL EMPALME'>EL EMPALME</option>
                        <option value='EL TRIUNFO'>EL TRIUNFO</option>
                        <option value='MILAGRO'>MILAGRO</option>
                        <option value='NARANJAL'>NARANJAL</option>
                        <option value='NARANJITO'>NARANJITO</option>
                        <option value='PALESTINA'>PALESTINA</option>
                        <option value='PEDRO CARBO'>PEDRO CARBO</option>
                        <option value='SAMBORONDON'>SAMBORONDON</option>
                        <option value='SANTA LUCIA'>SANTA LUCIA</option>
                        <option value='URBINA JADO'>URBINA JADO</option>
                        <option value='YAGUACHI'>YAGUACHI</option>
                        <option value='PLAYAS'>PLAYAS</option>
                        <option value='SIMON BOLIVAR'>SIMON BOLIVAR</option>
                        <option value='CORONEL MARCELINO MARIDUEÑA'>CORONEL MARCELINO MARIDUEÑA</option>
                        <option value='LOMAS DE SARGENTILLO'>LOMAS DE SARGENTILLO</option>
                        <option value='NOBOL'>NOBOL</option>
                        <option value='GENERAL  ANTONIO ELIZALDE'>GENERAL  ANTONIO ELIZALDE</option>
                        <option value='ISIDRO AYORA'>ISIDRO AYORA</option>
                        <option value='OTAVALO'>OTAVALO</option>
                        <option value='COTACACHI'>COTACACHI</option>
                        <option value='ANTONIO ANTE'>ANTONIO ANTE</option>
                        <option value='PIMAMPIRO'>PIMAMPIRO</option>
                        <option value='SAN MIGUEL DE URCUQUI'>SAN MIGUEL DE URCUQUI</option>
                        <option value='IBARRA'>IBARRA</option>
                        <option value='ESPINDOLA'>ESPINDOLA</option>
                        <option value='QUILANGA'>QUILANGA</option>
                        <option value='ZAPOTILLO'>ZAPOTILLO</option>
                        <option value='MACARA'>MACARA</option>
                        <option value='GONZANAMA'>GONZANAMA</option>
                        <option value='CALVAS'>CALVAS</option>
                        <option value='SOZORANGA'>SOZORANGA</option>
                        <option value='PINDAL'>PINDAL</option>
                        <option value='CELICA'>CELICA</option>
                        <option value='PALTAS'>PALTAS</option>
                        <option value='OLMEDO'>OLMEDO</option>
                        <option value='CATAMAYO'>CATAMAYO</option>
                        <option value='PUYANGO'>PUYANGO</option>
                        <option value='LOJA'>LOJA</option>
                        <option value='CHAGUARPAMBA'>CHAGUARPAMBA</option>
                        <option value='SARAGURO'>SARAGURO</option>
                        <option value='BABAHOYO'>BABAHOYO</option>
                        <option value='BABA'>BABA</option>
                        <option value='MONTALVO'>MONTALVO</option>
                        <option value='PUEBLOVIEJO'>PUEBLOVIEJO</option>
                        <option value='QUEVEDO'>QUEVEDO</option>
                        <option value='URDANETA'>URDANETA</option>
                        <option value='VENTANAS'>VENTANAS</option>
                        <option value='VINCES'>VINCES</option>
                        <option value='PALENQUE'>PALENQUE</option>
                        <option value='BUENA FE'>BUENA FE</option>
                        <option value='VALENCIA'>VALENCIA</option>
                        <option value='MOCACHE'>MOCACHE</option>
                        <option value='QUINSALOMA'>QUINSALOMA</option>
                        <option value='PUERTO LOPEZ'>PUERTO LOPEZ</option>
                        <option value='PAJAN'>PAJAN</option>
                        <option value='OLMEDO'>OLMEDO</option>
                        <option value='24 DE MAYO'>24 DE MAYO</option>
                        <option value='JIPIJAPA'>JIPIJAPA</option>
                        <option value='SANTA ANA'>SANTA ANA</option>
                        <option value='MONTECRISTI'>MONTECRISTI</option>
                        <option value='MANTA'>MANTA</option>
                        <option value='JARAMIJO'>JARAMIJO</option>
                        <option value='PORTOVIEJO'>PORTOVIEJO</option>
                        <option value='JUNIN'>JUNIN</option>
                        <option value='ROCAFUERTE'>ROCAFUERTE</option>
                        <option value='BOLIVAR'>BOLIVAR</option>
                        <option value='PICHINCHA'>PICHINCHA</option>
                        <option value='TOSAGUA'>TOSAGUA</option>
                        <option value='SUCRE'>SUCRE</option>
                        <option value='CHONE'>CHONE</option>
                        <option value='SAN VICENTE'>SAN VICENTE</option>
                        <option value='EL CARMEN'>EL CARMEN</option>
                        <option value='FLAVIO ALFARO'>FLAVIO ALFARO</option>
                        <option value='JAMA'>JAMA</option>
                        <option value='PEDERNALES'>PEDERNALES</option>
                        <option value='GUALAQUIZA'>GUALAQUIZA</option>
                        <option value='SAN JUAN BOSCO'>SAN JUAN BOSCO</option>
                        <option value='LIMON INDANZA'>LIMON INDANZA</option>
                        <option value='TIWINTZA'>TIWINTZA</option>
                        <option value='LOGROÑO'>LOGROÑO</option>
                        <option value='SANTIAGO'>SANTIAGO</option>
                        <option value='SUCUA'>SUCUA</option>
                        <option value='MORONA'>MORONA</option>
                        <option value='TAISHA'>TAISHA</option>
                        <option value='HUAMBOYA'>HUAMBOYA</option>
                        <option value='PALORA'>PALORA</option>
                        <option value='PABLO SEXTO'>PABLO SEXTO</option>
                        <option value='CARLOS JULIO AROSEMENA TOLA'>CARLOS JULIO AROSEMENA TOLA</option>
                        <option value='TENA'>TENA</option>
                        <option value='ARCHIDONA'>ARCHIDONA</option>
                        <option value='QUIJOS'>QUIJOS</option>
                        <option value='EL CHACO'>EL CHACO</option>
                        <option value='PASTAZA'>PASTAZA</option>
                        <option value='MERA'>MERA</option>
                        <option value='SANTA CLARA'>SANTA CLARA</option>
                        <option value='ARAJUNO'>ARAJUNO</option>
                        <option value='MEJIA'>MEJIA</option>
                        <option value='RUMIÑAHUI'>RUMIÑAHUI</option>
                        <option value='DISTRITO METROPOLITANO DE QUITO'>DISTRITO METROPOLITANO DE QUITO</option>
                        <option value='CAYAMBE'>CAYAMBE</option>
                        <option value='SAN MIGUEL DE LOS BANCOS'>SAN MIGUEL DE LOS BANCOS</option>
                        <option value='PEDRO MONCAYO'>PEDRO MONCAYO</option>
                        <option value='PEDRO VICENTE MALDONADO'>PEDRO VICENTE MALDONADO</option>
                        <option value='PUERTO QUITO'>PUERTO QUITO</option>
                        <option value='MOCHA'>MOCHA</option>
                        <option value='QUERO'>QUERO</option>
                        <option value='BAÑOS DE AGUA SANTA'>BAÑOS DE AGUA SANTA</option>
                        <option value='CEVALLOS'>CEVALLOS</option>
                        <option value='TISALEO'>TISALEO</option>
                        <option value='PATATE'>PATATE</option>
                        <option value='PELILEO'>PELILEO</option>
                        <option value='AMBATO'>AMBATO</option>
                        <option value='PILLARO'>PILLARO</option>
                        <option value='CHINCHIPE'>CHINCHIPE</option>
                        <option value='PALANDA'>PALANDA</option>
                        <option value='ZAMORA'>ZAMORA</option>
                        <option value='NANGARITZA'>NANGARITZA</option>
                        <option value='PAQUISHA'>PAQUISHA</option>
                        <option value='CENTINELA DEL CONDOR'>CENTINELA DEL CONDOR</option>
                        <option value='YANTZAZA'>YANTZAZA</option>
                        <option value='EL PANGUI'>EL PANGUI</option>
                        <option value='YACUAMBI'>YACUAMBI</option>
                        <option value='SAN CRISTOBAL'>SAN CRISTOBAL</option>
                        <option value='SANTA CRUZ'>SANTA CRUZ</option>
                        <option value='ISABELA'>ISABELA</option>
                        <option value='CUYABENO'>CUYABENO</option>
                        <option value='SHUSHUFINDI'>SHUSHUFINDI</option>
                        <option value='GONZALO PIZARRO'>GONZALO PIZARRO</option>
                        <option value='LAGO AGRIO'>LAGO AGRIO</option>
                        <option value='PUTUMAYO'>PUTUMAYO</option>
                        <option value='CASCALES'>CASCALES</option>
                        <option value='SUCUMBIOS'>SUCUMBIOS</option>
                        <option value='AGUARICO'>AGUARICO</option>
                        <option value='LORETO'>LORETO</option>
                        <option value='ORELLANA'>ORELLANA</option>
                        <option value='LA JOYA DE LOS SACHAS'>LA JOYA DE LOS SACHAS</option>
                        <option value='SANTO DOMINGO'>SANTO DOMINGO</option>
                        <option value='LA CONCORDIA'>LA CONCORDIA</option>
                        <option value='2402'>LA LIBERTAD</option>
                        <option value='2403'>SALINAS</option>
                        <option value='2401'>SANTA ELENA</option>
                        <option value='9007'>ABDON CALDERON</option>
                        <option value='9004'>EL PIEDRERO</option>
                        <option value='9006'>JUVAL</option>
                        <option value='9005'>SANTA ROSA DE AGUA CLARA</option>
                        <option value='9008'>MATILDE ESTHER</option>
                        <option value='9001'>LAS GOLONDRINAS</option>
					</select>			
				
			</div>
	</div>	
	<div>
	<label for="" class="matricula__matriculacion-label">Tipo De Colegio</label>
				<select class="form-control input-sm" name="tipoColegioId" required>
					<option value='1'>Fiscal</option>
					<option value='2'>Fiscomisional</option>
					<option value='3'>Particular</option>
					<option value='4'>Auditiva</option>
					<option value='5'>Municipal</option>
					<option value='6'>Extranjero</option>
					<option value='7'>no Registra</option>
					</select>		
					<label for="" class="matricula__matriculacion-label">Modalidad De La Carrera</label>
				<select class="form-control input-sm" name="modalidadCarrera" required>
					<option value='1'>Presencial</option>
					<option value='2'>Semi-Presencial</option>
					<option value='3'>Distancia</option>
					<option value='4'>Dual</option>
					</select>	
					<label for="" class="matricula__matriculacion-label">Jornada De La Carrera</label>
				<select class="form-control input-sm" name="jornadaCarrera" required>
					<option value='1'>Matutina</option>
					<option value='2'>Vespertina</option>
					<option value='3'>Nocturna</option>
					<option value='4'>Intensiva</option>
					</select>	
					<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha De Inicio De La Carrera<span class="valorError">*</span></label>
				<input type="date" class="form-control input-sm" name="fechaInicioCarrera" value="{{old('fechaNacimiento', $data->fechaNacimiento)}}" required>
			</div>	
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Fecha De Matriculacion <span class="valorError">*</span></label>
				<input type="date" class="form-control input-sm" name="fecha_matriculacion" value="{{old('fechaNacimiento', $data->fechaNacimiento)}}" required>
			</div>	
			<label for="" class="matricula__matriculacion-label">Tipo De Matricula</label>
				<select class="form-control input-sm" name="tipo_matricula" required>
					<option value='1'>Ordinaria</option>
					<option value='2'>Extraordinaria</option>
					<option value='3'>Especial</option>
					</select>	
					<label for="" class="matricula__matriculacion-label">nivel academico</label>
				<select class="form-control input-sm" name="nivelAcademicoQueCursa" required>
					<option value='1'>1ro</option>
					<option value='2'>2do</option>
					<option value='3'>3ro</option>
					<option value='4'>4to</option>
					<option value='5'>5to</option>
					<option value='6'>6to</option>
					</select>	
					<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">duracion del periodo academico<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="duracionPeriodoAcademico" maxlength="100" placeholder="duracion del periodo academico" value="{{old('apellidos', $data->apellidos)}}" required>
			</div>
			<label for="" class="matricula__matriculacion-label">ha repetido almenos una materia</label>
				<select class="form-control input-sm" name="haRepetidoAlMenosUnaMateria" required>
					<option value="1" {{$data->haRepetidoAlMenosUnaMateria == '1' ? 'selected' : ''}}>Si</option>
					<option value="2" {{$data->haRepetidoAlMenosUnaMateria == '2' ? 'selected' : ''}}>No</option>	
					</select>		
			
					<label for="" class="matricula__matriculacion-label">Ha Perdido la gratuidad</label>
				<select class="form-control input-sm" name="haPerdidoLaGratuidad" required>
					<option value='1'>Si</option>
					<option value='2'>No</option>
					<option value='3'>No aplica</option>
					</select>	
					<label for="" class="matricula__matriculacion-label">recibe pension diferenciada</label>
				<select class="form-control input-sm" name="recibePensionDiferenciada" required>
					<option value='1'>Si</option>
					<option value='2'>No</option>
					<option value='3'>No Aplica</option>
					</select>	
					<label for="" class="matricula__matriculacion-label">ocupacion</label>
				<select class="form-control input-sm" name="estudianteocupacionId" required>
					<option value='1'>Solo estudia</option>
					<option value='2'>Trabaja y Estudia </option>	
					</select>		
					<label for="" class="matricula__matriculacion-label">ingresos estudiante</label>
				<select class="form-control input-sm" name="ingresosestudianteId" required>
					<option value='1'>Financiar sus estudios</option>
					<option value='2'>Para mantener a su hogar </option>
					<option value='3'>Gastos personales</option>
					<option value='4'>No aplica</option>
					</select>	
					<label for="" class="matricula__matriculacion-label">Su familia recibe bono de desarrollo humano </label>
				<select class="form-control input-sm" name="bonodesarrolloId" required>
					<option value='1'>Si</option>
					<option value='2'>No </option>	
					</select>	
					<label for="" class="matricula__matriculacion-label">Realizo Practicas pre profesionales </label>
				<select class="form-control input-sm" name="haRealizadoPracticasPreprofesionales" required>
					<option value='1'>Si</option>
					<option value='2'>No </option>	
					</select>	
				

	</div>
	
			
	
			<div style="grid-column:1/3">
				<hr>
			</div>
			<divd>
			<h3 class="matricula__matriculacion-title">CONTACTOS DE EMERGENCIA</h3>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">horas de la ultima practica pre profesional que realizo<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="nroHorasPracticasPreprofesionalesPorPeriodo" maxlength="100" placeholder="duracion del periodo academico" value="{{old('apellidos', $data->apellidos)}}" required>
			</div>	
			<div class="matricula__matriculacion__input">
			<label for="" class="matricula__matriculacion-label">Tipo De institusion donde realizo las practicas pre profesionales</label>
				<select class="form-control input-sm" name="entornoInstitucionalPracticasProfesionales" required>
					<option value='1'>Publica</option>
					<option value='2'>Privada</option>
					<option value='3'>ONG</option>
					<option value='4'>Otro</option>
					<option value='5'>No aplica</option>
					</select>	
</div>
					<div class="matricula__matriculacion__input">	
					<label for="" class="matricula__matriculacion-label">sector economico donde realizo las practicas pre profesionales</label>
				<select class="form-control input-sm" name="sectorEconomicoPracticaProfesional" required>
				<option value='1'>Agricultura, ganaderia, silvicultura y pesca</option>
                    <option value='2'>Explotacion de minas y canteras</option>
                    <option value='3'>Industrias manofactureras</option>
                    <option value='4'>Suministro de electricidad, gas vapor y aire acondicionado</option>
                    <option value='5'>Distribucion de agua; alcantarillado, gestion de desechos y actividades de sanamiento </option>
                    <option value='6'>Construccion</option>
                    <option value='7'>Comercio al por mayor y menor reparacion de vehiculos automoteres y motocicletas</option>
                    <option value='9'>Transporte y almacenamiento</option>
                    <option value='10'>Actividades de alojamiento y de servicios de comidas</option>
                    <option value='11'>Informacion y comunicacion</option>
                    <option value='12'>Actividades financieras y de seguros</option>
                    <option value='13'>Actividadesde inmobiliarias</option>
                    <option value='14'>Actividades profesionales, cientificas y tecnicas</option>
                    <option value='15'>Actividades de servicios asministrativos y de apoyo</option>
                    <option value='16'>Administracion publica y defensa; planes de seguridad social de afiliacion obligartoria</option>
                    <option value='17'>Enseñanza</option>
                    <option value='18'>Actividades de atencion de la salud humana y de asistencia social </option>
                    <option value='19'>Artes, entretenimiento y recreacion</option>
                    <option value='20'>Otras actividades de servicios</option>
                    <option value='21'>Actividades de los hogares como productores de vienes y servicios para uso propio</option>
                    <option value='22'>No aplica</option>

					
					</select>	
</div>
					<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">tipo de beca que recibe </label>
				<select class="form-control input-sm" name="tipoBecaId" required>
					<option value='1'>Total</option>
					<option value='2'>Parcial</option>
					<option value='3'>No aplica</option>
					</select>	
</div>
					<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">primera razon de la beca </label>
				<select class="form-control input-sm" name="primeraRazonBecaId" required>
					<option value='1'>Socioeconomica</option>
					<option value='2'>No aplica</option>
					</select>
</div>
					<div class="matricula__matriculacion__input">	
					<label for="" class="matricula__matriculacion-label">segunda razon de la beca  </label>
				<select class="form-control input-sm" name="segundaRazonBecaId" required>
					<option value='1'>Excelencia academica</option>
					<option value='2'>No aplica</option>
					</select>
</div>
					<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">tercera razon de la beca</label>
				<select class="form-control input-sm" name="terceraRazonBecaId" required>
					<option value='1'>Deportiva</option>
					<option value='2'>No aplica</option>
					</select>	
					</div>
					<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">cuarta razon de la beca</label>
			<select class="form-control input-sm" name="cuartaRazonBecaId" required>
					<option value='1'>Pueblos y nacionalidades</option>
					<option value='2'>No aplica</option>
					</select>	
					</div>
					<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">quinta razon de la beca </label>
				<select class="form-control input-sm" name="quintaRazonBecaId" required>
					<option value='1'>Discapacidad</option>
					<option value='2'>No aplica</option>
					</select>	
</div>
					<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Sexta razon de la beca </label>
				<select class="form-control input-sm" name="sextaRazonBecaId " required>
					<option value='1'>Otra</option>
					<option value='2'>No aplica</option>
					</select>
</div>
				<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">porcentaje de la beca que cubre el valor del arancel<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="porcientoBecaCoberturaArancel"  maxlength="100" placeholder="ingrese un valor" value="{{old('apellidos', $data->apellidos)}}" required>
				
				<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">porcentaje de la beca que cubre la manutencion<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="porcientoBecaCoberturaManuntencion"  maxlength="100" placeholder="ingrese un valor" value="{{old('apellidos', $data->apellidos)}}" required>
			
			</div>
			<label for="" class="matricula__matriculacion-label">tipo de financiamiento de la beca</label>
				<select class="form-control input-sm" name="financiamientoBeca" required>
					<option value='1'>Fondos propios</option>
					<option value='2'>Transferencia del estado</option>
					<option value='3'>Donaciones</option>
					</select>
					<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">valor del monto de la ayuda economica<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="montoAyudaEconomica"  maxlength="100" placeholder="ingrese un valor" value="{{old('apellidos', $data->apellidos)}}" required>
				<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">valor del monto de credito educativo<span class="valorError"></span></label>
				<input type="text" class="form-control input-sm" name="montoCreditoEducativo"  maxlength="100" placeholder="ingrese un valor" value="{{old('apellidos', $data->apellidos)}}" required>
				
			</div>
			<label for="" class="matricula__matriculacion-label">ha participado durante el periodo de un proyecto de vinculacion social  </label>
				<select class="form-control input-sm" name="participaEnProyectoVinculacionSociedad" required>
					<option value='1'>Si</option>
					<option value='2'>No</option>
					<option value='3'>No aplica</option>
					</select>	
					<label for="" class="matricula__matriculacion-label">alcance del proyecto de vinculacion con la sociedad </label>
				<select class="form-control input-sm" name="tipoAlcanceProyectoVinculacionId" required>
					<option value='1'>Nacional</option>
					<option value='2'>Provincial</option>
					<option value='3'>Cantonal</option>
					<option value='4'>Parroquial</option>
					<option value='5'>No aplica</option>
					</select>
					
			</div>	
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">correo del estudiante</label>
				<input type="text" class="form-control input-sm" name="correoElectronico" placeholder="Teléfonos de la residencia o movil del estudiante" value="{{old('telefono', $dataProfile->telefono_movil)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">numero de telefono estudiante</label>
				<input type="text" class="form-control input-sm" name="telefono_movil"  maxlength="10" placeholder="Teléfonos de la residencia o movil del estudiante" value="{{old('telefono', $dataProfile->telefono_movil)}}">
			</div>











			<label for="" class="matricula__matriculacion-label">nivel de formacion del padre</label>
				<select class="form-control input-sm" name="nivelFormacionPadre" required>
					<option value='1'>Centro de alfabetizacion</option>
					<option value='2'>Jardin de infantes</option>
					<option value='3'>Primaria</option>
					<option value='4'>Educacion basica</option>
					<option value='5'>Secundaria</option>
					<option value='6'>Educacion media</option>
					<option value='7'>Superior no universitaria</option>
					<option value='8'>Superior universitaria</option>
					<option value='9'>Posgrado</option>
					</select>
					<label for="" class="matricula__matriculacion-label">nivel de formacion de la madre</label>
				<select class="form-control input-sm" name="nivelFormacionMadre" required>
					<option value='1'>Centro de alfabetizacion</option>
					<option value='2'>Jardin de infantes</option>
					<option value='3'>Primaria</option>
					<option value='4'>Educacion basica</option>
					<option value='5'>Secundaria</option>
					<option value='6'>Educacion media</option>
					<option value='7'>Superior no universitaria</option>
					<option value='8'>Superior universitaria</option>
					<option value='9'>Posgrado</option>
					</select>
					<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">ingresos del hogar<span</label>
				<input type="text" class="form-control input-sm" name="ingresoTotalHogar"maxlength="100" placeholder="ingrese un valor" value="{{old('direccion', $dataProfile->direccion_domicilio)}}" required>
			</div>	
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">numero de miembros del hogar<span</label>
				<input type="text" class="form-control input-sm" name="cantidadMiembrosHogar"  maxlength="100" placeholder="ingrese un valor" value="{{old('direccion', $dataProfile->direccion_domicilio)}}" required>
			</div>	
					


            
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Primer Contacto Emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="contactoEmergencia" minlength="3" maxlength="100" placeholder="Nombres y Apellidos del contacto de emergencia" value="{{old('contactoEmergencia', $dataProfile->nombre_contacto_emergencia)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono del contacto de emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="telefonoEmergencia" minlength="9" maxlength="10" placeholder="Teléfono del contacto para emergencias" value="{{old('telefonoEmergencia', $dataProfile->movil_contacto_emergencia)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parentezco<span class="valorError">*</span></label>
				<select class="form-control" name="parentezco_contacto_emergencia">
					<option value="">Seleccione un parentezco...</option>
					@foreach (config('pined.parentezcos') as $parentezco)
						<option {{old('parentezco_contacto_emergencia') == $parentezco ? 'selected' : ''}} {{$dataProfile->parentezco_contacto_emergencia == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
					@endforeach
					
				</select>
			</div>
			<div style="grid-column:1/3">
				<hr>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Segundo Contacto Emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="segundo_contacto_emergencia" minlength="3" maxlength="100" placeholder="Nombres y Apellidos del contacto de emergencia" value="{{old('contactoEmergencia', $dataProfile->nombre_contacto_emergencia2)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Teléfono del contacto de emergencia<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="telefonoEmergencia2" minlength="9" maxlength="10" placeholder="Teléfono del contacto para emergencias" value="{{old('telefonoEmergencia', $dataProfile->movil_contacto_emergencia2)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Parentezco<span class="valorError">*</span></label>
				<select class="form-control" name="parentezco_contacto_emergencia2">
					<option value="">Seleccione un parentezco...</option>
					@foreach (config('pined.parentezcos') as $parentezco)
						<option {{old('parentezco_contacto_emergencia2') == $parentezco ? 'selected' : ''}} {{$dataProfile->parentezco_contacto_emergencia == $parentezco ? 'selected' : ''}} value="{{$parentezco}}">{{$parentezco}}</option>
					@endforeach
				</select>
			</div>	
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">DIRECCIÓN DOMICILIO</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Ciudad de domicilio<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="ciudad" minlength="3" maxlength="100" placeholder="Ciudad de residencia del estudiante" value="{{old('ciudad', $dataProfile->ciudad_domicilio)}}" required>
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Dirección Domicilio<span class="valorError">*</span></label>
				<input type="text" class="form-control input-sm" name="direccion" minlength="5" maxlength="100" placeholder="Direccion del domicilio del estudiante" value="{{old('direccion', $dataProfile->direccion_domicilio)}}" required>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Domicilio Telefono</label>
				<input type="text" class="form-control input-sm" name="telefono" minlength="8" maxlength="10" placeholder="Teléfonos de la residencia o movil del estudiante" value="{{old('telefono', $dataProfile->telefono_movil)}}">
			</div>
			<div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Tipo de vivienda</label>
                <select class="form-control js-example-basic-single" name="tipo_ivienda" class="form-control">
                    @foreach($tipo_vivienda as $key => $tip)
                        <option value="{{ $tip }}"> {{ $tip }} </option>
                    @endforeach
                </select>
				{{-- <input type="text" class="form-control input-sm" name="tipo_Vivienda" minlength="3" maxlength="100" placeholder="Tipo de vivienda que reside el estudiante" value="{{old('tipoVivienda', $dataProfile->tipo_vivienda)}}"> --}}
			</div>
		</div>
	</div>
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">INSTITUCIÓN ANTERIOR</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Institución Anterior</label>
				<input type="text" class="form-control input-sm" name="institucionAnterior" placeholder="Institución anterior, en caso que exista" value="{{old('institucionAnterior', $data->institucionAnterior)}}">
			</div>
			<div></div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Razones por el cambio</label>
				<input type="text" class="form-control input-sm" name="razon_Cambio" minlength="3" maxlength="250" placeholder="Razones de cambio, si existio" value="{{old('razonCambio', $data->razonCambio)}}">
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Observaciones</label>
				<textarea class="form-control input-sm" name="observaciones" rows="4" cols="50">{{old('observaciones', $data->observaciones)}}</textarea>
			</div>
		</div>
	</div>


	@if ($acceso == true)
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">ACCESO</h3>
			<div class="matricula__matriculacion__input">
				<div>
					<label for="" class="matricula__matriculacion-label">Contraseña</label>
					<input type="text" class="form-control input-sm" name="password" placeholder="Contraseña..." value="">
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Correo</label>
					<input type="email" class="form-control input-sm" name="correo" placeholder="Correo del estudiante" value="{{old('correo', $data->profile->correo)}}">
				</div>

			</div>
		</div>
	@endif
	
	@if ($configuracionPago->valor == '1')
		<div class="matricula__matriculacion-block">
			<h3 class="matricula__matriculacion-title">PAGOS</h3>
			<div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Representante Financiero</label>
					<select name="idCliente" class="form-control js-example-basic-single">
						<option value="">Escoja un cliente...</option>
						@foreach($clients as $client)
							<option {{old('idCliente') == $client->id ? 'selected' : ''}} {{$dataProfile->idCliente == $client->id ? 'selected' : ''}} value="{{$client->id}}">{{$client->apellidos}} {{$client->nombres}}</option>
						@endforeach
					</select>
				</div>
				@if ($configuracionBecas->valor ?? '0' == '1')
					<div class="matricula__matriculacion__input">
						<label for="" class="matricula__matriculacion-label">Beca</label>
						<select name="beca" class="form-control">
							<option value="0">Sin Beca</option>
							@foreach($becas->where('tipo', 'BECA') as $beca)
                                <option 
                                    {{old('beca') == $beca->id ? 'selected' : ''}}
									@if ($crear !== true)
										@if( count($beca_estudiante) > 0)
											{{ $beca_estudiante->where('idBeca', $beca->id)->first() != null ? 'selected': '' }} 
										@endif
									@endif
									value="{{ $beca->id }}">{{ $beca->nombre}}</option>
							@endforeach
						</select>
					</div>
					<div class="matricula__matriculacion__input" id="descuentos">
						<label for="" class="matricula__matriculacion-label">Descuentos</label>	
						<div class="descuentos__inputCheckbox-grid">
							@if (count($becas) == 0) 
								<p>No hay descuentos.</p>
							@endif
							@foreach($becas->where('tipo', 'DESCUENTO') as $beca)
								<div>
									<p class="descuentos__inputCheckbox">{{ $beca->nombre}} 
											<input type="checkbox" 
											value="{{ $beca->id }}" 
											class="form-control" 
										name="descuentos[]"
										@if ($crear !== true)
											@if(count($beca_estudiante) > 0)
												{{ $beca_estudiante->where('idBeca', $beca->id)->first() != null ? 'checked': '' }} 
											@endif
										@endif
										>
									</p> 
								</div>
							@endforeach
						</div>
					</div>
				@endif
			</div>
		</div>
	@else
		<input type="hidden" name="beca" value="0">
		<div></div>
	@endif
	<div class="matricula__matriculacion-block">
		<h3 class="matricula__matriculacion-title">PERIODO ACTUAL</h3>
		<div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Bloqueo</label>
				<select class="form-control input-sm" name="bloqueado">
					<option value=1 {{ ($data->bloqueado == 1 ) ? ' selected' : '' }}>Bloqueado</option>
					<option value=0 {{ ($data->bloqueado == 0 ) ? ' selected' : '' }}>Desbloqueado</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input personas_autorizadas">
				<label for="" class="matricula__matriculacion-label">Tipo Bloqueo</label>
				<select id="tipo_bloqueo" class="form-control estudiantes" name="tipo_bloqueo[]" multiple="multiple">
					@foreach ($tipo_bloqueos as $bloqueo)
						<option 
						@foreach ($dataProfile->bloqueos as $data_bloqueo)
							@if ($data_bloqueo->id == $bloqueo->id)
								selected
							@endif
						@endforeach
						value="{{$bloqueo->id}}">{{$bloqueo->nombre}}</option>
					@endforeach
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Actualizar desde admisión</label>
				<div class="matricula__radio-botones">
					<div class="flex items-center">
						<label for="condicionado_si">
							Si
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="actDesdeAdmisiones" id="actDesdeAdmisiones_si" value="0"
							@if ($dataProfile->actDesdeAdmisiones != null)
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
						<input class="matricula__radio inclusion_radio" type="radio" name="actDesdeAdmisiones" id="actDesdeAdmisiones_no" value="1"
							@if ($dataProfile->actDesdeAdmisiones != null)
								{{$dataProfile->actDesdeAdmisiones == '1' ? 'checked' : ''}}
							@endif
							>
					</div>
				</div>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Tipo de matricula</label>
				<select id="estado_matricula" class="form-control input-sm" name="matricula">
					@if ($dataProfile->tipo_matricula == 'Pre Matricula')
					<option value="Pre Matricula"
							{{ 'Pre Matricula' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Pre-Matricula</option>
					@endif 
					@if ($dataProfile->tipo_matricula == null)
						<option value="Pre Matricula"
								{{ 'Pre Matricula' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Pre-Matricula</option>
					@endif
					<option value="Ordinaria" 
							{{ 'Ordinaria' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Ordinaria</option>
					<option value="Extraordinaria" 
							{{ 'Extraordinaria' == $dataProfile->tipo_matricula ? 'selected' : '' }}>Extraordinaria</option>
				</select>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Condicionado</label>
				<div class="matricula__radio-botones">
					<div class="flex items-center">
						<label for="condicionado_si">
							Si
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="condicionado" id="condicionado_si" value="Si"
							@if ($dataProfile->condicionado != null)
								{{$dataProfile->condicionado == 'Si' ? 'checked' : ''}}
							@endif
							>
					</div>
					<div class="flex items-center matricula__radio-div">
						<label for="condicionado_no">
							No
						</label>
						<input class="matricula__radio inclusion_radio" type="radio" name="condicionado" id="condicionado_no" value="No"
							@if ($dataProfile->condicionado != null)
								{{$dataProfile->condicionado == 'No' ? 'checked' : ''}}
							@else
								checked
							@endif
							>
					</div>
				</div>
			</div>
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">Carrera<span class="valorError">*</span></label>
				<select class="form-control input-sm" name="curso" id="matricula-curso">
				
				
					@foreach($careers as $career)
					 <!--<option data-seccion="{{ $career -> nombre }}" value="{{ $career -> id }}"
					 {{ $career->id == $dataProfile->id ? ' selected' : '' }}>-->
					 
					 	
					 		
						 	<option value="{{ $career ['id'] }}" >{{ $career ['nombre'] }}</option>
						
					 <!--<option value="{{ $career ['id'] }}" 
							{{  $career ['id'] }} == $dataProfile->id ? 'selected' : '' }}>{{ $career ['nombre'] }}</option>
						
							<option value="{{ $career ['id'] }}">{{ $career ['nombre'] }}</option>-->
						
					@endforeach
				</select>
			</div>
			
			@if ($numeroMatricula == true)
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Numero de Matricula</label>
					<input type="text" class="form-control input-sm" name="numeroMatricula" value="{{$dataProfile->numero_matriculacion ?? '-'}}">
				</div>
			@endif
			@if ($retirado == true)
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Retirado</label>
					<select class="form-control input-sm" name="retirado">
						<option value="SI" {{$dataProfile->retirado == 'SI' ? 'selected' : ''}} >SI</option>
						<option value="NO" {{$dataProfile->retirado == 'NO' ? 'selected' : ''}} >NO</option>
					</select>
				</div>
				<div class="matricula__matriculacion__input">
					<label for="" class="matricula__matriculacion-label">Observación del estudiante retirado</label>
					<textarea name="observacion_retirado" id="" cols="30" rows="5" class="form-control">{{old('observacion_retirado', $dataProfile->observacion_retirado)}}</textarea>
				</div>
			@endif
			<div class="matricula__matriculacion__input">
				<label for="" class="matricula__matriculacion-label">documentos informacion</label>
				<textarea name="documentos_informacion" cols="30" rows="5" class="form-control">{{old('documentos_informacion', $dataProfile->documentos_informacion)}}</textarea>
			</div>
		</div>
	</div>
	<div class="matricula__botones-final">
		<div>
			@if ($reporte_pagos == true || $data == !false) 
			<div class="dropdown">
				<button class="bg-none border-none dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img class="w-8" src="{{secure_asset('img/file-download.svg')}}" alt="">
				</button>
				<div class="dropdown-menu calificaciones__dropDown p-4" aria-labelledby="dropdownMenuButton" style="left: 6px; top: {{$crear ? '-53px' : '-486px'}}; width: 277px;">
					<div class="calificaciones__dropDown-grid">
						@if (!$crear)
						<a href="{{route('hojaDeVida', $data->id)}}" class="calificaciones__dropDown__item-link">
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
						</a>
						@endif
						<a href="{{route('reporte.informacionPersonalMatricula', $data->id)}}" class="calificaciones__dropDown__item-link">
							Ficha de Datos
						</a>
						@if (!$crear)
						<a href="{{route('reporte.actaDeMatricula', $data->id)}}" class="calificaciones__dropDown__item-link">
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
						</a>
						@endif
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="text-right">
			@if ($dataProfile->idCurso == !null && $configuracionTransporte->valor == '1')
				<a class="mb-1 btn btn-primary btn-lg" href="{{route('pagosCursoEstudiante', [$data->id])}}">
					Realizar Pago
				</a>
			@endif
            <input 
                id="btn-matricular-estudiante"
				type="submit"
				class="mb-1 btn btn-primary btn-lg" 
				value="{{$button}}">
		</div>
	</div>
</div>
