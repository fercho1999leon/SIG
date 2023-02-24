<div class="row wrapper white-bg">
		<div class="col-lg-12">
			<h2 class="title-page">Crear nuevo Formato de Solicitud</h2>
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
								<label for="" class="matricula__matriculacion-label">Nombre del Tramite</label>
								<input type="text" class="form-control input-sm" name="name_transact" minlength="10" maxlength="50" placeholder="Ej. Solicitud de Título" value="{{old('name_transact')}}" required>
							</div>
							<div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Título del Destinario </label>
								<input type="text" class="form-control input-sm" name="title_addressee" minlength="2" maxlength="100" placeholder="Ej. Sr. Lic. Ing. Msc. Tec." value="{{old('title_addressee')}}" required>
							</div>
							<div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Nombre Completo del Destinario </label>
								<input type="text" class="form-control input-sm" name="name_addressee" id="name_addressee"minlength="2" maxlength="100" placeholder="Nombres y Apellidos Completos" value="{{old('name_addressee')}}" required>
								<input type="hidden" name="id_destinatarrio" id="id_destinatarrio" value="" >
								<label for="" class="matricula__matriculacion-label">Seleccione el Destinario * Este campo puede quedar vacio una vez seleccionado o escrito </label>
								<input class="form-control" type="text" name="" id="NuevoEmail"  placeholder="Seleccione Usuario">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div id="listaCorreos"></div>
							</div>

							


                            <div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Departamento Encargado </label>
								<input type="text" class="form-control input-sm" name="department_responsible" minlength="2" maxlength="100" placeholder="EJ. SECRETARIA GENERAL " value="{{old('department_responsible')}}" required>
							</div>
                            <div></div>
							<div class="matricula__matriculacion__input">
								<label for="" class="matricula__matriculacion-label">Costo del Tramite </label>
								<input type="text" class="form-control input-sm" name="transact_amount" minlength="2" maxlength="100" placeholder="$5.00 " value="{{old('transact_amount')}}" required>
							</div>
                            <div></div>

							
						</div>
					</div>
					
					<div class="text-right">
						<button type="submit" class="mb-1 btn btn-primary btn-lg">Crear Tramite</button>
					</div>
					<input type="hidden" value=tramite name="tramite">
				</div>
			</form>
		</div>
	</div>
	
	