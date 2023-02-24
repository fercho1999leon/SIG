@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
@php
	use App\Rubro;
	use App\Course;
	use App\Student2Profile;
    use App\Permiso;
    $permiso = Permiso::desbloqueo('pagosGeneral');
    $p=0;
    $s=0;
@endphp
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">

            <div class="col-xs-12 titulo-separacion2">
				<h2 class="title-page">Pagos</h2>
				<div>
				</div>
					@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
                        @include('partials.pagos.reporteDiario')
                        @include('partials.pagos.reporteCuentasPorCobrar')
                        @include('partials.pagos.reporteCuentasPorCobrarExcel')
                        @include('partials.pagos.reporteDocumentosCobro')
                        @include('partials.pagos.estudianteConBecas100')
                        @include('partials.pagos.reporteDiarioGeneral')
                        @include('partials.pagos.reporteEnvioMensajesExcel')
                        @include('partials.pagos.ReporteInsumo')
                        @include('partials.pagos.facturasCobradasExcel')
					@endif
			</div>
        </div>
        <div class="row mt-1 mb350">
			<div class="col-lg-12">
				<div class="tabs-container">
					<ul class="nav nav-tabs">					
						<li class="active">
							<a data-toggle="tab" href="#tab-2">Pagos</a>
						</li>					
					</ul>
					<div class="tab-content">						
						<div id="tab-2" class="tab-pane active">
							<div class=" bg-none">
								@foreach ($coursesAll->groupBy('grado') as $key => $courses)
									<div class="typeOfCourse">
										<h3 class="a-btn__cursos">{{$key}}</h3>
										<div class="gradosCalificaciones-grid">
											@foreach ($courses as $course)
												<div class="gradosCalificaciones-item">
													<div class="gradosCalificaciones-curso">
														<a class="m-0" href="{{ route('pagosCurso', $course->id) }}">
															<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt="">
															{{$course->grado}} {{$course->especializacion}} {{$course->paralelo}}
														</a>
													</div>
													@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
													<div>
                                                        <a href="{{ route('pagosPorCursoDetallado', $course->id) }}" class="pinedTooltip mr-05" target="_blank">
															<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
															<span class="pinedTooltipH">Pagos Acumulados</span>
														</a>
														<a href="{{ route('pagosPorCurso', $course->id) }}" class="pinedTooltip mr-05" target="_blank">
															<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
															<span class="pinedTooltipH">Pagos</span>
														</a>
														<a href="{{route('avisoVencimientoPorCurso', $course)}}" class="pinedTooltip mr-05" target="_blank">
															<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
															<span class="pinedTooltipH">Aviso de Vencimiento</span>
														</a>
														<a href="{{route('reporteEstudiantesBecaCurso', $course)}}" class="pinedTooltip mr-05" target="_blank">
															<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
															<span class="pinedTooltipH">Reporte de estudiantes con beca</span>
														</a>
														<a href="{{route('reporteDeudaCurso', $course)}}" class="pinedTooltip mr-05" target="_blank">
															<img src="{{secure_asset('img/file-download.svg')}}" width="17" alt="">
															<span class="pinedTooltipH">Reporte deuda estudiantes excel</span>
														</a>
													</div>
													@endif
												</div>
											@endforeach
										</div>
									</div>
								@endforeach
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="estudiantesConBeca_Descuento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Estudiantes con becas o descuentos de 100%</h4>
				</div>
				<div class="modal-body">
					<form action="{{route('storeEstudianteBecas100')}}" method="POST">
						{{ csrf_field() }}
						<div class="flex justify-content-between">
							<h4>Seleccione los pagos a realizar.</h4>
							<h4 class="flex align-items-center mr-2">
								<label for="inputPagosAll" class="pointer mr-2">SELECCIONAR TODOS</label> <input class="mt-0" type="checkbox" id="inputPagosAll">
							</h4>
						</div>
						<table class="table s-calificaciones">
							<tr class="table__bgBlue">
								<td width="5">
								</td>
								<td class="text-center">Estudiantes</td>
							</tr>
							@foreach ($becasDescuentos as $beca100)
								@php
								$s=0;
								@endphp
								@foreach ($beca100->student as $beca)
									@php
									$p = count($beca100->student);
									$c=0;
									$e=0;
									foreach ($beca->student->pagos as $pago) {
										if($pago->pago->tipo == '4' || $pago->pago->tipo == 'Pension') {
											$c++;
											if ($pago->estado != 'PENDIENTE') {
												$e++;
											} else {
												$estudianteConPagosPendientes = false;//pendiente
											}
										}
									}
									if ($c=$e){
										$estudianteConPagosPendientes = true;//pagado
										$s++;
									}
									$profileyear= Student2Profile::where('idStudent',$beca->student->id)->get()->first();
									$curso = Course::where('id',$profileyear->idCurso)->get()->first();
									@endphp
									@if ($estudianteConPagosPendientes != true)
										<tr>
											<td>
												<input type="checkbox" name="idStudents[{{$beca->student->id}}]"class="checkboxBecados" id="beca{{$beca->id}}">
											</td>
											<td>
												<label class="pointer mb-0 w100 flex justify-content-between" for="beca{{$beca->id}}">
													{{$beca->student->apellidos}} {{$beca->student->nombres}}
													<a href="{{route('matriculaEditar', [$beca->student->id, $institution->periodoLectivo] )}}">
														<i class="fa fa-pencil a-fa-pencil__matricula text-3xl" ></i>
													</a>
												</label>
												<span class="text-xl text-grey-dark">{{$curso->grado}} {{$curso->especializacion}} {{$curso->paralelo}}</span>
												{{-- <span class="text-xl text-grey-dark">{{$beca->student->curso}}</span> --}}
											</td>
										</tr>
									@endif
								@endforeach
								@if ($estudianteConPagosPendientes != false && $p==$s)
									<tr>
										<td class="bold" colspan="2">
											<h3 class="m-0">
												No existen pagos pendientes en estudiantes con beca del 100%.
											</h3>
										</td>
									</tr>
								@endif
							@endforeach
						</table>
						<div class="text-right">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							@if ($p != $s)
								<button type="submit" class="btn btn-primary">Realizar Pagos</button>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		// select reportes
		const ReporteDiario = document.getElementById('reporteDiario')
		const ReporteDiarioGeneral = document.getElementById('reporteDiarioGeneral')
		const ReporteCuentasPorCobrar = document.getElementById('reporteCuentasPorCobrar')
        const ReporteCuentasPorCobrarExcel = document.getElementById('reporteCuentasPorCobrarExcel')
		const ReporteDocumentoCobro = document.getElementById('reporteDocumentoCobro')
		const EstudiantesBecados = document.getElementById('reporteEstudiantesBecados')
		const EnvioMensajesExcel = document.getElementById('reporteEnvioMensajesExcel')
        const ExcelReporteInsumo = document.getElementById('ReporteInsumo')
        const facturasCobradasExcel = document.getElementById('facturasCobradasExcel')

		const selectReportes = document.querySelectorAll('.selectReportes')
		selectReportes.forEach(select => {
			select.addEventListener('change', function() {
				if(select.value == 'cuentasPorCobrar') {
					ReporteCuentasPorCobrar.style.display = 'grid'
                    ReporteCuentasPorCobrarExcel.style.display = 'none'
					ReporteDiario.style.display = 'none'
					ReporteDiarioGeneral.style.display = 'none'
					ReporteDocumentoCobro.style.display = 'none'
					EstudiantesBecados.style.display = 'none'
					EnvioMensajesExcel.style.display = 'none'
                    ExcelReporteInsumo.style.display = 'none'
                    facturasCobradasExcel.style.display = 'none'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				} else if(select.value == 'cuentasPorCobrarExcel') {
					ReporteCuentasPorCobrar.style.display = 'none'
                    ReporteCuentasPorCobrarExcel.style.display = 'grid'
					ReporteDiario.style.display = 'none'
					ReporteDiarioGeneral.style.display = 'none'
					ReporteDocumentoCobro.style.display = 'none'
					EstudiantesBecados.style.display = 'none'
					EnvioMensajesExcel.style.display = 'none'
                    ExcelReporteInsumo.style.display = 'none'
                    facturasCobradasExcel.style.display = 'none'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				} else if(select.value == 'reporteDiario') {
					ReporteDiario.style.display = 'grid'
					ReporteDiarioGeneral.style.display = 'none'
					ReporteCuentasPorCobrar.style.display = 'none'
                    ReporteCuentasPorCobrarExcel.style.display = 'none'
					ReporteDocumentoCobro.style.display = 'none'
					EstudiantesBecados.style.display = 'none'
					EnvioMensajesExcel.style.display = 'none'
                    ExcelReporteInsumo.style.display = 'none'
                    facturasCobradasExcel.style.display = 'none'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				} else if(select.value == 'reporteDiarioGeneral') {
					ReporteDiario.style.display = 'none'
					ReporteDiarioGeneral.style.display = 'grid'
					ReporteCuentasPorCobrar.style.display = 'none'
                    ReporteCuentasPorCobrarExcel.style.display = 'none'
					ReporteDocumentoCobro.style.display = 'none'
					EstudiantesBecados.style.display = 'none'
					EnvioMensajesExcel.style.display = 'none'
                    ExcelReporteInsumo.style.display = 'none'
                    facturasCobradasExcel.style.display = 'none'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				} else if(select.value == 'documentosCobro') {
					ReporteDocumentoCobro.style.display = 'grid'
					ReporteDiario.style.display = 'none'
					ReporteDiarioGeneral.style.display = 'none'
					ReporteCuentasPorCobrar.style.display = 'none'
                    ReporteCuentasPorCobrarExcel.style.display = 'none'
					EstudiantesBecados.style.display = 'none'
					EnvioMensajesExcel.style.display = 'none'
                    ExcelReporteInsumo.style.display = 'none'
                    facturasCobradasExcel.style.display = 'none'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				} else if(select.value == 'descuentos100') {
					ReporteDocumentoCobro.style.display = 'none'
					ReporteDiario.style.display = 'none'
					ReporteDiarioGeneral.style.display = 'none'
					ReporteCuentasPorCobrar.style.display = 'none'
                    ReporteCuentasPorCobrarExcel.style.display = 'none'
					EstudiantesBecados.style.display = 'grid'
					EnvioMensajesExcel.style.display = 'none'
                    ExcelReporteInsumo.style.display = 'none'
                    facturasCobradasExcel.style.display = 'none'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				}else if(select.value == 'reporteEnvioMensajesExcel') {
					ReporteDocumentoCobro.style.display = 'none'
					ReporteDiario.style.display = 'none'
					ReporteDiarioGeneral.style.display = 'none'
					ReporteCuentasPorCobrar.style.display = 'none'
                    ReporteCuentasPorCobrarExcel.style.display = 'none'
					EstudiantesBecados.style.display = 'none'
					EnvioMensajesExcel.style.display = 'grid'
                    ExcelReporteInsumo.style.display = 'none'
                    facturasCobradasExcel.style.display = 'none'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				}else if(select.value == 'ReporteInsumo') {
					ReporteDocumentoCobro.style.display = 'none'
					ReporteDiario.style.display = 'none'
					ReporteDiarioGeneral.style.display = 'none'
					ReporteCuentasPorCobrar.style.display = 'none'
                    ReporteCuentasPorCobrarExcel.style.display = 'none'
					EstudiantesBecados.style.display = 'none'
					EnvioMensajesExcel.style.display = 'none'
                    ExcelReporteInsumo.style.display = 'grid'
                    facturasCobradasExcel.style.display = 'none'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				}else if(select.value == 'facturasCobradasExcel') {
					ReporteDocumentoCobro.style.display = 'none'
					ReporteDiario.style.display = 'none'
					ReporteDiarioGeneral.style.display = 'none'
					ReporteCuentasPorCobrar.style.display = 'none'
                    ReporteCuentasPorCobrarExcel.style.display = 'none'
					EstudiantesBecados.style.display = 'none'
					EnvioMensajesExcel.style.display = 'none'
                    ExcelReporteInsumo.style.display = 'none'
                    facturasCobradasExcel.style.display = 'grid'
					let optionId = select.getAttribute('data-optionid')
					select.selectedIndex = optionId
				}
			})
		});

		// reporte estudiantes becados
		const inputPagoMes = document.querySelectorAll('.checkboxBecados')
		const inputPagosTodos = document.getElementById('inputPagosAll');
		if(inputPagoMes && inputPagosTodos) {
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
	</script>
@endsection