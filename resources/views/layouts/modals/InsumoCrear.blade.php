@php
$PorcentajeInsumo = App\ConfiguracionSistema::InsumoPorcentual()->valor;
@endphp
<form class="form-inline" id="formaddInsumo" enctype="multpart/form-data">
    {{csrf_field()}}
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control" id="nombre" name="nombre">
    <label for="nombre">Porcentaje: </label>
    <input type="number" class="form-control" id="porcentaje" name="porcentaje" step="1" min="0" max="100" placeholder="porcentaje">
  
  </div>
  <input type="hidden" name="idDocente" value="{{$matter->idDocente}}">
  <input type="hidden" name="idCurso" value="{{$matter->idCurso}}">
  <input type="hidden" name="idMateria" value="{{$matter->id}}">
  <button type="submit" class="btn btn-default">Agregar.</button>
</form>

<div class="container" id="response2"></div>

<script type="text/javascript">
    $('#formaddInsumo').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('postaddInsumo')}}",
            type: "POST",
            data : $( this ).serialize()  ,

            success: function (result, status, xhr) {
                $('#response').html(result)
                reloadInsumos();
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
  });
</script>