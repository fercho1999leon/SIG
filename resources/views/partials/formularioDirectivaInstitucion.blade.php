
{!! Form::open(array('route' => 'editDirectivaInstitucion')) !!}

  <div class="row">
      <table id="tabla-cargos" class="table table-bordered table-hover">
          <tbody id="contentDirectiva">
              <tr style="background: #307ECC">
                  <th style="background: #307ECC;color: #FFFFFF">Orden</th>
                  <th style="background: #307ECC;color: #FFFFFF">Cargo</th>
                  <th style="background: #307ECC;color: #FFFFFF">Nombres y Apellidos</th>
                  <th style="background: #307ECC;color: #FFFFFF">Correo</th>
                  <th style="background: #307ECC;color: #FFFFFF">Teléfono</th>
                  <th style="background: #307ECC;color: #FFFFFF"></th>
              </tr>
          </tbody>
      </table>
      <input class="btn btn-primary dim addDirectiva" style="font-weight: bold; font-size: 14px" value="+ Agregar Cargo" onclick="" type="button">
  </div>
  <input type="submit" value="Guardar" class="btn btn-success">
{!! Form::close() !!}

<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script type="text/javascript">

$('.addDirectiva').on('click', function() {
  var count = $('#contentDirectiva').children('tr').length;
  $('#contentDirectiva').append("<tr id='dirId"+(count)+"'><td width='5px'><input class='form-control input-sm' name='n"+(count)+"' value='"+(count)+"' type='text'></td><td><input class='form-control input-sm' name='cargo"+(count)+"' value='' type='text'></td><td><input class='form-control input-sm' name='nombresyapellidos"+(count)+"' value='' type='text'></td><td><input class='form-control input-sm' name='email"+(count)+"' value='' type='email'></td><td><input class='form-control input-sm' name='telf"+(count)+"' value='' type='text'></td><td><input id='"+(count)+"' value=' X ' class='btn btn-danger btn-circle' onclick='eliminarFila(this.id);' type='button'></td></tr>");
});

function eliminarFila(id) {
  var elem = document.getElementById("dirId"+id);
  elem.parentNode.removeChild(elem);
}
</script>
