@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
	@include('layouts.nav_bar_top')
	<div class="row wrapper white-bg ">
		<div class="col-xs-12 seleccion-curso">
			<h2 class="title-page">Estadísticas</h2>
		</div>
	</div>
	<div class="wrapper wrapper-content dir-calificaciones">
		<div class="row mb-1">
			<div class="col-lg-6">
				<select class="selectpicker form-control" id="mySelect" onchange="myFunction()">
					<optgroup label="Quimestre 1">
						<option selected value="parcial1Q1">Parcial 1</option>
						<option value="parcial2Q1">Parcial 2</option>
						<option value="parcial3Q1">Parcial 3</option>
						<option value="exQ1">Examen</option>
						<option value="q1">Quimestre 1</option>
					</optgroup>

					<optgroup label="Quimestre 1">
						<option value="parcial1Q2">Parcial 1</option>
						<option value="parcial2Q2">Parcial 2</option>
						<option value="parcial3Q2">Parcial 3</option>
						<option value="exQ2">Examen</option>
						<option value="q2">Quimestre 2</option>
					</optgroup>

					<optgroup label="Año Lectivo">
						<option value="AL">Año Lectivo</option>
					</optgroup>
				</select>
			</div>
		</div>
		<!-- se eliminaron el resto, este es replica de los otros -->
		<div id="q1Parcial1">
			<div class="row">
				<div class="col-lg-7">
					<div class="ibox">
						<div class="ibox-content">
							<div class="row no-margins">
								<canvas id="bar-chart-q1p1" width="800" height="450"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<a href="pdf/Estadisticas/8A.pdf" download="Octavo A.pdf" class="pull-right btn btn-primary">
						<i class="fa fa-print btnImpresion color-white"></i> Descargar
					</a>
					<div class="ibox">
						<div class="ibox-title table__bgBlue">
							<h5>RESUMEN</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up color-white"></i>
								</a>
							</div>
						</div>
						<div class="ibox-content">
							<div class=" no-margins estadisticasResumen-container">
								<div class="estadisticasResumen-promedio">
									Promedio del curso:
								</div>
								<div class="estadisticasResumen-nota">
									9.08
								</div>
							</div>
						</div>
					</div>
					<div class="ibox">
						<div class="ibox-title table__bgBlue">
							<h5>DETALLE</h5>
							<div class="ibox-tools">
								<a class="collapse-link">
									<i class="fa fa-chevron-up color-white"></i>
								</a>
							</div>
						</div>
						<div class="ibox-content">
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#CN" data-toggle="collapse" class="no-margin pointer collapsed" aria-expanded="false">&gt; Ciencias Naturales</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="CN" class="nobotton white-bg collapse" aria-expanded="false">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#CO" data-toggle="collapse" class="no-margin pointer">&gt; Comercio</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="CO" class="collapse nobotton white-bg">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#COM" data-toggle="collapse" class="no-margin pointer collapsed" aria-expanded="false">&gt; Computación</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="COM" class="nobotton white-bg collapse" aria-expanded="false">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#DI" data-toggle="collapse" class="no-margin pointer">&gt; Dibujo Técnico</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="DI" class="collapse nobotton white-bg">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#ED" data-toggle="collapse" class="no-margin pointer">&gt; Ed. Cultural y Artística</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="ED" class="collapse nobotton white-bg">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#EDF" data-toggle="collapse" class="no-margin pointer">&gt; Educación Física</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="EDF" class="collapse nobotton white-bg">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#ES" data-toggle="collapse" class="no-margin pointer">&gt; Estudios Sociales</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="ES" class="collapse nobotton white-bg">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#LE" data-toggle="collapse" class="no-margin pointer">&gt; Lengua Extranjera</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="LE" class="collapse nobotton white-bg">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- materia -->
							<div class="a-reporte__materiaPromedio">
								<h4 href="#LL" data-toggle="collapse" class="no-margin pointer">&gt; Lenguaje y Literatura</h4>
								<p class="a-reporte__materiaPromedio--nota no-margin notaBuena">8.71</p>
							</div>
							<div id="LL" class="collapse nobotton white-bg">
								<div class="ibox">
									<div class="pined-table-responsive">
										<table class="s-calificaciones w100 s-calificaciones--trGris">
											<tbody>
												<tr class="table__bgBlue">
													<td class=" no-border">Rango</td>
													<td class="no-border">Descripción</td>
													<td class="no-border">#</td>
													<td class="no-border">%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
												<tr>
													<td>9-10</td>
													<td>Domina los aprendizajes requeridos</td>
													<td>5</td>
													<td>33%</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
