@extends('layouts.master') 
@section('styles')
@php
    use App\Rubro;
    use App\BecaDescuento;

		$user = Sentinel::getUser();
		$user = App\Administrative::where('userid', $user->id)->first();
		$leads = json_decode($responseData, true);
@endphp
@if($user->cargo=='Representante')
<script src=https://code.jquery.com/jquery-3.5.1.min.js></script>
<script src="https://cdn.kushkipagos.com/kushki-checkout.js"></script>
<script src="https://cdn.kushkipagos.com/kushki.min.js"></script>
<script type="text/javascript" src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$leads['id']}}"></script>
<a class="button-br" href=" {{route('representantePagosPendientes', [$student->idStudent]) }} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
@else
<a class="button-br" href=" {{route('pagosCursoEstudiante', [$student->idStudent]) }} ">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
	</button>
</a>
@endif
<style>
	.ocultarPagos{
		/* visibility: hidden; */
		display: none;
		visibility: hidden;
		width: 0;
		height: 0;
	}
</style>
@endsection
@section('content')
@include('partials.loader.loader')

<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg mb-1">
        <div class="padre-pago">
            <div class="profile-image mb-1">
                <img src="{{secure_asset('img/icono_persona.png')}}" alt="FACTURA" width="30">
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
                        <strong>DIRIGENTE:</strong> 
                        @if($tutor != null)
                            {{ $tutor->nombres }} {{ $tutor->apellidos }}
                        @endif

                    </h3>
                </p>
            </div>
        </div>
    </div>
        <div class="">
            <div class="header-pag-his">
            	
                <div class="notificacion">
                    <span class="notificaciones notificaciones-pago">
                        <figure class="simboloDolar">
                            <img src="{{secure_asset('img/simbolo-de-dolar.svg')}}" alt="" width="18">
                        </figure>
                        <label class="texto-notificaciones">Realizar Pagos</label>
                    </span>
				</div>
            </div>
            <div class="flex w-3/5">
                {{-- @if($pago->rubro->tipo_emision == "FACTURA") --}}
					{{-- <input type="text" class="colecturiaPago__metodosDePago-form__input mr-1 w-12" value="" style="width:50%" placeholder="Numero de Factura" name="numero_factura" required minlength="1" maxlength="9"> --}}
                {{-- @endif --}}
				<div class="flex">
					<form action="{{route('GuardarFactura')}}" method="post" id="guardarFactura">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
					<input class="colecturiaPago__metodosDePago-form__input align-content-center mr-1" value="{{ old('cedula_ruc' ,$student->cliente->cedula_ruc)}}" type="text" id="cedula_ruc" name="cedula_ruc" placeholder="Cédula o Ruc" required>
					<a href="#" id="btnBuscarCliente" class="btn btn-primary" style="display:flex;align-items: center;">BUSCAR</a>
				</div>
			</div>
			<div id="colecturiaPago" class="">
                <div class="row">
                    <div class="col-lg-6">						
                        <input type="text" style="visibility: hidden;" value="{{$student->cliente->id}}" name="idCliente" id="idCliente">
                        <input class="colecturiaPago__metodosDePago-form__input" type="text" value="{{old('nombres', $student->cliente->nombres)}}" id="nombres" name="nombres" placeholder="Nombres" required>
                        <input class="colecturiaPago__metodosDePago-form__input" type="text" value="{{ old('apellidos' ,$student->cliente->apellidos)}}" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                        <input class="colecturiaPago__metodosDePago-form__input" type="text" value="{{ old('telefono' ,$student->cliente->telefono)}}" id="telefono" name="telefono" placeholder="Telefono" required>
                    </div>
                    <input type="text" value="{{ $student->idStudent }}" name="idEstudiante" style="visibility: hidden;">
                    <input type="text" style="visibility: hidden;" value="{{ $factura->id ?? ''}}" name="idFactura">

                    <div class="col-lg-6">
                        <input class="colecturiaPago__metodosDePago-form__input" value="{{ old('direccion',$student->cliente->direccion) }}" id="direccion" type="text" name="direccion" placeholder="Direccion" required>
                        <input class="colecturiaPago__metodosDePago-form__input" value="{{ old('email',$student->cliente->correo) }}" id="email" type="email" name="email" placeholder="Correo electronico">
                    </div>
                    <br>
                </div>      
			</div>
			{{-- solo para interactuar con js --}}
			<input type="hidden" id="estudianteNombres" value="{{$student->nombres}} {{$student->apellidos}}">
			<input type="hidden" id="estudianteCurso" value="{{$student->course->grado}} {{$student->course->especializacion}} {{$student->course->paralelo}}">
			{{-- fin --}}
            <div class="bg-w-table white-bg">
                <div class="table-responsive">
                    <table class="table-pag-hist table">
                        <thead>
                            <tr>
                                <th>Año Lectivo</th>
                                <th>Mes</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Beca / Descuento</th>
                            </tr>
						</thead>
						<tbody>
							@foreach ($pagos as $pago)
								@php
									$rubro = Rubro::find($pago->idRubro);
								@endphp
								<tr>
									<td>PERIODO {{substr($periodo->fecha_inicial,0,4)}} - {{substr($periodo->fecha_final,0,4)}}</td>
									<td>
										{{App\Fechas::obtenerMes($pago->mes)}}
									</td>
									<td>{{ $rubro->tipo_rubro }}</td>
									<td>{{ $pago->valor_cancelar }}</td>
									<td>
										@if ($student->student->becasDescuentos->isNotEmpty())
											@foreach($student->student->becasDescuentos as $beca)
												@php
													$bd = BecaDescuento::find($beca->idBeca);
												@endphp
												<p class="mb-0"> {{ $bd->tipo }} - {{ $bd->tipo_pago }} : {{ $bd->valor }} </p>
											@endforeach
										@endif
									</td>
								</tr>
								<input type="hidden" value="{{$pago->id}}" name="idPago[]">
							@endforeach
						</tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-lg-6">
					@if ($cuadroAbonos)
						<table class="table bg-white">
							<tr class="table__bgBlue">
								<td colspan="2" class="text-center">Abonos</td>
							</tr>
							<tr>
								<td class="text-center bold">Cantidad</td>
								<td class="text-center bold">Fecha</td>
							</tr>
							@foreach($abonos as $abono)
								<tr>
									<td class="text-center">${{ $abono->cantidad }}</td>
									<td class="text-center">{{ substr($abono->created_at,0,16) }}</td>
								</tr>
							@endforeach
						</table>
					@endif
					@foreach ($pagos_detalle as $pd)
						<input type="hidden" value="{{ $pd->id }}" name="idPagoDetalle[]">
					@endforeach
                </div>
                    	@if($user->cargo=='Representante')
							@else

				<div class="col-lg-6">
                    <table class="table-pag-hist white-bg table">
						<tr>
							<td>Tipo de Pago:</td>
							<td>
								<select name="tipo_pago" id="tipo_pago" class="form-control">
									<option value="EFECTIVO">Efectivo</option>
									<option value="CHEQUE">Cheque</option>
									<option value="TARJETACREDITO">Tarjeta de Crédito</option>
									<option value="TARJETADEBITO">Tarjeta de Débito</option>
									<option value="DEPOSITO">Deposito/Transferencia</option>
								</select>
							</td>
						</tr>
						<tr id="trBanco" class="ocultarPagos">
							<td>Banco:</td>
							<td>
								<input placeholder="Nombre del Banco" type="text" class="form-control" name="banco">
							</td>
						</tr>
						<tr id="trDescripcion" class="ocultarPagos">
							<td>Numero:</td>
							<td>
								<input placeholder="Numero de la tarjeta de credito o débito" type="text" class="form-control" name="numero_descripcion">
							</td>
						</tr>
						<tr id="trTarjeta" class="ocultarPagos">
							<td>Tarjeta:</td>
							<td>
								<input placeholder="Visa, Mastercard, etc." type="text" class="form-control" name="nombre_tarjeta">
							</td>
						</tr>
                        <tr>
                            <td> Becas / Descuentos:</td>
                            <td>
                                @foreach($student->student->becasDescuentos as $beca)
                                    @php
                                        $bd = BecaDescuento::find($beca->idBeca);
                                    @endphp
                                    {{ $bd->tipo }} - {{ $bd->tipo_pago }} : {{ $bd->valor }}
                                    <!-- Campos necesarios para la validacion de los descuentos. Jorge Fierro 11 de enero de 2020 -->
                                    <input type="hidden" value="{{ $bd->tipo_pago }}" name="tipo_pagoBD">
                                    <input type="hidden" value="{{ $bd->valor }}" name="valorBD">

                                @endforeach
                            </td>
                        </tr>
						@php
                            $total = $pagos->sum('valor_cancelar');
                            $descuentoTotal = 0;
							foreach ($pagos as $pago) {
                                $descuentoTotal += App\Payment::calcularDescuentoEstudiante($student->idStudent, $pago->id);
                            }
						@endphp
                        <tr>
							<td>Subtotal:</td>
							<input type="text" style="visibility: hidden;" value="{{ $pagos->sum('valor_cancelar') }}" name="subtotal">                            
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
						</tr>
						<input type="text" style="visibility: hidden;" value="{{ $descuentoTotal }}" name="descuentoTotal">
						<tr>
							<td>Total: </td>
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
							<input type="text" style="visibility: hidden;" value="{{ bcdiv($descuentoTotal, '1', 2) }}" name="total" id="total">
						</tr>
						<tr>
							<td>Valor a pagar:</td>
							<td>
								<input type="number" 
								@if (!$cuadroAbonos)
									min="{{ bcdiv($descuentoTotal, '1', 2) }}" 
									max="{{ bcdiv($descuentoTotal, '1', 2) }}" 
								@endif
								step="0.01" class="colecturiaPago__metodosDePago-form__input" name="valor_pagar" id="valor_pagar" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">  
								<button 
									id="btn-realizar_pago" 
									data-toggle="modal" 
									data-target="#detallePago" 
									type="button"
									class="colecturiaPago__metodosDePago-form__enviar">Realizar Pago
								</button>
							</td>
						</tr>	
						 </table>
						</div>
					@endif
			</div>
         </div>
     </form> 
           	@if($user->cargo=='Representante')           	
			<div class="col-lg-6 white-bg">
			<table class="table-pag-hist table">
                        <thead>
                            <tr>
                                <th colspan="2">Pago en linea</th>
                            </tr>
                        </thead>
                            <tr>
                            <td> Becas / Descuentos:</td>
                            <td>
                                @foreach($student->student->becasDescuentos as $beca)
                                    @php
                                        $bd = BecaDescuento::find($beca->idBeca);
                                    @endphp
                                    {{ $bd->tipo }} - {{ $bd->tipo_pago }} : {{ $bd->valor }}
                                    <!-- Campos necesarios para la validacion de los descuentos. Jorge Fierro 11 de enero de 2020 -->
                                    <input type="hidden" value="{{ $bd->tipo_pago }}" name="tipo_pagoBD">
                                    <input type="hidden" value="{{ $bd->valor }}" name="valorBD">

                                @endforeach
                            </td>
                        </tr>
						@php
							$total = $pagos->sum('valor_cancelar');
							
							$descuentoTotal = 0;
							foreach ($pagos as $pago) {    
								$totalPago = $pago->valor_cancelar;
								$becaTotal = 0;
								$rubro = Rubro::find($pago->idRubro);   
								$descuento = 0;
                                if(count($student->student->becasDescuentos) != 0) {
                                    foreach($student->student->becasDescuentos as $beca){
                                        $bd = BecaDescuento::find($beca->idBeca);
                                        if($bd->tipo == 'BECA'){
                                            if($bd->tipo_pago == "USD"){
                                                $becaTotal = $bd->valor;
                                            }else if($bd->tipo_pago == "PORCENTAJE"){
                                                $becaTotal = $totalPago*($bd->valor/100);
                                            } 
                                        }
                                    }    
                                    $totalPago = $totalPago - $becaTotal;
                                    foreach($student->student->becasDescuentos as $beca){
                                        $bd = BecaDescuento::find($beca->idBeca);
                                        if($bd->tipo == 'DESCUENTO'){
                                            if($bd->tipo_pago == "USD"){
                                                $descuento = $bd->valor;
                                            }else if($bd->tipo_pago == "PORCENTAJE"){
                                                $descuento = $totalPago*($bd->valor/100);
                                            } 
                                        }
                                    }
                                }
								$descuentoTotal += (bcdiv($totalPago, '1', 2) - $descuento);    
							}
						@endphp
                        <tr>
							<td>Subtotal:</td>
							                          
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
						</tr>
						<input type="hidden" value="{{ $descuentoTotal }}" name="descuentoTotal">
						<tr>
							<td>Total: </td>
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
							
						</tr>
						<tr>
							<td>Total a pagar: </td>
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
							
						</tr>
						<input type="hidden" value="{{ bcdiv($descuentoTotal, '1', 2) }}" name="total" id="total">
							<input type="hidden" value="{{ bcdiv($descuentoTotal, '1', 2) }}" name="valor_pagar" id="valor_pagar">
						<input type="hidden" value="{{ $pagos->sum('valor_cancelar') }}" name="subtotal">  
						<input type="hidden" value="{{ bcdiv($descuentoTotal, '1', 2) }}" name="valor_pagar" id="valor_pagar">	
                    </table>
                    <input type="checkbox" id="terminosCondiciones" onclick="mostraModal();" name="terminosCondiciones"> Acepta los terminos y condiciones
				
				</div>
				<div id="mostrarDF" style="display: none">
					<div class="col-lg-6">

					<form id="" action="{{route('recibeToken2')}}" method="POST" class="paymentWidgets" data-brands='VISA MASTER DINERS DISCOVER'>
				{{ csrf_field() }}
				<div class="wpwlbutton"></div>
				</form>
				</div>
			</div>
			<div class="col-lg-6">
			
			</div>
			<div class="row mt-1">
			<!-- oculto Kushki
			
			<div class="col-lg-6">
			</div>
			<div class="col-lg-6">
			<tr>
			<td colspan="2">

				<button 
				onclick="validarPEL();" 
					type="button"
					class="colecturiaPago__metodosDePago-form__enviar"
					>Pago en linea
				</button>
			</td>
			</tr>		
			</div>-->	
			</div>
		</div>
      @endif
