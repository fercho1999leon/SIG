@extends('layouts.master')
@section('content')
@php
	use App\Factura;
	use App\Abono;
	use App\Fechas;
	use App\BecaDescuento;
	use App\Rubro;
	use Carbon\Carbon;
	use App\Permiso;
		$user = Sentinel::getUser();
		$user = App\Administrative::where('userid', $user->id)->first();
		$hoy=Carbon::now();
		$permiso = Permiso::desbloqueo('pagosGeneral');
        $col = Sentinel::getUser()->email == 'soporte@pined.ec' ? 4 : 3 ;

@endphp
@if($user->cargo=='Representante')
<a class="button-br" href="{{ route('hijo', $student->id) }}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
@else
<a class="button-br" href="{{ route('pagosCurso', $course->id) }}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
@endif
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg mb-1">
		<div class="padre-pago">
			<div class="profile-image mb-1">
				<img src="{{secure_asset('img/icono_persona.png')}}" alt="FACTURA" W width="30">
			</div>
			<div class="profile-info">
				<h2 class="no-margins">
					{{ $student->apellidos }} {{ $student->nombres }}
				</h2>
				<p>
					<h3 style="padding-left:10px">
						<strong>CURSO:</strong> {{ $course->grado }} {{ $course->paralelo}}
					</h3>
				</p>
				<p>@if($user->cargo=='Representante')
					@else
					<h3 style="padding-left:10px">
						<strong>DIRIGENTE:</strong>
						@if($tutor != null)
							{{ $tutor->nombres }} {{ $tutor->apellidos }}
						@endif
					</h3>
					@endif
				</p>
			</div>
		</div>
	</div>
	<div class="white-bg p-1">
		<div class="mb-1 titulo-separacion">
			<div class="mt-5 sm:mt-0">
				@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
					@if($user->cargo=='Representante') <!-- si es representante oculta los botones de acción-->
						<button class="btn btn-primary" data-toggle="modal" data-target="#modalPagosMultiple">Pagos En Linea</button>
					@else
						@if( count($pagosPendientes) > 0 )
							<a
								class="pinedTooltip mr-05"
								href="{{ route('avisoVencimiento', $student->id) }}">
								<img src="{{secure_asset('img/file-download.svg')}}" width="30" alt="">
								<span class="pinedTooltipH">Aviso de Vencimiento</span>
							</a>
						@endif
						@if (session('user_data')->cargo == 'Colecturia')
							<a target="_blank" href="{{route('reporte.actaDeMatricula', $student->id)}}" class="btn btn-primary">Acta de Matrícula</a>
						@endif
						<button data-toggle="modal" data-target="#modalPagosMultiple" class="pinedTooltip mr-05">
							<a>
								<img src="{{secure_asset('img/usd-circle-light.svg')}}" width="36" alt="">
								<span class="pinedTooltipH">PAGOS MULTIPLES FACTURAS</span>
							</a>
						</button>
						<button data-toggle="modal" data-target="#modalPagosReciboMultiple" class="pinedTooltip mr-05">
							<a>
								<img src="{{secure_asset('img/pago.png')}}" width="36" alt="">
								<span class="pinedTooltipH">PAGOS MULTIPLES RECIBOS</span>
							</a>
						</button>
						<button data-toggle="modal" data-target="#modalDescuentos" class="pinedTooltip mr-05">
						<a>
							<img src="{{secure_asset('img/informacion-boton.svg')}}" class="ml-1" width="36" alt="">
							<span class="pinedTooltipH">BECAS / DESCUENTOS</span>
						</a>
						</button>
					@endif
				@endif
			</div>
		</div>
		<div class="bg-w-table" id="Q1">
			<div class="table-responsive">
				<table class="table table-pag-hist header-pag-his-withoutborder">
					<thead>
						<tr>
							<th>#</th>
							<th>Rubro</th>
							<th>Valor</th>
							<th>Estado</th>
							@if($user->cargo=='Representante')
							@else
							<th colspan="{{$col}}">Acción</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach($pagos as $pago)
							@if(isset($pago->pago->idRubro))
								@php
									$es =0;
									$rubro = Rubro::find($pago->pago->idRubro);
								@endphp
								<tr>
									<td>{{ $c }}</td>
									<td>
										{{ Fechas::getMes($pago->pago->mes) }} - {{ $rubro->tipo_rubro }}
									</td>
									<td>
										@php
											if($pago->abonos->isNotEmpty() && $pago->pago->rubro()->first()->tipo_emision != "RECIBO"){
												$factura = Factura::find($pago->facturaDetalle->last()->idFactura);
												$total = bcdiv($factura->total,'1',2);
											}else{
												$total = bcdiv(App\Payment::calcularDescuentoEstudiante($student->id, $pago->pago->id),1,2);
											}
										@endphp
										{{"$ "}}{{$total}}
									</td>
									@php
									@endphp
									<td width="80px">
										@if ($pago->estado == 'PAGADO')
											<a class="pinedTooltip mr-05">
												<img src="{{secure_asset('img/pagos-check-verde.svg')}}" class="ml-1" width="20" alt="">
												<span class="pinedTooltipH">PAGADO</span>
											</a>
										@else
											<a class="pinedTooltip mr-05">
												<img src="{{secure_asset('img/exclamation-circle.svg')}}" class="ml-1" width="20" alt="">
												<span class="pinedTooltipH">PENDIENTE</span>
											</a>
										@endif
										@if ($pago->facturaDetalle->last() != null)
											<a class="pinedTooltip mr-05" href="" data-toggle="modal" data-target="#modalUser{{$pago->facturaDetalle->last()->idFactura}}">
												<img src="{{secure_asset('img/informacion-boton.svg')}}" class="ml-1" width="12" alt="">
												<span class="pinedTooltipH">INFORMACION</span>
											</a>
										@endif
									</td>@if($user->cargo=='Representante') <!-- si es representante oculta los botones de acción-->

									@else
									<td width="50px">
										@if($pago->abonos->isNotEmpty())
											<a 
												class="btnHistorico pinedTooltip"
												url="{{route('getAbonos', $pago->abonos->last()->idFactura)}}">
												<img src="{{secure_asset('img/receipt-light.svg')}}" width="20" alt="" >
												<span class="pinedTooltipH">Historico</span>
											</a>
										@endif
									</td>
										@if( $pago->estado != "PAGADO" )
											<td width="60px">
												@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
													<form action="{{ route('NuevaFactura', $student->id) }}" method="POST">
														<input type="hidden" name="pagos_id[]" value="{{$pago->idPago}}">
														{{ csrf_field() }}
														<button type="submit" class="pinedTooltip">
															<a>
																<img src="{{secure_asset('img/usd-circle-light.svg')}}" width="20" alt="">
																<span class="pinedTooltipH-left">Realizar Pago</span>
															</a>
														</button>
													</form>
												@endif
											</td>
											<td width="60px">
												@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
													<a
														href="#"
														class="btnProrroga pinedTooltip mr-05"
														idEstudiante="{{ $student->id }}"
														idPago="{{ $pago->idPago }}"
														data-toggle="modal"
														data-target="#myModal">
														<img src="{{secure_asset('img/bullhorn.svg')}}" width="20" alt="">
														<span class="pinedTooltipH-left">Prorroga</span>
													</a>
												@endif
											</td>
                                            <td width="50px">
                                                @if (Sentinel::getUser()->email == 'soporte@pined.ec')
                                                    <a class="pinedTooltip mr-05" onclick="EliminarPago({{$pago->id}})">
                                                        <img src="{{secure_asset('img/times-circle-solid.svg')}}" width="20">
                                                        <span class="pinedTooltipH-left">Eliminar pago</span>
                                                    </a>
                                                @endif
                                            </td>
										@else
											@if ($pago->facturaDetalle->isNotEmpty())
												@if(strtoupper($rubro->tipo_emision) == "FACTURA")
													<td width="60px">
														@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
															<a class="pinedTooltip mr-05" href="{{route('descargarFacturaPago',['idPago' => $pago->facturaDetalle->last()->idFactura, 'idEstudiante' => $student->id])}}">
																<img src="{{secure_asset('img/file-download.svg')}}" width="16" alt="">
																<span class="pinedTooltipH-left">Descargar Factura</span>
															</a>
														@endif
													</td>
													<td width="60px">
														@if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
															<a
																class="pinedTooltip mr-05" onclick="darDeBaja({{$pago->facturaDetalle->last()->idFactura}})">
																<img src="{{secure_asset('img/thumbs-down-regular.svg')}}" width="20">
																<span class="pinedTooltipH-left">Dar de Baja</span>
															</a>
														@endif
													</td>
												@else
													@if( $pago->facturaDetalle->last()->idFactura != null)
														<td width="60px">
															@if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
																<a href="{{ route('pdfRecibo', $pago->facturaDetalle->last()->idFactura ) }}" class="pinedTooltip mr-05">
																	<img src="{{secure_asset('img/file-download.svg')}}" width="16" alt="">
																	<span class="pinedTooltipH-left">Descargar Recibo</span>
																</a>
															@endif
														</td>
														<td width="60px">
															@if($permiso ==null || ($permiso != null && $permiso->eliminar == 1))
																<a class="pinedTooltip mr-05" onclick="darDeBaja({{$pago->facturaDetalle->last()->idFactura}})">
																	<img src="{{secure_asset('img/thumbs-down-regular.svg')}}" width="20">
																	<span class="pinedTooltipH-left">Dar de Baja</span>
																</a>
															@endif
														</td>
													@endif
												@endif

											@else
												<td width="60px">-</td>
												<td width="60px">-</td>
											@endif
										@endif
										@endif
									</td>
								</tr>
								@php
									$c++;
								@endphp
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	{{-- Modal del usuario que realizo el pago --}}
	@foreach ($pagos as $pago)

		@if ($pago->facturaDetalle->last() != null)
			<div id="modalUser{{$pago->facturaDetalle->last()->idFactura}}" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Registro del pago</h4>
						</div>
						<div class="modal-body">
							@php
								$factura = Factura::find($pago->facturaDetalle->last()->idFactura);
							@endphp
							<ul><li>
							Nombre: {{$factura->user->apellidos}} {{$factura->user->nombres}}

							</li>
							<li>
							Tipo de pago: {{$factura->tipo_pago}}
							</li>
							<li>
							Fecha de pago: {{$factura->created_at->format('d-m-Y') }}
							</li>

							<!--se hace este if para mostrar el bontón de anular pago por la pasarela DataFast-->
							@if($factura->created_at->format('d-m-Y') == $hoy->format('d-m-Y') && $factura->idTransaccion != null && $pago->estado !='PENDIENTE')
							<li><a class="btn btn-info" href="{{route('AnularTransaccion', [$factura->id,$student->id])}}">
								<img src="{{secure_asset('img/thumbs-down-regular.svg')}}" width="15">
								Anular Pago
							</a>
							</li>
							@endif
						</ul>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		@endif
	@endforeach

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agregar Prorroga</h4>
				</div>
				<div class="modal-body">
					<div class="flex align-items-end">
						<label for="" class="mb-0 text-right mr-1">Ingrese el numero de dias:</label>
						<input class="form-control mr-1" type="number" id="diasProrroga" min="1" max="30">
						<a href="#" class="btn btn-primary" id="btnGuardarProrroga">Guardar</a>
					</div>
					<input type="text" id="idEstudiante" style="visibility: hidden;">
					<input type="text" id="idPago" style="visibility: hidden;">
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	{{-- Modal de los abonos que realizo --}}
	<div id="modalHistorico" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Historico</h4>
				</div>
				<div class="modal-body">
						<table class="table table-pag-hist">
							<thead>
								<tr>
									<td>Cantidad</td>
									<td>Fecha</td>
								</tr>
							</thead>
							<tbody id="tblAbonos">
							</tbody>
						</table>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	{{-- Modal Pagos multiples para facturas--}}
	<div class="modal fade" id="modalPagosMultiple" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Pago facturas Multiple</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('NuevaFactura', $student->id) }}" method="POST">
						{{ csrf_field() }}
						<h3>Datos del Cliente:</h3>
						@if($user->cargo=='Representante')
					<table class="table table-hover table-responsive">
					   <tbody>
					    <tr><input type="hidden" name="id_cliente" value="{{old('id_cliente', $student_cliente->cliente->id)}}">
					      <th scope="row">Cédula</th>
					      <td><input class="form__input" type="text" value="{{old('cedula_ruc', $student_cliente->cliente->cedula_ruc)}}" id="cedula_ruc" name="cedula_ruc" placeholder="cedula_ruc" required minlength="10" maxlength="10"  ></td>

					    </tr>
					    @php
					    list($nombre1,$nombre2) = explode(" ", $student_cliente->cliente->nombres);
					    @endphp
					    <tr>
					      <th scope="row">Primer Nombre</th>
					      <td><input class="form__input" type="text" value="{{old('nombre1', $nombre1)}}" id="nombre1" name="nombre1" placeholder="Primer Nombre" required>
					      </td>
					      <th scope="row">Segundo Nombre</th>
					      <td><input class="form__input" type="text" value="{{old('nombre2', $nombre2)}}" id="nombre2" name="nombre2" placeholder="Segundo Nombre" required>
					      </td>

					    </tr>
					    <tr><th scope="row">Apellidos</th>
					      <td><input class="form__input" type="text" value="{{ old('apellidos' ,$student_cliente->cliente->apellidos)}}" id="apellidos" name="apellidos" placeholder="Apellidos" required></td>
					      <th scope="row">Correo</th>
					      <td><input class="form__input" value="{{ old('email',$student_cliente->cliente->correo) }}" id="email" type="email" name="email" placeholder="Correo electronico">
					      </td>
					    </tr>
					    <tr><th scope="row">Teléfono</th>
					      <td><input class="form__input" type="text" value="{{ old('telefono' ,$student_cliente->cliente->telefono)}}" id="telefono" name="telefono" placeholder="Telefono" required>
					      </td>
					      <th scope="row">Dirección</th>
					      <td><input class="form__input" value="{{ old('direccion',$student_cliente->cliente->direccion) }}" id="direccion" type="text" name="direccion" placeholder="Direccion" required>
					      </td>
					    </tr>
					</tbody>
				</table>
				@endif
					<div class="flex justify-content-between">
							<h4>Seleccione los pagos a realizar.</h4>
							<h4 class="flex align-items-center mr-2">
								<span class="mr-2">SELECCIONAR TODOS</span> <input class="mt-0" type="checkbox" id="inputPagosAll">
							</h4>
						</div>
						<table class="table s-calificaciones">
							<tr class="table__bgBlue">
								<td></td>
								<td class="text-center">Mes</td>
								<td class="text-center">Tipo</td>
								<td class="text-center">Valor</td>
							</tr>
							@foreach($pagos->where('estado' ,'!=', "PAGADO") as $pago)
							@if(isset($pago->pago->idRubro))

								@php
									$rubro = Rubro::find($pago->pago->idRubro);
								@endphp
									@if($rubro->tipo_emision == "FACTURA" && count($pago->abonos) == 0 )
										<tr>
											<td class="text-center" width="5">
												<input type="checkbox" value="{{ $pago->idPago }}" name="pagos_id[]">
											</td>
											<td class="text-center">{{ Fechas::obtenerMes($pago->pago->mes) }}</td>
											<td class="text-center">{{ $rubro->tipo_rubro }}</td>
											<td class="text-center">{{ $pago->pago->valor_cancelar }}</td>
										</tr>
									@endif
								@endif
							@endforeach
						</table>
						<div class="text-right">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary">Ir a pagos</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- Modal Pagos multiples para recibos--}}
	<div class="modal fade" id="modalPagosReciboMultiple" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Pago Recibos Multiple</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('NuevaFactura', $student->id) }}" method="POST">
						{{ csrf_field() }}
						<h3>Datos del Cliente:</h3>
						<div class="flex justify-content-between">
							<h4>Seleccione los pagos a realizar.</h4>
							<h4 class="flex align-items-center mr-2">
								<span class="mr-2">SELECCIONAR TODOS</span> <input class="mt-0" type="checkbox" id="inputPagosAll">
							</h4>
						</div>
						<table class="table s-calificaciones">
							<tr class="table__bgBlue">
								<td></td>
								<td class="text-center">Mes</td>
								<td class="text-center">Tipo</td>
								<td class="text-center">Valor</td>
							</tr>
							@foreach($pagos->where('estado' ,'!=', "PAGADO") as $pago)
								@if(isset($pago->pago->idRubro))
									@php
										$rubro = Rubro::find($pago->pago->idRubro);
									@endphp
									@if($rubro->tipo_emision == "RECIBO")
										<tr>
											<td class="text-center" width="5">
												<input type="checkbox" value="{{ $pago->idPago }}" name="pagos_id[]">
											</td>
											<td class="text-center">
												{{ $pago->pago->mes == '1' ? 'Enero' : ''}}
												{{ $pago->pago->mes == '2' ? 'Febrero' : ''}}
												{{ $pago->pago->mes == '3' ? 'Marzo' : ''}}
												{{ $pago->pago->mes == '4' ? 'Abril' : ''}}
												{{ $pago->pago->mes == '5' ? 'Mayo' : ''}}
												{{ $pago->pago->mes == '6' ? 'Junio' : ''}}
												{{ $pago->pago->mes == '7' ? 'Julio' : ''}}
												{{ $pago->pago->mes == '8' ? 'Agosto' : ''}}
												{{ $pago->pago->mes == '9' ? 'Septiembre' : ''}}
												{{ $pago->pago->mes == '10' ? 'Octubre' : ''}}
												{{ $pago->pago->mes == '11' ? 'Noviembre' : ''}}
												{{ $pago->pago->mes == '12' ? 'Diciembre' : ''}}
											</td>
											<td class="text-center">{{ $rubro->tipo_rubro }}</td>
											<td class="text-center">{{ $pago->pago->valor_cancelar }}</td>
										</tr>
									@endif
								@endif
							@endforeach
						</table>
						<div class="text-right">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary">Ir a pagos</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- Modal Descuentos --}}
	<div class="modal fade" id="modalDescuentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Becas / Descuentos</h4>
				</div>
				<div class="modal-body">					
					@include('partials.pagos.becasDescuentos',
					['crear' => false,
					'id' => $student->id])					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
