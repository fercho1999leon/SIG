
@php
$rol = Sentinel::getUser()->roles()->first()->name;
$user_data = session('user_data');
@endphp
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
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Seleccione el Tramite</label>
								
                                <select class="form-control input-sm" name="name_transact">
                                
                                </select>
							</div>
							
							<div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Solicitante</label>
                                <label for="" class="matricula__matriculacion-label">{{ strtoupper($user_data->userid.' '.$user_data->apellidos)}}</label>
                                
								
							</div>
                            <div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Cedula Solicitante </label>
								<label for="" class="matricula__matriculacion-label">{{ strtoupper($user_data->ci)}} </label>
                                
							</div>
                            <div></div>
                            <div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Detalle Solicitud </label>
                                <textarea name="descriptions" placeholder="Detalles de la Solicitud"></textarea>								
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
	
	