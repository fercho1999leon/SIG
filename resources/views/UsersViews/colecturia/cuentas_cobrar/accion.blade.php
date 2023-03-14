

<button type="button" class="btn btn-warning" onclick="verpagocxc('{{$idCuenta}}','1','{{$IDEstudiante}}','{{$fecha_emision}}','{{$fecha_vencimiento}}','{{$concepto}}','{{$saldo}}')" title="Ver Pagos"><i class="fa fa-eye" aria-hidden="true"></i></button>
<br>
<br>
<a href="{{ route('verificacionPago',$idCuenta) }}" class="btn btn-warning" title="Procesar Pago"><i class="fa fa-money" aria-hidden="true"></i></a>
<br>
<br>
@if(Sentinel::inRole('UsersViews.colecturia') || ($permiso != null && $permiso->eliminar == 1))
    <a href="#" title="Eliminar" onclick="eliminarpago({{$idCuenta}})"><i class="btn btn-warning fa fa-trash icon__eliminar"></i></a>
@endif
<!--<button type="button" class="btn btn-warning" onclick="verpagocxc('{{$idCuenta}}','1','{{$IDEstudiante}}','{{$fecha_emision}}','{{$fecha_vencimiento}}','{{$concepto}}','{{$saldo}}')" title="Procesar Pago"><i class="fa fa-money" aria-hidden="true"></i></button>-->






