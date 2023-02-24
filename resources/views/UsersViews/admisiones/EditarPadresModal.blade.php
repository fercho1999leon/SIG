<div class="modal-dialog dirModalAgregarGrado modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Datos Generales del {{$parentezco=='P' ? 'Padre':'Madre'}}</h3>
            </div>
            <div class="modal-body" >
                 <form method="post" action="{{ route('padres.update')}}" id="formEditarPadres">
            <input type="hidden" value="{{$estudiante->ci}}" name="search">
                <input type="hidden" value="{{$padre->id}}" name="id_padre">
                <input type="hidden" value="{{$parentezco}}" name="t_padre" id="t_padre">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('partials.fichas.fichasPadresFormulario', ['btn' => 'ACTUALIZAR'])
            </form>
            </div>
        </div>
</div>
<script>
    $('#formEditarPadres').submit(function(e){
    e.preventDefault()
    var t_padre = $('#t_padre').val()
    if (t_padre=='P') {
        var pos = 2;
    }else{
         var pos = 3;
    }
     $.ajax({
            url: "{{ route('padres.update')}}",
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
                 ver_PasoPaso(pos);
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