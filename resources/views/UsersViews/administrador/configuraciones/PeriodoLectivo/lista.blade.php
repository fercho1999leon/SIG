@section('contentPanel')
<div class="col-xs-12 white-bg">
                    <h3 class="title-page"> Lista de periodos<button  class="btn btn-primary float-right  btn-sm" onclick="nuevoPeriodo();">Nuevo</button></h3>
                    <table class="table text-left">
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Fechas</th>
                    <th>Régimen</th>
                    <th>Acción</th>
                    @foreach($periodos as $periodo)
                    <tr><td>{{$loop->iteration.'.'}} </td>
                        <td>{{$periodo->nombre}}</td>
                        <td>{{$periodo->fecha_inicial}} a {{$periodo->fecha_final}}</td>
                        <td>{{$periodo->regimen}}</td>
                              <td><a onclick="ver_unidades('{{$periodo->id}}')" title="Unidades Generales"><i class="fa fa-list icon__ver"></i></a>
                                &nbsp;<a onclick="editar_Periodo('{{$periodo->id}}')" title="Editar"><i class="fa fa-pencil icon__editar"></i></a>
                                &nbsp;<a onclick="eliminar_Periodo('{{$periodo->id}}')" class="btn_delt_es" title="Eliminar"><i class="fa fa-trash icon__eliminar"></i></a></td>
                        </tr>
        @endforeach
    </table>
</div>
@endsection