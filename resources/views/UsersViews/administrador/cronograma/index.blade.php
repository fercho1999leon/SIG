@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-lg-12 titulo-separacion">
			<h2 class="title-page">Cronograma</h2>
		</div>
	</div>
	<div class="row mb350 mt-1">
		<div class="col-xs-12">
			<div class="cronogramaRoles-grid">
				@for ($i = 0; $i < count($roles); $i++)
					<div>
						<h3 class="ronogramaRoles__rolTitutlo">
							{{$roles[$i] == 'institucion' ? 'INSTITUCIÓN' : ''}}
							{{$roles[$i] == 'institucion_interna' ? 'INSTITUCIÓN INTERNA' : ''}}
							{{$roles[$i] == 'docente' ? 'DOCENTES' : ''}}
						</h3>
						@foreach ($cronogramas->where('rol', $roles[$i]) as $key => $cronograma)
							<div class="cronogramaRoles-item relative">
								<h3>Descripción:</h3>
								<h4>{{$cronograma->titulo ?? '-'}}</h4>
								<a href='{{Storage::url($cronograma->adjunto)}}' class="btn btn-primary w100" download>DESCARGAR CRONOGRAMA</a>
								<span class="cronogramaRoles__parcial">
									{{$cronograma->parcial == 'p1q1' ? '1er Parcial' : '' }}
									{{$cronograma->parcial == 'p2q1' ? '2do Parcial' : '' }}
									{{$cronograma->parcial == 'p3q1' ? '3er Parcial' : '' }}
									{{$cronograma->parcial == 'q1' ? 'Quimestral 1' : '' }}
									{{$cronograma->parcial == 'p1q2' ? '1er Parcial' : '' }}
									{{$cronograma->parcial == 'p2q2' ? '2do Parcial' : '' }}
									{{$cronograma->parcial == 'p3q2' ? '3er Parcial' : '' }}
									{{$cronograma->parcial == 'q2' ? 'Quimestral 2' : '' }}
									{{$cronograma->parcial == 'anual' ? 'Anual' : '' }}
								</span>
							</div>						
						@endforeach
					</div>
				@endfor
			</div>
		</div>
	</div>
</div>
@endsection