</div>


{{-- Modal confirmación --}}
<div class="modal fade" id="detallePago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title uppercase text-center" id="myModalLabel">Confirmación de pago</h4>
			</div>
			<div class="modal-body">
				<h3 class="text-center mb-1">PERIODO LECTIVO {{$periodo->nombre}}</h3>
				<div class="confirmacion__pago">
					<div>
						<h3 class="m-0">Cliente:</h3>
						<hr class="mt-0 mb-3">
						<ul class="pl-10" id="datosCliente">
						</ul>
					</div>
					<div>
						<h3 class="m-0">Estudiante:</h3>
						<hr class="mt-0 mb-3">
						<ul class="pl-10" id="datosEstudiante">
						</ul>
					</div>
				</div>
				<br>
				<table class="s-calificaciones w100">
					<tr class="table__bgBlue">
						<td class="text-center">Rubro-Mes</td>
						<td class="text-center">Valor</td>
						<td class="text-center">Desc</td>
					</tr>
					@php
						$rubro = Rubro::find($pago->idRubro);
					@endphp
					@foreach ($pagos as $pago)
						<tr>
							<td class="text-center">
								{{App\Fechas::obtenerMes($pago->mes)}}
							</td>
							<td class="text-center"> {{App\Payment::calcularDescuentoEstudiante($student->idStudent, $pago->id)}} </td>
							<td class="text-center">
                            @if ($student->student->becasDescuentos->isNotEmpty())
                                @foreach($student->student->becasDescuentos as $beca)
                                    @php
                                        $bd = BecaDescuento::find($beca->idBeca);
                                    @endphp
                                    <p class="mb-0"> {{ $bd->tipo }} - {{ $bd->tipo_pago }} : {{ $bd->valor }} </p>
                                @endforeach
                            @endif
							</td>
						</tr>
					@endforeach
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" onclick="modalRealizarPago()" id="buttonModal__button-realziar-pago" class="btn btn-primary">Realizar Pago</button>
			</div>
		</div>
	</div>