</div>
</div>
</div>
<!-- Script del Select -->
<script src="js/chart.min.js"></script>
<script>
	function myFunction() {
		var seleccion = document.getElementById("mySelect").value;

		if (seleccion === 'parcial1Q1') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'block';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		} else if (seleccion === 'parcial2Q1') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'block';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		} else if (seleccion === 'parcial3Q1') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'block';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		}
		else if (seleccion === 'exQ1') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'block';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		}
		else if (seleccion === 'q1') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'block';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		}
		else if (seleccion === 'parcial1Q2') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'block';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		}
		else if (seleccion === 'parcial2Q2') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'block';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		}
		else if (seleccion === 'parcial3Q2') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'block';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		}
		else if (seleccion === 'exQ2') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'block';
			document.getElementById('q2Final').style.display = 'none';
		}
		else if (seleccion === 'q2') {
			document.getElementById('Final').style.display = 'none';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'block';
		}
		else if (seleccion === 'AL') {
			document.getElementById('Final').style.display = 'block';
			document.getElementById('q1Parcial1').style.display = 'none';
			document.getElementById('q1Parcial2').style.display = 'none';
			document.getElementById('q1Parcial3').style.display = 'none';
			document.getElementById('q1Examen').style.display = 'none';
			document.getElementById('q1Final').style.display = 'none';
			document.getElementById('q2Parcial1').style.display = 'none';
			document.getElementById('q2Parcial2').style.display = 'none';
			document.getElementById('q2Parcial3').style.display = 'none';
			document.getElementById('q2Examen').style.display = 'none';
			document.getElementById('q2Final').style.display = 'none';
		}
	}
</script>

<!-- Anual -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [8.71, 8.66, 8.84, 8.53, 8.69, 9.1, 9.59, 8.96, 9.23, 8.86, 9.36, 10, 9.51, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q1 - P1 -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q1p1"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [8.33, 8.15, 9.20, 9.73, 8.80, 9.54, 8.47, 8.39, 8.76, 8.33, 9.44, "EX", 9.58, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q1 - P2 -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q1p2"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [7.52, 8.50, 8.18, 9.66, 9.32, 10, 8.85, 8.33, 8.57, 7.58, 8.93, "EX", 9.04, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q1 - P3 -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q1p3"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [9.11, 8.03, 8.40, 9.52, 9.63, 8.73, 8.96, 8.96, 8.46, 8.82, 8.94, "EX", 9.97, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q1 - Examen -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q1ex"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [6.26, 8.51, 7.40, 9.66, 8.53, 8.00, 8.90, 8.23, 7.73, 7.06, 9.06, 10.00, 10.00, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q1 -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q1"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [7.91, 8.28, 8.35, 9.64, 9.10, 9.13, 8.78, 8.49, 8.42, 8.00, 9.09, 10, 9.62, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q2 - P1 -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q2p1"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [9.27, 9.14, 9.67, 9.59, 8.81, 9.29, 8.85, 9.25, 9.23, 9.07, 9.88, "EX", 9.42, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q2 - P2 -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q2p2"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [9.42, 9.17, 9.68, 9.29, 8.43, 9.52, 9.14, 9.27, 9.50, 9.02, 9.35, "EX", 9.70, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q2 - P3 -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q2p3"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [9.35, 9.16, 9.68, 9.44, 8.73, 9.40, 9, 9.26, 9.30, 9.06, 9.62, "EX", 9.54, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q2 - Examen -->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q2ex"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [9.29, 8.86, 9.14, 9.05, 9.10, 9.62, 9.55, 8.70, 9.33, 8.94, 9.50, 10.00, 9.40, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script>
<!-- Q2-->
<script type="text/javascript">
	new Chart(document.getElementById("bar-chart-q2"), {
		type: 'bar',
		data: {
			labels: ["Ciencias Naturales", "Comercio", "Computación", "Dibujo Técnico", "Ed. Cultural y Art.", "Educación Física", "Estudios Sociales", "Lengua Extranjera", "Lengua y Literatura", "Matemáticas", "Música", "Proyectos Educativos", "Valores Humanos"],
			datasets: [
				{
					label: "",
					backgroundColor: ["#A93226", "#884EA0", "#2471A3", "#229954", "#D4AC0D", "#CA6F1E", "#2E4053", "#CB4335", "#7D3C98", "#2E86C1", "#138D75", "#28B463", "#A93226"],
					data: [9.29, 8.86, 9.14, 9.05, 9.10, 9.62, 9.55, 8.70, 9.33, 8.94, 9.5, 10, 9.4, 0, 10]
				}
			]
		},
		options: {
			legend: { display: false },
			title: {
				display: true
			}
		}
	});
</script> @endsection