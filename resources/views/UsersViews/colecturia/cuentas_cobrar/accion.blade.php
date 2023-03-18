

<a type="button" onclick="verpagocxc('{{$idCuenta}}','1','{{$IDEstudiante}}','{{$fecha_emision}}','{{$fecha_vencimiento}}','{{$concepto}}','{{$saldo}}')" title="Ver Pagos"><i class="fa fa-eye" aria-hidden="true"></i></a>

<a href="{{ route('verificacionPago',$idCuenta) }}"  title="Procesar Pago"><i class="fa fa-money" aria-hidden="true"></i></a>
@if(Sentinel::inRole('UsersViews.colecturia') )
    <a type="button" onclick="editpaycxc('{{$idCuenta}}','1','{{$IDEstudiante}}','{{$fecha_emision}}','{{$fecha_vencimiento}}','{{$concepto}}','{{$saldo}}')" title="Editar Pago"><i class="fa fa-pencil" aria-hidden="true"></i></a>
@endif
@if(Sentinel::inRole('UsersViews.colecturia') )
    <a href="#" title="Eliminar" onclick="eliminarpago({{$idCuenta}})" title="Eliminar Pago"><i class=" fa fa-trash icon__eliminar"></i></a>
@endif
<!--<button type="button" class="btn btn-warning" onclick="verpagocxc('{{$idCuenta}}','1','{{$IDEstudiante}}','{{$fecha_emision}}','{{$fecha_vencimiento}}','{{$concepto}}','{{$saldo}}')" title="Procesar Pago"><i class="fa fa-money" aria-hidden="true"></i></button>-->






