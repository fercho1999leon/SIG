@php
    $permiso = App\Permiso::desbloqueo('configuracion_cronograma');
@endphp
@extends('layouts.master')
@if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
@section('content')
<a class="button-br" href="{{route('configuraciones')}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Cronograma</h2>
			<button class="title-page btn btn-black" data-toggle="modal" data-target="#cronograma">Agregar Cronograma</button>
		</div>
	</div>
	<div class="row mb350 mt-1">
		<div class="col-xs-12">
			<div class="cronogramaRoles-grid">
				@for ($i = 0; $i < count($roles); $i++)
					<div>
						<h3 class="ronogramaRoles__rolTitutlo">
							{{$roles[$i] == 'institucion' ? 'INSTITUCIÓN' : ''}}
							{{$roles[$i] == 'institucion_interna' ? 'INSTITUCIÓN INTERNA' : ''}}
							{{$roles[$i] == 'docente' ? 'DOCENTES' : ''}}
			
						</h3>
						@foreach ($cronogramas->where('rol', $roles[$i]) as $key => $cronograma)
							<div class="cronogramaRoles-item relative" id="{{$cronograma->id}}">
								<h3>Descripción:</h3>
								<h4>{{$cronograma->titulo ?? '-'}}</h4>
								<a href='{{Storage::url($cronograma->adjunto)}}' class="btn btn-primary w100" download>DESCARGAR CRONOGRAMA</a>
								<span class="cronogramaRoles__parcial">
									{{$cronograma->parcial == 'p1q1' ? '1er Parcial' : '' }}
									{{$cronograma->parcial == 'p2q1' ? '2do Parcial' : '' }}
									{{$cronograma->parcial == 'p3q1' ? '3er Parcial' : '' }}
									{{$cronograma->parcial == 'q1' ? 'Quimestral 1' : '' }}
									{{$cronograma->parcial == 'p1q2' ? '1er Parcial' : '' }}
									{{$cronograma->parcial == 'p2q2' ? '2do Parcial' : '' }}
									{{$cronograma->parcial == 'p3q2' ? '3er Parcial' : '' }}
									{{$cronograma->parcial == 'q2' ? 'Quimestral 2' : '' }}
									{{$cronograma->parcial == 'anual' ? 'Anual' : '' }}
								</span>
								<div class="d-flex mt-1" style="align-items: center;">
									<a data-toggle="modal" data-target="#editCronograma{{$key}}" class="cronogramaRoles__editar">
										<i class="icon__editar fa fa-pencil"></i>
									</a>
									<div onclick="eliminarCronograma({{$cronograma->id}})">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button type="submit" class="icon__eliminar-btn">
											<i class="fa fa-trash"></i>
										</button>
									</div>
								</div>
							</div>						
						@endforeach
					</div>
				@endfor
			</div>
		</div>
	</div>
</div>
<!-- Crear Actividad -->
<div class="modal fade" id="cronograma" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('configuracion_cronograma-store')}}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cronograma</h4>
				</div>
				<div class="modal-body">
					<div class="cronogramaConfigracionesModal-grid">
						<div>
							<label for="">Titulo</label>
							<input type="text" name="titulo" class="form-control" value="{{old('titulo')}}">
						</div>
						<div>
							<label for="">Adjuntar cronograma</label>
							<input type="file" name="archivoCronograma" required>
						</div>
						<div>
							<label for="">Parcial</label>
							<select class="form-control" name="parcial" required>
								<option value="">Seleccione un parcial</option>
								<option value="anual" {{old('parcial') == 'anual' ? 'selected' : ''}}>Anual</option>
								<optgroup label="Quimestre 1">
									<option value="p1q1" {{old('parcial') == 'p1q1' ? 'selected' : ''}} >Parcial 1</option>
									<option value="p2q1" {{old('parcial') == 'p2q1' ? 'selected' : ''}} >Parcial 2</option>
									<option value="p3q1" {{old('parcial') == 'p3q1' ? 'selected' : ''}} >Parcial 3</option>
									<option value="q1" {{old('parcial') == 'q1' ? 'selected' : ''}} >Quimestral</option>
								</optgroup>
								<optgroup label="Quimestre 2">
									<option value="p1q2" {{old('parcial') == 'p1q2' ? 'selected' : ''}}>Parcial 1</option>
									<option value="p2q2" {{old('parcial') == 'p2q2' ? 'selected' : ''}}>Parcial 2</option>
									<option value="p3q2" {{old('parcial') == 'p3q2' ? 'selected' : ''}}>Parcial 3</option>
									<option value="q2" {{old('parcial') == 'q2' ? 'selected' : ''}}>Quimestral</option>
								</optgroup>
							</select>
						</div>
						<div>
							<label for="">Rol</label>
							<select class="form-control" name="rol" required>
								<option value="">Seleccione un rol</option>
								<option value="institucion" {{old('rol') == 'institucion' ? 'selected' : ''}}>Institución</option>
								<option value="institucion_interna" {{old('rol') == 'institucion_interna' ? 'selected' : ''}}>Institución(interna)</option>
								<option value="docente" {{old('rol') == 'docente' ? 'selected' : ''}}>Docente</option>
								<option value="representante" {{old('rol') == 'representante' ? 'selected' : ''}}>Representante</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Subir Cronograma</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Editar Actividad -->
