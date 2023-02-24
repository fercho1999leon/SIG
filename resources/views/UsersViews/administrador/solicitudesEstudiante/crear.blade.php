@extends('layouts.master')

@php
    $rol = Sentinel::getUser()->roles()->first()->name;
    $user_data = session('user_data');
   // $estudiante = session('estudiante'); 
	$tMessages = session('tMessages');
	use App\Student2;
	use App\ConfiguracionSistema;
	use Carbon\Carbon;
	use App\Institution;
    $institution = Institution::first();
@endphp
@section('content')

	<a class="button-br" href=" {{route('solicitudesEstudiantes') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar 
		</button>
	</a>

    <div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg">
		<div class="col-lg-12">
			<h2 class="title-page">Crear Nueva Solicitud</h2>
		</div>
	</div>
	<div class="wrapper wrapper-content">
		<div class="row">
			<form action="" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="hidden" value="tramite" name="tramite">
				<div class="panel pl-1 pr-1 matricula__matriculacion">
					<div class="matricula__matriculacion-block">
						<h3 class="matricula__matriculacion-title">DATOS DE LA SOLICITUD</h3>
                        
						<div>
							<div class="">
								<label for="" class="matricula__matriculacion-label">Seleccione el Tramite</label>
								
                                <select class="form-control input-sm" id="titulo_solicitud" name="title_transact">
									<option> Seleccione</option>
                                @foreach ($solicitud as $solicitudes)
                                    <option value="{{$solicitudes->id}}">{{$solicitudes->title}}</option>
																		
								@endforeach
                                </select>
								<div id="valoresCambiantes">

								</div>
								

								<input type="hidden" class="form-control" name="ci_student" value="{{ strtoupper($user_data->ci)}}" required >
								<input type="hidden" class="form-control" name="name_student" value="{{ strtoupper($user_data->nombres.' '.$user_data->apellidos)}}" required >
								
								<input type="hidden" class="form-control" name="career" value="{{$career->nombre}}" required >
								<input type="hidden" class="form-control" name="id_student" value="{{$estudiante_id}}" required >
								
								
							</div>    
							<div>
                               
                            </div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Solicitante</label><br>
								<label class="matricula__matriculacion-label" value="{{ strtoupper($user_data->nombres.' '.$user_data->apellidos)}}">{{ strtoupper($user_data->nombres.' '.$user_data->apellidos)}} </label>
								
							</div>
                            <div>   
                                
                            </div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Cedula Solicitante </label><br>
								<label class="matricula__matriculacion-label" value="{{ strtoupper($user_data->ci)}}">{{ strtoupper($user_data->ci)}} </label>
                                
							</div>
                            <div>
                           		
                            </div>
                            <div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Carrera</label><br>
                                <label class="matricula__matriculacion-label" value="{{$career->nombre}}">{{$career->nombre}}</label>
                                								
							</div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Detalle Solicitud </label><br>
                                <textarea name="descriptions" id="descriptions"placeholder="Detalles de la Solicitud" cols="60" rows="5"></textarea>								
							</div>
						</div>
					</div>
					
					<div class="text-right">
						<button type="submit" class="mb-1 btn btn-primary btn-lg">Crear Solicitud</button>
					</div>
					<input type="hidden" value=tramite name="tramite">
				</div>
			</form>
		</div>
	</div>
	
	
    </div>
        
</div>
	@if($errors->any())
		<div id="show-error" class="modal fade in" id="importar" role="dialog" >
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">ERROR AL CREAR SOLICITUD</h4>
					</div>
					@foreach($errors->all() as $value)
                        <div class="alert alert-danger" style="margin: 10px;" role="alert">Error:: {{$value}}</div>
                    @endforeach
			</div>
		</div>  
	@endif
@endsection

@section('scripts')
	<script src="{{secure_asset('js/crearSolicitud.js')}}"></script>
	<script>
		$(document).ready(function() {
			$('#show-error').modal();
		});
	</script>
@endSection