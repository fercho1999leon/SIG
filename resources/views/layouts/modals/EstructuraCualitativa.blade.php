  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Estructuras Cualitativas<button  class="btn btn-primary float-right  btn-sm" onclick="nuevaEsturctura();">Nuevo</button></h3>
      </div>
      <div class="modal-body">
        <div id="respuestaEstructura"></div>
        <div id="nuevaE" style="display: none;">
          <form  method="POST" id="formaddEst">
          {{csrf_field()}}
          <div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Nombre<span class="valorError">*</span></label>
                <input type="text"  id="nombre" name="nombre" placeholder="Nombre" >
              &nbsp;<button  type="submit" class="btn btn-primary btn-sm">Guardar</button>
        </div>
          </form>
        </div>
        <div id="editarE" style="display: none">
        </div>
         <div id="estructuraIndex">
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
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function nuevaEsturctura(){
    if ($("#nuevaE").is(":visible")) {
      $('#nuevaE').hide();
    }else{
      $('#accionEstructura').hide();
      $('#editarE').hide();
      $('#nuevaE').show();
    }
  }
  $('#formaddEst').submit(function(e){
    e.preventDefault()
     $.ajax({
            url: "{{route('estructuras.store')}}",
            type: "POST",
            data : $( this ).serialize()  ,
            success: function (result, status, xhr) {
              $('#respuestaEstructura').html(result)
                reloadEstructuras();
                $("#formaddEst")[0].reset();
            }, error: function (xhr, status, error) {
                mensaje ='<div class="alert alert-danger" role="alert">'+xhr['responseText']+'</div>';
                $('#respuestaEstructura').html(mensaje)
            }
        });
  });
  function reloadEstructuras(){
    $.ajax({
            url: "{{route('verEstructuras',['id' =>  1 ])}}",
            type: "GET",
            success: function (result, status, xhr) {
        $('#respuesta').show();
              $("#formaddEst")[0].reset();
              $('#estructuraIndex').empty();
              $('#estructuraIndex').html(result)
            }, error: function (xhr, status, error) {
                alert('error')
            }
        });
  }
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