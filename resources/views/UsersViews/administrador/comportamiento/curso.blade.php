@extends('layouts.master')
@section('content')
@php
$unidad = App\UnidadPeriodica::unidadP();
$permiso = App\Permiso::desbloqueo('comportamiento');
@endphp
<a class="button-br" href="{{route('comportamiento')}}">
	<button>
		<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
	</button>
</a>
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Comportamiento</small></h2>
			<div class="lg:flex">
				<select class="select__header form-control" id="selectParcial">
                @foreach($unidad as $und)
                <optgroup label="{{$und->nombre}}">
                    @php
                    $parcialP = App\ParcialPeriodico::parcialP($und->id);
                    @endphp
                    @foreach($parcialP as $par )
                        <option value="{{$par->identificador}}" {{$par->identificador == $parcial ? 'selected' : ''}} >{{$par->nombre}}</option>
                    @endforeach
                    </optgroup>
                @endforeach
                	<option value="anual" {{$parcial == 'anual' ? 'selected' : ''}}>Anual</option>
            </select>
				@if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
				<a class="btn btn-black sm:mb-0 lg:mt-0 lg:ml-2 w-48" href="{{route('comportamiento-reporte-por-parcial', [$course, $parcial])}}">Descargar</a>
				@endif
			</div>
		</div>
		<div class="row wrapper migajasDePan">
			<div class="col-lg-12">
				<div class="border">
					<a class="no-pointer"> {{$course->grado}} {{$course->especialzacion}} {{$course->paralelo}} </a>
				</div>
			</div>
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
							@php $comportamientos = $comportamientoEstudiantes->where('idStudent', $student->idStudent)->where('parcial', $parcial)->where('idPeriodo', $periodo) @endphp
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
								@if($permiso ==null || ($permiso != null && $permiso->editar == 1))
								<a href=" {{route('comportamiento-estudiante', ['idEstudiante' => $student->idStudent, 'idCurso' => $student->idCurso, 'parcial' => $parcial])}} ">
									<i class="fa fa-pencil a-fa-pencil__matricula"></i>
								</a>
								@endif
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
<script>
	function load() {
		const url = "{{route('comportamiento-curso-js')}}"
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
	}
	window.onload = load;
</script>