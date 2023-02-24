@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
<a class="button-br" href="{{route('destrezasAdminCurso', $Matter->idCurso)}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">
				Destrezas
			</h2>
			<select class="select__header form-control" id="selectParcial">
				<optgroup label="Quimestre 1">
					<option value="P1Q1" {{$parcial == 'P1Q1' ? 'selected' : '' }}>Q1 - Parcial 1</option>
					<option value="P2Q1" {{$parcial == 'P2Q1' ? 'selected' : '' }}>Q1 - Parcial 2</option>
					<option value="P3Q1" {{$parcial == 'P3Q1' ? 'selected' : '' }}>Q1 - Parcial 3</option>
					<option value="EXQ1" {{$parcial == 'EXQ1' ? 'selected' : '' }}>Examen Quimestre 1</option>
				</optgroup>
				<optgroup label="Quimestre 2">
					<option value="P1Q2" {{$parcial == 'P1Q2' ? 'selected' : '' }}>Q2 - Parcial 1</option>
					<option value="P2Q2" {{$parcial == 'P2Q2' ? 'selected' : '' }}>Q2 - Parcial 2</option>
					<option value="P3Q2" {{$parcial == 'P3Q2' ? 'selected' : '' }}>Q2 - Parcial 3</option>
					<option value="EXQ2" {{$parcial == 'EXQ2' ? 'selected' : '' }}>Examen Quimestre 2</option>
				</optgroup>
			</select>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="migajasDePan__enlaces-container">
					<a href="{{route('destrezasAdminCurso', $Matter->idCurso)}}"> {{$course->grado}}
						{{$course->especialzacion}} {{$course->paralelo}} </a>
					<img src="{{secure_asset('img/chevron-double-right-solid.svg')}}" width="10" alt="">
					<a class="no-pointer"> {{$Matter->nombre}} </a>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-1 mb-1">
		<div class="col-xs-12 ">
			<div class="agregarSeccionCont">
				<a href="#" data-toggle="modal" data-target="#aT">
					<button class="btn dirConfiguraciones__instituto--agregarInfo">Añadir Clase Destreza</button>
				</a>
			</div>
		</div>
		<div class="col-xs-12 mt-1">
			<div class="panel panel-default">
				<div class="pined-table-responsive">
					<div class="d-f">
						<div class="mr-3">
							<table id="tableGrades" class="s-calificaciones">
								<tr class="table__bgBlue">
									<td class="text-center no-border">#</td>
									<td class="no-border fz19">Estudiante</td>
								</tr>
								@foreach($Students as $index => $student)
								<tr>
									<td class="text-center">{{($index+1)}}</td>
									<td class="">{{$student->apellidos}}, {{$student->nombres}}</td>
								</tr>
								@endforeach
							</table>
						</div>
						<div>
							<table class="s-calificaciones">
								<tr class="table__bgBlue">
									<td colspan="3" class="no-border fz19">Listado destrezas</td>
								</tr>
								@foreach($destrezas as $destreza)
								<tr>
									<td>
										<a
											href="{{route('showClaseDestrezasMateriaAdmin',['idMateria' => $Matter->id, 'parcial' => $parcial, 'idDestreza' => $destreza->id])}}">
											{{$destreza->nombre}}
										</a>
									</td>
									<td class="text-center">
										<a href="{{route('editDestrezaAdmin',[$Matter->id, $parcial,$destreza->id])}}">
											<i class="fa fa-pencil icon__ver"></i>
										</a>
									</td>
									<td class="text-center">
										<form
											action="{{route('deleteDestrezasAdmin',[$destreza->id, $parcial])}}"
											method="post" class="icon__eliminar-form form-delete"
											onclick="eliminarDestreza({{$destreza->id}})">
											<input name="_method" type="hidden" value="DELETE">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<button type="submit" class="icon__eliminar-btn">
												<i class="fa fa-trash icon__eliminar"></i>
											</button>
										</form>
									</td>
								</tr>
								@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Crear Actividad -->
<div class="modal fade" id="aT" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Crear Clase Destreza</h4>
			</div>
			<div class="modal-body">
				<form id="FormAddActivity" method="POST"
					action="{{route('crearClaseDestrezaAdmin',[$Matter->id, $parcial])}}">
					<div class="widget widget-tabs">
						<div class="tabs-container">
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#tab-1">GENERAL</a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab-2">OBSERVACIONES</a>
								</li>
							</ul>
							{{csrf_field()}}
							<div class="tab-content">
								<div id="tab-1" class="tab-pane active">
									<table class="table table-bordered" width="75%">
										<tbody>
											<tr>
												<td width="25%" class="text-right" style="background: #EDF3F4">
													<span>Destreza</span>
												</td>
												<td>
													<select class="form-control" name="idDestreza" required>
														<option value="">Seleccionar...</option>
														@foreach($destrezasCreadas as $destreza)
														<option value="{{$destreza->id}}">{{$destreza->nombre}}</option>
														@endforeach
													</select>
												</td>
											</tr>
											<tr>
												<td width="25%" class="text-right" style="background: #EDF3F4">
													<span>Quimestre</span>
												</td>
												<td>
													<select class="form-control" name="idQuimestre" required>
														<option value="">Seleccionar...</option>
														<option value="Q1">1er Quimestre</option>
														<option value="Q2">2do Quimestre</option>
													</select>
												</td>
											</tr>
											<tr>
												<td width="25%" class="text-right" style="background: #EDF3F4">
													<span>Parcial</span>
												</td>
												<td>
													<select class="form-control" name="idParcial" required>
														<option value="">Seleccionar...</option>
														<option value="P1">1er Parcial</option>
														<option value="P2">2do Parcial</option>
														<option value="P3">3er Parcial</option>
														<option value="EX">Examen</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div id="tab-2" class="tab-pane">
									<input type="textarea" class="form-control" rows="5" name="observacion"
										id="descripcion" placeholder="Observaciones">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary" id="AddActividad">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	const url = "{{route('destrezasAdmin')}}"
	const idMateria = '{{$Matter->id}}'
	const selectParcial = document.getElementById('selectParcial')
	selectParcial.addEventListener('change', function() {
		const parcial = selectParcial.value
		let newurl = `${url}/${idMateria}/${parcial}`
		location.href = newurl;
	})
</script>
@endsection
@section('scripts')
	<script>
		var url = window.location.origin
		function eliminarDestreza(idDestreza) {
			Swal.fire({
				title: '¿Seguro desea eliminar esta destreza?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'SI',
				cancelButtonText: 'NO'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							type: "POST",
							url: `${url}/configuraciones/areas/${idDestreza}`,
							data: {
								'_token': $('input[name=_token]').val(),
								'_method': 'DELETE'
							},
							success: function (response) {
								$('#'+idDestreza).css('display', 'none')
								Swal.fire(
									'La area ha sido eliminado!',
									'',
									'success'
								)
							}, error: function(response) {
								alert('Algo salio mal.')
							}
						});
						
				}
			})
		}
	</script>
@endsection