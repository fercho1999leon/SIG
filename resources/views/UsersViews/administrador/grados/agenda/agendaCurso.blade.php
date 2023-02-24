@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('grade_agenda');
@endphp
	<a class="button-br" href="{{ route('grade_agenda') }}">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17">Regresar
		</button>
	</a>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-xs-12 titulo-separacion">
				<h2 class="title-page">AGENDA ESCOLAR</h2>
				@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
				<div class="title-page lg:flex">
					<a target="_blank" class="pinedTooltip sm:mb-0 lg:mt-0 lg:ml-2" href="{{route('agenda-escolar-reporteDiario',[$course, 'fecha='.request('fecha')])}}">
						<img class="mr-05" src="{{secure_asset('img/file-download.svg')}}" width="20">
						<span class="z-50 pinedTooltipH" style="z-index:9999">Reporte del día</span>
					</a>
					<a class="btn btn-black sm:mb-0 lg:mt-0 lg:ml-2 w-48" href="{{route('ver_CursoAgenda.semanal', [$course, 'fecha='.request('fecha')])}}">Semanal</a>
				</div>
				@endif
			</div>
			<div class="row wrapper migajasDePan">
				<div class="col-lg-12">
					<div class="migajasDePan__enlaces-container">
						<a href=""> {{$course->grado}} {{$course->paralelo}} {{$course->especializacion}}  </a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 mt-2">
				<form method="get" class="">
					<div class="agendaEscolar__buscador">
						<input type="date" class="form-control" name="fecha" id="" value="{{request('fecha')}}">
						<button class="btn btn-primary" type="submit">Buscar</button>
					</div>
				</form>
			</div>
			<div class="col-lg-12 mb-6">
				<div class="">
					<div class="r-calificacioneshijo-item ibox m-0 border-bottom">
						<header class="r-calificaciones-header flex justify-center align-items-center">
							<h3 class="r-calificacioneshijo-materia">
								HORARIO DE CLASE
							</h3>
							<a class="collapse-link">
								<i class="fa fa-chevron-down" style="color: #3a3a3a;font-size:20px"></i>
							</a>
						</header>
						<section class="r-calificaciones-section">
							<div class="ibox-content p-0 no-border" style="display: none;">
								<table class="table__agenda-escolar w100">
									<thead>
										<th class="text-center"></th>
										<th class="text-center">LUNES</th>
										<th class="text-center">MARTES</th>
										<th class="text-center">MIERCOLES</th>
										<th class="text-center">JUEVES</th>
										<th class="text-center">VIERNES</th>
										<th class="text-center">SABADO</th>
									</thead>
									<tbody>
										@foreach( $schedulers as $scheduler)
										<tr>
											@if($scheduler->horaInicio!=null)
											<td>
												<div class="table__agenda-escolar--hora">
													<div>
														<div>
															{{ substr($scheduler->horaInicio,0,5) }}
														</div>
														<div>
															{{ substr($scheduler->horaFin,0,5) }}
														</div>
													</div>
												</div>
											</td>
											@else
											<td></td>
											@endif
											@if($scheduler->dia1!=null)
											<td class="text-center">
												<div class="table__agenda-escolar--materia-flex">												@foreach( $matters as $matter)
														@if( $scheduler->dia1==$matter->id)
															{{ $matter->nombre }}<br>
															@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a href="{{ route('crearClaseAdministrador',['id' => $matter->id, 'idCurso' => $course->id, 'fecha='.request('fecha') ]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
																<img src="{{secure_asset('img/circleMore.svg')}}" width="16">
															</a>
														@endif
														@endif
													@endforeach
												</div>
											</td>
											@else
											<td></td>
											@endif

											@if($scheduler->dia2!=null)
											<td class="text-center">
												<div class="table__agenda-escolar--materia-flex">

													@foreach( $matters as $matter)
														@if( $scheduler->dia2==$matter->id)
															{{ $matter->nombre }}
															@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a href="{{ route('crearClaseAdministrador',['id' => $matter->id, 'idCurso' => $course->id, 'fecha='.request('fecha') ]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
																<img src="{{secure_asset('img/circleMore.svg')}}" width="16">
															</a>
														@endif
														@endif
													@endforeach
												</div>
											</td>
											@else
											<td></td>
											@endif

											@if($scheduler->dia3!=null)
											<td class="text-center">
												<div class="table__agenda-escolar--materia-flex">

													@foreach( $matters as $matter)
														@if( $scheduler->dia3==$matter->id)
															{{ $matter->nombre }}
															@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a href="{{ route('crearClaseAdministrador',['id' => $matter->id, 'idCurso' => $course->id, 'fecha='.request('fecha') ]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
																<img src="{{secure_asset('img/circleMore.svg')}}" width="16">
															</a>
														@endif
														@endif
													@endforeach
												</div>
											</td>
											@else
											<td></td>
											@endif

											@if($scheduler->dia4!=null)
											<td class="text-center">
												<div class="table__agenda-escolar--materia-flex">
												@foreach( $matters as $matter)
														@if( $scheduler->dia4==$matter->id)
															{{ $matter->nombre }}
															@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a href="{{ route('crearClaseAdministrador',['id' => $matter->id, 'idCurso' => $course->id, 'fecha='.request('fecha') ]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
																<img src="{{secure_asset('img/circleMore.svg')}}" width="16">
															</a>
														@endif
														@endif
													@endforeach
												</div>
											</td>
											@else
											<td></td>
											@endif

											@if($scheduler->dia5!=null)
											<td class="text-center">
												<div class="table__agenda-escolar--materia-flex">

													@foreach( $matters as $matter)
														@if( $scheduler->dia5==$matter->id)
															{{ $matter->nombre }}
															@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a href="{{ route('crearClaseAdministrador',['id' => $matter->id, 'idCurso' => $course->id, 'fecha='.request('fecha') ]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
																<img src="{{secure_asset('img/circleMore.svg')}}" width="16">
															</a>
															@endif
														@endif
													@endforeach
												</div>
											</td>
											@else
											<td></td>
											@endif


											@if($scheduler->dia6!=null)
											<td class="text-center">
												<div class="table__agenda-escolar--materia-flex">

													@foreach( $matters as $matter)
														@if( $scheduler->dia6==$matter->id)
															{{ $matter->nombre }}
															@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
															<a href="{{ route('crearClaseAdministrador',['id' => $matter->id, 'idCurso' => $course->id, 'fecha='.request('fecha') ]) }}" class="table__agenda-escolar--materia-edit" style="color: green">
																<img src="{{secure_asset('img/circleMore.svg')}}" width="16">
															</a>
															@endif
														@endif
													@endforeach
												</div>
											</td>
											@else
											<td></td>
											@endif
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</section>
					</div>
				</div>
			</div>
			@include('partials.agenda._agendaEscolar-materias', [
				'editar' => 'editClaseAdministrador',
				'eliminar' => 'destroyClaseAdministrador'
			])
		</div>
	</div>
@endsection

@section('scripts')
@endsection