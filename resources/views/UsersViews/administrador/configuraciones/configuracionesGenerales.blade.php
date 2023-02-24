@php
    $permiso = App\Permiso::desbloqueo('configuracionesGenerales');
@endphp
@extends('layouts.master')
@if ($permiso == null || ( $permiso != null && $permiso->ver == 1 ))
@section('content')
<a class="button-br" href="{{ route('configuraciones') }}">
	<button>
		<img src="img/return.png" alt="" width="17">Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<form action="{{ route('actualizarConfiguraciones') }}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="row wrapper white-bg ">
			<div class="col-lg-12">
				<h2 class="title-page">Configuraciones Generales
				</h2>
			</div>
		</div>
		<div class="wrapper">
			<div class="widget widget-tabs confGeneral__widget">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#tab-1" class="uppercase">administrativas</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-2" class="uppercase">docentes</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-3" class="uppercase">
								pagos/colecturía
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-5" class="uppercase">
								Materias
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-6" class="uppercase">
								Boletin <!--Libreta-->
							</a>
						</li>
						<!--<li>
							<a data-toggle="tab" href="#tab-7" class="uppercase">
								DHI
							</a>
						</li>-->
						<li>
							<a data-toggle="tab" href="#tab-8" class="uppercase">
								Certificados
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab-9" class="uppercase">
								Estudiante  <!--Representantes / Estudiantes-->
							</a>
                        </li>
                        <li>
							<a data-toggle="tab" href="#tab-10" class="uppercase">
								Admisiones
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="tab-1" class="tab-pane active">
							<div class="confGeneral__grid">
								<div class="confGeneral__item">
									<div></div>
									<div class="confGeneral__radio">
										<label for="">
											<p class="no-margin">Si</p>
										</label>
										<label for="">
											<p class="no-margin">No</p>
										</label>
									</div>
								</div>
								<!--<div class="confGeneral__item">
									<p class="no-margin">Activar modulo Transporte:</p>
									<div class="confGeneral__radio">
										<input type="radio" name="transporte" {{$transporte->valor == 1 ? 'checked' : ''}} value="1">
										<input type="radio" name="transporte" {{$transporte->valor == 0 ? 'checked' : ''}} value="0">
									</div>
								</div>-->
								<div class="confGeneral__item">
									<p class="no-margin">Activar modulo progreso formativo</p>
									<div class="confGeneral__radio">
										<input type="radio" name="progresoformativo" value="1" {{$progresoformativo->valor == '1' ? 'checked' : ''}} >
										<input type="radio" name="progresoformativo" value="0" {{$progresoformativo->valor == '0' ? 'checked' : ''}} >
									</div>
								</div>								
								<div class="confGeneral__item">
									<p class="no-margin">Activar modulo admisiones</p>
									<div class="confGeneral__radio">
										<input {{$activarAdmisiones->valor == '1' ? 'checked' : ''}} type="radio" name="activarAdmisiones" value="1">
										<input {{$activarAdmisiones->valor == '0' ? 'checked' : ''}} type="radio" name="activarAdmisiones" value="0">
									</div>
								</div>
								<!--<div class="confGeneral__item">
									<p class="no-margin">Activar enlace Aulas Virtuales</p>
									<div class="confGeneral__radio">
										<input {{$activarAulaVirtual->valor == '1' ? 'checked' : ''}} type="radio" name="activarAulaVirtual" value="1">
										<input {{$activarAulaVirtual->valor == '0' ? 'checked' : ''}} type="radio" name="activarAulaVirtual" value="0">
									</div>
								</div>-->

								<div class="confGeneral__item">
									<p class="no-margin">Calcular Promedio Por Insumo Activo</p>
									<div class="confGeneral__radio">
										<input {{$PromedioInsumo->valor == '1' ? 'checked' : ''}} type="radio" name="PromedioInsumo" id="PromedioInsumo" value="1">
										<input {{$PromedioInsumo->valor == '0' ? 'checked' : ''}} type="radio" name="PromedioInsumo" value="0">
									</div>
								</div>
								<div class="confGeneral__item">
									<p class="no-margin">Asignar Porcentaje por Insumo</p>
									<div class="confGeneral__radio">
										<input {{$InsumoPorcentual->valor == '1' ? 'checked' : ''}} type="radio" name="InsumoPorcentual" id='InsumoPorcentual_A' value="1">
										<input {{$InsumoPorcentual->valor == '0' ? 'checked' : ''}} type="radio" name="InsumoPorcentual" id='InsumoPorcentual_I' value="0">
									</div>
								</div>
								<!--<div class="confGeneral__item">
									<p class="no-margin">Promediar Comportamiento por Materias</p>
									<div class="confGeneral__radio">
										<input {{$PromedioComportamiento->valor == '1' ? 'checked' : ''}} type="radio" name="PromedioComportamiento" value="1">
										<input {{$PromedioComportamiento->valor == '0' ? 'checked' : ''}} type="radio" name="PromedioComportamiento" value="0">
									</div>
                                </div>-->
								<div class="confGeneral__item">
									<label for="">Contador de Matricula</label>
									<select class="form-control" name="contador_matricula" id="contador_matricula" {{ $contador_matricula->valor != '' ? 'disabled' : ''}} onchange="contadorMatricula()">
										<option value="" {{ $contador_matricula->valor == '' ? "selected" : "" }} disable>Seleccione...</option>
										<option value="G" {{ $contador_matricula->valor == 'G' ? "selected" : "" }}>General</option>
										<option value="S" {{ $contador_matricula->valor == 'S' ? "selected" : "" }}>Por Seccion</option>
									</select>
                                </div>
								<div class="confGeneral__item">
									<p class="no-margin">Asistencia</p>
									<select name="asistencia" class="form-control">
										<option {{$asistencia->valor == 'diaria' ? 'selected' : ''}} value="diaria">Diaria</option>
										<option {{$asistencia->valor == 'parcial' ? 'selected' : ''}} value="parcial">Parcial</option>
									</select>
								</div>
							</div>
						</div>
						<div id="tab-2" class="tab-pane">
							<div></div>
							<div class="confGeneral__item">
								<div></div>
								<div class="confGeneral__radio">
									<label for="">
										<p class="no-margin">Si</p>
									</label>
									<label for="">
										<p class="no-margin">No</p>
									</label>
								</div>
							</div>							
							<div class="confGeneral__item">
								<p class="no-margin">Edita Calificaciones</p>
								<div class="confGeneral__radio">
								@if($edita_calificaciones->valor == "1")
									<input type="radio" checked name="editaCalificaciones" value="1">
									<input type="radio" name="editaCalificaciones" value="0">
								@else
									<input type="radio" name="editaCalificaciones" value="1">
									<input type="radio" checked name="editaCalificaciones" value="0">
								@endif
								</div>
							</div>
							<div class="confGeneral__item">
								<p class="no-margin">Ingresa Evaluacion</p>
								<div class="confGeneral__radio">
								@if($ingresa_evaluacion->valor == "1")
									<input type="radio" checked name="ingresaEvaluacion" value="1">
									<input type="radio" name="ingresaEvaluacion" value="0">
								@else
									<input type="radio" name="ingresaEvaluacion" value="1">
									<input type="radio" checked name="ingresaEvaluacion" value="0">
								@endif
								</div>
							</div>
							<div class="confGeneral__item">
								<p class="no-margin">Ingresa Examen</p>
								<div class="confGeneral__radio">
								@if($ingresa_examen->valor == "1")
									<input type="radio" checked name="ingresaExamen" value="1">
									<input type="radio" name="ingresaExamen" value="0">
								@else
									<input type="radio" name="ingresaExamen" value="1">
									<input type="radio" checked name="ingresaExamen" value="0">
								@endif
								</div>
							</div>
							<div class="confGeneral__item">
								<p class="no-margin">Ingresa Recuperaciones</p>
								<div class="confGeneral__radio">
								@if($ingresa_recuperacion->valor == "1")
									<input type="radio" checked name="ingresaRecuperaciones" value="1">
									<input type="radio" name="ingresaRecuperaciones" value="0">
								@else
									<input type="radio" name="ingresaRecuperaciones" value="1">
									<input type="radio" checked name="ingresaRecuperaciones" value="0">
								@endif
								</div>
							</div>
							<div class="confGeneral__item">
									<p class="no-margin">Eliminar Actividades</p>
									<div class="confGeneral__radio">
										<input {{$DeleteActDocente->valor == '1' ? 'checked' : ''}} type="radio" name="DeleteActDocente" value="1">
										<input {{$DeleteActDocente->valor == '0' ? 'checked' : ''}} type="radio" name="DeleteActDocente" value="0">
									</div>
								</div>
						</div>
						<div id="tab-3" class="tab-pane">
							<div></div>
							<div class="confGeneral__item">
								<div></div>
								<div class="confGeneral__radio">
									<label for="">
										<p class="no-margin">Si</p>
									</label>
									<label for="">
										<p class="no-margin">No</p>
									</label>
								</div>
							</div>
							@if (session('user_data')->cargo === 'Financiero')
								<div class="confGeneral__item">
									<p class="no-margin">Habilitar asignación de becas/descuentos en el perfil Administrador</p>
									<div class="confGeneral__radio">
										<input type="radio" value="1" name="asignacionBecasAdm" {{$asignacionBecasAdm->valor == '1' ? 'checked' : ''}}>
										<input type="radio" value="0" name="asignacionBecasAdm" {{$asignacionBecasAdm->valor == '0' ? 'checked' : ''}}>
									</div>
								</div>
								<div class="confGeneral__item">
									<p class="no-margin">Habilitar asignación de becas/descuentos en el perfil Colecturía</p>
									<div class="confGeneral__radio">
										<input type="radio" value="1" name="asignacionBecasCol" {{$asignacionBecasCol->valor == '1' ? 'checked' : ''}}>
										<input type="radio" value="0" name="asignacionBecasCol" {{$asignacionBecasCol->valor == '0' ? 'checked' : ''}}>
									</div>
								</div>
								<div class="confGeneral__item">
									<p class="no-margin">Habilitar asignación de becas/descuentos en el perfil Secretaría</p>
									<div class="confGeneral__radio">
										<input type="radio" value="1" name="asignacionBecasSec" {{$asignacionBecasSec->valor == '1' ? 'checked' : ''}}>
										<input type="radio" value="0" name="asignacionBecasSec" {{$asignacionBecasSec->valor == '0' ? 'checked' : ''}}>
									</div>
								</div>
							@endif
							<div class="confGeneral__item">
								<p class="no-margin">Activar Pagos</p>
								<div class="confGeneral__radio">
									@if($activar_pagos->valor == "1")
										<input type="radio" checked name="activar_pagos" value="1">
										<input type="radio" name="activar_pagos" value="0">
									@else
										<input type="radio" name="activar_pagos" value="1">
										<input type="radio" checked name="activar_pagos" value="0">
									@endif
								</div>
							</div>
							<div class="confGeneral__item">
								<p class="no-margin">Activación de facturación electronica</p>
								<div class="confGeneral__radio">
									<input type="radio" {{$activacionFacturaEletctronica->valor === '1' ? 'checked' : ''}} name="activacionFacturaElectronica" value="1">
									<input type="radio" {{$activacionFacturaEletctronica->valor === '0' ? 'checked' : ''}} name="activacionFacturaElectronica" value="0">
								</div>
							</div>
							{{-- <div class="confGeneral__item">
                                <p class="no-margin">Activar Pago En Linea</p>
                                <div class="confGeneral__radio">
                                    <input {{$pagoEnLinea->valor == '1' ? 'checked' : ''}} type="radio" name="pagoEnLinea" value="1">
                                    <input {{$pagoEnLinea->valor == '0' ? 'checked' : ''}} type="radio" name="pagoEnLinea" value="0">
                                </div>
                            </div> --}}
							{{-- <div class="confGeneral__item">
								<p class="no-margin">Pago Adelantado</p>
								<div class="confGeneral__radio">
									<input type="radio" name="pago_adelantado" value="1" {{$pago_adelantado->valor === '1' ? 'checked' : ''}} {{$pago_adelantado->valor != '' ? 'disabled' : ''}} onclick="pagoAdelantado()">
									<input type="radio" name="pago_adelantado" value="0" {{$pago_adelantado->valor === '0' ? 'checked' : ''}} {{$pago_adelantado->valor != '' ? 'disabled' : ''}} onclick="pagoAdelantado()">
								</div>
							</div> --}}
							<div class="confGeneral__item">
								<p class="no-margin">Tipo de formato en la generación de facturas</p>
								<div class="confGeneral__radio">
									<select name="factura_formatos" id="factura_formatos" class="form-control" style="width:150px;">
										<option {{$confFormatoFacturas->valor == '0' ? 'selected' : ''}} value="0">Formato 1</option>
										<option {{$confFormatoFacturas->valor == '1' ? 'selected' : ''}} value="1">Formato 2</option>
                                        <option {{$confFormatoFacturas->valor == '2' ? 'selected' : ''}} value="2">Formato 2 doble</option>
                                        <option {{$confFormatoFacturas->valor == '3' ? 'selected' : ''}} value="3">Formato 2 sin encabezado</option>
                                        <option {{$confFormatoFacturas->valor == '4' ? 'selected' : ''}} value="4">Formato 3 doble</option>
									</select>
								</div>
							</div>
							<div class="confGeneral__item">
								<p class="no-margin">Día a bloquear Pago</p>
								<div class="confGeneral__radio">
									<select name="diaPago" id="diaPago" class="form-control" style="width:150px;">
										<option
											@if($dia_pago->valor == '0')
												selected
											@endif
											value="0">NINGUNO
										</option>
										@for ($i = 1; $i < 31; $i++)
											<option
											{{$dia_pago->valor == $i ? "selected" : ""}}
											value="{{ $i }}"
											>
											{{ $i }}
											</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="confGeneral__item">
								<p class="no-margin">Reiniciar contador facturación electronica</p>
								<div class="confGeneral__radio">
									<button onclick="mensajeContador()" id="reiniciarContador" type="button" class="btn btn-primary" {{$confContadorFactura->valor === '0' ? 'disabled' : ''}}>Reiniciar</button>
								</div>
							</div>
						</div>
						<div id="tab-5" class="tab-pane">
							<h3>Orden de insumos en Reportes</h3>
							<div class="configuracionesGenerales__insumos">
								<div class="configuracionesGenerales__insumos__numeros">
									@foreach($insumos as $insumo)
										<span>{{ $loop->iteration }}</span>
									@endforeach
								</div>
								<ul class="configuracionesGenerales__insumos-grid sortable">
									@foreach($insumos as $insumo)
										<li class="uppercase pointer">{{ $insumo->nombre }}</li>
									@endforeach
								</ul>
							</div>
							<input type="text" name="orden_insumos" value="{{ $orden_insumos->valor }}" style="visibility:hidden" id="insumosOrden">
							{{-- <h3>Niveles de Materias</h3>
							<div class="d-flex flex-column mb-12">
								<label for="area_materia">Materia</label>
								<select class="form-control" name="area_materia" id="ddlMateria">
									@foreach($materias as $key =>  $materia)
										<option value="{{ $key }}">{{ $key }}</option>
									@endforeach
								</select>
							</div>
							<div class="d-flex flex-column mb-12">
								<label for="nivel">Nivel</label>
								<input type="text" id="nivelMateria" name="nivel" class="form-control">
								<input type="text" id="nivelID" value="" name="nivelID" style="visibility: hidden;">
							</div> --}}
						</div>
						<div id="tab-6" class="tab-pane">
							<div class="confGeneral__grid">
                                <div></div>
								<div class="confGeneral__item">
									<div></div>
									<div class="confGeneral__radio">
										<label for="">
											<p class="no-margin">Si</p>
										</label>
										<label for="">
											<p class="no-margin">No</p>
										</label>
									</div>
								</div>
								<!--<div class="confGeneral__item ">
									<p class="no-margin">Nombre de representante en descargables:</p>
									<div class="confGeneral__radio">
										<input type="radio" name="libretaParcial" value="1" {{$nombre_representante_libreta_parcial->valor == '1' ? 'checked' : ''}}>
										<input type="radio" name="libretaParcial" value="0" {{$nombre_representante_libreta_parcial->valor == '0' ? 'checked' : ''}}>
									</div>
                                </div>-->	
                                <div class="confGeneral__item">
									<p class="no-margin">Notas menores a {{ $nota_menor->valor }} en rojo:</p>
									<div class="confGeneral__radio">
										@if($notas_menores->valor == "1")
											<input type="radio" checked name="notasMenores" value="1">
											<input type="radio" name="notasMenores" value="0">
										@else
											<input type="radio" name="notasMenores" value="1">
											<input type="radio" checked name="notasMenores" value="0">
										@endif
									</div>
								</div>
								<div class="confGeneral__item ">
									<p class="no-margin">Notas en Rojo menores de:</p>
									<div class="confGeneral__radi d-ibo">
										<select class="form-control" name="nota_menor" id="nota_menor" class="form-control">
											<option
											@if($nota_menor->valor == '7')
												selected
											@endif
											value="7">7</option>
											<option
											@if($nota_menor->valor == '6')
												selected
											@endif
											value="6">6</option>
											<option
											@if($nota_menor->valor == '5')
												selected
											@endif
											value="5">5</option>
											<option value="4"
											@if($nota_menor->valor == '4')
												selected
											@endif
											>4</option>
											<option
											@if($nota_menor->valor == '3')
												selected
											@endif
											value="3">3</option>
											<option
											@if($nota_menor->valor == '2')
												selected
											@endif
											value="2">2</option>
											<option
											@if($nota_menor->valor == '1')
												selected
											@endif
											value="1">1</option>
										</select>
									</div>
								</div>
								<div class="confGeneral__item ">
									<p class="no-margin">Formato Libreta:</p>
									<div class="confGeneral__radi d-ibo">
										<select class="form-control" name="tipo_libreta" id="tipo_libreta" class="form-control">
											<option
												@if($tipo_libreta == '0')
													selected
												@endif
											value="0">Formato 1
											</option>
											<option
												@if($tipo_libreta == '1')
													selected
												@endif
											value="1">Formato 2
											</option>
											<option
												@if($tipo_libreta == '2')
													selected
												@endif
											value="2">Formato 3 - (desarrollo)
											</option>

										</select>
									</div>
								</div>
								<div class="confGeneral__item ">
									<p class="no-margin">Nota minima a calificar:</p>
									<div class="confGeneral__radi d-ibo">
										<input class="form-control" type="number"
										min="0.01"
										step="0.01"
										max="7"
										name="nota_minima" value="{{$nota_minima->valor}}">
									</div>
                                </div>
								<div class="confGeneral__item ">
									<p class="no-margin">Comportamiento en Rojo a partir de:</p>
									<div class="confGeneral__radi d-ibo">
										<select name="comportamiento_menor" id="comportamiento_menor" class="form-control">
											<option value="Ninguno"
											@if($comportamiento_menor->valor == 'Ninguno')
												selected
											@endif
											>Ninguno</option>
											<option value="A"
											@if($comportamiento_menor->valor == 'A')
												selected
											@endif
											>A</option>
											<option value="B"
											@if($comportamiento_menor->valor == 'B')
												selected
											@endif
											>B</option>
											<option value="C"
											@if($comportamiento_menor->valor == 'C')
												selected
											@endif
											>C</option>
											<option value="D"
											@if($comportamiento_menor->valor == 'D')
												selected
											@endif
											>D</option>
											<option value="E"
											@if($comportamiento_menor->valor == 'E')
												selected
											@endif
											>E</option>
										</select>
									</div>
								</div>
								<div class="confGeneral__item ">
									<p class="no-margin" hidden>Ingreso de comportamiento Quimestral:</p>
									<div class="confGeneral__radi d-ibo">
										<select name="comportamientoQuimestral" class="form-control" style="visibility:hidden;">
											<option {{$comportamientoQuimestral->valor == 'crear' ? 'selected' : ''}} value="crear">Se registra comportamiento</option>
											<option {{$comportamientoQuimestral->valor == 'replicar' ? 'selected' : ''}} value="replicar">Se replica 3er Parcial</option>
										</select>
									</div>
								</div>
							</div>
						</div>			
						<div id="tab-7" class="tab-pane">
							<div class="confGeneral__grid">
								<div></div>
								<div class="confGeneral__item ">
									<p class="no-margin">Ingreso de notas</p>
									<div class="confGeneral__radi d-ibo">
										<select class="form-control" name="dhi">
											<option {{$dhi->valor == '' ? 'selected' : ''}} value="">Seleccione una opción...</option>
											<option {{$dhi->valor == 'QUIMESTRAL' ? 'selected' : ''}} value="QUIMESTRAL">Quimestral</option>
											<option {{$dhi->valor == 'PARCIAL' ? 'selected' : ''}} value="PARCIAL">Parcial</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div id="tab-8" class="tab-pane">
                            <div class="confGeneral__item ">
                                <p class="no-margin" hidden>N° de estudiantes en Cuadro de honor</p>
                                <div class="confGeneral__radi d-ibo">
                                        <input type="hidden" name="NroEstudiantesCH"  placeholder="" class="form-control" value="{{(int)$NroEstudiantesCH->valor}}" hidden>
                                </div>
                            </div>
							<div class="confGeneral__item ">
                                <p class="no-margin">Certificado de Matricula</p>
                                <div class="confGeneral__radi d-ibo">
                                    <select class="form-control" name="certificado_matricula">
                                        <option {{$certificado_matricula->valor == '0' ? 'selected' : ''}} value="">Seleccione una opción...</option>
                                        <option {{$certificado_matricula->valor == '1' ? 'selected' : ''}} value="1">Formato 1</option>
                                        <option {{$certificado_matricula->valor == '2' ? 'selected' : ''}} value="2">Formato 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="confGeneral__item ">
                                <p class="no-margin">Certificado de Asistencia</p>
                                <div class="confGeneral__radi d-ibo">
                                    <select class="form-control" name="CertAsistencia">
                                        <option {{$CertAsistencia->valor == '0' ? 'selected' : ''}} value="">Seleccione una opción...</option>
                                        <option {{$CertAsistencia->valor == '1' ? 'selected' : ''}} value="1">Formato 1</option>
                                        <option {{$CertAsistencia->valor == '2' ? 'selected' : ''}} value="2">Formato 2</option>
                                    </select>
                                </div>
							</div>
							<div class="confGeneral__item ">
                                <p class="no-margin" hidden>Certificado de Promocion</p>
                                <div class="confGeneral__radi d-ibo">
                                    <select class="form-control" name="CertPromocion" style="visibility:hidden;" >
                                        <option {{$certificado_promocion->valor == '0' ? 'selected' : ''}} value="0">Formato 1</option>
                                        <option {{$certificado_promocion->valor == '1' ? 'selected' : ''}} value="1">Formato 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="confGeneral__item ">
                                <p class="no-margin">Formato de Pase de Año</p>
                                <div class="confGeneral__radi d-ibo">
                                    <select class="form-control" name="FormatoPaseAnio">
                                        <option {{$FormatoPaseAnio->valor == '0' ? 'selected' : ''}} value="0">Formato 1</option>
                                        <option {{$FormatoPaseAnio->valor == '1' ? 'selected' : ''}} value="1">Formato 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="confGeneral__item ">
                                <p class="no-margin">Contrato Económico</p>
                                <div class="confGeneral__radi d-ibo">
                                    <select class="form-control" name="contratoEconomico">
                                        <option {{$contratoEconomico->valor == '0' ? 'selected' : ''}} value="0">Sin Formato</option>
                                        <option {{$contratoEconomico->valor == '1' ? 'selected' : ''}} value="1">Formato 1</option>
                                        <option {{$contratoEconomico->valor == '2' ? 'selected' : ''}} value="2">Formato 2</option>
										<option {{$contratoEconomico->valor == '3' ? 'selected' : ''}} value="3">Formato 3</option>
                                    </select>
                                </div>
                            </div>
						</div>
						<div id="tab-9" class="tab-pane">
							<div></div>
							<div class="confGeneral__item">
								<div></div>
								<div class="confGeneral__radio">
									<label for="">
										<p class="no-margin">Si</p>
									</label>
									<label for="">
										<p class="no-margin">No</p>
									</label>
								</div>
							</div>
							<div class="confGeneral__item">
								<p class="no-margin">Edita Datos</p>
								<div class="confGeneral__radio">
								@if($editarDatosEstudiante->valor == "1")
									<input type="radio" checked name="editarDatosEstudiante" value="1">
									<input type="radio" name="editarDatosEstudiante" value="0">
								@else
									<input type="radio" name="editarDatosEstudiante" value="1">
									<input type="radio" checked name="editarDatosEstudiante" value="0">
								@endif
								</div>
                            </div>
                            <div class="confGeneral__item">
                                <p class="no-margin">Mostrar calificaciones en perfil Estudiante<!--Mostrar calificaciones en perfil Representante-Estudiante:--></p>
                                <div class="confGeneral__radio">
                                    <input type="radio" name="mostrarCalificaciones" value="1" {{$mostrar_calificaciones->valor == '1' ? 'checked' : ''}}>
                                    <input type="radio" name="mostrarCalificaciones" value="0" {{$mostrar_calificaciones->valor == '0' ? 'checked' : ''}}>
                                </div>
                            </div>
                            <div class="confGeneral__item">
                                <p class="no-margin">Mostrar libreta en perfil <!--representante/-->Estudiante:</p>
                                <div class="confGeneral__radio">
                                    @if($mostrar_libreta->valor == "1")
                                        <input type="radio" checked name="mostrar_libreta" value="1">
                                        <input type="radio" name="mostrar_libreta" value="0">
                                    @else
                                        <input type="radio" name="mostrar_libreta" value="1">
                                        <input type="radio" checked name="mostrar_libreta" value="0">
                                    @endif
                                </div>
                            </div>
                            <div class="confGeneral__item ">
                                <p class="no-margin">Los estudiantes pueden eliminar mensajes:</p>
                                <div class="confGeneral__radio">
                                    <input {{$eliminarMensajesEstudiantes->valor == '1' ? 'checked' : ''}} type="radio" name="eliminarMensajesEstudiantes" value="1">
                                    <input {{$eliminarMensajesEstudiantes->valor == '0' ? 'checked' : ''}} type="radio" name="eliminarMensajesEstudiantes" value="0">
                                </div>
                            </div>
                            <div class="confGeneral__item">
                                <p class="no-margin">Correos de estudiantes a administrador</p>
                                <div class="confGeneral__radio">
                                    <input {{$sendToAdmin->valor == '1' ? 'checked' : ''}} type="radio" name="sendToAdmin" value="1">
                                    <input {{$sendToAdmin->valor == '0' ? 'checked' : ''}} type="radio" name="sendToAdmin" value="0">
                                </div>
                            </div>
							<!--<div class="confGeneral__item">
                                <p class="no-margin">Permitir Actualización de datos desde representante</p>
                                <div class="confGeneral__radio">
                                    <input {{$ActDatosRepre->valor == '1' ? 'checked' : ''}} type="radio" name="ActDatosRepre" value="1">
                                    <input {{$ActDatosRepre->valor == '0' ? 'checked' : ''}} type="radio" name="ActDatosRepre" value="0">
                                </div>
							</div>-->
							<div class="confGeneral__item">
                                <p class="no-margin">Permitir Actualización de datos desde estudiante</p>
                                <div class="confGeneral__radio">
                                    <input {{$ActDatosEstu->valor == '1' ? 'checked' : ''}} type="radio" name="ActDatosEstu" value="1">
                                    <input {{$ActDatosEstu->valor == '0' ? 'checked' : ''}} type="radio" name="ActDatosEstu" value="0">
                                </div>
                            </div>
                            <div class="confGeneral__item">
                                <p class="no-margin">Permitir Adjuntos en .R.</p>
                                <div class="confGeneral__radio">
                                    <input {{$adjuntoRepresentante->valor == '1' ? 'checked' : ''}} type="radio" name="adjuntoRepresentante" value="1">
                                    <input {{$adjuntoRepresentante->valor == '0' ? 'checked' : ''}} type="radio" name="adjuntoRepresentante" value="0">
                                </div>
                            </div>
                        </div>
                        <div id="tab-10" class="tab-pane">
							<div></div>
							<div class="confGeneral__item">
								<div></div>
								<div class="confGeneral__radio">
									<label for="">
										<p class="no-margin">Si</p>
									</label>
									<label for="">
										<p class="no-margin">No</p>
									</label>
								</div>
							</div>
                            <div class="confGeneral__item">
                                <p class="no-margin">Nuevo Estudiante Admisión</p>
                                <div class="confGeneral__radio">
                                    <input {{$nuevoEstudianteAdmision->valor == '1' ? 'checked' : ''}} type="radio" name="nuevoEstudianteAdmision" value="1">
                                    <input {{$nuevoEstudianteAdmision->valor == '0' ? 'checked' : ''}} type="radio" name="nuevoEstudianteAdmision" value="0">
                                </div>
                            </div>							
							<div class="confGeneral__item">
                                <p class="no-margin">Buscar Estudiante</p>
                                <div class="confGeneral__radio">
                                    <input {{$AdmisionesBuscar->valor == '1' ? 'checked' : ''}} type="radio" name="AdmisionesBuscar" value="1">
                                    <input {{$AdmisionesBuscar->valor == '0' ? 'checked' : ''}} type="radio" name="AdmisionesBuscar" value="0">
                                </div>
                            </div>
                            <div class="confGeneral__item ">
                                <p class="no-margin">Periodo pase de año</p>
                                <div class="confGeneral__radi d-ibo">
                                    <select class="form-control" name="PeriodoPaseAnio">
                                        <option {{$PeriodoPaseAnio->valor == '0' ? 'selected' : ''}} value="0">Seleccione una opción...</option>
                                        @foreach($periodosLectivos as $periodo)
                                        <option {{$PeriodoPaseAnio->valor == $periodo->id ? 'selected' : ''}} value="{{$periodo->id}}">{{$periodo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="confGeneral__item ">
                                <p class="no-margin">Restricción Paralelo/Especialización</p>
                                <div class="confGeneral__radi d-ibo">
                                    <select class="form-control" name="selectParaleloRepre">
                                        <option {{$selectParaleloRepre->valor == '0' ? 'selected' : ''}} value="0">Ninguna restricción</option>
                                        <option {{$selectParaleloRepre->valor == '1' ? 'selected' : ''}} value="1">Restringir paralelos</option>
                                        <option {{$selectParaleloRepre->valor == '2' ? 'selected' : ''}} value="2">Restringir paralelos/especializaciones</option>
                                    </select>
                                </div>
                            </div>
						</div>
					</div>
				</div>
				<input type="submit" value="Guardar" class="mt-1 btn btn-primary">
			</div>
		</div>
	</form>
</div>

@endsection
@else
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-lg-12 titulo-separacion">
                <h2 class="title-page">NO TIENE PERMISOS NECESARIOS.</h2>
            </div>
        </div>
    </div>
@endif

@section('scripts')
<script src="{{secure_asset('js/html5sortable.js')}}"></script>
<script>
sortable('.sortable')[0].addEventListener('sortupdate', function(e) {
	let orden = "";
	let items = sortable('.sortable', 'serialize')[0].items.forEach( (item,index) => {
		orden += "'"+item.node.textContent + "',";
	});
	orden = orden.substring(0,orden.length-1);
	document.getElementById('insumosOrden').value = orden;
});
$.get( "{{route('configuracionesGeneralesNivelMaterias') }}", {
	materia: $('#ddlMateria').val()
},function(data) {
	if(data.length != 0){
		document.getElementById('nivelMateria').value = data[0].nivel;
		document.getElementById('nivelID').value = data[0].id;
	}else{
		document.getElementById('nivelMateria').value = "";
		document.getElementById('nivelID').value ="";
	}
});
$('#ddlMateria').change( function() {
	$.get( "{{route('configuracionesGeneralesNivelMaterias') }}", {
		materia: $('#ddlMateria').val()
	},function(data) {
		if(data.length != 0){
			document.getElementById('nivelMateria').value = data[0].nivel;
			document.getElementById('nivelID').value = data[0].id;
		}else{
			document.getElementById('nivelMateria').value = "";
			document.getElementById('nivelID').value ="";
		}
	});
})
var url = window.location.origin
function contadorMatricula() {
	Swal.fire({
		title: 'Esta acción es irreversible ¿Seguro deseas escojer esta opción? Una vez guardado, no podras cambiar el contador de matricula',
		icon: 'warning',
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'OK',
	})
}

function pagoAdelantado() {
	Swal.fire({
		title: 'Esta acción es irreversible ¿Seguro deseas escojer esta opción? Una vez guardado, no podras cambiar el Pago Adelantado',
		icon: 'warning',
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'OK',
	})
}

function mensajeContador() {
	Swal.fire({
		title: 'Ingresa desde que numero de factura deseas que comience.',
		icon: 'warning',
		input: 'text',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
			if (result.value > 0) {
				$.ajax({
					type: "POST",
					url: "reiniciar-contador-factura",
					data: {
						'_token': $('input[name=_token]').val(),
						numeroFactura: result.value
					},
					success: function (response) {
						$('#reiniciarContador').attr('disabled', '')
					}
				});
			} else if(result.value <= 0) {
				alert('Debes ingresar un numero mayor a 0');
			}
		})
}
$("#InsumoPorcentual_A").change(function () {
	if ($("#PromedioInsumo").is(':checked')) {
		alert('No se puede activar si "Calcular Promedio Por Insumo Activo" se encuentra activo');
		if($("#InsumoPorcentual_A").is(':checked')){
		$("#InsumoPorcentual_I").prop('checked', true);
	}
	}
});
</script>
@endsection