@php
    $permiso = App\Permiso::desbloqueo('cursosEdicion');
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
	<div class="row wrapper white-bg">
		<div class="col-lg-12 ">
			<!--<h2 class="title-page">Configuraciones 
				<small>Cursos</small>
				<small>Carreras</small>
			</h2>-->
			<div class="card-body d-flex justify-content-between align-items-center">
				<h2	class="title-page"> Configuraciones 
				<small>Carreras</small></h2>

				<div class="card-body d-flex">
				<a href="{{ route('createCarreras') }}">
            	<button class="btn dirConfiguraciones__instituto--agregarInfo btn-sm" >Agregar Carrera</button>
        		</a>&nbsp;
				
				{{--<a href="#">
					<button class="btn dirConfiguraciones__instituto--agregarInfo btn-sm" >Agregar Insumo</button>
				</a>--}}
				
				@if(Sentinel::getUser()->email === 'info@itred.edu.ec')
					<button class="btn btn-info">
						<a class="mostrar_orden_materias" href="{{route('insumos.index')}}" style="color: white;"><i class="fa fa-cogs" >&nbsp;</i>Insumos</a>
					</button>
				@endif
			
						<!--<a href="#" class="btn btn-primary btn-sm">Agregar Insumos</a>-->
			</div>
			</div>
		</div>
		@php
            $PorcentajeInsumo = App\ConfiguracionSistema::InsumoPorcentual()->valor;
            $bandera = '';
        @endphp
			
	</div>
	
		<div class="row text-center">
			<div class="col-lg-12 barra-inicial">
				<!--
				<h3 class="m-0 p-1 color-white"> Educación Inicial  </h3>
				-->
				<h3 class="m-0 p-1 color-white"> Carreras </h3>
			</div>
			
		</div>
		<br>
		<div id="career-list" class="a-listaPersonal">
		@foreach($careers as $career)
			<div class="fAdministrativo">
				<div class="a-personal-administrativo__card relative">
					
					<p class="a-nombre-administrativo"> {{ $career->nombre }} </p>
					<hr class="a-hr-administrativo">
					<div class="text-center a-personal-administrativo__icons">
						


				


						<div class="card-body d-flex justify-content-between align-items-center">
							<!--<span>
								<a data-route="#" class="icon__ver">
									<i class="fa fa-eye"></i>
								</a>
							</span>-->
							
							<span>
								<a href="carreras/Carreras/modificar/{{$career['id']}}" class="icon__editar">
									<i class="fa fa-pencil"></i>
								</a>
							</span>
							
							<!--
							<span>
								<button class="btn dirConfiguraciones__instituto--agregarInfo ml-1" data-toggle="modal" data-target="#">
									+ Semestre 
								</button>
							</span>
							-->
							<span>


                            <form action="{{route('carrera_update_delete',$career->id)}}" method="post" class="icon__eliminar-form form-delete" onclick="return confirm('¿Seguro desea eliminar a esta Carrera?')" >
									<!--@csrf
									@method('DELETE')-->
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="icon__eliminar-btn fz19">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</span>


							<!--<span>
								<button class="btn dirConfiguraciones__instituto--agregarInfo ml-1 btn-sm" data-toggle="modal" data-target="#">
									Añadir Semestre 
								</button>
							</span>-->
							<!--<span>
							<a href="{{ route('semestres') }}">
								<button class="btn dirConfiguraciones__instituto--agregarInfo ml-1 btn-sm" >Ver Semestres</button>
							</a>
							</span>-->
							

							<span>
								<a href="semestres/carrera/{{$career['id']}}" class="icon__ver">
									<i class="fa fa-eye"></i>
								</a>
							</span>



							<span>
								<!--
									<a href="insumos/carrera/{{$career['id']}}" class="icon__editar">
										<i class="fa fa-cogs"></i>
									</a>
								-->
							</span>
							
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>

		
			
	


</div>
{{-- Editar curso --}}
<!-- Modificacion de Materias-->
<div class="modal fade" id="dirModalEditarMateria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
    <!--fin-->
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
<script type="text/javascript">
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
</script>
@endsection