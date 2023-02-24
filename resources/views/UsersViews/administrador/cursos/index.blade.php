@extends('layouts.master') 
@section('content')
@include('partials.loader.loader')

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">{{$data->nombsemt}}/ Paralelo</h2>
        </div>

        <div class="agregarSeccionCont">       
			<a href="crearSemestreCurso/{{$id}}">
				<button class="btn dirConfiguraciones__instituto--agregarInfo" >Agregar Paralelo </button>
			</a>
    	</div>
    </div>
    <hr class="dirConfiguraciones__instituto--hr">

    <a class="button-br" href="{{ route('cursosEdicion') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>
  
    <div class="row text-center">
		<div class="col-lg-12 barra-inicial">
			<h3 class="m-0 p-1 color-white"> 
				Carrera {{ $cursto->nombre }}	
			</h3>
			</div>
	</div>



	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="dirConfiguraciones__cursos">			
			<div class="dirConfiguraciones__cursos__seccion">
				@foreach($cursos as $course)
					<div class="d-ib">
					<div class="dirConfiguraciones__materias-cont">						
						<h2 class="dirConfiguraciones__cursos__seccion--title">
							Paralelo {{ $course->paralelo }}
						</h2>
						
						<span>
							
							<a href="curso/Semestres/modificar/{{$course['id']}}'" class="icon__editar">
								<i class="fa fa-pencil"></i>
							</a>
						</span>
						<span>


						<form action="{{route('curso_update_delete',$course)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a este Curso?')" >
						
								<input name="_method" type="hidden" value="DELETE">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<button type="submit" class="icon__eliminar-btn fz19">
									<i class="fa fa-trash"></i>
								</button>
							</form>
						</span>
						<!--
						<button	id="btnCourse1" class="btn" data-toggle="modal" data-target="#modalAgregarAreaEI">
							<img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="" />Agregar Materia
						</button>
						-->
						<button id="btnCourse1" class="btn" data-toggle="modal" data-target="#dirModalAgregarMateria{{$course->id}}" onclick="fillModal({{$course->id}})">
							<img src="{{secure_asset('img/circle-more.svg')}}" width="15" alt="">Agregar Materia
						</button>
						<!--
						<button id="btnordenar" class="btn" data-toggle="modal">
							<a class="mostrar_orden_materias" href="{{route('getMatterOrder',['curso' => $course->id])}}" style="color: white;"><i class="fa fa-list-ul" >&nbsp;</i>Ordenar Materias</a>
						</button>
						-->
					</div>
				</div>
				<br>

				<div class="configuracionesMaterias-grid" id="curso{{$course->id}}" >
						@php						
							$matters = App\Matter::getMattersByCourseConfig($course->id)->where('estado','=','1');						
						@endphp						
						@foreach ($matters as $matter)
						@if($matter->nombre=='') 
							NO EXISTE MATERIAS REGISTRADAS
						@endif
							<div class="configuracionesMaterias__item" id="{{$matter->id}}">
								<p class="no-margin bold"> {{$matter->nombre}} </p>
								<div class="configuracionesMaterias__btnEdit">
									<a class="dirConfiguraciones__materias--linkEdit" href="{{route('getMatter',['matter' => $matter->id])}}">Editar</a>
										<span>							
											<div class="icon__eliminar-form form-delete m-0" onclick="eliminarMateria({{$matter->id}})">
												<input name="_method" type="hidden" value="DELETE">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<button type="submit" class="icon__eliminar-btn">
													<i class="fa fa-trash"></i>
												</button>
											</div>
										</span>
								</div>
							</div>
						@endforeach
					</div>
					<!--@php
						$bandera = $course->seccion;
					@endphp-->
					@include('partials.configuraciones.modalAgregarMateria',[
						'course' => $course
					])
				@endforeach
				
			</div>								
		</div>
	</div>
	
</div>

<!-- Modal Agregar Area EI -->
<!--
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
-->
    <!-- Modificacion de Materias-->
    <div class="modal fade" id="dirModalEditarMateria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
    <!--fin-->



@endsection
@section('scripts')
<script>
$('#mySelect').change(function () {    
    window.location.href = "#" +  $('#mySelect').val();
});

function fillModal(avg){
	console.log('entra xxxxxxxx');
		$('#idCurso').val(avg)
		console.log('entra',avg);
	}

	$('.dirConfiguraciones__materias--linkEdit').click(function(e){
		e.preventDefault();
		console.log($(this).attr('href'));
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#dirModalEditarMateria').html(result)
                $('#dirModalEditarMateria').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});
	$('.mostrar_orden_materias').click(function(e){
		e.preventDefault()
		 $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#dirModalEditarMateria').html(result)
                $('#dirModalEditarMateria').modal('show')
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
	});


	var url = window.location.origin
	function eliminarMateria(idMateria) {
		Swal.fire({
			title: '¿Seguro desea eliminar la materia?',
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
						url: `${url}/materiasEdicion/delete/${idMateria}`,
						data: {
							'_token': $('input[name=_token]').val(),
							'_method': 'DELETE'
						},
						success: function (response) {
							$('#'+idMateria).css('display', 'none')
							Swal.fire(
								'La materia ha sido eliminada!',
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
