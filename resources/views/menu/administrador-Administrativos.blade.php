<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="profile-element">
					<img alt="image" class="img-circle" src="img/user.png" width="25%" />
					<a href="#">
						<span class="block ">
							<h4 class="uppercase">
								<strong class="font-bold">{{ Sentinel::getUser()->first_name }}</strong>
								<br>
								<small class="profile-type">Administrador</small>
							</h4>
						</span>
					</a>
				</div>
				<div class="logo-element">
					<img alt="logo" src="img/logo unico.png" width="50px" />
				</div>
			</li>
			<li>
				<a href="{{ route('home') }}">
					<i class="fa fa-th-large"></i>
					<span class="nav-label">Mi Perfil </span>
				</a>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-globe"></i>
					<span class="nav-label">Notificaciones  </span>
				</a>
			</li>
			<li>
				<a>
					<i class="fa fa-institution"></i>
					<span class="nav-label">Institución </span>
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					<li>
						<a href="{{ route('institucion') }}">Información </a>
					</li>
					<li>
						<a class="pagina-inactiva" href="#">Grados/Paralelos </a>
					</li>
					<li>
						<a class="pagina-inactiva" href="#">Materias/Asignaturas </a>
					</li>
					<li>
						<a class="pagina-inactiva" href="#">Docentes </a>
					</li>
					<li>
						<a class="pagina-inactiva" href="#">Año Lectivo </a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-bookmark"></i>
					<span class="nav-label">Grados </span>
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					<li>
						<a href="#" class="pagina-inactiva">Información </a>
					</li>
					<li>
						<a href="#" class="pagina-inactiva">Agenda Escolar </a>
					</li>
					<li>
						<a href="#" class="pagina-inactiva">Calificaciones </a>
					</li>
					<li>
						<a href="#" class="pagina-inactiva">Lista </a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-check-square-o"></i>
					<span class="nav-label">Asistencia Estudiantil</span>
				</a>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-clock-o"></i>
					<span class="nav-label">Horario Escolar </span>
				</a>
			</li>
			<li>
				<a href="director_reportes.php" class="pagina-inactiva">
					<i class="fa fa-clipboard"></i>
					<span class="nav-label">Reportes </span>
				</a>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-usd"></i>
					<span class="nav-label">Pagos </span>
				</a>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-calendar"></i>
					<span class="nav-label">Calendario Académico </span>
				</a>
			</li>
			<li class="active">
				<a href="#">
					<i class="fa fa-group"></i>
					<span class="nav-label">Fichas Personales </span>
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					<li class="active">
						<a href="{{ route('administratives.index') }}">Administrativos </a>
					</li>
					<li>
						<a href="{{ route('teachers.index') }}">Docentes </a>
					</li>
					<li>
						<a href="{{ route('studentsFiles.index') }}">Estudiantes </a>
					</li>
					<!--
					<li>
						<a href="{{ route('representativesFiles.index') }}">.R. </a>
					</li>-->
				</ul>
			</li>
			<li>
				<a href="{{ route('students.index') }}">
					<i class="fa fa-newspaper-o"></i>
					<span class="nav-label">MatrículaK </span>
				</a>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-star"></i>
					<span class="nav-label">Historial de Uso</span>
				</a>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-cogs"></i>
					<span class="nav-label">Configuraciones</span>
				</a>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-comments-o"></i>
					<span class="nav-label">Soporte</span>
				</a>
			</li>
			<li>
				<a href="#" class="pagina-inactiva">
					<i class="fa fa-comments-o"></i>
					<span class="nav-label">Biblioteca</span>
				</a>
			</li>
		</ul>
	</div>
</nav>