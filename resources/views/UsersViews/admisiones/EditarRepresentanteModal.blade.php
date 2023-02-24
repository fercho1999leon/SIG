<div class="modal-dialog dirModalAgregarGrado modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Datos Generales del Represnetante</h3>
			</div>
			<div class="modal-body" >
				<form action="{{route('representante.Edit', $data)}}" id="formActRepresentante" method="POST" enctype="multipart/form-data">
							{{csrf_field()}}
							<input type="hidden" value="Representante" name="tipo_usuario">
							<div class="panel pl-1 pr-1 matricula__matriculacion">
								@include('UsersViews.admisiones.fichaRepresentante')
								<div class="text-center">
									<button type="submit" class="mb-1 btn btn-primary btn-lg">Actualizar Representante</button>
								</div>
								<input type="hidden" value="Representante" name="cargo">
								<input type="hidden" value="{{$estudiante->id}}" name="id_estudiante">
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
$('#formActRepresentante').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('representante.Edit', $data)}}",
            type: "POST",
            data : $( this ).serialize(),
            success: function (result, status, xhr) {
            	$('#mostrarModal').modal('hide');
                 Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Representante Actualizado',
                showConfirmButton: false,
                timer: 1500,
                });
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