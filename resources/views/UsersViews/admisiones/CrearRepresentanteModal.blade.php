<div class="modal-dialog dirModalAgregarGrado modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Crear Representante</h3>
			</div>
			<div class="modal-body" >
				<form action="{{ route('representante.store') }}" id="formCrearRepresentante" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" value="Representante" name="tipo_usuario">
					<input type="hidden" name="id_estudiante" value="{{$estudiante->id}}">
					<div class="panel p-4 matricula__matriculacion">
						@include('UsersViews.admisiones.fichaRepresentante')
						<div class="flex flex-col lg:flex-row lg:justify-between">
							<div>
								<div class="flex flex-column mt-4">
									<span class="text-xl mb-3 flex items-center" style="font-size:16px">
										<label class="font-light mb-0" for="financiero">¿Este usuario tambien es el representante financiero?</label>
										<input id="financiero" class="mt-0" type="checkbox" name="crearCliente" style="margin-left:5px">
									</span>
									<span class="text-xl mb-3 flex items-center" style="font-size:16px">
										<label class="font-light mb-0" for="padre">¿Este usuario tambien es el padre de familia?</label>
										<input id="padre" class="mt-0" type="checkbox" name="crearPadre" style="margin-left:5px">
									</span>
								</div>
							</div>
							<div>
								<div class="text-right">
									<button type="submit" class="mb-1 btn btn-primary btn-lg">Crear Representante</button>
								</div>
								<input type="hidden" value="Representante" name="cargo">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
$(document).ready(function() {
	$("#ocultar_admision").hide();//oculto valores de correo
	$("#ver_admision").show();//mostrar mensaje de Usuario y contraseña
	});
	// Mostrando el formulario para crear el cliente
	$('#financiero').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilCliente').css('display', 'grid')
		}
		$('#creacionPerfilCliente').css('display', 'none')
	})

	// Mostrando el formulario para crear el padre
	$('#padre').change(function() {
		if ($(this).prop('checked')) {
			return $('#creacionPerfilPadre').css('display', 'grid')
		}
		$('#creacionPerfilPadre').css('display', 'none')
	});
	$('#formCrearRepresentante').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('representante.store')}}",
            type: "POST",
            data : $( this ).serialize(),
            success: function (result, status, xhr) {
            	$('#mostrarModal').modal('hide');
                 Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Representante Creado',
                showConfirmButton: false,
                timer: 1500,
                })
                 reloadDatosGenerales();
                 ver_PasoPaso(4);
            }, error: function (xhr, status, error) {
            	$('#mostrarModal').modal('hide');
            	 Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: ''+xhr['responseText'],
                showConfirmButton: false,
                timer: 4500,
                })
            }
        });
  });
</script>