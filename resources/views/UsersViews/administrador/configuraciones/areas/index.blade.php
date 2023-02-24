@php
    $permiso = App\Permiso::desbloqueo('configuracionesAreas');
@endphp
@extends('layouts.master')
@if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
@section('content')
<a class="button-br" href="{{ route('configuraciones') }}">
	<button>
		<img src="img/return.png" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12">
			<h2 class="title-page">Configuraciones <small>Areas</small></h2>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="dirConfiguraciones__cursos">
			@if($regimen=='Regular')
				<div class="dirConfiguraciones__cursos__seccion">
					<div class="d-ib">
						<div class="dirConfiguraciones__materias-cont">
							<h2 class="dirConfiguraciones__cursos__seccion--title">
								Educación Inicial 
							</h2>
							<button	id="btnCourse1" class="btn" data-toggle="modal" data-target="#modalAgregarAreaEI">
								<img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="" />Agregar Area
							</button>
							<button id="btnordenar" class="btn" data-toggle="modal">
									<a class="mostrar_orden_areas" href="{{route('ordenAreas',['area' => 'EI'])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Areas</a>
								</button>
						</div>
					</div>
					<div class="configuracionesMaterias-grid">
						@foreach ($areaEI as $area)
							<div class="configuracionesMaterias__item" id="{{$area->id}}">
								<p class="no-margin bold"> {{$area->nombre}} </p>
								<div class="configuracionesMaterias__btnEdit">
									<a href="" data-toggle="modal" data-target="#modalEditarArea{{$area->id}}">
										<i class="fa fa-pencil icon__ver color-white"></i>
									</a>
									<span>
										<div class="icon__eliminar-form form-delete m-0" onclick="eliminarArea({{$area->id}})">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<button type="submit" class="icon__eliminar-btn">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</span>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			@endif
			<div class="dirConfiguraciones__cursos__seccion">
				<div class="d-ib">
					<div class="dirConfiguraciones__materias-cont">
						<h2 class="dirConfiguraciones__cursos__seccion--title">
							Educación General Básica
						</h2>
						<button	id="btnCourse1" class="btn" data-toggle="modal" data-target="#modalAgregarAreaEGB">
							<img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="" />Agregar Area
						</button>
						<button id="btnordenar" class="btn" data-toggle="modal">
									<a class="mostrar_orden_areas" href="{{route('ordenAreas',['area' => 'EGB'])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Areas</a>
						</button>
					</div>
				</div>
				<div class="configuracionesMaterias-grid">
					@foreach ($areaEGB as $area)
						<div class="configuracionesMaterias__item" id="{{$area->id}}">
							<p class="no-margin bold"> {{$area->nombre}} </p>
							<div class="configuracionesMaterias__btnEdit">
								<a href="" data-toggle="modal" data-target="#modalEditarArea{{$area->id}}">
									<i class="fa fa-pencil icon__ver color-white"></i>
								</a>
								<span>
									<div class="icon__eliminar-form form-delete m-0" onclick="eliminarArea({{$area->id}})">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="icon__eliminar-btn">
											<i class="fa fa-trash"></i>
										</button>
									</div>
								</span>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			<div class="dirConfiguraciones__cursos__seccion">
				<div class="d-ib">
					<div class="dirConfiguraciones__materias-cont">
						<h2 class="dirConfiguraciones__cursos__seccion--title">
							Bachillerato General Unificado
						</h2>
						<button	id="btnCourse1" class="btn" data-toggle="modal" data-target="#modalAgregarAreaBGU">
							<img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="" />Agregar Area
						</button>
						<button id="btnordenar" class="btn" data-toggle="modal">
						<a class="mostrar_orden_areas" href="{{route('ordenAreas',['area' => 'BGU'])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Areas</a>
						</button>
					</div>
				</div>
				<div class="configuracionesMaterias-grid">
					@foreach ($areaBGU as $area)
						<div class="configuracionesMaterias__item" id="{{$area->id}}">
							<p class="no-margin bold"> {{$area->nombre}} </p>
							<div class="configuracionesMaterias__btnEdit">
								<a href="" data-toggle="modal" data-target="#modalEditarArea{{$area->id}}">
									<i class="fa fa-pencil icon__ver color-white"></i>
								</a>
								<span>
									<div class="icon__eliminar-form form-delete m-0" onclick="eliminarArea({{$area->id}})">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="icon__eliminar-btn">
											<i class="fa fa-trash"></i>
										</button>
									</div>
								</span>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Agregar Area EI -->