</div>
<!--
<div class="modal" tabindex="-1" role="dialog" id="PEL">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">PAGO EN LINEA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<h3 class="text-center mb-1">PERIODO LECTIVO {{$periodo->nombre}}</h3>
				<div class="confirmacion__pago">
					<div>
						<h3 class="m-0">Cliente:</h3>
						<hr class="mt-0 mb-3">
						<ul class="pl-10" id="datosCliente2">
						</ul>
					</div>
					<div>
						<h3 class="m-0">Estudiante:</h3>
						<hr class="mt-0 mb-3">
						<ul class="pl-10" id="datosEstudiante2">
						</ul>
					</div>
				</div> 
				<input type="checkbox" id="terminosCondiciones" onclick="mostraModal();" name="terminosCondiciones"> Acepta los terminos y condiciones
				<br>
				<div id="mostrarKushki" style="display: none">
        		<form id="pagoEnLinea" action="{{route('GuardarFactura')}}" method="POST">
					{{ csrf_field() }}
					<div class="bg-w-table white-bg">
                <div class="table-responsive">
					<input type="hidden" value="{{$pago->id}}" name="idPago[]">
					<input type="text" style="visibility: hidden;"  value="{{$student->cliente->id}}" name="idCliente">
					<input  type="hidden" value="{{ old('cedula_ruc' ,$student->cliente->cedula_ruc)}}" id="cedula_ruc2" name="cedula_ruc2" readonly="readonly" ><input  type="hidden" value="{{old('nombres', $student->cliente->nombres)}}" id="nombres2" name="nombres2" >
					<input type="hidden" value="{{ old('apellidos' ,$student->cliente->apellidos)}}" id="apellidos2" name="apellidos2">
					<input  type="hidden" value="{{ old('telefono' ,$student->cliente->telefono)}}" id="telefono2" name="telefono2">
					<input type="hidden" value="{{ $student->idStudent }}" name="idEstudiante" >
					<input type="hidden"  value="{{ $factura->id ?? ''}}" name="idFactura">
					<input  value="{{ old('direccion',$student->cliente->direccion) }}" id="direccion2" type="hidden" name="direccion2" >
					<input  value="{{ old('email',$student->cliente->correo) }}" id="email2" type="hidden" name="email2" >
					
			
                    <table class="table-pag-hist table">
                        <thead>
                            <tr>
                                <th colspan="2">Pago en linea</th>
                            </tr>
                            <tr>
                            <td> Becas / Descuentos:</td>
                            <td>
                                    @foreach($student->student->becasDescuentos as $beca)
                                        @php
                                            $bd = BecaDescuento::find($beca->idBeca);
                                        @endphp
                                        {{ $bd->tipo }} - {{ $bd->tipo_pago }} : {{ $bd->valor }}
                                        <!-- Campos necesarios para la validacion de los descuentos. Jorge Fierro 11 de enero de 2020 
                                        <input type="hidden" value="{{ $bd->tipo_pago }}" name="tipo_pagoBD">
                                        <input type="hidden" value="{{ $bd->valor }}" name="valorBD">

                                    @endforeach
                            </td>
                        </tr>
						@php
							$total = $pagos->sum('valor_cancelar');
							
							$descuentoTotal = 0;
							foreach ($pagos as $pago) {    
								$totalPago = $pago->valor_cancelar;
								$becaTotal = 0;
								$rubro = Rubro::find($pago->idRubro);   
								$descuento = 0;
                                if(count($student->student->becasDescuentos) != 0) {
                                    foreach($student->student->becasDescuentos as $beca){
                                        $bd = BecaDescuento::find($beca->idBeca);
                                        if($bd->tipo == 'BECA'){
                                            if($bd->tipo_pago == "USD"){
                                                $becaTotal = $bd->valor;
                                            }else if($bd->tipo_pago == "PORCENTAJE"){
                                                $becaTotal = $totalPago*($bd->valor/100);
                                            } 
                                        }
                                    }    
                                    $totalPago = $totalPago - $becaTotal;
                                    foreach($student->student->becasDescuentos as $beca){
                                        $bd = BecaDescuento::find($beca->idBeca);
                                        if($bd->tipo == 'DESCUENTO'){
                                            if($bd->tipo_pago == "USD"){
                                                $descuento = $bd->valor;
                                            }else if($bd->tipo_pago == "PORCENTAJE"){
                                                $descuento = $totalPago*($bd->valor/100);
                                            } 
                                        }
                                    }
                                }
								$descuentoTotal += (bcdiv($totalPago, '1', 2) - $descuento);    
							}
						@endphp
                        <tr>
							<td>Subtotal:</td>
							<input type="text" style="visibility: hidden;" value="{{ $pagos->sum('valor_cancelar') }}" name="subtotal">                            
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
						</tr>
						<input type="text" style="visibility: hidden;" value="{{ $descuentoTotal }}" name="descuentoTotal">
						<tr>
							<td>Total: </td>
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
							<input type="text" style="visibility: hidden;" value="{{ bcdiv($descuentoTotal, '1', 2) }}" name="total" id="total">
							<input type="text" style="visibility: hidden;" value="{{ bcdiv($descuentoTotal, '1', 2) }}" name="valor_pagar" id="valor_pagar">
						</tr>
						<tr>
							<td>Total a pagar: </td>
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
							<input type="text" style="visibility: hidden;" value="{{ bcdiv($descuentoTotal, '1', 2) }}" name="valor_pagar" id="valor_pagar">
						</tr>
						<tr>
							<td>Valores adicionales de la pasarela de pago: </td>
							<td>{{ bcdiv($descuentoTotal-$abonos->sum('cantidad'), '1', 2) }}</td>
							<input type="text" style="visibility: hidden;" value="{{ bcdiv($descuentoTotal, '1', 2) }}" name="valor_pagar" id="valor_pagar">
						</tr>
						</thead>
						
                        <input type="hidden" name="tipo_pago" value="TARJETACREDITO">
      					<input type="hidden" name="banco" value="">
      					<input type="hidden" name="numero_descripcion" value="">
      					<input type="hidden" name="nombre_tarjeta" value="">
                    </table>
                    @foreach ($pagos_detalle as $pd_el)
						<input type="hidden" value="{{ $pd_el->id }}" name="idPagoDetalle[]">
					@endforeach
                </div>
            </div>

			</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> modal de pagos kushki cierra-->
