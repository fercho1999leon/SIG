@extends('layouts.master')
@section('content')
	<div id="page-wrapper" class="gray-bg dashbard-1">
		 @include('layouts.nav_bar_top')
		<div class="row wrapper white-bg ">
			<div class="col-lg-12">
				<h2 class="title-page">Institución
					<small> Año Lectivo</small>
				</h2>
			</div>
		</div>
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="col-lg-6">
					<div class="ibox">
						<div class="ibox-title bg_color7">
							<h5>DATOS GENERALES</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up color-white"></i>
								</a>
							</div>
						</div>
						<div class="ibox-content" >
							<div class="row no-margins">
								<div class="col-lg-5">
									<div class="widget style1 navy-bg">
										<div class="row vertical-align">
											<div class="col-xs-3">
												<i class="fa fa-thumbs-up fa-3x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<h2 class="font-bold">10</h2>
												<h5 class="font-bold">Calificación Base</h5>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="widget style1 yellow-bg">
										<div class="row vertical-align">
											<div class="col-xs-3">
												<i class="fa fa-thumbs-up fa-3x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<h2 class="font-bold">7</h2>
												<h5 class="font-bold">Calificación Mínima</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ibox">
						<div class="ibox-title bg_color7">
							<h5>RELACIONES CUALITATIVAS</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up color-white"></i>
								</a>
							</div>
						</div>
						<div class="ibox-content">
							<div class="row no-margins">
								<p class="fz2">
									<i class="fa fa-angle-right text-color7"></i> Notas de aprendizaje
								</p>
								<div class="ml-2">
									<p>
										<strong>9:</strong> Domina los aprendizajes requeridos
									</p>
									<p>
										<strong>7:</strong> Alcanza los aprendizajes requeridos
									</p>
									<p>
										<strong>4.01:</strong> Está próximo a alcanzar los aprendizajes requeridos
									</p>
									<p>
										<strong>0:</strong> No alcanza los aprendizajes requeridos
									</p>
								</div>
							</div>
							<!--
							<div class="row no-margins">
								<p class="fz2">
									<i class="fa fa-angle-right text-color7"></i> Notas de promedios cualitativos
								</p>
								<div class="ml-2">
									<p>
										<strong>10-EX:</strong> Demuestra destacado desempeño en cada fase del desarrollo del proyecto escolar lo que constituye
										un excelente aporte a su formación integral.
									</p>
									<p>
										<strong>8-MB:</strong> Demuestra muy buen desempeño en cada fase del desarrollo del proyecto escolar lo que constituye
										aporte a su formación integral.
									</p>
									<p>
										<strong>6-B:</strong> Demuestra buen desempeño en cada fase del desarrollo del proyecto escolar lo que constribuye a su
										formación integral.
									</p>
									<p>
										<strong>0.1-R:</strong> Demuestra regular desempeño en cada fase del desarrollo del proyecto escolar lo que constribuye
										escasamentes a su formación integral.
									</p>
								</div>
							</div>-->
							<!--
							<div class="row no-margins">
								<p class="fz2">
									<i class="fa fa-angle-right text-color7"></i> Notas de comportamiento
								</p>
								<div class="ml-2">
									<p>
										<strong>9:</strong> A
									</p>
									<p>
										<strong>7:</strong> B
									</p>
									<p>
										<strong>5:</strong> C
									</p>
									<p>
										<strong>3:</strong> D
									</p>
									<p>
										<strong>0:</strong> E
									</p>
								</div>
							</div>
							-->
							<div class="row no-margins">
								<p class="fz2">
									<i class="fa fa-angle-right text-color7"></i> Notas cualitativas de comportamiento
								</p>
								<div class="ml-2">
									<p>
										<strong>E:</strong>
										<u>Insatisfactorio</u> No cumple con los compromisos establecidos para la sana convivencia social.
									</p>
									<p>
										<strong>D:</strong>
										<u>Mejorable</u> Falla reiteradamente en el cumplimiento de los compromisos establecidos para la sana convivencia
										social.
									</p>
									<p>
										<strong>C:</strong>
										<u>Poco Satisfactorio</u> Falla ocasionalmente en el cumplimiento de los compromisos establecidos para la sana convivencia
										social.
									</p>
									<p>
										<strong>B:</strong>
										<u>Satisfactorio</u> Cumple con los compromisos establecidos para la sana convivencia social.
									</p>
									<p>
										<strong>A:</strong>
										<u>Muy Satisfactorio</u> Lidera el cumplimiento de los compromisos establecidos para la sana convivencia social.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="ibox">
						<div class="ibox-title bg_color7">
							<h5>PERÍODOS</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up color-white"></i>
								</a>
							</div>
						</div>
						<div class="ibox-content">
							<div class="row no-margins">
								<p class="fz2">
									<i class="fa fa-star text-color7"></i> Semestre 1
								</p>
								<p class="institucionLectivo-parcialesTitle">
									<code> PARCIALES  <strong class="text-color4"> 80% </strong></code>
								</p>
								<div class="ml-2">
									<p>
										<i class="fa fa-angle-right"></i>
										<strong>Parcial 1</strong> ({{$fechap1q1FI .' - '. $fechap1q1FF}})
									</p>
									<p>
										<i class="fa fa-angle-right"></i>
										<strong>Parcial 2</strong> ({{$fechap2q1FI.' - '.$fechap2q1FF}})
									</p>
									<p>
										<i class="fa fa-angle-right"></i>
										<strong>Parcial 3</strong> ({{$fechap3q1FI.' - '.$fechap3q1FF}})
									</p>
								</div>
								<p class="institucionLectivo-parcialesTitle">
									<code> EXAMEN  <strong class="text-color4"> 20% </strong></code>
								</p>
								<div class="ml-2">
									<p>
										<i class="fa fa-angle-right"></i>
										<strong>Examen Quimestral ({{$fechaexq1FI.' - '.$fechaexq1FF}})</strong>
									</p>
								</div>
							</div>
							<div class="row no-margins">
								<p class="fz2">
									<i class="fa fa-star text-color7"></i> Semestre 2
								</p>
								<p class="institucionLectivo-parcialesTitle">
									<code> PARCIALES  <strong class="text-color4"> 80% </strong></code>
								</p>
								<div class="ml-2">
									<p>
										<i class="fa fa-angle-right"></i>
										<strong>Parcial 1</strong> ({{$fechap1q2FI .' - '. $fechap1q2FF}})
									</p>
									<p>
										<i class="fa fa-angle-right"></i>
										<strong>Parcial 2</strong> ({{$fechap2q2FI .' - '. $fechap2q2FF}})
									</p>
									<p>
										<i class="fa fa-angle-right"></i>
										<strong>Parcial 3</strong> ({{$fechap3q2FI .' - '. $fechap3q2FF}})
									</p>
								</div>
								<p class="institucionLectivo-parcialesTitle">
									<code> EXAMEN  <strong class="text-color4"> 20% </strong></code>
								</p>
								<div class="ml-2">
									<p>
										<i class="fa fa-angle-right"></i>
										<strong>Examen Quimestral ({{$fechaexq2FI.' - '.$fechaexq2FF}})</strong>
									</p>
								</div>
							</div>
						</div>
					</div>
					<!--
					<div class="ibox">
						<div class="ibox-title bg_color7">
							<h5>EXAMENES ADICIONALES</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up color-white"></i>
								</a>
							</div>
						</div>
						<div class="ibox-content">
							<div class="row no-margins">
								<p>
									<i class="fa fa-angle-right"></i>
									<strong>Supletorio</strong> (Sup.)
								</p>
								<p>
									<i class="fa fa-angle-right"></i>
									<strong>Remedial</strong> (Rem.)
								</p>
								<p>
									<i class="fa fa-angle-right"></i>
									<strong>Gracia</strong> (Gra.)
								</p>
							</div>
						</div>
					</div>
					<div class="ibox">
						<div class="ibox-title bg_color7">
							<h5>SECCIONES</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up color-white"></i>
								</a>
							</div>
						</div>
						<div class="ibox-content">
							<div class="row no-margins">
								@foreach ($courses->groupBy('seccion') as $key => $course)
									<div class="row no-margins">
										<p class="fz2">
											<i class="fa fa-angle-right text-color7"></i>
											{{$key == 'EI' ? 'Educación Inicial' : ''}}
											{{$key == 'EGB' ? 'Educación General Básica' : ''}}
											{{$key == 'BGU' ? 'Bachillerato General Unificado' : ''}}
											<small>({{$key}})</small>
										</p>
									</div>
									<div class="ml-2">
										@foreach ($courses->where('seccion', $key) as $course)
											<p>
												<i class="fa fa-angle-double-right"></i>
												<strong> {{$course->grado}} {{$course->especializacion}} {{$course->paralelo}} </strong>
											</p>
										@endforeach
										{{-- <p>
											<i class="fa fa-angle-right"></i>
											<strong>IE</strong>
											<small>-Iniciada</small>
										</p>
										<p>
											<i class="fa fa-angle-right"></i>
											<strong>EP</strong>
											<small>-En Proceso</small>
										</p>
										<p>
											<i class="fa fa-angle-right"></i>
											<strong>A</strong>
											<small>-Adquirida</small>
										</p> --}}
									</div>
								@endforeach
							</div>
						</div>
					</div>-->
				</div>
			</div>
		</div>
	</div>
@endsection