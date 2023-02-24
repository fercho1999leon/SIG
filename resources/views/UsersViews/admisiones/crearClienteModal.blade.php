<div class="modal-dialog dirModalAgregarGrado modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Crear Cliente</h3>
            </div>
            <div class="modal-body" >
                <form method="post" action="{{ route('cliente.store') }}" id="formCrearCliente" enctype="multipart/form-data">
                <input type="hidden" name="id_estudiante" value="{{$estudiante->id}}">
                {{ csrf_field() }}
                @include('partials.fichas.formularioCliente', ['btn' => 'Crear Cliente'])
            </form>
            </div>
        </div>
    </div>
    <script>
        $('#formCrearCliente').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('cliente.store')}}",
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
                 ver_PasoPaso(5);
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