@endsection
@section('scripts')
@if($user->cargo=='Representante')
<script type="text/javascript">
	/*function validarPEL(){
	//var ced=document.getElementById('cedula_ruc').value;
	var ced=document.getElementById('cedula_ruc').value;
	var nom=document.getElementById('nombres2').value;
	var ape=document.getElementById('apellidos2').value;
	var dir=document.getElementById('direccion2').value;
	var tel=document.getElementById('telefono2').value;
	var ema=document.getElementById('email2').value;
	if ( nom !='' && ape!='' && dir!='' && tel!='' && ema!='' && ced!='') {
		document.getElementById('datosCliente2').innerHTML = ''
		document.getElementById('datosEstudiante2').innerHTML = ''
		const datosCliente2 = document.getElementById('datosCliente2')
			datosCliente2.appendChild(contentInput('cedula_ruc2'))
			datosCliente2.appendChild(contentInput('nombres2', 'apellidos2'))
			datosCliente2.appendChild(contentInput('email2'))
		const datosEstudiante2 = document.getElementById('datosEstudiante2')
			datosEstudiante2.appendChild(contentInput('estudianteNombres'))
			datosEstudiante2.appendChild(contentInput('estudianteCurso'))
		$('#PEL').modal('show');

	}else{return alert('Por favor, llena todos los campos');}
	}*/
	$( document ).ready(function() {

	$("#cedula_ruc").change(function(){
	document.getElementById('cedula_ruc2').value = $('#cedula_ruc').val();
	});
	$("#nombres").change(function(){
	document.getElementById('nombres2').value = $('#nombres').val();
	});
	$("#apellidos").change(function(){
	document.getElementById('apellidos2').value = $('#apellidos').val();
	});
	$("#direccion").change(function(){
	document.getElementById('direccion2').value = $('#direccion').val();
	});
	$("#telefono").change(function(){
	document.getElementById('telefono2').value = $('#telefono').val();
	});
	$("#email").change(function(){
	document.getElementById('email2').value = $('#email').val();
	});


/* kusky///
     var kushki = new KushkiCheckout({
        form: "pagoEnLinea",
        merchant_id: "fc804215c7cf4fb4879e6009b18b4bab",
        amount: $('#total').val(),
        currency: "USD",
      	payment_methods:["credit-card"], // Payment Methods enabled
      	inTestEnvironment: true, 
      	regional:false // Optional
      	});*/
    }); 
