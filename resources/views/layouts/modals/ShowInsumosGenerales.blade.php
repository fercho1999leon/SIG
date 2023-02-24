@php
  use App\General;
@endphp
<table class="table text-left">
    <th>Nombre</th>
    <th>Sección</th>
    <th>Acción</th>
    @foreach($insumos as $insumo)
        <tr><td>{{$loop->iteration.'.'}} &nbsp; {{$insumo->nombre}}</td>
                        <td>{{General::getSeccion($insumo->seccion)}}</td>
                        <td><a href="{{route('insumos.show',['supply'=> $insumo])}}" class="btn_InsumosG_Editar"><i class="fa fa-pencil icon__editar"></i>
                            &nbsp;<a href="{{route('deleteInsumoG',['supply'=>  $insumo])}}" class="btn_InsumosG_Eliminar"><i class="fa fa-trash icon__eliminar"></a></td>
                    </tr>
    @endforeach
</table>
<script type="text/javascript">
$('.btn_InsumosG_Editar').click(function(e){
    $('#respuesta').hide();
    $('#editar').show();
    e.preventDefault()
    $.ajax({
    url: $(this).attr('href'),
    type: "GET",
        success: function (result, status, xhr) {
        $('#editar').html(result)
        if ($("#nuevo").is(":visible")) {
        $('#nuevo').hide();
        }
        }, error: function (xhr, status, error) {
        alert('error')
        }
    });
});
$('.btn_InsumosG_Eliminar').click(function(e){
        e.preventDefault()
        var txt;
        var r = confirm("Precione aceptar para eliminar");
        if (r == true) {
             $.ajax({
                url: $(this).attr('href'),
                type: "GET",
                success: function (result, status, xhr) {
                    $('#respuesta').html(result)
                    reloadInsumosGenerales()
                }, error: function (xhr, status, error) {
                    alert('error')
                }
            });
         }
    });
</script>
