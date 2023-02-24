@php
$PorcentajeInsumo = App\ConfiguracionSistema::InsumoPorcentual()->valor;
@endphp
<form class="form-inline" id="formeditInsumo" enctype="multpart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">
  <div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$supply->nombre}}">
    <label for="nombre">Porcentaje: </label>

    <input type="number" class="form-control" id="porcentaje" name="porcentaje" step="1" min="0" max="100" placeholder="porcentaje" value="{{$supply->porcentaje}}">


  </div>
  <button type="submit" class="btn btn-default">Actualizar.</button>
</form>
<div class="container" id="response2"></div>
<script type="text/javascript">
    $('#formeditInsumo').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('putInsumo',['supply'  =>  $supply->id])}}",
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