</script>
<script type="text/javascript">
	function mostraModal(){
		if( $('#terminosCondiciones').prop('checked') ) {
    $('#mostrarKushki').show();
	}else{
		$('#mostrarKushki').hide();
	}
	}
	function mostraModal(){
		if( $('#terminosCondiciones').prop('checked') ) {
    $('#mostrarDF').show();
	}else{
		$('#mostrarDF').hide();
	}
	}
</script>

@else	<script type="text/javascript">
	var realizar_pago = document.getElementById('btn-realizar_pago')
	realizar_pago.addEventListener('click', function() {
		document.getElementById('datosCliente').innerHTML = ''
		document.getElementById('datosEstudiante').innerHTML = ''
		const datosCliente = document.getElementById('datosCliente')
			datosCliente.appendChild(contentInput('cedula_ruc'))
			datosCliente.appendChild(contentInput('nombres', 'apellidos'))
			datosCliente.appendChild(contentInput('email'))
		const datosEstudiante = document.getElementById('datosEstudiante')
			datosEstudiante.appendChild(contentInput('estudianteNombres'))
			datosEstudiante.appendChild(contentInput('estudianteCurso'))
			
	});
</script>
@endif
<script>
	// Permite llamar a un elemento de forma mas rapida
	function getValue(id) {
		return document.getElementById(id).value
	}
	function eliminartarjetas() {
		Swal.fire({
			title: "Realmente desea eliminar las tarjetas asociadas",		
			showCancelButton: true,

			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si',
			cancelButtonText: 'No'
			}).then((result) => {
					if (result.value==true) {
						var id_Cliente= $('#idCliente').val();
						$.ajax({
						type: "GET",
						url: "/pagos/Eliminar_tarjetas/"+ id_Cliente,
						success: function (response) {
						location. reload();
						}, error: function() {
						console.log('Sucedio error al eliminar')
						}
    					});
					}
				});
	
	}

	// Cuando el usuario va a realizar el pago desde el modal
	function modalRealizarPago() {
		let nombres = getValue('nombres')
		let apellidos = getValue('apellidos')
		let telefono = getValue('telefono')
		let direccion = getValue('direccion')
		let email = getValue('email')
		let valor = getValue('valor_pagar')
		if (!nombres || !apellidos || !telefono || !direccion || !email || !valor) {
			return alert('Por favor, llena todos los campos')
		}
        document.getElementById('buttonModal__button-realziar-pago').setAttribute('disabled', true)
        document.getElementById('buttonModal__button-realziar-pago').textContent = 'Realizando pago.....'
		document.getElementById('guardarFactura').submit()
	}

	function contentInput(idInput, idInput2) {
		var li = document.createElement('li')
			li.textContent = idInput2 ? getValue(idInput)+' '+getValue(idInput2) : getValue(idInput)
		return li
	}
	// Cuando haga click en realizar pago, los datos se llamaran para que salgan en el modal


    $('#btnBuscarCliente').click( function (e) {
    	@if($user->cargo=='Representante')
		{
		document.getElementById('cedula_ruc').value = '';
		document.getElementById('nombres2').value= '';
		document.getElementById('apellidos2').value= '';
		document.getElementById('direccion2').value= '';
		document.getElementById('telefono2').value= '';
		document.getElementById('email2').value= '';
		}
    	@endif
    	
        let ced = $('#cedula_ruc').val()
        $.ajax({
            url: "{{ route('urlGetCliente') }}" + "/"+ ced,
            type: "GET",
            success: function (result, status, xhr) {
               //console.log(result)
               $('#nombres').val(result.nombres)
               $('#apellidos').val(result.apellidos)
               $('#telefono').val(result.telefono)
               $('#email').val(result.correo)
               $('#direccion').val(result.direccion)
            }, error: function (xhr, status, error) {
             alert('cedula no encontrada')
            }
        });
    })
	
    $('#tipo_pago').change(function (e) {
        $('#trBanco').removeClass('ocultarPagos')
        $('#trTarjeta').removeClass('ocultarPagos')
        $('#trDescripcion').removeClass('ocultarPagos')
        switch($(this).val()) {
            case "CHEQUE":
                $('#trTarjeta').addClass('ocultarPagos')
            break;
            case "TARJETA":
            break;
            case "EFECTIVO":
                $('#trBanco').addClass('ocultarPagos')
                $('#trTarjeta').addClass('ocultarPagos')
                $('#trDescripcion').addClass('ocultarPagos')
            break;
            case "DEPOSITO":
				$('#trTarjeta').addClass('ocultarPagos')
				$('#trDescripcion').addClass('ocultarPagos')
				$('#trBanco').addClass('ocultarPagos')
            break;
        
        }
    });
  
