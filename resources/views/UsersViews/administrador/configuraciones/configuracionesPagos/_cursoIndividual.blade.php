@if ($course->grado)
	<div class="configuracionesPagos-item">
		<div class="text-center">
			<div class="d-ib">
				<div class="dirConfiguraciones__materias-cont mb-1 configuracionesPago__crearpago-c">
					<h2 class="dirConfiguraciones__cursos__seccion--title">
						{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}</h2>
					<a class="btn configuracionesPagos__crearpago" href="{{ route('configuraciones_CrearPago', $course->id)}}">
						<img src="{{secure_asset('img/circle-more.svg')}}" class="mr-05" width="15" alt=""> Crear Pago
					</a>
				</div>
			</div>
		</div>
		<div class="configuracionesPago__detalles">
			<div class="pined-table-responsive white-bg p-0">
				<table class="s-calificaciones w100">
					<tr class="table__bgBlue">
						<td class="no-border">Tipo</td>
						<td class="no-border">Mes</td>
						<td class="no-border">Valor</td>
						<td class="no-border" colspan="2"></td>
					</tr>
					@foreach($pays as $pay)
						@if($course->id == $pay->idCurso )
						<tr id="{{$pay->id}}">
							<td>
								{{ $pay->rubro->tipo_rubro }}
							</td>
							<td>
								@php
									$nombreMes=$pay->mes;
									switch($pay->mes){
										case 1:
											$nombreMes = "Enero";
											break;
										case 2:
											$nombreMes = "Febrero";
											break;
										case 3:
											$nombreMes = "Marzo";
											break;
										case 4:
											$nombreMes = "Abril";
											break;
										case 5:
											$nombreMes = "Mayo";
											break;
										case 6:
											$nombreMes = "Junio";
											break;
										case 7:
											$nombreMes = "Julio";
											break;
										case 8:
											$nombreMes = "Agosto";
											break;
										case 9:
											$nombreMes = "Septiembre";
											break;
										case 10:
											$nombreMes = "Octubre";
											break;
										case 11:
											$nombreMes = "Noviembre";
											break;
										case 12:
											$nombreMes = "Diciembre";
											break;
									}
								@endphp
								{{ $nombreMes }}
							</td>
							<td>
								{{ $pay->valor_cancelar }}
							</td>
							<td class="text-center" width="5">
								<a href="{{ route('configuraciones_EditarPago', $pay->id)}}">
									<i class="fa fa-pencil a-fa-pencil__matricula"></i>
								</a> 
							</td>
							<td class="text-center" width="5">
								<div class="icon__eliminar-form form-delete" onclick="eliminarRubro({{$pay->id}})" >
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="icon__eliminar-btn">
										<i class="fa fa-trash"></i>
									</button>
								</div>
							</td>
						</tr>
						@endif
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endif