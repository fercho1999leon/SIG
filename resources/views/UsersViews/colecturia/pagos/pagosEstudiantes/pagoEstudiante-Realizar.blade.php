<style>
#idDeposito, 
#idCheque,
#idTarjeta {
	grid-gap: 10px;
    width: 100%;
}
</style>
@extends('layouts.master') 
@section('content')
<a class="button-br" href="{{ route('pagosCursoEstudiante', $student->id) }}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg mb-1">
        <div class="padre-pago">
            <div class="profile-image mb-1">
                <img src="{{secure_asset('img/icono_persona.png')}}" alt="FACTURA" W width="30">
            </div>
            <div class="profile-info">
                <h2 class="no-margins">
                    {{ $student->nombres }} {{ $student->apellidos }}
                </h2>
                <p>
                    <h3 style="padding-left:10px">
                        <strong>CURSO:</strong> {{ $course->grado }} {{ $course->paralelo}} 
                    </h3>
                </p>
                <p>
                    <h3 style="padding-left:10px">
                        <strong>DIRIGENTE:</strong> {{ $tutor->nombres }} {{ $tutor->apellidos }}
                    </h3>
                </p>
            </div>
        </div>
    </div>
    <div class="">
        <div class="pagoEstudiante__firstBlock">
            <div class="notificacionn">
				<div class="bg-w-table white-bg">
					<div class="table-responsive">
						<table class="table">
							<tr class="table__bgBlue">
								<td class="text-center fz19" colspan="2">DETALLES DE PAGO</td>
							</tr>
							<tr>
								<td width="50%" style="border-right: 1px solid #e7eaec;" class="text-center">AÑO LECTIVO</td>
								<td width="50%" class="text-center">PERIODO 2018 - 2019</td>
							</tr>
							<tr>
								<td style="border-right: 1px solid #e7eaec;" class="text-center">Mes</td>
								<td class="text-center">{{ $registroPago->mes}}</td>
							</tr>
							<tr>
								<td style="border-right: 1px solid #e7eaec;" class="text-center">Tipo</td>
								<td class="text-center">{{ $registroPago->tipo}}</td>
							</tr>
							<tr>
								<td style="border-right: 1px solid #e7eaec;" class="text-center">Mes</td>
								<td class="text-center">{{ $registroPago->valor}}</td>
							</tr>
							<tr>
								<td colspan="2" class="text-center">
									<b>TOTAL: {{ $total=$registroPago->valor }}</b>
								</td>
							</tr>

							<tr>
								@if( $pago->beca!=null )
									<td style="border-right: 1px solid #e7eaec;" class="text-center">BECA</td>
									<td class="text-center">
										@if( $beca->valor!=null ) 
											-{{ $beca->valor }}
											<span style="display: none">
												{{ $cantidadBeca=$beca->valor }}
											</span>
										@else
											-{{ bcdiv(($beca->porcentaje/100)*$registroPago->valor, '1',2) }} 
											<span style="display: none">
												{{ $cantidadBeca=bcdiv(($beca->porcentaje/100)*$registroPago->valor, '1',2) }}
											</span>
										@endif
									</td>
								@endif
								<span style="display: none">
									{{ $valorHastaBeca=bcdiv($registroPago->valor-$cantidadBeca, '1', 2) }}
								</span>
							</tr>

							<tr>
								@if( $pago->descuento!=null )
									<td style="border-right: 1px solid #e7eaec;" class="text-center">DESCUENTO</td>
									<td class="text-center">
										@if( $descuento->valor!=null ) 
											-{{ $descuento->valor }}
											<span style="display: none">
												{{ $cantidadDescuento=$descuento->valor }}
											</span>
										@else
											-{{ bcdiv(($descuento->porcentaje/100)*$registroPago->valor, '1',2) }}
											<span style="display: none">
												{{ $cantidadDescuento= bcdiv(($descuento->porcentaje/100)*$valorHastaBeca, '1',2) }}
											</span>
										@endif
									</td>
								@endif
								<span style="display: none">
									{{ $valorHastaDescuento=  $valorHastaBeca-$cantidadDescuento }}
								</span>
							</tr>

							@foreach( $pagosEstudiantes as $pE )
								<tr>
									<td style="border-right: 1px solid #e7eaec;" class="text-center">ABONO</td>
									<td class="text-center">
										-{{ $pE->cantidad }}
										<span style="display: none">
											{{ $cantidadPagosAnteriores=$cantidadPagosAnteriores+$pE->cantidad }}
										</span>
									</td>
								</tr>
							@endforeach

							<tr>
								<td colspan="2" class="text-center">
									<b>TOTAL A CANCELAR: {{ $total=$valorHastaDescuento-$cantidadPagosAnteriores }}</b>
								</td>
							</tr>

						</table>
					</div>
				</div>			
			</div>

			<div id="colecturiaPago" class="">
				<table class="table m-0">
					<tr class="table__bgBlue">
						<td class=" text-center fz19">FORMULARIO DE PAGO</td>
					</tr>
				</table>
				<form method="post" action="{{ route('generarPagoEstudiante', ['idStudent'=> $student->id, 'idPago'=> $pago->id] ) }}" class="colecturiaPago__metodosDePago-form">
					<input name="_method" type="hidden" value="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
					<input  class="colecturiaPago__metodosDePago-form__input" name="nombres" type="text" placeholder="Nombres" required>
					<input  class="colecturiaPago__metodosDePago-form__input" name="apellidos" type="text" placeholder="Apellidos" required>
					<input  class="colecturiaPago__metodosDePago-form__input" name="ciRUC" type="text" placeholder="Cédula o Ruc" required>
					<input  class="colecturiaPago__metodosDePago-form__input" name="telefono" type="text" placeholder="Teléfono/móvil" required>
					<input  class="colecturiaPago__metodosDePago-form__input" name="ciudad" type="text" placeholder="Ciudad" required>
					<input  class="colecturiaPago__metodosDePago-form__input" name="direccion" type="text" placeholder="Dirección" required>
					<input  class="colecturiaPago__metodosDePago-form__input" name="correo" type="email" placeholder="Correo" required>
	
					<select id="tipoDePago" class="colecturiaPago__metodosDePago-form__input pagos__select" name="tipoPago" required>
						<option value="">Elija una forma de pago...</option>
						<option value="Caja">Caja</option>
						<option value="Deposito/Transferencia">Deposito / Transferencia</option>
						<option value="Cheque">Cheque</option>
						<option value="Tarjeta">Tarjeta de credito</option>
					</select>

					{{-- Caja --}}
					<div style="display:none;" id="idCaja" class="colecturiaPago__metodosDePago-form__cantidad">
						<span class="colecturiaPago__metodosDePago-form__cantidad">
							<span class="colecturiaPago__metodosDePago-form__cantidad-icon">$</span>
							<input class="colecturiaPago__metodosDePago-form__input" name="cantidadCaja" type="number" step="0.01" placeholder="Cantidad a pagar" >
						</span>
					</div>

					{{-- Deposito / Transferencia --}}
					<div style="display:none;" id="idDeposito">
						<input class="colecturiaPago__metodosDePago-form__input" name="numeroDeposito" type="text" placeholder="Numero de papeleta" >
						<span class="colecturiaPago__metodosDePago-form__cantidad">
							<span class="colecturiaPago__metodosDePago-form__cantidad-icon">$</span>
							<input class="colecturiaPago__metodosDePago-form__input" name="cantidadDeposito" type="number" step="0.01" placeholder="Cantidad a pagar" >
						</span>
					</div>

					{{-- Tarjeta --}}
					<div style="display:none;" id="idTarjeta">
						<input class="colecturiaPago__metodosDePago-form__input" name="datosTarjeta" type="text" placeholder="Nombres y Apellidos" >
						<input class="colecturiaPago__metodosDePago-form__input" name="numeroTarjeta" type="text" placeholder="Numero de tarjeta" >
						<span class="colecturiaPago__metodosDePago-form__cantidad">
							<span class="colecturiaPago__metodosDePago-form__cantidad-icon">$</span>
							<input class="colecturiaPago__metodosDePago-form__input" name="cantidadTarjeta" type="number" step="0.01" placeholder="Cantidad a pagar" >
						</span>
					</div>

					{{-- Cheque --}}
					<div style="display:none;" id="idCheque">
						<input class="colecturiaPago__metodosDePago-form__input" name="numeroCheque" type="text" placeholder="Numero de cheque" >
						<input class="colecturiaPago__metodosDePago-form__input" name="bancoCheque" type="text" placeholder="Nombre del Banco" >
						<span class="colecturiaPago__metodosDePago-form__cantidad">
							<span class="colecturiaPago__metodosDePago-form__cantidad-icon">$</span>
							<input class="colecturiaPago__metodosDePago-form__input" name="cantidadCheque" type="number" step="0.01" placeholder="Cantidad a pagar" >
						</span>
					</div>

					<button type="submit" class="colecturiaPago__metodosDePago-form__enviar"  value="Realizar Pago" :disabled="yolo">Realizar Pago</button>
				</form>
			</div>
        </div>
    </div>
