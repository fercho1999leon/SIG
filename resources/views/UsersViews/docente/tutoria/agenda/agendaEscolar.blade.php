@extends('layouts.master') @section('content')
<div id="wrapper">
	@include('layouts.nav_bar_top')
	<div id="page-wrapper" class="gray-bg dashbard-1">
		<div class="row wrapper white-bg noBefore titulo-separacion">
			<h2 class="title-page">"AGENDA"
				<small class="text-color7 bold"> Octavo A</small>
			</h2>
			<div class="btn-group">
				<a class="btn btn-primary" href="#">
					<i class="fa fa-download"></i> Descargas</a>
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="#"> General</a>
					</li>
					<li>
						<a href="#"> Estudiantes</a>
					</li>
					<li>
						<a href="#"> Horario</a>
					</li>
					<li>
						<a href="#"> Clases</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-sm-6 mb-1">
					<button type="button" class="btn btn-w-m btn-primary" data-toggle="modal" data-target="#myModal">Semana Anterior</button>
				</div>
			</div>
			<div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header d-modalSemana--title">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close2</span>
							</button>
							<h2 class="text-left">
								<i class="fa fa-calendar fa-x"></i> | Elija una semana
							</h2>
						</div>
						<div class="modal-body">
							<div class="typeOfCourse text-center">
								<a href="#q1" data-toggle="collapse" class="d-semanaQuimestre--button">
									Quimestre 1
								</a>
								<div id="q1" class="collapse">
									<div class="d-semanaQuimestre-grid">
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color7" colspan="7">
														MAYO 2016
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td data-dismiss="modal">
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
													<td>
														<a data-dismiss="modal">5</a>
													</td>
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
													<td>
														<a data-dismiss="modal">12</a>
													</td>
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
													<td>
														<a data-dismiss="modal">19</a>
													</td>
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
													<td>
														<a data-dismiss="modal">26</a>
													</td>
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td>
														<a data-dismiss="modal">28</a>
													</td>
													<td>
														<a data-dismiss="modal">29</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">30</a>
													</td>
													<td>
														<a data-dismiss="modal">31</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
													<td class="d-modalQuimestre__diasMesSiguiente">2</td>
													<td class="d-modalQuimestre__diasMesSiguiente">3</td>
													<td class="d-modalQuimestre__diasMesSiguiente">5</td>
													<td class="d-modalQuimestre__diasMesSiguiente">6</td>
												</tr>
											</tbody>
										</table>
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color8" colspan="7">
														JUNIO 2016
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td class="d-modalQuimestre__diasMesSiguiente">30</td>
													<td class="d-modalQuimestre__diasMesSiguiente">31</td>
													<td>
														<a data-dismiss="modal">1</a>
													</td>
													<td>
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
													<td>
														<a data-dismiss="modal">5</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
													<td>
														<a data-dismiss="modal">12</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
													<td>
														<a data-dismiss="modal">19</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
													<td>
														<a data-dismiss="modal">26</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td>
														<a data-dismiss="modal">28</a>
													</td>
													<td>
														<a data-dismiss="modal">29</a>
													</td>
													<td>
														<a data-dismiss="modal">30</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
													<td class="d-modalQuimestre__diasMesSiguiente">2</td>
													<td class="d-modalQuimestre__diasMesSiguiente">3</td>
												</tr>
											</tbody>
										</table>
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color9" colspan="7">
														JULIO 2016
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td class="d-modalQuimestre__diasMesSiguiente">27</td>
													<td class="d-modalQuimestre__diasMesSiguiente">28</td>
													<td class="d-modalQuimestre__diasMesSiguiente">29</td>
													<td class="d-modalQuimestre__diasMesSiguiente">30</td>
													<td>
														<a data-dismiss="modal">1</a>
													</td>
													<td>
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">4</a>
													</td>
													<td>
														<a data-dismiss="modal">5</a>
													</td>
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">11</a>
													</td>
													<td>
														<a data-dismiss="modal">12</a>
													</td>
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">18</a>
													</td>
													<td>
														<a data-dismiss="modal">19</a>
													</td>
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">25</a>
													</td>
													<td>
														<a data-dismiss="modal">26</a>
													</td>
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td>
														<a data-dismiss="modal">28</a>
													</td>
													<td>
														<a data-dismiss="modal">29</a>
													</td>
													<td>
														<a data-dismiss="modal">30</a>
													</td>
													<td>
														<a data-dismiss="modal">31</a>
													</td>
												</tr>
											</tbody>
										</table>
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color1" colspan="7">
														AGOSTO 2016
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">1</a>
													</td>
													<td>
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
													<td>
														<a data-dismiss="modal">5</a>
													</td>
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">8</a>
													</td>
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
													<td>
														<a data-dismiss="modal">12</a>
													</td>
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">15</a>
													</td>
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
													<td>
														<a data-dismiss="modal">19</a>
													</td>
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">22</a>
													</td>
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
													<td>
														<a data-dismiss="modal">26</a>
													</td>
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td>
														<a data-dismiss="modal">28</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">29</a>
													</td>
													<td>
														<a data-dismiss="modal">30</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">31</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
													<td class="d-modalQuimestre__diasMesSiguiente">2</td>
													<td class="d-modalQuimestre__diasMesSiguiente">3</td>
													<td class="d-modalQuimestre__diasMesSiguiente">4</td>
												</tr>
											</tbody>
										</table>
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color2" colspan="7">
														SEPTIEMBRE 2016
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td class="d-modalQuimestre__diasMesSiguiente">29</td>
													<td class="d-modalQuimestre__diasMesSiguiente">30</td>
													<td class="d-modalQuimestre__diasMesSiguiente">31</td>
													<td>
														<a data-dismiss="modal">1</a>
													</td>
													<td>
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">5</a>
													</td>
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">12</a>
													</td>
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">19</a>
													</td>
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">26</a>
													</td>
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">28</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">29</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">30</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
													<td class="d-modalQuimestre__diasMesSiguiente">2</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="typeOfCourse text-center">
								<a href="#q2" data-toggle="collapse" class="d-semanaQuimestre--button">
									Quimestre 2
								</a>
								<div id="q2" class="collapse">
									<div class="d-semanaQuimestre-grid">
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color2" colspan="7">
														OCTUBRE 2016
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
													<td>
														<a data-dismiss="modal">5</a>
													</td>
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
													<td>
														<a data-dismiss="modal">9</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
													<td>
														<a data-dismiss="modal">12</a>
													</td>
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
													<td>
														<a data-dismiss="modal">16</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
													<td>
														<a data-dismiss="modal">19</a>
													</td>
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
													<td>
														<a data-dismiss="modal">23</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
													<td>
														<a data-dismiss="modal">26</a>
													</td>
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td>
														<a data-dismiss="modal">28</a>
													</td>
													<td>
														<a data-dismiss="modal">29</a>
													</td>
													<td>
														<a data-dismiss="modal">30</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">31</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
													<td class="d-modalQuimestre__diasMesSiguiente">2</td>
													<td class="d-modalQuimestre__diasMesSiguiente">3</td>
													<td class="d-modalQuimestre__diasMesSiguiente">4</td>
													<td class="d-modalQuimestre__diasMesSiguiente">5</td>
													<td class="d-modalQuimestre__diasMesSiguiente">6</td>
												</tr>
											</tbody>
										</table>
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color3" colspan="7">
														NOVIEMBRE 2016
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td class="d-modalQuimestre__diasMesSiguiente">31</td>
													<td>
														<a data-dismiss="modal">1</a>
													</td>
													<td>
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
													<td>
														<a data-dismiss="modal">5</a>
													</td>
													<td>
														<a data-dismiss="modal">6</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
													<td>
														<a data-dismiss="modal">12</a>
													</td>
													<td>
														<a data-dismiss="modal">13</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
													<td>
														<a data-dismiss="modal">19</a>
													</td>
													<td>
														<a data-dismiss="modal">20</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
													<td>
														<a data-dismiss="modal">26</a>
													</td>
													<td>
														<a data-dismiss="modal">27</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">28</a>
													</td>
													<td>
														<a data-dismiss="modal">29</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">30</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
													<td class="d-modalQuimestre__diasMesSiguiente">2</td>
													<td class="d-modalQuimestre__diasMesSiguiente">3</td>
													<td class="d-modalQuimestre__diasMesSiguiente">4</td>
												</tr>
											</tbody>
										</table>
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color4" colspan="7">
														DICIEMBRE 2016
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td class="d-modalQuimestre__diasMesSiguiente">28</td>
													<td class="d-modalQuimestre__diasMesSiguiente">29</td>
													<td class="d-modalQuimestre__diasMesSiguiente">30</td>
													<td>
														<a data-dismiss="modal">1</a>
													</td>
													<td>
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">5</a>
													</td>
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">12</a>
													</td>
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">19</a>
													</td>
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">26</a>
													</td>
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">28</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">29</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">30</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">
														<a data-dismiss="modal">31</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
												</tr>
											</tbody>
										</table>
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color5" colspan="7">
														ENERO 2017
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
													<td>
														<a data-dismiss="modal">5</a>
													</td>
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
													<td>
														<a data-dismiss="modal">12</a>
													</td>
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
													<td>
														<a data-dismiss="modal">19</a>
													</td>
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
													<td>
														<a data-dismiss="modal">26</a>
													</td>
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td>
														<a data-dismiss="modal">28</a>
													</td>
													<td>
														<a data-dismiss="modal">29</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">30</a>
													</td>
													<td>
														<a data-dismiss="modal">31</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
													<td class="d-modalQuimestre__diasMesSiguiente">2</td>
													<td class="d-modalQuimestre__diasMesSiguiente">3</td>
													<td class="d-modalQuimestre__diasMesSiguiente">4</td>
													<td class="d-modalQuimestre__diasMesSiguiente">5</td>
												</tr>
											</tbody>
										</table>
										<table class="table d-modalQuimestre--table">
											<thead class="text-center">
												<tr>
													<th class="text-center d-modalQuimestre__mes bg_color14" colspan="7">
														FEBRERO 2017
													</th>
												</tr>
												<tr>
													<th class="text-center d-modalQuimestre__dias">
														Lunes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Martes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Miércoles
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Jueves
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Viernes
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Sábado
													</th>
													<th class="text-center d-modalQuimestre__dias">
														Domingo
													</th>
												</tr>
											</thead>
											<tbody>
												<tr class="text-center">
													<td class="d-modalQuimestre__diasMesSiguiente">30</td>
													<td class="d-modalQuimestre__diasMesSiguiente">31</td>
													<td>
														<a data-dismiss="modal">1</a>
													</td>
													<td>
														<a data-dismiss="modal">2</a>
													</td>
													<td>
														<a data-dismiss="modal">3</a>
													</td>
													<td>
														<a data-dismiss="modal">4</a>
													</td>
													<td>
														<a data-dismiss="modal">5</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">6</a>
													</td>
													<td>
														<a data-dismiss="modal">7</a>
													</td>
													<td>
														<a data-dismiss="modal">8</a>
													</td>
													<td>
														<a data-dismiss="modal">9</a>
													</td>
													<td>
														<a data-dismiss="modal">10</a>
													</td>
													<td>
														<a data-dismiss="modal">11</a>
													</td>
													<td>
														<a data-dismiss="modal">12</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">13</a>
													</td>
													<td>
														<a data-dismiss="modal">14</a>
													</td>
													<td>
														<a data-dismiss="modal">15</a>
													</td>
													<td>
														<a data-dismiss="modal">16</a>
													</td>
													<td>
														<a data-dismiss="modal">17</a>
													</td>
													<td>
														<a data-dismiss="modal">18</a>
													</td>
													<td>
														<a data-dismiss="modal">19</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">20</a>
													</td>
													<td>
														<a data-dismiss="modal">21</a>
													</td>
													<td>
														<a data-dismiss="modal">22</a>
													</td>
													<td>
														<a data-dismiss="modal">23</a>
													</td>
													<td>
														<a data-dismiss="modal">24</a>
													</td>
													<td>
														<a data-dismiss="modal">25</a>
													</td>
													<td>
														<a data-dismiss="modal">26</a>
													</td>
												</tr>
												<tr class="text-center">
													<td>
														<a data-dismiss="modal">27</a>
													</td>
													<td>
														<a data-dismiss="modal">28</a>
													</td>
													<td class="d-modalQuimestre__diasMesSiguiente">1</td>
													<td class="d-modalQuimestre__diasMesSiguiente">2</td>
													<td class="d-modalQuimestre__diasMesSiguiente">3</td>
													<td class="d-modalQuimestre__diasMesSiguiente">4</td>
													<td class="d-modalQuimestre__diasMesSiguiente">5</td>
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
			<div class="row">
				<div class="col-lg-12">
					<div class="tabs-container">
						<ul class="de_tabs nav nav-tabs text-center noBefore">
							<li class="active">
								<a data-toggle="tab" class="tabsDias" href="#tab-1s">LUNES</a>
							</li>
							<li>
								<a data-toggle="tab" class="tabsDias" href="#tab-2s">MARTES</a>
							</li>
							<li>
								<a data-toggle="tab" class="tabsDias" href="#tab-3s">MIERCOLES</a>
							</li>
							<li>
								<a data-toggle="tab" class="tabsDias" href="#tab-4s">JUEVES</a>
							</li>
							<li>
								<a data-toggle="tab" class="tabsDias" href="#tab-5s">VIERNES</a>
							</li>
						</ul>
						<div class="tab-content dir_ae">
							<div id="tab-1s" class="tab-pane active">
								<div class="ibox-content" id="agenda-curso">
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>1</span>
												</span>
												<span class="c-hour">7:00
													<br>7:45</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>3RO BACHILLERATO CONTABILIDAD</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<a href="#" class="d-agendaEscolar-verMas">ver más</a>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>2</span>
												</span>
												<span class="c-hour">7:45
													<br>8:30</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>3RO BACHILLERATO CIENTÍFICO</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>3</span>
												</span>
												<span class="c-hour">8:30
													<br>9:15</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO B</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>6</span>
												</span>
												<span class="c-hour">11:15
													<br>12:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>8</span>
												</span>
												<span class="c-hour">13:15
													<br>14:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div id="tab-2s" class="tab-pane">
								<div class="ibox-content" id="agenda-curso">

									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>1</span>
												</span>
												<span class="c-hour">7:00
													<br>7:45</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO B</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>2</span>
												</span>
												<span class="c-hour">7:45
													<br>8:30</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>3RO BACHILLERATO CONTABILIDAD</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>3</span>
												</span>
												<span class="c-hour">8:30
													<br>9:15</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>3RO BACHILLERATO INFORMÁTICA</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>4</span>
												</span>
												<span class="c-hour">9:15
													<br>10:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>5</span>
												</span>
												<span class="c-hour">10:30
													<br>11:15</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>6</span>
												</span>
												<span class="c-hour">11:15
													<br>12:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>NOVENO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>7</span>
												</span>
												<span class="c-hour">12:00
													<br>12:45</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>NOVENO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>9</span>
												</span>
												<span class="c-hour">13:15
													<br>14:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>1RO BACHILLERATO CIENTÍFICO</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div id="tab-3s" class="tab-pane">
								<div class="ibox-content" id="agenda-curso">

									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>1</span>
												</span>
												<span class="c-hour">7:00
													<br>7:45</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>3RO BACHILLERATO CIENTÍFICO</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>2</span>
												</span>
												<span class="c-hour">7:45
													<br>8:30</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>2DO BACHILLERATO CIENTÍFICO</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>

									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>6</span>
												</span>
												<span class="c-hour">11:15
													<br>12:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO B</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>7</span>
												</span>
												<span class="c-hour">11:15
													<br>12:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>NOVENO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>8</span>
												</span>
												<span class="c-hour">13:15
													<br>14:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div id="tab-4s" class="tab-pane">
								<div class="ibox-content" id="agenda-curso">

									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>1</span>
												</span>
												<span class="c-hour">7:00
													<br>7:45</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>2</span>
												</span>
												<span class="c-hour">7:45
													<br>8:30</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>1RO BACHILLERATO CIENTÍFICO</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>4</span>
												</span>
												<span class="c-hour">9:15
													<br>10:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>NOVENO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>


									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>7</span>
												</span>
												<span class="c-hour">12:00
													<br>12:45</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>3RO BACHILLERATO CIENTÍFICO</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>8</span>
												</span>
												<span class="c-hour">13:15
													<br>14:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO B</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>9</span>
												</span>
												<span class="c-hour">14:00
													<br>14:45</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>2DO BACHILLERATO INFORMÁTICA</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div id="tab-5s" class="tab-pane">
								<div class="ibox-content" id="agenda-curso">

									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>1</span>
												</span>
												<span class="c-hour">7:00
													<br>7:45</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>NOVENO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>2</span>
												</span>
												<span class="c-hour">7:45
													<br>8:30</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO A</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>3</span>
												</span>
												<span class="c-hour">8:30
													<br>9:15</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>3RO BACHILLERATO INFORMÁTICA</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>5</span>
												</span>
												<span class="c-hour">10:30
													<br>11:15</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO B</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>6</span>
												</span>
												<span class="c-hour">11:15
													<br>12:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>OCTAVO B</strong>
													<span>|</span>
													<strong>MATEMÁTICAS</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="row hora-materia mb-1">
											<div class="col-sm-3 col-md-2 materia_de">
												<span class="hour hour-1">
													<span>8</span>
												</span>
												<span class="c-hour">13:15
													<br>14:00</span>
											</div>
											<div class="col-sm-9 col-md-10 profesor_de">
												<div class="punta"></div>
												<h4 class="title_profesor">
													<strong>3RO BACHILLERATO CONTABILIDAD</strong>
													<span>|</span>
													<strong>INVESTIGACIÓN</strong>
													<span>|</span>
													<button id="COMPUTACION" onclick="modal(this.id)" type="button" class="btn" data-toggle="modal" data-target="#myModal2">ver más</button>
												</h4>
												<p>Descripcion de clase, deberes, talleres o lecciones.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--Modal-->
			<div class="row">
				<div class="col-lg-12">
					<div class="modal inmodal fade modal-dir-agenda" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<div class="row">
										<div class="col-xs-12">
											<div class="modal-dir-agenda-perf">
												<div>
													<img class="d-modalDiario--docente-img" src="img/docentes.png">
												</div>
												<h5>
													CAROLINA QUIROZ SANTOS
													<br>
													<strong>PROFESOR</strong>
													<br>
												</h5>
											</div>
										</div>
										<div class="title-ae">
											<h2>
												<img src="img/diario escolar.png" width="22"> Diario Escolar
											</h2>
										</div>
									</div>
								</div>
								<div class="modal-body">
									<textarea class="form-control" rows="10" placeholder="Descripción de los detalles de la clase"></textarea>
									<br>
									<textarea class="form-control mb-1" rows="2" placeholder="Observaciones"></textarea>
									<div class="d-modalDiario--tarea">
										<label class="mr-05">Tareas Adjuntos:</label>
										<button type="button" class="btn btn-success d-modalDiario--btnCrear-tarea">Crear Tarea</button>
									</div>
									<div class="alert alert-info">
										<strong>Tarea 1</strong> Descripcion de la tarea.
										<small class="pull-right">Vence en xx/xx/xxxx</small>
									</div>
									<div class="alert alert-info">
										<strong>Tarea 2</strong> Descripcion de la tarea.
										<small class="pull-right">Vence en xx/xx/xxxx</small>
									</div>
									<br>
									<label>Archivos Adjuntos:</label>
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<input type="file" name="..." />
										<span class="fileinput-filename"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function mostrar(dato) {
		if (dato == "0") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "1") {
			document.getElementById("mes1q1").style.display = "block";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "2") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "block";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "3") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "block";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "4") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "block";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "5") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "block";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "6") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "block";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "7") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "block";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "8") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "block";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "9") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "block";
			document.getElementById("mes5q2").style.display = "none";
		}
		if (dato == "10") {
			document.getElementById("mes1q1").style.display = "none";
			document.getElementById("mes2q1").style.display = "none";
			document.getElementById("mes3q1").style.display = "none";
			document.getElementById("mes4q1").style.display = "none";
			document.getElementById("mes5q1").style.display = "none";
			document.getElementById("mes1q2").style.display = "none";
			document.getElementById("mes2q2").style.display = "none";
			document.getElementById("mes3q2").style.display = "none";
			document.getElementById("mes4q2").style.display = "none";
			document.getElementById("mes5q2").style.display = "block";
		}
	}
</script> @endsection