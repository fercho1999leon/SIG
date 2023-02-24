<h3 class="modal-title">Estructura: {{$estructura->nombre}}</h3>
 <form method="POST" id="rangosCualitativos_{{$estructura->id}}" >
        {{csrf_field()}}
        <input type="hidden" name="idEstructura" value="{{$estructura->id}}">
<table class="table">
    <th>Numero</th>
    <th>Rango Inicial</th>
    <th>Rango Final</th>
    <th>Nota</th>
    <th>Descripción</th>
    @foreach($rangos as $rango)
    <tr><td>{{$loop->iteration.'.'}}</td>
        <input type="hidden" name="id[]"  value="{{$rango->id}}">
        <td><input type="number" name="rangoI[]" step="0.01" min="0.01" value="{{$rango->rangoI}}"></td>
        <td><input type="number" name="rangoF[]" step="0.01" min="0.01" value="{{$rango->rangoF}}"></td>
        <td><input type="text" name="nota[]" value="{{$rango->nota}}"></td>
        <td><input type="text" name="descripcion[]" value="{{$rango->descripcion}}"></td>
        <td><a href="{{route('deleteRango',['id' => $rango->id])}}" class="delete_Rango"><i class="fa fa-trash icon__eliminar"></i></a></td>
    </tr>
    @endforeach
    <tr><td>Nuevo</td>
        <td><input type="number" name="rangoI_nuevo" step="0.01" min="0.01"></td>
        <td><input type="number" name="rangoF_nuevo" step="0.01" min="0.01"></td>
        <td><input type="text" name="nota_nuevo"></td>
        <td><input type="text" name="descripcion_nuevo" ></td></tr>
    <tr><td colspan="6"><button type="submit" class="btn btn-primary btn-sm">Guardar</button></td></tr>
</table>
</form>
<script type="text/javascript">
 $('#rangosCualitativos_{{$estructura->id}}').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('actualizarRangos')}}",
            type: "POST",
            data : $(this).serialize()  ,
            success: function (result, status, xhr) {
                $('#respuestaEstructura').html(result)
                reloadEstructuras();
            }, error: function (xhr, status, error) {
                mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                $('#respuestaEstructura').html(mensaje)
            }
        });
  });
 $('.delete_Rango').click(function(e){
    e.preventDefault()
            var txt;
            var r = confirm("Precione aceptar para eliminar");
            if (r == true) {
             $.ajax({
                    url: $(this).attr('href'),
                    type: "GET",
                    success: function (result, status, xhr) {
                       $('#respuestaEstructura').html(result)
                        reloadEstructuras();
                    }, error: function (xhr, status, error) {
                        mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                        $('#respuestaEstructura').html(mensaje)
                    }
                });
         }
  });
</script>
