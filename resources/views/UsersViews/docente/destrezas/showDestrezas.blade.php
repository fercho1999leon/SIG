@extends('layouts.master')
@section('content')
@php
$unidad = App\UnidadPeriodica::unidadP();
use Illuminate\Pagination\LengthAwarePaginator;
$permiso =  App\Permiso::desbloqueo('destrezasAdmin');
@endphp
@if(session('user_data')->cargo =='Administrador')
<a class="button-br" href=" {{route('destrezasAdminCurso', $Matter->idCurso)}} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
@else
<a class="button-br" href=" {{route('destrezas')}} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
@endif
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion pb-4 pt-4">
			<h3 class="title-page">Destrezas de {{$Matter->nombre}}</h3>
			<div class="flex flex-col lg:flex-row">
				<select class="mr-4 select__header form-control" id="selectParcial">
					@foreach($unidad as $und)
						<optgroup label="{{$und->nombre}}">
							@php
								$parcialP = App\ParcialPeriodico::parcialP($und->id);
							@endphp
							@foreach($parcialP as $par )
								@if($par->identificador=='q1')
									<option value="EXQ1" {{'EXQ1' == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
								@elseif($par->identificador=='q2')
									<option value="EXQ2" {{'EXQ2' == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
								@else
									<option value="{{strtoupper($par->identificador)}}" {{strtoupper($par->identificador) == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
								@endif
							@endforeach
							<option value="{{strtoupper($und->identificador)}}" {{$parcial == strtoupper($und->identificador) ? 'selected' : ''}} >{{$und->nombre}}</option>
						</optgroup>
					@endforeach
					<option value='ANUAL' {{$parcial == 'ANUAL' ? 'selected' : ''}} >Anual</option>
            	</select>
                {{-- @if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
				<a target="_blank" href="{{route('lista.cotejo', [$Matter, $parcial])}}" class="m-0 btn btn-black sm:mt-4 lg:mt-0">Lista de Cotejo</a>
                @endif --}}
			</div>
		</div>
	</div>
	<div class="row mt-1 mb-1 ">
		<div class="col-xs-12 ">
			<div class="white-bg  col-xs-12 titulo-separacion ">
				<h2 class="title-page">DESTREZAS</h2>
			<table>
			<tr>
            <td>
                @if($permiso ==null || ($permiso != null && $permiso->editar == 1))
            	<a href="#" data-toggle="modal" data-target="#Listar_Destrezas">
					<button class="btn btn-success">Gestionar Destrezas</button>
				</a>
                @endif
            </td>
            </tr>
			</table>
			</div>
		</div>
		<div class="col-xs-12 mt-1">
			<div class="panel panel-default">
				<div class="pined-table-responsive">
					<div class="d-f">
						<div class="mr-3">
							<form name="cualitativo" action="{{route('CalificacionCualitativaQuimestral')}}"  method="post">
							<table id="tableGrades" class="s-calificaciones">
								<input type="hidden" name="_token" value="{{ csrf_token()}}">
								<input type="hidden" name="C_parcial" value="{{$parcial}}">
								<input type="hidden" name="C_materia" value="{{$Matter->id}}">
								<tr class="table__bgBlue">
									<td class="text-center no-border">#</td>
									<td class="no-border fz19">Estudiante</td>
									<td class="no-border fz19">Calificación</td>
								</tr>
								@foreach($Students as $index => $student)
									<tr>
										<td class="text-center">{{($index+1)}}</td>
											<input type="hidden" name="CQ_estudiante[]" value="{{$student->id}}">
										<td class="uppercase">{{$student->apellidos}}, {{$student->nombres}}</td>
										<td class="uppercase">
											<select name="Calif_Cualitativa[]">
												@php
													$CCQ=App\calificacionCualitativaAmbitos::NotaCualitativaQuimestral($Matter->id,$student->id,$parcial);
												@endphp
												@if($CCQ!=null)
													<option value="NE" {{$CCQ->Calificacion == 'NE' ? 'selected' : '' }}>No Evaluada</option>
													<option value="I" {{$CCQ->Calificacion == 'I' ? 'selected' : '' }}>Inicio</option>
													<option value="EP" {{$CCQ->Calificacion == 'EP' ? 'selected' : '' }}>En proceso</option>
													<option value="A" {{$CCQ->Calificacion == 'A' ? 'selected' : '' }}>Adquirida</option>
												@else
													<option value="NE">No Evaluada</option>
													<option value="I">Inicio</option>
													<option value="EP">En proceso</option>
													<option value="A">Adquirida</option>
												@endif
											</select>
										</td>
									</tr>
								@endforeach
                                @if($permiso ==null || ($permiso != null && $permiso->editar == 1))
									<tr>
										<td colspan="3" align="right">
											<button type="submit" class="btn btn-primary">Guardar Calificaciones</button>
										</td>
									</tr>
                                @endif
							</table>
							</form>
						</div>
						<div>
							<table class="s-calificaciones">
								<tr class="table__bgBlue">
									<td colspan="2" class="no-border fz19">Listado destrezas</td>
								</tr>
								@foreach($destrezas as $destreza)
								<tr id="{{$destreza->id}}">
                                    @if($permiso ==null || ($permiso != null && $permiso->editar == 1))
									<td>
										<a  data-toggle="tooltip" title="{{$destreza->nombre}}"
											href="{{route('showClaseDestrezasMateria',['idMateria'  => $Matter->id, 'parcial' => $parcial, 'idDestreza'  =>  $destreza->id])}}">
											{{str_limit($destreza->nombre,50)}}
										</a>
									</td>
                                    @else
                                    <td>{{str_limit($destreza->nombre,50)}}
                                    </td>
                                    @endif
									<td class="text-center">
                                        @if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
										<div
											method="post" class=""
											onclick="eliminarEnlace({{$destreza->id_destreza}}, '{{$parcial}}', '{{$destreza->id}}')">
											<input type="hidden" name="_token2" value="{{ csrf_token() }}">
											<button type="submit" class="icon__eliminar-btn">
												<i class="fa fa-unlink"></i>
											</button>
										</div>
                                        @endif
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
<!--crear Destreza JR-->
<div class="modal fade" id="C_destreza" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Crear Destreza Materia</h4>
			</div>
			<div class="modal-body">
				<form id="crear_destreza" method="post" action="{{ route('crearDestrezaDocente') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idMateriaGrado" id="idMateriaGrado" value="{{$Matter->id}}">
                <input type="hidden" name="grado" id="grado" value="{{$Course->id}}">
                <input type="hidden" name="parcial" id="parcial" value="{{$parcial}}">
                <input type="hidden" name="idDes_edit" id="idDes_edit" value="">
                    <input name="nombre" id="nombre" type="text" class="form-control" placeholder="Nombre de la destreza...">
                    <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" placeholder="Descripción de la destreza"></textarea>
                    <input type="checkbox" name="addToLis" value="{{$parcial}}"> Agregar al listado de la materia
                    <div class="modal-footer">
                    	<div id="botonesguardar">
                        <input type="reset" class="btn btn-danger " value="Cancelar">
                        <button type="submit" class="btn btn-primary ">GUARDAR</button>
                        </div>
                        <div id="botoneseditar" style="display: none">
                        	<input type="button" onclick="updateDestreza();" class="btn btn-primary " value="Editar">
                        </div>
                    </div>
            </form>
			</div>
		</div>
	</div>
</div>
@php
	if ($parcial=='ANUAL'){
		$titulo_check = "";
	}else{
		$parc = ( strlen($parcial) < 3 ? strtolower($parcial) : strtolower(substr($parcial,2,4)) );
		$unid = $unidad->where('identificador', $parc)->first()->id;
		$titulo_check = App\ParcialPeriodico::where('idUnidad', $unid)->where('identificador', strtolower($parc))->first()->nombre;
	}
@endphp

<div class="modal fade" id="Listar_Destrezas" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Listado de Materias</h4>


			</div>

			<div class="modal-body">
				<div class="flex justify-content-between">
							<h4></h4>
							<h4 class="flex align-items-center mr-2">
								<span class="mr-2"> Seleccionar todos</span>
							 <input class="mt-0" type="checkbox" checked="checked" id="inputPagosAll">&nbsp;&nbsp;
							 &nbsp;&nbsp;
								<button class="btn btn-primary" onclick="nuevaDestreza();">Crear Destreza<i class="fa fa-plus fa-fw" ></i></button>
							</h4>
							</div>
						<div class="card-body table-responsive p-0">
					<table class="table table-hover">
                      <tbody>
                        <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>{{$titulo_check}}</th>
                        <th colspan="2">Acción</th>
                      </tr>
                      <form method="post" action="{{route('crearClaseDestreza')}}">
                      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                      	<input type="hidden" name="parcial" value="{{$parcial}}">
                      	<input type="hidden" name="idMateria" id="idMateria" value="{{$Matter->id}}">
                      	<input type="hidden" name="grado" id="grado" value="{{$Course->id}}">
                      @foreach($destrezasCreadas as $destreza)
                      <tr id="verD{{$destreza->id}}">
                      	<td id="destrezaId" >
                      		{{$loop->index+1}}
                      	</td>
                      	<td id="destrezaNombre{{$destreza->id}}">
                      		{{str_limit($destreza->nombre,50)}}
                      	</td>
                      	<td id="destrezaDescripcion{{$destreza->id}}">
                      		{{str_limit($destreza->descripcion,50)}}
                      	</td>
                      	<td>
                      	<input type="checkbox" checked="checked" name="idDestreza[]" id="lis{{$destreza->id}}" onclick="desactivarREAD({{$destreza->id}})" value="{{$destreza->id}}">
                      	</td>
                      	<td>
                      	<input type="hidden" name="obs{{$destreza->id}}" id="obs{{$destreza->id}}" class="desactivar_read"  value="">
						<a onclick="editDestreza({{$destreza->id}},'{{$parcial}}');" >
						<i class="fa fa-pencil icon__ver"></i>
					</a>
					</td>
                     <td>
                     	<a onclick="eliminarDestreza({{$destreza->id}}, '{{$parcial}}')" >
						<i class="fa fa-trash icon__eliminar"></i>
					</a>
                      	</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>

				<div class="modal-footer">
				<input class="btn btn-danger" data-dismiss="modal" value="Cancelar">
				<button type="submit" class="btn btn-primary">Agregar al parcial</button>
				</div>
            </form>
			</div>
		</div>
	</div>
</div>
<script>
const url = "{{route('destrezas')}}"
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
		var enlace = window.location.origin
		function eliminarDestreza(idDestreza, parcial) {
			$('#Listar_Destrezas').modal('hide');
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
							url: `${enlace}/docente/Destrezas/${idDestreza}/${parcial}/delete`,
							data: {
								'_token': $('input[name=_token]').val(),
								'_method': 'DELETE'
							},
							success: function (response) {
								$('#verD'+idDestreza).css('display', 'none')
								$('#'+idDestreza).css('display', 'none')
								$('#Listar_Destrezas').modal('show');
							}, error: function(response) {
								alert('Algo salio mal.')
							}
						});

				}
			})
		}
		function eliminarEnlace(idClaseDestreza, parcial, idDestreza) {
			Swal.fire({
				title: '¿Seguro desea eliminar este enlace?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'SI',
				cancelButtonText: 'NO'
				}).then((result) => {
					//alert('dentro'+idClaseDestreza+ `${enlace}/docente/Destrezas/${idClaseDestreza}/${parcial}/enlace`);
					if (result.value) {
						$.ajax({
							type: "POST",
							url: `${enlace}/docente/Destrezas/${idClaseDestreza}/${parcial}/enlace`,
							data: {
								'_token': $('input[name=_token2]').val(),
								'_method': 'DELETE'
							},
							success: function (response) {
								$('#'+idDestreza).css('display', 'none')
								Swal.fire(
									'La destreza se ha desvinculado!',
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
		const listaDes = document.querySelectorAll('input[name="idDestreza[]"]')
		const activar = document.getElementById('inputPagosAll');
		if(listaDes) {
			activar.addEventListener('click', function() {
				if(activar.checked) {
					listaDes.forEach(e => {
						e.checked = true;
					});
				//$('.desactivar_read').prop("readonly",false);
				} else {
					listaDes.forEach(e => {
						e.checked = false;
					});
					//$('.desactivar_read').prop("readonly",true);


				}
			})
			listaDes.forEach(e => {
				e.addEventListener('click', function() {
					if(e.checked == false) {
						activar.checked = false;
					}
				})
			});
		} else {
			console.log('Error al seleccionar los input')
		}
		function desactivarREAD($id){

			if ($('#lis'+$id).prop('checked')) {
				//$('#obs'+$id).prop("readonly",false);


			}else{
				//$('#obs'+$id).prop("readonly",true);
			}

		}function nuevaDestreza(){
			$('#crear_destreza')[0].reset();
			$('#botoneseditar').hide();
			$('#botonesguardar').show();
			 $('#Listar_Destrezas').modal('hide');
			 $('#C_destreza').modal('show');
		}
		function editDestreza(idDestreza,parcial){
			//alert('dentro'+idDestreza+enlace+parcial);
			$.ajax({
           	type: "GET",
      		url: `${enlace}/docente/Destrezas/${idDestreza}/${parcial}/actualizar Destreza`,

          success:function(data){
          	$('#crear_destreza')[0].reset();
                $('#nombre').val(data['nombre']);
                $('#desc').val(data['descripcion']);
                $('#idDes_edit').val(data['id']);
				$('#Listar_Destrezas').modal('hide');
				$('#C_destreza').modal('show');
				$('#botonesguardar').hide();
				$('#botoneseditar').show();


          }, error: function() {
        console.log('Sucedio error al traer la información ')
      }
         });


		}
		function updateDestreza(){
			var valorId = $('input[name=idDes_edit]').val();
			var nombre = $('input[name=nombre]').val();
			var descripcion = $('#desc').val();
			//alert('update'+$('#desc').val());
			$.ajax({
							type: "POST",
							url: `${enlace}/docente/Destrezas/update`,
							data: {
								'_token': $('input[name=_token]').val(),
								'idMateriaGrado': $('input[name=idMateriaGrado]').val(),
								'grado': $('input[name=grado]').val(),
								'parcial': $('input[name=parcial]').val(),
								'nombre': $('input[name=nombre]').val(),
								'desc': $('#desc').val(),
								'id': $('input[name=idDes_edit]').val(),
								'_method': 'PUT'

							},
							success: function (response) {
							$('#destrezaNombre'+valorId).text(nombre.substring(0,50));
							$('#destrezaDescripcion'+valorId).text(descripcion.substring(0,50));
							$('#Listar_Destrezas').modal('show');
							$('#C_destreza').modal('hide');
							}, error: function(response) {
								alert('Algo salio mal.')
							}
						});
		}
	</script>
@endsection