<div class="modal fade" id="modalAgregarAreaEI" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Area</h4>
			</div>
			<form action="{{route('configuracionesAreas-post')}}" method="POST">
				<div class="modal-body">
					<div class="grid-form">
						{{ csrf_field() }}
						<p class="no-margin grid-form-p">Nombre de la Área: </p>
						<input type="text" name="nombreArea" class="form-control" placeholder="" required>
						<p class="no-margin grid-form-p">Dependiente: </p>
						<input type="checkbox" name="dependiente" class="form-control">
						<p class="no-margin grid-form-p">Observación: </p>
						<textarea name="observacionArea" id="" cols="30" rows="4" class="form-control"></textarea>
						<input name="seccionArea" type="text" value="EI" style="visibility: hidden">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Agregar Area EGB -->
<div class="modal fade" id="modalAgregarAreaEGB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Area</h4>
			</div>
			<form action="{{route('configuracionesAreas-post')}}" method="POST">
				<div class="modal-body">
					<div class="grid-form">
						{{ csrf_field() }}
						<p class="no-margin grid-form-p">Nombre de la Área: </p>
						<input type="text" name="nombreArea" class="form-control" placeholder="" required>
						<p class="no-margin grid-form-p">Dependiente: </p>
							<input type="checkbox" name="dependiente" class="form-control">
						<p class="no-margin grid-form-p">Observación: </p>
						<textarea name="observacionArea" id="" cols="30" rows="4" class="form-control"></textarea>
						<input name="seccionArea" type="text" value="EGB" style="visibility: hidden">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Agregar Area BGU -->
<div class="modal fade" id="modalAgregarAreaBGU" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Area</h4>
			</div>
			<form action="{{route('configuracionesAreas-post')}}" method="POST">
				<div class="modal-body">
					<div class="grid-form">
						{{ csrf_field() }}
						<p class="no-margin grid-form-p">Nombre de la Área: </p>
						<input type="text" name="nombreArea" class="form-control" placeholder="" required>
						<p class="no-margin grid-form-p">Dependiente: </p>
							<input type="checkbox" name="dependiente" class="form-control">
						<p class="no-margin grid-form-p">Observación: </p>
						<textarea name="observacionArea" id="" cols="30" rows="4" class="form-control"></textarea>
						<input name="seccionArea" type="text" value="BGU" style="visibility: hidden">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Editar -->
@foreach ($areas as $area)
	<div class="modal fade" id="modalEditarArea{{$area->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" onclick="fillModal()">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar Area</h4>
				</div>
				<form action="{{route('configuracionesAreas-edit', $area)}}" method="POST">
					<div class="modal-body">
						<div class="grid-form">
							{{ csrf_field() }}
							{{method_field('PUT')}}
							<p class="no-margin grid-form-p">Nombre de la Área: </p>
							<input type="text" name="nombreArea" class="form-control" placeholder="" value="{{$area->nombre}}">
							<p class="no-margin grid-form-p">Dependiente: </p>
							<input type="checkbox" name="dependiente" class="form-control" {{ $area->dependiente ? 'checked' : ''}}>
							<p class="no-margin grid-form-p">Observación: </p>
							<textarea name="observacionArea" id="" cols="30" rows="4" class="form-control">{{$area->observacion}}</textarea>
							<input name="seccionArea" type="hidden" value="{{$area->seccion}}">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Actualizar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modificacion de orden de areas-->
<div class="modal fade" id="dirModalEditarordenArea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

</div>
<!--fin-->
@endforeach
@endsection
@else
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">NO TIENE PERMISOS NECESARIOS.</h2>
            </div>
        </div>
    </div>
@endif
@section('scripts')
	<script>
		var url = window.location.origin
		function eliminarArea(idArea) {
			Swal.fire({
				title: 'Seguro desea eliminar a esta area?',
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
							url: `${url}/configuraciones/areas/${idArea}`,
							data: {
								'_token': $('input[name=_token]').val(),
								'_method': 'DELETE'
							},
							success: function (response) {
								$('#'+idArea).css('display', 'none')
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
		$('.mostrar_orden_areas').click(function(e){
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#dirModalEditarordenArea').html(result)
                $('#dirModalEditarordenArea').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});
	</script>
@endsection
