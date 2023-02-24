@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12">
			<h2 class="title-page">Institución
				<small> Docentes</small>
			</h2>
		</div>
	</div>
	<div class="row mt-1">
		<div class="col-xs-12">
			<input id="searchTerm" type="text" class="inputSearch" placeholder="Buscar..." onkeyup="doSearch()">
		</div>
	</div>
	<div class="row animated">
		<div class="col-xs-12">
			<div class="white-bg p-1">
				<div class="pined-table-responsive">
					<table id="regTable" class="s-calificaciones w100" id="table-list">
						<tr class="table__bgBlue">
							<td class="no-border text-center">Docente</td>
							<td class="no-border text-center">Dirigente</td>
							<td class="no-border text-center">Correo</td>
							<td class="no-border text-center">Materias</td>
							<td class="no-border text-center"></td>
						</tr>
						<tr>
							<td>
								<span>Ruth, Arguello Mendoza</span>
							</td>
							<td>
								<span>Octavo A</span>
							</td>
							<td>
								<span>ruty271@hotmail.com</span>
							</td>
							<td class="text-center">
								<button class="btn btn-primary btnPlus btnPlus" type="button" data-toggle="modal" data-toggle="modal" data-target="#dirMateriasProfesor1">
									<i class="fa fa-search-plus"></i> Ver</button>
							</td>
							<td class="text-center">
								<a href="" data-toggle="modal" data-toggle="modal" data-target="#dirInfoProfesor1">
									<i class="fa fa-eye a-fa-download__matricula mr-1"></i>
								</a>
								<a href="pdf/Info Profesor 1.pdf" download="Info Profesor 1.pdf">
									<i class="fa fa-print icon__enviar-mensaje"></i>
								</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal de Información de materias de 8A -->
<div class="modal fade" id="dirMateriasProfesor1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h2 class="modal-title" id="curso-modal">
					<i class="fa fa-user"></i> Ruth Arguello Mendoza</h2>
			</div>
			<div class="modal-body ">
				<div class="row mt-0">
					<div class="col-lg-3">
					</div>
					<div class="col-lg-6">
						<ul class="list-group clear-list m-t">
							<li class="list-group-item fist-item">
								<span class="pull-right">
									Octavo A
								</span>
								<span class="label label-success">1</span>
								<span> Lengua y Literatura </span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal de Información de Profesor 1 -->
<div class="modal fade" id="dirInfoProfesor1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h2 class="modal-title" id="curso-modal">
					<i class="fa fa-user text-color3"></i> Ruth Arguello Mendoza</h2>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="widget widget-tabs">
							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<li class="active">
										<a data-toggle="tab" href="#tab-1">General</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab-2">Adicional</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab-3">Domicilio</a>
									</li>
									<li>
										<a data-toggle="tab" href="#tab-4">Cargos</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="tab-1" class="tab-pane active">
										<table class="table table-bordered" width="75%">
											<tbody>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Cédula/Pasaporte </span>
													</td>
													<td><p class="no-margin"> 0926011438</p> </td>
												</tr>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Nombres </span>
													</td>
													<td> <p class="no-margin">Miguel</p> </td>
												</tr>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Apellidos </span>
													</td>
													<td><p class="no-margin"> Bonifaz Calderon</p></td>
												</tr>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Sexo </span>
													</td>
													<td><p class="no-margin">Femenino</p></td>
												</tr>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Fecha de Nacimiento </span>
													</td>
													<td>
														<p class="no-margin">
															xx/xx/xx
														</p>
													</td>
												</tr>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Correo </span>
													</td>
													<td><p class="no-margin">ruty271@hotmail.com</p></td>
												</tr>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Celular </span>
													</td>
													<td><p class="no-margin">NO DISPONIBLE</p></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div id="tab-2" class="tab-pane">
										<table class="table table-bordered" width="75%">
											<tbody>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Biografía </span>
													</td>
													<td>
														<p class="no-margin">
															<!-- aquí -->
														</p>
													</td>
												</tr>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Curriculum </span>
													</td>
													<td>
														<p class="no-margin">
															<!-- aquí -->
														</p>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div id="tab-3" class="tab-pane">
										<table class="table table-bordered" width="75%">
											<tbody>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Dirección del domicilio </span>
													</td>
													<td><p class="no-margin"> Cdla. Maldonado</p></td>
												</tr>
												<tr>
													<td class="text-right w25 tabletd_name">
														<span> Teléfono del domicilio </span>
													</td>
													<td><p class="no-margin">2860085</p></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div id="tab-4" class="tab-pane">
										<div class="pined-table-responsive">
											<table class="s-calificaciones w100">
												<tr class="table__bgBlue">
													<td class="no-border">#</td>
													<td class="no-border">Departamento</td>
													<td class="no-border">Cargo</td>
												</tr>
												<tr>
													<td>1</td>
													<td>Docente</td>
													<td>Profesor de Lengua y Literatura</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script language="javascript">
	function doSearch() {
		var tableReg = document.getElementById('regTable');
		var searchText = document.getElementById('searchTerm').value.toLowerCase();
		for (var i = 1; i < tableReg.rows.length; i++) {
			var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
			var found = false;
			for (var j = 0; j < cellsOfRow.length && !found; j++) {
				var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
				if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
					found = true;
				}
			}
			if (found) {
				tableReg.rows[i].style.display = '';
			} else {
				tableReg.rows[i].style.display = 'none';
			}
		}
	}
</script> @endsection