</script>
<script type="text/javascript">

var wpwlOptions = { 
     onReady: function() {   


		var BotonEliminarTarjetas = '<div class="wpwl-wrapper wpwl-wrapper-submit">'+'<div class="wpwl-wrapper wpwl-wrapper-submit">'+'<input type="button" onclick="eliminartarjetas();"class="btn btn-warning" value="Eliminar Tarjetas">'+'</div>';
     	$('form.wpwl-form-registrations').find('.wpwl-wrapper-submit').before(BotonEliminarTarjetas);

		var createRegistrationHtml = '<div class="customLabel">Desea Guardar de manera segura sus datos?</div>'+'<div class ="customInput"><input type="checkbox" name="createRegistration"/></div>';
     	$('form.wpwl-form-card').find('.wpwl-wrapper-submit').before(createRegistrationHtml);




     		 
            var numberOfInstallmentsHtml = '<div class="wpwl-label wpwl-label-custom" style="display:inline-block">Diferidos:</div>' + 
              '<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">'  + 
              '<select id="selector" onchange="nuevo()" name="recurring.numberOfInstallments"><option value="0">0</option><option value="3">3</option>'+'</div>';  
            $('form.wpwl-form-card').find('.wpwl-button').before(numberOfInstallmentsHtml);    
            var frecuente = '<div class="wpwl-label wpwl-label-custom" style="display:inline-block">Intereses:</div>' + 
              '<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">' + 
              '<select name="customParameters[SHOPPER_interes]"><option value="0">No</option></select>' + 
              '</div>';  
            $('form.wpwl-form-card').find('.wpwl-button').before(frecuente);  
            var gracia = '<div class="wpwl-label wpwl-label-custom" style="display:inline-block">Meses de Gracia:</div>' + 
              '<div class="wpwl-wrapper wpwl-wrapper-custom" style="display:inline-block">' + 
              '<select name="customParameters[SHOPPER_gracia]"><option value="0">No</option></select>' + 
              '</div>';  
            $('form.wpwl-form-card').find('.wpwl-button').before(gracia);
          },
          style: "card",
          locale: "es",        
          labels:{cvv:"codigo de verificación", cardHolder:"Nombre(igual que en la tarjeta)"},
          registrations:{
          	requireCvv: true,
          	hideInitialPaymentForms:true
          }

      }
      function nuevo(){
      	if($('#selector').val()!=0){
		Swal.fire({
			title: "CONDICIONES DE DIFERIDOS SEGUN BANCOS",
			html: "MASTERCARD, NO PUEDE ACEPTAR DIFERIDOS DE:<li>MASTERCARD BANKCARD</li><li>MASTERCARD PRODUBANCO</li><li>MASTERCARD BANCO INTERNACIONAL</li><li>MASTERCARD BANCO DEL AUSTRO</li><Br>VISAS, NO PUEDE ACEPTAR DIFERIDOS DE:<li>VISA BANKCARD</li><li>VISA BANCO INTERNACIONAL</li><li>VISA BANCO AMAZONAS</li><li>VISA BANCO DE MACHALA</li><li>VISA BANCO DEL AUSTRO</li><li>VISA MUTUALISTA DE AZUAY</li>",
			showCancelButton: true,

			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Cancelar',
			cancelButtonText: 'Continuar'
			}).then((result) => {
					if (result.value==true) {
					$('#selector').val(0);
					//alert('cancelo');
					}
				}).catch(() => {
				
                })
		}
	}
      </script>
 

@endsection