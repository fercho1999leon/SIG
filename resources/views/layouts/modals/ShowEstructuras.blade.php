<table class="table text-left">
    <th>Nombre</th>
    <th>Acción</th>
    @foreach($estructuras as $estructura)
    <tr><td>{{$loop->iteration.'.'}} &nbsp; {{$estructura->nombre}}</td>
              <td><a href="{{route('verRangos',['estr' =>  $estructura->id])}}" id="{{$estructura->id}}" class="btn_ver_rangos"><i class="fa fa-list icon__ver"></i></a>
                 &nbsp;<a href="{{route('estructuras.show',['estr' => $estructura])}}" class="btn_edit_es"><i class="fa fa-pencil icon__editar"></i></a>
                &nbsp;<a href="{{route('deteteEstructura',['estr' => $estructura])}}"  class="btn_delt_es"><i class="fa fa-trash icon__eliminar"></i></a></td>
            </tr>
    <tr>
              <td colspan="2">
              <div id="rangos{{$estructura->id}}" style="display: none;"></div>
            </td>
            </tr>
    @endforeach
</table>
<script type="text/javascript">
    $('.btn_delt_es').click(function(e){
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
$('.btn_edit_es').click(function(e){
  if ($("#nuevaE").is(":visible")) {
        $('#nuevaE').hide();
        }
        $('#editarE').show();
    e.preventDefault()
     $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {
                $('#editarE').html(result)
                reloadEstructuras();
            }, error: function (xhr, status, error) {
               mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                $('#respuestaEstructura').html(mensaje)
            }
        });
  });
$('.btn_ver_rangos').click(function(e){
  //alert($(this).attr('id'));
  var id = $(this).attr('id');
  if ($('#rangos'+id).is(":visible")) {
      $('#rangos'+id).hide();
    }else{
      $('#rangos'+id).show();
    }
    e.preventDefault()
     $.ajax({
            url: $(this).attr('href'),
            type: "GET",
            success: function (result, status, xhr) {

                $('#rangos'+id).html(result)
            }, error: function (xhr, status, error) {
               mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                $('#respuestaEstructura').html(mensaje)
            }
        });
  });
</script>