@foreach ($cronogramas as $key => $cronograma)
<div class="modal fade" id="editCronograma{{$key}}" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{route('configuracion_cronograma-update', $cronograma)}}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Cronograma</h4>
					</div>
					<div class="modal-body">
						<div class="cronogramaConfigracionesModal-grid">
							<div>
								<label for="">Titulo</label>
								<input type="text" name="titulo" class="form-control" value="{{$cronograma->titulo}}">
							</div>
							<div>
								<label for="">Adjuntar cronograma</label>
								<input type="file" name="archivoCronograma">
							</div>
							<div>
								<label for="">Parcial</label>
								<select class="form-control" name="parcial" required>
									<option value="">Seleccione un parcial</option>
									<option value="anual" {{$cronograma->parcial == 'anual' ? 'selected': ''}} >Anual</option>
									<optgroup label="Quimestre 1">
										<option value="p1q1" {{$cronograma->parcial == 'p1q1' ? 'selected': ''}} >Parcial 1</option>
										<option value="p2q1" {{$cronograma->parcial == 'p2q1' ? 'selected': '' }}>Parcial 2</option>
										<option value="p3q1" {{$cronograma->parcial == 'p3q1' ? 'selected': '' }}>Parcial 3</option>
										<option value="q1" {{$cronograma->parcial == 'q1' ? 'selected': '' }}>Quimestral</option>
									</optgroup>
									<optgroup label="Quimestre 2">
										<option value="p1q2" {{$cronograma->parcial == 'p1q2' ? 'selected': ''}} >Parcial 1</option>
										<option value="p2q2" {{$cronograma->parcial == 'p2q2' ? 'selected': ''}}>Parcial 2</option>
										<option value="p3q2" {{$cronograma->parcial == 'p3q2' ? 'selected': ''}}>Parcial 3</option>
										<option value="q2" {{$cronograma->parcial == 'q2' ? 'selected': ''}}>Quimestral</option>
									</optgroup>
								</select>
							</div>
							<div>
								<label for="">Rol</label>
								<select class="form-control" name="rol" required>
									<option value="">Seleccione un rol</option>
									<option value="institucion" {{$cronograma->rol == 'institucion' ? 'selected' : ''}} >Institución</option>
									<option value="institucion_interna" {{$cronograma->rol == 'institucion_interna' ? 'selected' : ''}} >Institución(interna)</option>
									<option value="docente" {{$cronograma->rol == 'docente' ? 'selected' : ''}} >Docente</option>
									<option value="representante" {{$cronograma->rol == 'representante' ? 'selected' : ''}} >Representante</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Actualizar Cronograma</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
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
		function eliminarCronograma(idCronograma) {
			Swal.fire({
				title: '¿Seguro desea eliminar este cronograma?',
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
							url: `${url}/configuraciones/cronogramaA/${idCronograma}/delete`,
							data: {
								'_token': $('input[name=_token]').val(),
								'_method': 'DELETE'
							},
							success: function (response) {
								$('#'+idCronograma).css('display', 'none')
								Swal.fire(
									'El cronograma ha sido eliminado!',
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