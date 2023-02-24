<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISTRED | RECTOR</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="profile-element">
                            <img alt="image" class="img-circle" src="img/secretaria.jpg" width="40%" />
                            <a href="#">
                                <span class="block ">
                                    <h4>
                                        <strong class="font-bold">TERESA CORREA ZAMBRANO</strong>
                                        <br>
                                        <small class="profile-type">SECRETARIA</small>
                                    </h4>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">
                            <img alt="logo" src="img/logo unico.png" width="50px" />
                        </div>
                    </li>
                    <li>
                        <a href="secretaria.php">
                            <i class="fa fa-th-large"></i>
                            <span class="nav-label">Mi Perfil</span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_institucion.php">
                            <i class="fa fa-institution"></i>
                            <span class="nav-label">Institucion</span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_notificacion.php">
                            <i class="fa fa-globe"></i>
                            <span class="nav-label">Notificaciones</span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_calendario.php">
                            <i class="fa fa-calendar"></i>
                            <span class="nav-label">Calendario Academico</span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_asistencia.php">
                            <i class="fa fa-check-square-o"></i>
                            <span class="nav-label">Asistencia</span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_horarios.php">
                            <i class="fa fa-clock-o"></i>
                            <span class="nav-label">Horarios</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <i class="fa fa-group"></i>
                            <span class="nav-label">Fichas Personales </span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="secretaria_personal.php">Personal Administrativo </a>
                            </li>
                            <li>
                                <a href="secretaria_profesores.php">Docentes </a>
                            </li>
                            <li>
                                <a href="secretaria_alumnos.php">Estudiantes </a>
                            </li>
                            <li>
                                <a href="secretaria_representantes.php">.R. </a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a>
                            <i class="fa fa-bookmark"></i>
                            <span class="nav-label">Grados </span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="secretaria_agenda.php">Agenda Escolar </a>
                            </li>
                            <li>
                                <a href="secretaria_asistencia.php">Asistencia Escolar </a>
                            </li>
                            <li>
                                <a href="secretaria_calificaciones.php">Calificaciones </a>
                            </li>
                            <li>
                                <a href="secretaria_estadisticas.php">Estadísticas </a>
                            </li>
                            <li>
                                <a href="secretaria_lista.php">Lista </a>
                            </li>
                            <li class="active">
                                <a href="secretaria_ranking.php">Ranking </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="secretaria_reportes.php">
                            <i class="fa fa-clipboard"></i>
                            <span class="nav-label">Reportes </span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_matricula.php">
                            <i class="fa fa-newspaper-o"></i>
                            <span class="nav-label">Matrícula </span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_planificaciones.php">
                            <i class="fa fa-folder"></i>
                            <span class="nav-label">Planificaciones</span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_historial.php">
                            <i class="fa fa-star"></i>
                            <span class="nav-label">Historial de Uso</span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_configuraciones.php">
                            <i class="fa fa-cogs"></i>
                            <span class="nav-label">Configuraciones</span>
                        </a>
                    </li>
                    <li>
                        <a href="secretaria_soporte.php">
                            <i class="fa fa-comments-o"></i>
                            <span class="nav-label">Soporte</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#" id="menu-desplegable">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="count-info" href="profesor_notificaciones.php">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-warning">1</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="count-info" href="profesor_notificaciones.php">
                                <i class="fa fa-bell"></i>
                                <span class="label label-primary">1</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i>Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row wrapper white-bg">
                <div class="col-lg-12">
                    <h2 class="title-page">Grados
                        <small> Ranking Académico</small>
                    </h2>
                </div>
            </div>
            <div class="row mb350">
                <div class="col-lg-12">
                    <div class="widget widget-tabs bg-none">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li>
                                    <a data-toggle="tab" href="#tab-1">Educación Inicial (0)</a>
                                </li>
                                <li class="active">
                                    <a data-toggle="tab" href="#tab-2">Educación General Básica (6)</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3">Bachillerato General Unificado (9)</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane">
                                    <div class="alert alert-success">
                                        <strong>Uppss!</strong> No tiene información a mostrar.
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane active">
                                    <div class="alert alert-success">
                                        <strong>Uppss!</strong> No tiene información a mostrar.
                                    </div>
                                </div>
                                <div id="tab-3" class="tab-pane">
                                    <div class="alert alert-success">
                                        <strong>Uppss!</strong> No tiene información a mostrar.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/theme-js.js"></script>
</body>

</html>