<script>
		const selectParcial = document.getElementById('selectPeriodo');
		const url = "{{ route('pagosCursoEstudianteJs') }}";
		const id = "{{$student->id}}"
		if (selectParcial) {
			selectParcial.addEventListener('change', function() {
				const idPeriodo = selectParcial.value
				const newurl = `${url}/${id}/${idPeriodo}`
				location.href = newurl;
			})
		} else {
			console.log('Error al obtener el select');
		}
		const inputPagoMes = document.querySelectorAll('input[name="pagos_id[]"]')
		const inputPagosTodos = document.getElementById('inputPagosAll');
		if(inputPagoMes) {
			inputPagosTodos.addEventListener('click', function() {
				if(inputPagosTodos.checked) {
					inputPagoMes.forEach(e => {
						e.checked = true;
					});
				} else {
					inputPagoMes.forEach(e => {
						e.checked = false;
					});
				}
			})
			inputPagoMes.forEach(e => {
				e.addEventListener('click', function() {
					if(e.checked == false) {
						inputPagosTodos.checked = false;
					}
				})
			});
		} else {
			console.log('Error al seleccionar los input')
		}
		$('.btnProrroga').click( function (e) {
			console.log
			$.ajax({
				url: "{{ route('getProrrogaRoute') }}/"+$(this).attr('idPago')+"/"+$(this).attr('idEstudiante'),
				type: "GET",
				success: function (result, status, xhr) {
					$('#diasProrroga').val(result);

				}
			});
			$('#idPago').val( $(this).attr('idPago') )
			$('#idEstudiante').val( $(this).attr('idEstudiante') )
		})
		$('#btnGuardarProrroga').click( function (e) {
			$.ajax({
				url: "{{ route('setProrroga') }}",
				type: "POST",
				data: {
					'_token': $('input[name=_token]').val(),
					diasProrroga: $('#diasProrroga').val(),
					idPago: $('#idPago').val(),
					idEstudiante: $('#idEstudiante').val()
				},
				success: function (result, status, xhr) {
					$('#myModal').modal('toggle');
				}
			});
		})
	$('.btnHistorico').click( function (e) {
		if($(this).attr('url')!= null) {
			$.ajax({
				url: $(this).attr('url') ,
				type: "GET",
				success: function (result, status, xhr) {
					$('#tblAbonos').empty()
					result.abonos.forEach( el => {
						if (el.estatus != 'BAJA' && el.estatus != "PAGADO"){
							$('#tblAbonos').append(
								`<tr>
									<td>$ ${el.cantidad}</td>
									<td>${el.created_at.slice(1,16)}</td>
									<td><a href="{{route('urlabono') }}/${el.id}" class="pinedTooltip mr-05" target="_blank"><img src="{{secure_asset('img/file-download.svg')}}" width="14" alt="" align=""><span class="pinedTooltipH">Descargar Recibo</span></a></td>
									<td><a href="{{route('urlRecibo') }}/baja/${el.id}" class="pinedTooltip mr-05"><i class="fa fa-trash icon__eliminar"></i><span class="pinedTooltipH">Dar de Baja</span></a></td>
								</tr>`
							)
						}
					})
					$('#modalHistorico').modal('toggle');
				}
			});
		}else{
			$('#tblAbonos').empty()
			$('#modalHistorico').modal('toggle');
		}
	})
	
		var enlace = window.location.origin
		function darDeBaja(idFactura) {
			Swal.fire({
				title: '¿Seguro desea dar de baja a la Factura?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'SI',
				cancelButtonText: 'NO'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							type: "GET",
							url: `${enlace}/factura/baja/${idFactura}`,
							success: function (response) {
								location.reload()
							}, error: function(response) {
								alert('Algo salio mal.')
							}
						});

				}
			})
		}

        var enlace = window.location.origin
		function EliminarPago(idPagoDetalle) {
			Swal.fire({
				title: '¿Seguro desea eliminar el Pago?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'SI',
				cancelButtonText: 'NO'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							type: "GET",
							url: `${enlace}/PagosDetalles/baja/${idPagoDetalle}`,
							success: function (response) {
								location.reload()
							}, error: function(response) {
								alert('Algo salio mal.')
							}
						});

				}
			})
		}
	</script>
@endsection