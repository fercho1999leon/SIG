<div class="modal-dialog dirModalAgregarGrado modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Editar Cliente</h3>
            </div>
            <div class="modal-body" >
                <form method="post" action="{{ route('actualizarCliente', $cliente) }}" id="formeditarCliente">
                <input type="hidden" value="{{$estudiante->id}}" name="id_estudiante">
                <input type="hidden" value="{{$cliente->id}}" name="id_cliente">
                {{ csrf_field() }}
                @include('partials.fichas.formularioCliente', ['btn' => 'Actualizar Cliente'])
            </form>
            </div>
        </div>
    </div>
    <script>
    $('#formeditarCliente').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{ route('actualizarCliente', $cliente) }}",
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

