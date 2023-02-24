@extends('layouts.master')
@section('content')
{{-- @include('partials.loader.loader') --}}
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg " >
            <div class="col-lg-12 titulo-separacion">
				<h2 class="title-page">Observaciones Aulicas</h2>
				<select class="form-control select__header" id="selectObservaciones">
					<option value="todos">Todos</option>
					<option value="0">Pendiente</option>
					<option value="1">Finalizado</option>
				</select>
            </div>
		</div>
        <div class="row mt-1 mb350">
            <div class="col-lg-12">
				<div class="osbervacionesAulicas__grid">
				@foreach ($docentes as $docente)
					<div class="osbervacionesAulicas__item" data-status="{{$docente->status ?? 'todos'}}">
						<h3 class="transporte__unidad__datos m-0">
							{{$docente->apellidos}} {{$docente->nombres}} 
							<span>
								{{$docente->grado}} {{$docente->especializacion}} {{$docente->paralelo}}
							</span>
							@if ($docente->observacionId != null)
								<p class="observacionesAulicas__item--status" style="background: {{$docente->status == 1 ? '#12CC94' : '#FF4545'}}">
									{{$docente->status == 1 ? 'FINALIZADO' : 'PENDIENTE'}}
								</p>
							@endif
						</h3>
						<div>
							@if ($docente->observacionId != null)
								<a href="{{route('aulicas.show', $docente->id)}}">
									<i class="fa fa-eye icon__ver"></i>
								</a>
								@if ($docente->status !== 1)
									<a href="{{route('aulicas.edit', $docente->id)}}">
										<i class="fa fa-pencil a-fa-pencil__matricula"></i>
									</a>
								@endif
							@else
								<a href="{{route('aulicas.create', $docente->id)}}" class="btn btn-primary">
									GENERAR
								</a>
							@endif
						</div>
					</div>
				@endforeach
				</div>
			</div>
        </div>
	</div>
	<script>
		const select = document.getElementById('selectObservaciones')
		const cardDocentes = document.querySelectorAll('.osbervacionesAulicas__item')
		select.addEventListener('change', function() {
			cardDocentes.forEach(e => {
				const status = e.getAttribute('data-status')
				if(status == select.value) {
					e.style.display = 'flex'
				} else {
					e.style.display = 'none'
				}

				if (select.value == 'todos') {
					cardDocentes.forEach(e => {
						e.style.display = 'flex'
					});
				}
			});
		})
		
	</script>
@endsection

