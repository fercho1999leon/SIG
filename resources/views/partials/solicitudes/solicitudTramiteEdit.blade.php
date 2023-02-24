<div class="row wrapper white-bg">
		<div class="col-lg-12">
			<h2 class="title-page">Editar Formato de Solicitud</h2>
		</div>
	</div>
	<div class="wrapper wrapper-content">
		<div class="row">
        @foreach ($tipo_Solicitud as $tipo_Solicitudes)
        
			<form action="" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}
             
				<input type="hidden" value="tramite" name="tramite">
				<div class="panel pl-1 pr-1 matricula__matriculacion">
					<div class="matricula__matriculacion-block">
						<h3 class="matricula__matriculacion-title">DATOS DE LA SOLICITUD</h3>

						<div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Nombre del Tramite</label>
								<input type="text" class="form-control input-sm" name="name_transact" minlength="10" maxlength="50" placeholder="Ej. Solicitud de Título" value="{{$tipo_Solicitudes->title}}" required>
							</div>
							<div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Título del Destinario </label>
								<input type="text" class="form-control input-sm" name="title_addressee" minlength="2" maxlength="100" placeholder="Ej. Sr. Lic. Ing. Msc. Tec." value="{{$tipo_Solicitudes->addressee_title}}" required>
							</div>
							<div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Nombre Completo del Destinario </label>
								<input type="text" class="form-control input-sm" name="name_addressee" minlength="2" maxlength="100" placeholder="Nombres y Apellidos Completos" value="{{$tipo_Solicitudes->addressee_name}}" required>
							</div>
                            <div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Departamento Encargado </label>
								<input type="text" class="form-control input-sm" name="department_responsible" minlength="2" maxlength="100" placeholder="EJ. SECRETARIA GENERAL " value="{{$tipo_Solicitudes->addressee_departament}}" required>
							</div>
                            <div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Costo del Tramite </label>
								<input type="text" class="form-control input-sm" name="transact_amount" minlength="2" maxlength="100" placeholder="$5.00 " value="{{number_format($tipo_Solicitudes->amount,2, ',', '.')}}" required>
							</div>
                            <div></div>
						</div>
					</div>
					
					<div class="text-right">
						<button type="submit" class="mb-1 btn btn-primary btn-lg">Actualizar Tramite</button>
					</div>
					<input type="hidden" value=tramite name="tramite">
				</div>
			</form>
            @endforeach
		</div>
	</div>
	
	