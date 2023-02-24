@section('parcialesP')
<div class="col-xs-12 white-bg">
                    <h3 class="title-page"> Parciales Periodicos de la Unidad General: <strong>{{$unidad->nombre}} / {{$periodo->nombre}} </strong><button  class="btn btn-primary float-right  btn-sm" onclick="nuevoParcial();">Nuevo</button></h3>
                    <table class="table text-left">
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Identificador</th>
                    <th>Estatus</th>
                    <th>Fecha Inc</th>
                    <th>Fecha Fin</th>
                    <th>Acción</th>
                    @foreach($parciales as $parcial)
                    <tr><td>{{$loop->iteration.'.'}} </td>
                        <td>{{$parcial->nombre}}</td>
                        <td>{{$parcial->identificador}}</td>
                        <td>{{$parcial->activo == 1 ? 'Activo': 'Inactivo'}}</td>
                        <td>{{$parcial->fechaI}}</td>
                        <td>{{$parcial->fechaF}}</td>
                        <td><a onclick="editarParcial('{{$parcial->id}}')" title="Editar"><i class="fa fa-pencil icon__editar"></i></a>
                        &nbsp;<a onclick="eliminarParcial('{{$parcial->id}}','{{$unidad->id}}')" title="Eliminar"><i class="fa fa-trash icon__eliminar"></i></a></td>
                    </tr>
        @endforeach
    </table>
</div>
<div class="modal" id="NuevoParcial" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Nuevo Parcial</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="respuestaParcial"></div>
       <form  method="POST" id="formaddParcialP">
          {{csrf_field()}}
          <input type="hidden" name="id" value="" id="idParcial" >
          <input type="hidden" name="idPeriodo" value="{{$periodo->id}}" id="idPeriodo" >
          <input type="hidden" name="idUnidad" value="{{$unidad->id}}" id="idUnidad" >
          <div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Nombre <span class="valorError">*</span></label>
                <input type="text" class="form-control input-sm" name="nombre" id="nombreParcial" minlength="2" maxlength="100" placeholder="Nombre" value="">
        </div>
        <div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Identificador <span class="valorError">*</span></label>
                <input type="text" class="form-control input-sm" name="identificador" id="identificadorParcial" minlength="2" maxlength="100" placeholder="Identificador" value="">
        </div>
        <div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Activo <span class="valorError">*</span> </label>
                <input type="checkbox" class="form-control input-sm" name="activo" id="activoParcial" value="1" >
        </div>
        <div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Fecha Inicial <span class="valorError">*</span> </label>
                <input type="date" class="form-control input-sm" name="fechaI" id="fechaI">
        </div>
        <div class="matricula__matriculacion__input">
                <label for="" class="matricula__matriculacion-label">Fecha Final <span class="valorError">*</span> </label>
                <input type="date" class="form-control input-sm" name="fechaF" id="fechaF"  >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="guardarParcial({{$unidad->id}});" id="guardarP" class="btn btn-primary">Guardar</button>
        <button type="button" id="actualizarP" onclick="actualizarParcial({{$unidad->id}});" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection