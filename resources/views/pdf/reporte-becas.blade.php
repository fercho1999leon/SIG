@php
	use App\PagoEstudianteDetalle;
	use App\Rubro;
	use App\Payment;
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte de cobros</title>
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">

</head>
<style>
	.table td,
	.table th {
		font-size: 8pt !important;
	}
	.reporteBeca__imprimir {
		position: absolute;
		right: 5px;
		background: black;
		color: white;
		border: none;
		padding: 5px 10px;
		border-radius: 4px;
		text-transform: uppercase;
		cursor:pointer;
	}
	@media print {
		.reporteBeca__imprimir {
			display: none;
		}
	}
</style>
<body class="relative">
	
	<button class="btn btn-black reporteBeca__imprimir" id="reporteBeca__imprimir">
		Imprimir reporte
	</button>
	<table class="table">
		<thead>
			<tr>
				<th colspan="13">
					<div class="actaCalificaciones__titulo">
						<p class="text-center uppercase bold mb-05"> {{$institution->nombre}} </p>
						<p class="text-center uppercase bold mb-05">lista de estudiantes con becas de pensión</p>
						<p class="text-center uppercase bold mb-05">año lectivo: {{ $periodo->nombre }}</p>
					</div>
				</th>
			</tr>
			<tr class="uppercase">
				<td colspan="13" class="no-border">fecha: {{$now->format('d/m/Y')}} </td>
			</tr>
			<tr>
				<td rowspan="2" class="text-center">No.</td>
				<td rowspan="2" colspan="2" class="text-center">Nombre</td>
				<td colspan="4" class="text-center">Matricula</td>
				<td colspan="4" class="text-center">Pensiones</td>
				<td rowspan="2" class="text-center">Total Dscto</td>
				<td rowspan="2" class="text-center">Total Paga</td>
			</tr>
			<tr>
				<td class="text-center">Valor Total</td>
				<td class="text-center">%Beca</td>
				<td class="text-center">Valor Total Dscto</td>
				<td class="text-center">Valor Total Paga</td>
				<td class="text-center">Valor Total Sin Becas</td>
				<td class="text-center">% Becas</td>
				<td class="text-center">Valor Total Dscto</td>
				<td class="text-center">Valor Total Paga</td>
			</tr>
		</thead>
		@php
			$i=1;

			$suma_matricula=0;
			$suma_pago_pensiones=0;
			$suma_descuento_pensiones=0;
			$suma_pago_total_pensiones=0;
			$suma_total_pagar=0;
		@endphp
		@foreach ($becas as $key => $beca)
			<tr class="bgDark reporteBeca__one">
				<td colspan="13" style="text-align: center">{{$beca->nombre}}</td>	
			</tr>
            @php
                $cEstudiantes =0;
				$contador_beca=1;
			@endphp
            @foreach($students as $student)
                @php
                    $curso = $courses->where('id' , $student->idCurso)->first();
                @endphp
				@if($beca->id==$student->idBeca)
					<tr>
						<td>{{$i++}}</td>
						<td colspan="2">{{$student->apellidos}} {{$student->nombres}} - {{ $curso->grado }} {{ $curso->especializacion }} {{ $curso->paralelo }}</td>
						<!-- En matrícula no se aplica becas-->
                        @php
                            $cEstudiantes++;
							$pagos = PagoEstudianteDetalle::getDetailPaymentsByStudent($student->id,$student->idCurso);
							$pays = Payment::getPaymentsByCourse($student->idCurso);
							$pago_matricula =Payment::where('idCurso', $student->idCurso)
											->where('tipo','Matricula')
											->get();
							$valor_matricula=0;
							foreach($pago_matricula as $p_m){
								$valor_matricula=$p_m->valor_cancelar;
							}
							$suma_matricula=bcdiv($suma_matricula+$valor_matricula,'1',2);
						@endphp
						<td>
							{{$valor_matricula}}
						</td>
						<td>0.00</td>
						<td>0.00</td>
						<td>
							{{$valor_matricula}}
						</td>

						<!-- En pensiones si aplica becas/descuento-->
						@php
							$pago_pensiones =Payment::where('idCurso', $student->idCurso)
											->where('tipo','Pension')
											->get();
							$pago_pension =Payment::where('idCurso', $student->idCurso)
											->where('tipo','Pension')
											->first();
							$pago_pension=0;
							$num=1;
							foreach($pago_pensiones as $p_p){
								$pago_pension=$p_p->valor_cancelar;
							}
							$pago_pension=bcdiv($pago_pension,'1',2);
							$contador_pensiones = 10;
							$pago_pensiones=bcdiv($pago_pension*$contador_pensiones,'1',2);
							if($beca->tipo_pago=='PORCENTAJE'){
								$descontar=($beca->valor/100);
							}
							$descuento_pago_pensiones=bcdiv($pago_pensiones*$descontar,'1',2); 
							$pago_total_pensiones=bcdiv($pago_pensiones-$descuento_pago_pensiones,'1',2);
							

							$suma_pago_pensiones=bcdiv($suma_pago_pensiones+$pago_pensiones,'1',2);
							$suma_descuento_pensiones=bcdiv($suma_descuento_pensiones+$descuento_pago_pensiones,'1',2); 
							$suma_pago_total_pensiones=bcdiv($suma_pago_total_pensiones+$pago_total_pensiones,'1',2);
						@endphp
						<td>
							{{$pago_pensiones}}
						</td>
						<td>
							@if($beca->tipo=='BECA')
								{{$beca->valor}}
								@if($beca->tipo_pago=='PORCENTAJE')		
								@else
									USD 
								@endif
							@endif	
							@if($beca->tipo=='DESCUENTO')
								{{$beca->valor}}
								@if($beca->tipo_pago=='PORCENTAJE')
									%
								@else
									USD 
								@endif
							@endif
						</td>
						<td>
							{{$descuento_pago_pensiones}}
						</td>
						<td>
							{{$pago_total_pensiones}}
						</td>
						<!-- Total Descuentos -->
						@php
							$total_descuentos=bcdiv($descuento_pago_pensiones,'1',2);
						@endphp
						<td>{{$total_descuentos}}</td>

						<!-- Total Pagar -->
						@php
							$total_pagar=bcdiv($valor_matricula+$pago_total_pensiones,'1',2);
							$suma_total_pagar=bcdiv($suma_total_pagar+$total_pagar,'1',2);
						@endphp
						<td>
							{{$total_pagar}}
						</td>
						
					</tr>
					@php
						$contador_beca++;
					@endphp
				@endif
			@endforeach

			@if($contador_beca>1)
				<tr>
                    <td style="text-align: center">{{$cEstudiantes}}</td>
					<td colspan="2" style="text-align: center">Suman</td>
					<td style="text-align: center">{{$suma_matricula}}</td>	
					<td colspan="2" style="text-align: center"></td>
					<td style="text-align: center">{{$suma_matricula}}</td>
					<td style="text-align: center">{{$suma_pago_pensiones}}</td>
					<td style="text-align: center"></td>
					<td style="text-align: center">{{$suma_descuento_pensiones}}</td>
					<td style="text-align: center">{{$suma_pago_total_pensiones}}</td>
					<td style="text-align: center">{{$suma_descuento_pensiones}}</td>
					<td style="text-align: center">{{$suma_total_pagar}}</td>
				</tr>
				@php
					$suma_matricula= 0;
					$suma_pago_pensiones=0;
					$suma_descuento_pensiones=0;
					$suma_pago_total_pensiones=0;
					$suma_total_pagar=0;
				@endphp
			@endif
			<tr>
				<td colspan="13" class="no-border" style="visibility:hidden">space</td>
			</tr>
			


		@endforeach
	</table>
	<script>
		let imprimir = document.getElementById('reporteBeca__imprimir');
		imprimir.addEventListener('click', function(e) {
			window.print()
		})
	</script>
</body>

</html>