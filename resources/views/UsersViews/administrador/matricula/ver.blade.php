@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg directorPerfil-info">
		<div class="col-lg-12">
			<h2 class="title-page">Estudiante:
				<small>{{ $data->nombres }} {{ $data->apellidos }}</small>
			</h2>
		</div>
	</div>
	<br>
	<span class="label label-success">Información del Estudiante</span>
	<div class="row">
		<div class="col-lg-12">
			<div class="widget widget-tabs mt-0">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#tab-registro">Registro</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-general">General</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-adicional">Adicional</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-emergencias">Emergencias</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-al">Año Lectivo</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-R">Representante</a>
						</li>
					</ul>
					<div class="tab-content">

						<div id="tab-registro" class="tab-pane active">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Cédula/Pasaporte </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->ci }}</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div id="tab-general" class="tab-pane">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Nombres </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->nombres }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Apellidos </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->apellidos }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Sexo </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->sexo }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Fecha de Nacimiento </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->fechaNacimiento }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Ciudad Domicilio </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->ciudad }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Dirección Domicilio </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->direccion }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Teléfono(movil) </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->telefono }}</p>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
						<div id="tab-adicional" class="tab-pane">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Nacionalidad </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->nacionalidad }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Lugar de Nacimiento </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->lugarNacimiento }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Tipo de Vivienda </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->tipoVivienda }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Institución Anterior </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->institucionAnterior }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Razones por el cambio </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->razonCambio }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Observaciones </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->observaciones }}</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div id="tab-emergencias" class="tab-pane">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Clínica / Hosp. de preferencia </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->clinica }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Indicaciones </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->indicaciones }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Tipo de sangre </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->tipoSangre }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Contacto de emergencia </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->contactoEmergencia }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Teléfono del contacto de emergencia </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->telefonoEmergencia }}</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div id="tab-al" class="tab-pane">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Curso </span>
										</td>
										<td>
											<p class="no-margin">@if($data->idCurso != null ) {{ $courses[$data->idCurso -1]->grado }} {{ $courses[$data->idCurso -1]->paralelo }} @endif</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Seccion </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->seccion }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Tipo de matricula </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->matricula }}</p>
										</td>
									</tr>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Nivel </span>
										</td>
										<td>
											<p class="no-margin">{{ $data->nivelDeIngles }}</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div id="tab-R" class="tab-pane">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td class="text-right w25 tabletd_name">
											<span> Representante </span>
										</td>
										<td>
											<p class="no-margin">@if( $data->idRepresentante != null ) {{ $users[$data-> idRepresentante -1]->nombres }} {{ $users[$data-> idRepresentante
											-1]->apellidos }} @endif</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection