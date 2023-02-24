@extends('layouts.master')
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Comportamiento <small> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} </small></h2>
			<select class="select__header form-control" id="selectParcial">
		        @foreach($unidad as $und)
					<optgroup label="{{$und->nombre}}">
						@php $pars = $parcialP->where('idUnidad',$und->id); @endphp
						@foreach($pars as $par )
							<option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{ (substr($par->nombre, 3,6) == "Examen") ? $und->nombre : $par->nombre }}</option>
						@endforeach
					</optgroup>
				@endforeach
				@if ($confComportamiento->valor == 'crear')
					<option value="anual" {{$parcial == 'anual' ? 'selected' : ''}}>Anual</option>
				@endif
		    </select>
        </div>
    </div>
    <div class="row mt-1 mb350">
        <div class="col-xs-12">
			<div class="table-responsive">
				<table class="s-calificaciones white-bg w100">
					<tr class="table__bgBlue">
						<td width="5" class="text-center">#</td>
						<td>Estudiantes</td>
						<td width="10" class="text-center">Nota</td>
						<td>Observación - Recomendación</td>
						<td width="5"></td>
					</tr>
					@foreach ($students as $student)
						<tr>
							@php $comportamientos = $comportamientoEstudiantes->where('idStudent', $student->idStudent)->where('parcial', $parcial)->where('idPeriodo', $periodo);
							@endphp
							<td class="text-center"> {{$count++}} </td>
							<td> {{$student->apellidos}} {{$student->nombres}} </td>
							@if ($comportamientos != null)
							<td class="text-center">
								@forelse ($comportamientos->sortByDesc('id')->take(1) as $comportamiento)
									{{$comportamiento->nota}}
								@empty
									-
								@endforelse
							</td>
							<td>
								@forelse ($comportamientos->sortByDesc('id')->take(1) as $comportamiento)
									{{$comportamiento->observacion}}
								@empty
									-
								@endforelse
							</td>
							@endif
							<td class="text-center">
								<a href=" {{route('tutor-comportamiento-estudiante', ['idCurso' => $student->idCurso, 'parcial' => $parcial, 'idEstudiante' => $student->idStudent])}} ">
									<i class="fa fa-pencil a-fa-pencil__matricula"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
	<script>
		const url = "{{route('tutor-comportamiento-js')}}"
		const idCurso = '{{$course->id}}'
		const selectParciales = document.getElementById('selectParcial')
		if(selectParciales) {
			selectParciales.addEventListener('change', function() {
				const parcial = selectParciales.value
				let newurl = `${url}/${idCurso}/${parcial}`
				location.href = newurl;
			})
		} else {
			console.log('no se pudo obtener el id del select')
		}
	</script>
@endsection