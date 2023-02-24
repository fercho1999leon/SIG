<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ISTRED | Representante</title>

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
                            <img alt="image" class="img-circle" src="img/icono-representante.jpg" width="40%" />
                            <a href="#">
                                <span class="block ">
                                    <h4>
                                        <strong class="font-bold">CINTHIA HERA RODRIGUEZ</strong>
                                        <br>
                                        <small class="profile-type">REPRESENTANTE</small>
                                    </h4>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">
                            <img alt="logo" src="img/logo unico.png" width="50px" />
                        </div>
                    </li>
                    <li>
                        <a href="padre.php">
                            <i class="fa fa-th-large"></i>
                            <span class="nav-label">Mi Perfil</span>
                        </a>
                    </li>
                    <li>
                        <a href="padre_institucion.php">
                            <i class="fa fa-institution"></i>
                            <span class="nav-label">Institucion</span>
                        </a>
                    </li>
                    <li>
                        <a href="padre_notificacion.php">
                            <img src="img/notificaciones.svg" alt="" width="17">
                            <span class="nav-label">Notificaciones </span>
                            <span class="label label-warning">Nuevo</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <img src="img/icono persona white.png" width="15px">
                            <span class="nav-label">Alumno</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="padre_hijo1.php">
                                    <img src="img/icono_persona.png" width="20px"> ELKIN DAVID SANNA HERA</a>
                            </li>
                            <li>
                                <a href="padre_hijo2.php">
                                    <img src="img/icono_persona.png" width="20px"> ALAN JOEL SANNA HERA</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="padre_calendario.php">
                            <i class="fa fa-calendar"></i>
                            <span class="nav-label">Calendario Academico</span>
                        </a>
                    </li>
                    <li class="active">
                        <a>
                            <img src="img/pago.png" width="15px">
                            <span class="nav-label">Pagos</span>

                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#" id="menu-desplegable">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="count-info" href="padre_notificacion.php">
                                <img src="img/notificaciones.svg" alt="" width="17">
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
            <div class="row wrapper white-bg mb-1">
                <div class="padre-pago">
                    <div class="profile-image">
                        <img src="img/hijo1.png" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <h2 class="no-margins">ELKIN DAVID SANNA HERA</h2>
                        <p>
                            <h3>
                                <strong>CURSO:</strong> Tercero Bachillerato "A"
                            </h3>
                        </p>
                        <p>
                            <h3>
                                <strong>DIRIGENTE:</strong> José Pazmiño
                            </h3>
                        </p>
                    </div>
                    <div class="container-notificacion">
                        <div class="notificacion">
                            <a href="padre_pago_historico1.php">
                                <span class="mensajes">
                                    <figure class="simboloDolar2">
                                        <img src="img/moneda.svg" alt="" width="18">
                                    </figure>
                                    <label class="label-n texto-mensajes">Histórico
                                        <label>
                                </span>
                            </a>
                        </div>
                        <div class="notificacion">
                            <a href="padre_pago_realizar1.php">
                                <span class="notificaciones">
                                    <figure class="simboloDolar">
                                        <img src="img/simbolo-de-dolar.svg" alt="" width="18">
                                    </figure>
                                    <label class="label-n texto-notificaciones">Realizar Pagos
                                        <label>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row wrapper white-bg mb-1">
                <div class="padre-pago">
                    <div class="profile-image">
                        <img src="img/hijo2.png" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <h2 class="no-margins">ALAN JOEL SANNA HERA</h2>
                        <p>
                            <h3>
                                <strong>CURSO:</strong> Tercero Bachillerato "A"
                            </h3>
                        </p>
                        <p>
                            <h3>
                                <strong>DIRIGENTE:</strong> José Pazmiño
                            </h3>
                        </p>
                    </div>
                    <div class="container-notificacion">
                        <div class="notificacion">
                            <a href="padre_pago_historico2.php">
                                <span class="mensajes">
                                    <figure class="simboloDolar2">
                                        <img src="img/moneda.svg" alt="" width="18">
                                    </figure>
                                    <label class="label-n texto-mensajes">Histórico
                                        <label>
                                </span>
                            </a>
                        </div>
                        <div class="notificacion">
                            <a href="padre_pago_realizar2.php">
                                <span class="notificaciones">
                                    <figure class="simboloDolar">
                                        <img src="img/simbolo-de-dolar.svg" alt="" width="18">
                                    </figure>
                                    <label class="label-n texto-notificaciones">Realizar Pagos
                                        <label>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/theme-js.js"></script>
</body>

</html>