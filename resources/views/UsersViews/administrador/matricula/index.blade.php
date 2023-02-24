@extends('layouts.master2')
@section('assets')
@include('partials.loader.loader')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('matricula');
$usuario = session('user_data')->correo;
@endphp
<link href="{{secure_asset('bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
@endsection @section('content')
<style>
 .kv-file-upload{
    color:#fff !important;
    visibility: hidden !important;
}
</style>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	@if($permiso==null || ($permiso != null && $permiso->editar == 1))
	<div class="agregarSeccionCont">
		<a href="{{route('matriculaCrear')}}">
			<button class="matricula__reporteTotalEstudiantesMatriculado">Matricular Nuevo Estudiante</button>
		</a>
		@if (Sentinel::getUser()->email === 'info@itred.edu.ec')
			<button class="d-verInsumo-crear" data-toggle="modal" data-target="#importar" href="#">IMPORTAR</button>
		@endif
	</div>
	@endif
	<hr class="dirConfiguraciones__instituto--hr">
	<div class="row">
		@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
		<div class="col-lg-12 matricula__reporteTotalEstudiantesMatriculado-flex">
			<div class="p-1">
				<a class="matricula__reporteTotalEstudiantesMatriculado btn-primary" href="{{route('excel.index')}}">Descargar en Excel</i>&nbsp;
                </a>
				<a target="_blank" class="matricula__reporteTotalEstudiantesMatriculado btn-primary" href="{{route('reporte.matriculados2')}}">REPORTE ESTUDIANTES MATRICULADOS</a>
				<a target="_blank" class="matricula__reporteTotalEstudiantesMatriculado btn-primary" href="{{route('reporteEstudiantesConBecas')}}">ESTUDIANTES CON BECAS</a>
				<a target="_blank" class="matricula__reporteTotalEstudiantesMatriculado btn-primary" href="{{route('reporteMatriculados')}}">ESTUDIANTES MATRICULADOS</a>
			</div>
		</div>
		@endif
		<div class="col-lg-12">
			<form action="" class="matricula__filtroStudents">
				<input type="text" name="search" value="{{request('search')}}" class="form-control" placeholder="Buscar estudiante...">
				<select name="courses" class="form-control">
					<option value="">Todos los cursos</option>
					@foreach ($courses->where('seccion', 'EI') as $course)
						<option {{request('courses') == $course->id ? 'selected' : ''}} value="{{$course->id}}">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} </option>
					@endforeach
					@foreach ($courses->where('seccion', 'EGB') as $course)
						<option {{request('courses') == $course->id ? 'selected' : ''}} value="{{$course->id}}">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} </option>
					@endforeach
					@foreach ($courses->where('seccion', 'BGU') as $course)
						<option {{request('courses') == $course->id ? 'selected' : ''}} value="{{$course->id}}">{{$course->grado}} {{$course->paralelo}} {{$course->especializacion}} </option>
					@endforeach
				</select>
				<div class="matricula__filtroStudents__radios">
					@foreach (['Pre Matricula' => 'Pre Matricula'] as $key => $value)
						<div>
							<label class="m-0" for="{{$key}}" >{{$value}}</label>
							<input type="checkbox" name="matricula" id="{{$key}}" value="{{$key}}" {{request('matricula') == $key ? 'checked' : ''}} >
						</div>
					@endforeach
				</div>
				<button type="submit" class="btn btn-primary">BUSCAR</button>
			</form>
			<div class="director-profesores a-matricula__estudiantes">
				@foreach($students as $student)
					<div class="docente a-matricula__estudiantes-item" id="{{$student->id}}">
						<div class="w100 text-center">
							<p class="uppercase mb-05" id="admin">{{$student->apellidos}}, {{$student->nombres}}
								@if ($student->matricula == 'Pre Matricula')
									<span class="label label-danger">Pre-Matricula</span>
								@endif
							</p>
						<div class="a-personal-administrativo__icons">
								<div class="flex align-items-center">
									@if ($bloqueos[$student->id])
									@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
										<svg
											url="{{route('matriculacion.obtenerBloqueos', $student->id)}}"
											aria-hidden="true"
											class="student__svg--block ml-3 pointer obtenerBloqueoEstudiante"
											style="width:15px"
											data-prefix="fas"
											data-icon="ban"
											xmlns="http://www.w3.org/2000/svg"
											viewBox="0 0 512 512"><path fill="#ed5565" d="M256 8C119.034 8 8 119.033 8 256s111.034 248 248 248 248-111.034 248-248S392.967 8 256 8zm130.108 117.892c65.448 65.448 70 165.481 20.677 235.637L150.47 105.216c70.204-49.356 170.226-44.735 235.638 20.676zM125.892 386.108c-65.448-65.448-70-165.481-20.677-235.637L361.53 406.784c-70.203 49.356-170.226 44.736-235.638-20.676z"/>
										</svg>
									@endif
									@endif
								</div>
								<div>
								</div>
								<div>
									@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
									<a href="{{route('matriculaEditar', [$student->id, $institution->periodoLectivo] )}}">
										<i class="fa fa-pencil a-fa-pencil__matricula"></i>
									</a>
									@endif
									@if($usuario==='soporte@pined.ec')
									@if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
									<a data-route="{{route('eliminarEstudiante', $student)}}" onclick="eliminarEstudiante({{$student->id}})" class="eliminarEstudiante">
										<i class="fa fa-trash icon__eliminar" ></i>
									</a>
									@endif
									@else
									{{--mostrar boton desabilitado--}}
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			{{$students->appends(request(['matricula', 'search', 'courses']))->links()}}
		</div>
	</div>
</div>
{{-- Modal para ver Bloqueos del estudiante  --}}
<div class="modal fade" id="bloqueoEstudiante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

</div>

<div class="modal fade" id="importar" role="dialog">
	<!--
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Importar Estudiantes y Representantes</h4>
            </div>
        <form method="post" action="{{route('importarEstudiantes')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input id="excel" name="excel" type="file" class="file">
    </form>
    </div>
	-->
</div>
</div>

@endsection
@section('scripts')
	<script>
		$('.obtenerBloqueoEstudiante').click(function() {
			$.ajax({
				type: "GET",
				url: $(this).attr('url'),
				success: function (response) {
					$('#bloqueoEstudiante').html(response)
					$('#bloqueoEstudiante').modal()
				}, error: function() {
					alert('sucedio un error');
				}
			});
		})
		var button = $('.eliminarEstudiante')
		var url = window.location.origin
		function eliminarEstudiante(idEstudiante) {
			Swal.fire({
				title: 'Seguro desea eliminar a este estudiante?',
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
							url: `${url}/student/eliminar/${idEstudiante}`,
							data: {
								'_token': $('input[name=_token]').val(),
								'_method': 'DELETE'
							},
							success: function (response) {
								$(`#${idEstudiante}`).css('display', 'none')
								Swal.fire(
									'El estudiante ha sido eliminado!',
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