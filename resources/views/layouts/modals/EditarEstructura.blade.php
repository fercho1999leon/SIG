  <form  method="POST" id="formEditEst">
    <input type="hidden" name="id" value="{{$estructura->id}}">
    <input type="hidden" name="_method" value="PUT">
      {{csrf_field()}}
        <div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Nombre<span class="valorError">*</span></label>
                <input type="text"  id="nombre" name="nombre" placeholder="Nombre" value="{{$estructura->nombre}}">
                <button  type="submit" class="btn btn-primary btn-sm">Actualizar</button>
        </div>

  </form>
  <script type="text/javascript">
 $('#formEditEst').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('estructuras.update',['Est'  =>  $estructura])}}",
            type: "POST",
            data : $( this ).serialize()  ,
            success: function (result, status, xhr) {
                $('#respuestaEstructura').html(result)
                reloadEstructuras();
            }, error: function (xhr, status, error) {
                mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                $('#respuestaEstructura').html(mensaje)
            }
        });
  });
</script>