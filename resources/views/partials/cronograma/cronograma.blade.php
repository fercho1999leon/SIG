<div class="row mb350 mt-1">
	<div class="col-xs-12">
		<div class="cronogramaRoles__general">
			@for ($i = 0; $i < count($roles); $i++)
				<div>
					<h3 class="a-btn__cursos">
						{{$roles[$i] == 'institucion' ? 'INSTITUCIÓN' : ''}}
						{{$roles[$i] == 'institucion_interna' ? 'INSTITUCIÓN INTERNA' : ''}}
						{{$roles[$i] == 'docente' ? 'DOCENTES' : ''}}
						@if ($student != null)
							{{$roles[$i] == 'representante' ? 'ESTUDIANTE' : ''}}
						@else	
						<!--	{{$roles[$i] == 'representante' ? 'REPRESENTANTE' : ''}}-->
						@endif
					</h3>
					<div class="cronogramaRoles__general-grid">
						@foreach ($cronogramas->where('rol', $roles[$i]) as $key => $cronograma)
							<div class="cronogramaRoles-item m-0 relative">
								<h3>Descripción:</h3>
								<h4>{{$cronograma->titulo ?? '-'}}</h4>
								<a href='{{Storage::url($cronograma->adjunto)}}' class="w100 pinedTooltip" download>
									<img src="{{secure_asset('img/file-download.svg')}}" width="16" alt="">
									<span class="pinedTooltipH">DESCARGAR CRONOGRAMA</span>
								</a>
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
				</div>
			@endfor
		</div>
	</div>
</div>