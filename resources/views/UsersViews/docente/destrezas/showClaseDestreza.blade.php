@extends('layouts.master')
@section('content')
<a class="button-br" href="{{route('showDestrezasMateria',['idMateria' => $Matter->id, 'parcial' => $parcial])}}">
<button>
	<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Destrezas de {{$Matter->nombre}}
			</h2>
		</div>
	</div>
	<div class="row mt-1 mb-1">
		<div class="col-xs-12 mt-1">
			<div class="panel panel-default">
				<div class="pined-table-responsive">
					<div class="d-f">
						<div class="mr-3">
							<table id="tableGrades" class="s-calificaciones">
								<tr class="table__bgBlue">
									<td class="text-center no-border">#</td>
									<td class="no-border fz19">Estudiante</td>
									@foreach($clasedestrezas as $clasedestreza)
										<td class="no-border fz19 " data-toggle="tooltip"title="{{$destreza->nombre}}">
											{{str_limit($destreza->nombre,50)}} {{$clasedestreza->parcial}}
										</td>
									@endforeach
								</tr>
								@foreach($Students as $index => $student)
								<tr>
									<td class="text-center">{{($index+1)}}</td>
									<td class="uppercase">{{$student->apellidos}}, {{$student->nombres}}</td>
									@foreach($clasedestrezas as $clasedestreza)
										@if($destreza->id == $clasedestreza->idDestrezas)
										<td>
											<!-- <input type="text" id="std{{($index + 1).$loop->iteration}}" class="" value="" name=""> -->
											<select class="form-control"
												id="calificacionesSelect-{{$destreza->id}}-{{$clasedestreza->id}}-{{$student->id}}"
												name="calificacionesSelect-{{$destreza->id}}-{{$clasedestreza->id}}-{{$student->id}}"
												onchange="changedGrade(this.id)" class="">
												<option value="0">Seleccionar Nota</option>
												<option value="I">Inicio</option>
												<option value="EP">En proceso</option>
												<option value="A">Adquirida</option>
												<option value="NE">No Evaluada</option>
											</select>
										</td>
										@endif
									@endforeach
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
				<form id="FormAddActivity" action="{{route('crearClaseDestreza')}}">
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
							<input type="hidden" name="idMateria" value="{{$Matter->id}}">
							<div class="tab-content">
								<div id="tab-1" class="tab-pane active">
									<table class="table table-bordered" width="75%">
										<tbody>
											<tr>
												<td width="25%" class="text-right" style="background: #EDF3F4">
													<span>Destreza</span>
												</td>
												<td>
													<select class="form-control" name="idDestreza">
														<option value="">Seleccionar...</option>
														<option value="{{$destreza->id}}">{{$destreza->nombre}}</option>
													</select>
												</td>
											</tr>
											<tr>
												<td width="25%" class="text-right" style="background: #EDF3F4">
													<span>Quimestre</span>
												</td>
												<td>
													<select class="form-control" name="idQuimestre">
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
													<select class="form-control" name="idParcial">
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
	@endsection

	@section('scripts')
	<script>
		function changedGrade(id){
		var json = {};
		var splitID = id.split('-');
		var elms = document.getElementById("tableGrades").getElementsByTagName("select");
		for (var i = 0; i < elms.length; i++) {
			if(elms[i].id.indexOf("calificacionesSelect-"+splitID[1]+"-"+splitID[2]) !== -1){
				var splitID2 = elms[i].id.split('-');
				json[splitID2[3]] = elms[i].value;
			}
		}

		$.ajax({
			 url: "{{route('updateClaseDestreza')}}" ,
			 type:"POST",
			 data:{
				 '_token': $('input[name=_token]').val(),
				 "notas": JSON.stringify(json) ,
				 "id": splitID[2]},
			 success: function(result, status, xhr){

			 },
			 error: function (xhr,status,error){
					 alert("Error!!");

			 },

	 });
	}

	var clases = {!!$jsonClases!!};
	var elms = document.getElementById("tableGrades").getElementsByTagName("select");

		jQuery.each(clases, function(k, val) {
			var cali = JSON.parse(val['calificacion']);

				jQuery.each(cali, function(j, value) {

						for (var i = 0; i < elms.length; i++) {
							var splitID2 = elms[i].id.split('-');
							if(splitID2[1]==val['idDestrezas']	&&	splitID2[2]==val['id']){
								if(j==splitID2[3]){
									$("#"+elms[i].id).find('option[value="'+value+'"]').attr("selected",true);
								}
							}
						}


				});

		});





	</script>

	@endsection