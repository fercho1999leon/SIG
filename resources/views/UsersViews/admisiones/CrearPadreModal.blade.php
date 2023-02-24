<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Crear {{$parentezco=='P' ? 'Padre':'Madre'}}</h3>
            </div>
            <div class="modal-body" >
                <div class="wrapper wrapper-content">
                    <form method="post" action="{{ route('padre.store') }}" id="formCrearPadre" enctype="multipart/form-data">
                        <input type="hidden" name="id_estudiante" value="{{$estudiante->id}}">
                        <input type="hidden" value="{{$parentezco}}" name="t_padre" id="t_padre">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('partials.fichas.fichasPadresFormulario', ['btn' => 'CREAR'])
                    </form>
                </div>
            </div>
        </div>
</div>
<script>
    // Mostrando el formulario para crear el padre
    $('#representante').change(function() {
        if ($(this).prop('checked')) {
            return $('#creacionPerfilRepresentante').css('display', 'grid')
        }
        $('#creacionPerfilRepresentante').css('display', 'none')
    });
    $('#formCrearPadre').submit(function(e){
    var t_padre = $('#t_padre').val()
    if (t_padre=='P') {
        var pos = 2;
    }else{
         var pos = 3;
    }
    e.preventDefault()
     $.ajax({
            url: "{{route('padre.store')}}",
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