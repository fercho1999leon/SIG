@extends('layouts.master')
@section('content')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('pagosGeneral');
@endphp
<a class="button-br" href="{{ route('pagosGeneral', $id_carrera) }}">
    <button>
        <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
    </button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-12 seleccion-curso">
			<h2 class="title-page">PAGOS
                <small>
                	{{ $course->grado}} {{ $course->paralelo }} {{$course->especializacion}}
                </small>
                </h2>
            <div style="display:flex;">
                @if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
				<div class="pagosCursos__selectMes">
					<div>
						<label for="">Tipo</label>
						<select class="form-control" name="" id="tipoMatricula">
							@foreach ($rubros as $rubro)
								<option value="{{ $rubro->id}}">{{ $rubro->tipo_rubro }}</option>
							@endforeach
							<option value="Otro">OTRO</option>
						</select>
					</div>
					<div>
						<label for="">Mes</label>
						<select class="form-control" name="" id="mesMatricula">
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
						</select>
					</div>
				</div>
				<input type="hidden" value="{{ url('/colecturia/estudiantes-pagados-por-curso/'.$course->id) }}" id="estudiantesPagadosRoute">
				<input type="hidden" value="{{ url('/colecturia/estudiantes-pendientes/'.$course->id) }}" id="estudiantesPendientesRoute">
				<input type="hidden" value="{{ url('/colecturia/estudiantes-pendientes-prorroga/'.$course->id) }}" id="estudiantesProrrogaRoute">
				<a href="#" class="title-page btn btn-primary mr-1"  id="estudiantesPagadosLink">
					<img class="mr-05" src="{{secure_asset('img/file-download-white.svg')}}" width="12">
					Pagados
				</a>
				<a class="title-page btn btn-primary mr-1" id="estudiantesPendientesLink">
					<img class="mr-05" src="{{secure_asset('img/file-download-white.svg')}}" width="12">
					Pendientes
				</a>
				<a class="title-page btn btn-primary mr-1" id="estudiantesProrrogaLink">
					<img class="mr-05" src="{{secure_asset('img/file-download-white.svg')}}" width="12">
					Prórroga
				</a>
                @endif
			</div>
		</div>
	</div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="colecturiaPagos__curso__stundets-grid">
				@foreach($students as $student)
                <div class="colecturiaPagos__curso__students-item">
                    <a href="{{ route('pagosCursoEstudiante', [$student->id]) }}" class="colecturiaPagos__curso__students-name bold">
                        {{ $student->apellidos }}, {{ $student->nombres }}
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#estudiantesPagadosLink').attr('href', $('#estudiantesPagadosRoute').val() + '/' + $('#tipoMatricula').val() + '/' + $('#mesMatricula').val())
    $('#estudiantesProrrogaLink').attr('href', $('#estudiantesProrrogaRoute').val() + '/' + $('#mesMatricula').val() + '/' + $('#tipoMatricula').val())
	$('#estudiantesPendientesLink').attr('href', $('#estudiantesPendientesRoute').val() + '/' + $('#mesMatricula').val() + '/' + $('#tipoMatricula').val())
$('#tipoMatricula').change(function() {
    $('#estudiantesPagadosLink').attr('href', $('#estudiantesPagadosRoute').val() + '/' + $('#tipoMatricula').val() + '/' + $('#mesMatricula').val())
    $('#estudiantesProrrogaLink').attr('href', $('#estudiantesProrrogaRoute').val() + '/' + $('#mesMatricula').val() + '/' + $('#tipoMatricula').val())
	$('#estudiantesPendientesLink').attr('href', $('#estudiantesPendientesRoute').val() + '/' + $('#mesMatricula').val() + '/' + $('#tipoMatricula').val())

})

$('#mesMatricula').change(function() {
    $('#estudiantesPagadosLink').attr('href', $('#estudiantesPagadosRoute').val() + '/' + $('#tipoMatricula').val() + '/' + $('#mesMatricula').val())
    $('#estudiantesProrrogaLink').attr('href', $('#estudiantesProrrogaRoute').val() + '/' + $('#mesMatricula').val() + '/' + $('#tipoMatricula').val())
	$('#estudiantesPendientesLink').attr('href', $('#estudiantesPendientesRoute').val() + '/' + $('#mesMatricula').val() + '/' + $('#tipoMatricula').val())

})

</script>
@endsection