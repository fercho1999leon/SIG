@section('UnidadesGenerales')
<div class="col-xs-12 white-bg">
  <h3 class="title-page"> Unidades Generales del Periodo Lectivo: <strong>{{$periodo->nombre}}</strong><button class="btn btn-primary float-right  btn-sm" onclick="nuevaUnidad();">Nuevo</button></h3>
  <table class="table text-left">
    <th>N°</th>
    <th>Nombre</th>
    <th>Identificador</th>
    <th>Estatus</th>
    <th>Acción</th>
    @foreach($unidades as $unidad)
    <tr>
      <td>{{$loop->iteration.'.'}} </td>
      <td>{{$unidad->nombre}}</td>
      <td>{{$unidad->identificador}}</td>
      <td>{{$unidad->activo == 1 ? 'Activo': 'Inactivo'}}</td>
      <td><a onclick="verParciales('{{$unidad->id}}')" title="Unidades Generales"><i class="fa fa-list icon__ver"></i></a>
        &nbsp;<a onclick="editarUnidad('{{$unidad->id}}')" title="Editar"><i class="fa fa-pencil icon__editar"></i></a>
        &nbsp;<a onclick="eliminarUnidad('{{$unidad->id}}','{{$periodo->id}}')" title="Eliminar"><i class="fa fa-trash icon__eliminar"></i></a></td>
    </tr>
    @endforeach
  </table>
</div>
<div class="modal" id="NuevaUnidad" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Nueva Unidad</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="respuestaUnidad"></div>
        <form method="POST" id="formaddUnidad">
          {{csrf_field()}}
          <input type="hidden" name="id" value="" id="idUnidad">
          <input type="hidden" name="idPeriodo" value="{{$periodo->id}}" id="idPeriodo">
          <div class="matricula__matriculacion__input">
            <label for="" class="matricula__matriculacion-label">Nombre <span class="valorError">*</span></label>
            <input type="text" class="form-control input-sm" name="nombre" id="nombreUnidad" minlength="2" maxlength="100" placeholder="Nombre" value="">
          </div>
          <div class="matricula__matriculacion__input">
            <label for="" class="matricula__matriculacion-label">Identificador <span class="valorError">*</span></label>
            <input type="text" class="form-control input-sm" name="identificador" id="identificador" minlength="2" maxlength="100" placeholder="Identificador" value="">
          </div>
          <div class="matricula__matriculacion__input">
            <label for="" class="matricula__matriculacion-label">Activo <span class="valorError">*</span> </label>
            <input type="checkbox" class="form-control input-sm" name="activo" id="activo" value="1">
          </div>
      
          <div class="modal-footer">
            <button type="button" onclick="guardarUnidad({{$periodo->id}});" id="guardarU" class="btn btn-primary">Guardar</button>
            <button type="button" id="actualizarU" onclick="actualizarUnidad({{$periodo->id}});" class="btn btn-primary">Actualizar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection