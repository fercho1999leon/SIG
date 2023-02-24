{{--
<div class="widget widget-tabs no-margin">
	<div class="tabs-container">
		<ul class="nav nav-tabs">
			<li class="active">
				<a data-toggle="tab" href="#tab-general">General</a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab-domicilio">Domicilio</a>
			</li>
			<li>
				<a data-toggle="tab" href="#tab-trabajo">Trabajo</a>
			</li>
		</ul>
						
		<div class="tab-content">
			<div id="tab-general" class="tab-pane active">
				<div class="form-group">
					<div class="table-responsive">
						<table class="table table-bordered a-table__nuevoAdministrativo">
							<tbody>
								<tr>
									<td class="text-right w25 tabletd_name">
										<span> Cédula/Pasaporte </span>
									</td>
									<td>
										{{$data->ci }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Nombres </span>
									</td>
									<td>
										{{ $data->nombres }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Apellidos </span>
									</td>
									<td>
										{{ $data->apellidos }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Sexo </span>
									</td>
									<td>
										@if($data->sexo == "Masculino")
											Masculino
			                            @else
											Femenino
			                            @endif
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Fecha Nacimiento </span>
									</td>
									<td>
										{{ $data->fNacimiento }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Nacionalidad </span>
									</td>
									<td>
										{{ $data->nacionalidad }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Telefono/Móvil </span>
									</td>
									<td>
										{{ $data->movil }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Correo: </span>
									</td>
									<td>
										{{ $data->correo }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Parentezco </span>
									</td>
									<td>
										@if($data->parentezco == "Padre")
											Padre
			                            @else
											Madre
			                            @endif
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Biografía </span>
									</td>
									<td>
										{{ $data->bio }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Estudios </span>
									</td>
									<td>
										{{ $data->estudios }}
									</td>
								</tr>
								<tr>
									<td class="text-right tabletd_name">
										<span> Religión </span>
									</td>
									<td>
										{{ $data->religion }}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div id="tab-domicilio" class="tab-pane">
				<div class="form-group">
					<div class="table-responsive">
						<table class="table table-bordered a-table__nuevoAdministrativo">
							<tr>
								<td class="text-right tabletd_name">
									<span> Ciudad Domicilio </span>
								</td>
								<td>
									{{ $data->ciudadDomicilio }}
								</td>
							</tr>
							<tr>
								<td class="text-right tabletd_name">
									<span> Dirección Domicilio </span>
								</td>
								<td>
									{{ $data->direccionDomicilio }}
								</td>
							</tr>
							<tr>
								<td class="text-right tabletd_name">
									<span> Teléfono Domicilio </span>
								</td>
								<td>
									{{ $data->telefonoDomicilio }}
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div id="tab-trabajo" class="tab-pane">
				<div class="form-group">
					<div class="table-responsive">
						<table class="table table-bordered a-table__nuevoAdministrativo">
							<tr>
								<td class="text-right tabletd_name">
									<span> Ciudad Trabajo: </span>
								</td>
								<td>
									{{ $data->ciudadTrabajo }}
								</td>
							</tr>
							<tr>
								<td class="text-right tabletd_name">
									<span> Dirección Trabajo: </span>
								</td>
								<td>
									{{ $data->direccionTrabajo }}
								</td>
							</tr>
							<tr>
								<td class="text-right tabletd_name">
									<span> Teléfono Trabajo: </span>
								</td>
								<td>
									{{ $data->telefonoTrabajo }}
								</td>
							</tr>
							<tr>
								<td class="text-right tabletd_name">
									<span> Cargo/Actividad: </span>
								</td>
								<td>
									{{ $data->cargoTrabajo }}
								</td>
							</tr>
							<tr>
								<td class="text-right tabletd_name">
									<span> Lugar Trabajo: </span>
								</td>
								<td>
									{{ $data->lugarTrabajo }}
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
--}}