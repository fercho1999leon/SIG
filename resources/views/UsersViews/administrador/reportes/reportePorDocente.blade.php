@extends('layouts.master')
@section('content')
@include('partials.loader.loader')
@php
$unidad = App\UnidadPeriodica::unidadP();
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg titulo-separacion noBefore">
		<div class="col-xs-12 titulo-separacion">
			<h2 class="title-page">Reporte Por Docentes</h2>
			<!--<select class=" form-control select__header" id="mySelect">
                @foreach($unidad as $und)
                <optgroup label="{{$und->nombre}}">
                    @php
                    $parcialP = App\ParcialPeriodico::parcialP($und->id);
                    @endphp
                    @foreach($parcialP as $par )
                    @if(($par->identificador == 'q1') || ($par->identificador == 'q2'))
                    @else
                        <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                    @endif
                    @endforeach
                    </optgroup>
                @endforeach
            </select>-->
		</div>
	</div>
	<div class="row mt-1">
		<div class="gradosCalificaciones-grid">
			<div style="grid-column: 1 / -1;">
				<h3 class="a-btn__cursos">Producción Audiovisual/Primer Semestre</h3>
			</div>
		</div>
	<div class="gradosCalificaciones-item reporteCurso-item">
					<div class="gradosCalificaciones-curso">
						<a href="#">
							<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> Katiuska Alvarado
                        </a>
                        <a href="#" class="rep reportePorEstudiante__download-icon">
                            <i class="fa fa-download"></i>
                        </a>
					</div>
				</div>


		<div class="gradosCalificaciones-grid">
			<div style="grid-column: 1 / -1;">
				<h3 class="a-btn__cursos">Producción Audiovisual/Segundo Semestre</h3>
			</div>
		</div>
			<div class="gradosCalificaciones-item reporteCurso-item">
					<div class="gradosCalificaciones-curso">
						<a href="#">
							<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> Nathaly Batalla
                        </a>
                        <a href="#" class="rep reportePorEstudiante__download-icon">
                            <i class="fa fa-download"></i>
                        </a>
					</div>
				</div>

				<div class="gradosCalificaciones-grid">
			<div style="grid-column: 1 / -1;">
				<h3 class="a-btn__cursos">Telemática y Redes/Primer Semestre</h3>
			</div>
		</div>
			<div class="gradosCalificaciones-item reporteCurso-item">
					<div class="gradosCalificaciones-curso">
						<a href="#">
							<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> Libia Ponce
                        </a>
                        <a href="#" class="rep reportePorEstudiante__download-icon">
                            <i class="fa fa-download"></i>
                        </a>
					</div>
				</div>

		<!--
		<div class="col-xs-12">
			@foreach($docentes as $key => $d)
				<div class="gradosCalificaciones-grid">
					<div style="grid-column: 1 / -1;">
						<h3 class="a-btn__cursos">{{  $key }}</h3>
					</div>
					<div class="gradosCalificaciones-item reporteCurso-item">

				</div>

					@foreach($d as $docente)
						<div class="gradosCalificaciones-item reporteCurso-item">
							<div class="gradosCalificaciones-curso text-center">
								<a href="">
									<img src="{{secure_asset('img/iconCalificaciones.svg')}}" class="mr-05" width="20" alt=""> {{ $docente->apellidos }} {{ $docente->nombres }}
								</a>
							</div>
							<select name="" id="select__reportes" class="form-control reportePorCurso--select">
								<option value="">Escoja un reporte...</option>
								<optgroup label="Actas">
									<option value="{{ route('actaCalificacionesDocente', ['docente' => $docente->id, 'parcial' => $parcial])}}">Reporte Actas</option>
									<option value="{{ route('ActaCalificacionesQuimestreDocente', ['quimestre' => $parcial, 'docente' => $docente->id])}}">Reporte Actas Quimestre</option>
									{{-- <option value="{{route('reporteActaDeControlDeInsumos-docente', [$docente, $parcial])}}">Acta de Control de Insumos</option> --}}
									<option value="{{route('reporteInsumo', [$docente, $parcial])}}">Actividades Realizadas Parcial</option>
								</optgroup>
								<optgroup label="Estadísticas">
									<option value="{{ route('EstadisticasPorParcialDocente', ['parcial' => $parcial, 'docente' => $docente->id])}}">Estadísticas Parcial</option>
									<option value="{{ route('EstadisticasPorQuimestreDocente', ['parcial' => $parcial, 'docente' => $docente->id])}}">Estadísticas Quimestre</option>
									<option value="{{ route('EstadisticasAnualDocente', ['docente' => $docente->id])}}">Estadísticas Anual</option>
								</optgroup>
							</select>
						</div>
					@endforeach

				</div>
			@endforeach
		</div>-->

	</div>
</div>
@endsection

@section('scripts')
<script>
$('#mySelect').change(function () {
	window.location.href = "{{ route('reportePorCursoRuta') }}/" +  $('#mySelect').val();
});
</script>
<script>
	const selectReportes = document.querySelectorAll('.reportePorCurso--select');
	if(selectReportes) {
		selectReportes.forEach(e => {
			e.addEventListener('change', function() {
				$url = e.value
				if($url) {
					window.open($url, '_blank');
				}
			})
		});
	}
</script>
<script>
$('#mySelect').change(function () {
    window.location.href = "{{ route('reportePorDocenteRuta') }}/" +  $('#mySelect').val();
});
</script>

@endsection
