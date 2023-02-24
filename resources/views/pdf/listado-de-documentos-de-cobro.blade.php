@php
	use App\Student2;
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ secure_asset('css/pdf/pdf.css') }}">
	<title>Listado de documentos por cobro</title>
</head>
<style>
.table th,
.table td {
	font-size: 12pt !important;
}
</style>
<body>
	<table class="table">
		<thead>
			<tr>
				<th colspan="8" style="vertical-align:top;" class="no-border" width="20%">
					<div class="header__logo" style="text-align:left">
						<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
					</div>
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">Año Lectivo: {{ App\PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo) }}</h3>
						<h3 class="up">Listado de documentos de Cobro</h3>
					</div>
				</th>
			</tr>
		</thead>
		<tr>
			<td colspan="2" class="no-border">Desde: {{$fechaInicio}}</td>
			<td colspan="2" class="no-border">Hasta: {{$fechaFin}}</td>
			<td colspan="2" class="no-border">Fecha: {{$fechaActual}}</td>
		</tr>
		<tr>
			<td class="text-center">No. Doc.</td>
			<td class="text-center">Fecha</td>
			<td class="text-center">Cliente</td>
			<td class="text-center">Subtotal</td>
			<td class="text-center">Total</td>
			<td class="text-center">Estudiante</td>
			<td class="text-center">Curso</td>
			<td class="text-center">Usuario</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center">
                {{$total}}
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
		@foreach ($facturas as $factura)
			@if ( $ver[$factura->id] == true && $factura->estatus !== 'BAJA' && count($factura->facturaDetalle) > 0 )
				@php
					$student = Student2::find($factura->facturaDetalle->first()->idEstudiante);
				@endphp
				<tr>
					<td style="display:none">{{$i++}}</td>
					<td width="1%" class="text-center">
						{{$factura->numeroFactura}}
					</td>
					<td class="text-center">
						@php
							$fecha_dia = Carbon\Carbon::createFromDate(substr($factura->created_at,0,4), substr($factura->created_at,5,2), substr($factura->created_at,8,2))->day;
							$fecha_mes = Carbon\Carbon::createFromDate(substr($factura->created_at,0,4), substr($factura->created_at,5,2), substr($factura->created_at,8,2))->month;
							$fecha_anio = Carbon\Carbon::createFromDate(substr($factura->created_at,0,4), substr($factura->created_at,5,2), substr($factura->created_at,8,2))->year;
						@endphp
						{{$fecha_dia}}/{{App\Fechas::obtenerMes($fecha_mes)}}/{{$fecha_anio}}
					</td>
					<td>{{$factura->cliente->apellidos}} {{$factura->cliente->nombres}} </td>
					<td class="text-center">{{$factura->subtotal}}</td>
					<td class="text-center">{{$factura->total}}</td>
					
					<td>
						{{$student->apellidos}} {{$student->nombres}}
					</td> 
					<td>
						{{$student->profilePerYear->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first()->course->grado}} 
						{{$student->profilePerYear->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first()->course->especializacion}} 
						{{$student->profilePerYear->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first()->course->paralelo}}
					</td>
					<td>{{$factura->user->apellidos}} {{$factura->user->nombres}}</td>
				</tr>					
			@endif
		@endforeach
	</table>
	<div style="page-break-after:always;"></div>
	<table class="table">
		<thead>
			<tr>
				<th colspan="8" style="vertical-align:top;" class="no-border" width="20%">
					<div class="header__logo" style="text-align:left">
						<img @if(DB::table('institution')->where('id', '1')->first()->logo == null)src="{{ secure_asset('img/logo/logo.png') }}" @else src="{{ secure_asset('/storage/logo/'.DB::table('institution')->where('id', '1')->first()->logo) }}"                                  @endif width="70" alt="" >
					</div>
					<div class="header__info text-center">
						<h3>{{ $institution->nombre }}</h3>
						<h3 class="up">Año Lectivo: {{ App\PeriodoLectivo::getPeriodo(Sentinel::getUser()->idPeriodoLectivo) }}  </h3>
						<h3 class="up">
							Listado de documentos de Cobro
						</h3>
					</div>
				</th>
			</tr>
		</thead>
		<tr>
			<td colspan="2" class="no-border">Desde: {{$fechaInicio}}</td>
			<td colspan="2" class="no-border">Hasta: {{$fechaFin}}</td>
			<td colspan="2" class="no-border">Fecha: {{$fechaActual}}</td>
		</tr>
		<tr>
			<td class="text-center">No. Doc.</td>
			<td class="text-center">Fecha</td>
			<td class="text-center">Cliente</td>
			<td class="text-center">Subtotal</td>
			<td class="text-center">Total</td>
			<td class="text-center">Estudiante</td>
			<td class="text-center">Curso</td>
			<td class="text-center">Usuario</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center">
                {{$totalAbonos}}
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
		@foreach ($abonosF as $abon)
			@if ($abon->estatus !== 'BAJA' && count($abon->facturaDetalle) > 0 )
				@php
					$student = Student2::find($abon->facturaDetalle->first()->idEstudiante);				
				@endphp
				<tr>
					<td style="display:none">{{$i++}}</td>
					<td  width="1%" class="text-center">{{$abon->numeroFactura}}</td>
					<td class="text-center">
						@php
							$fecha_dia = Carbon\Carbon::createFromDate(substr($abon->created_at,0,4), substr($abon->created_at,5,2), substr($abon->created_at,8,2))->day;
							$fecha_mes = Carbon\Carbon::createFromDate(substr($abon->created_at,0,4), substr($abon->created_at,5,2), substr($abon->created_at,8,2))->month;
							$fecha_anio = Carbon\Carbon::createFromDate(substr($abon->created_at,0,4), substr($abon->created_at,5,2), substr($abon->created_at,8,2))->year;
						@endphp
						{{$fecha_dia}}/{{ App\Fechas::obtenerMes($fecha_mes)}}/{{$fecha_anio}}
					</td>
					<td>{{$abon->cliente->apellidos}} {{$abon->cliente->nombres}}</td>
					<td class="text-center">{{$abon->total}}</td>
					<td class="text-center">{{$abon->abonos->sum('cantidad')}}</td>
					<td>{{$student->apellidos}} {{$student->nombres}}</td> 
					<td>
						{{$student->profilePerYear->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first()->course->grado}} 
                        {{$student->profilePerYear->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first()->course->especializacion}} 
                        {{$student->profilePerYear->where('idPeriodo', Sentinel::getUser()->idPeriodoLectivo)->first()->course->paralelo}}
					</td>
					<td>{{$abon->user->apellidos}} {{$abon->user->nombres}}</td>
				</tr>					
			@endif
		@endforeach
	</table>
</body>
</html>