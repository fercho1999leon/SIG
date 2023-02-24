

<button type="button" class="btn btn-warning" onclick="verpagocxc('{{$idCuenta}}','1','{{$IDEstudiante}}','{{$fecha_emision}}','{{$fecha_vencimiento}}','{{$concepto}}','{{$saldo}}')" title="Ver Pagos"><i class="fa fa-eye" aria-hidden="true"></i></button>
<br>
<br>
<a href="{{ route('verificacionPago',$idCuenta) }}" class="btn btn-warning" title="Procesar Pago"><i class="fa fa-money" aria-hidden="true"></i></a>
<!--<button type="button" class="btn btn-warning" onclick="verpagocxc('{{$idCuenta}}','1','{{$IDEstudiante}}','{{$fecha_emision}}','{{$fecha_vencimiento}}','{{$concepto}}','{{$saldo}}')" title="Procesar Pago"><i class="fa fa-money" aria-hidden="true"></i></button>-->