</div>
<script>
	const transaccionPago = (idSelect, idCaja, idDeposito, idTarjeta, idCheque) => {
		let selectPago = document.getElementById(idSelect),
		caja = document.getElementById(idCaja),
		deposito = document.getElementById(idDeposito),
		tarjeta = document.getElementById(idTarjeta),
		cheque = document.getElementById(idCheque)

		if(selectPago && caja && deposito && tarjeta && cheque) {
			selectPago.addEventListener('change', () => {
				if(selectPago.value == 'Caja') {
					caja.style.display = 'block';

					deposito.style.display = 'none';
					tarjeta.style.display = 'none';
					cheque.style.display = 'none';
				} else if(selectPago.value == 'Deposito/Transferencia') {
					deposito.style.display = 'grid';

					tarjeta.style.display = 'none';
					cheque.style.display = 'none';
					caja.style.display = 'none';
				} else if(selectPago.value == 'Cheque') {
					cheque.style.display = 'grid';

					tarjeta.style.display = 'none';
					deposito.style.display = 'none';
					caja.style.display = 'none';
				} else if(selectPago.value == 'Tarjeta') {
					tarjeta.style.display = 'grid';

					cheque.style.display = 'none';
					deposito.style.display = 'none';
					caja.style.display = 'none';
				} else {
					cheque.style.display = 'none';
					tarjeta.style.display = 'none';
					deposito.style.display = 'none';
					caja.style.display = 'none';
				}
			})
		} else {
			alert('Hubo un error, comuniquese con soporte.')
		}
	} 


	transaccionPago('tipoDePago', 'idCaja', 'idDeposito', 'idTarjeta', 'idCheque')
</script>
@endsection
