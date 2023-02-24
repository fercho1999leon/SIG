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
    <a class="button-br" href="padre_pago_realizar1.php">
        <button>
            <img src="img/return.png" alt="" width="17">Regresar
        </button>
    </a>
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
                            <span class="nav-label" style="padding-left:8px">Alumno</span>
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
                    <li class="active">
                        <a href="padre_pago.php">
                            <img src="img/pago.png" width="15px">
                            <span class="nav-label" style="padding-left:8px">Pagos</span>

                        </a>
                    </li>
                </ul>
            </div>

        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
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
                            <h3 style="padding-left:10px">
                                <strong>CURSO:</strong> Tercero Bachillerato "A"
                            </h3>
                        </p>
                        <p>
                            <h3 style="padding-left:10px">
                                <strong>DIRIGENTE:</strong> José Pazmiño
                            </h3>
                        </p>
                    </div>
                    <div class="container-notificacion">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-pad-pag-his">
                <div class="header-pag-his">
                    <div class="notificacion">
                        <span class="notificaciones notificaciones-pago">
                            <figure class="simboloDolar">
                                <img src="img/simbolo-de-dolar.svg" alt="" width="18">
                            </figure>
                            <label class="texto-notificaciones">Realizar Pagos</label>
                        </span>
                    </div>
                    <div class="lista-prof">
                        <select onchange="metodoPago()" class="form-control selectPayment">
                            <option value="none">Elige forma de pago</option>
                            <option value="pagoDeposito">Deposito / Transferencia</option>
                            <option value='pagoTarjeta'>Tarjeta de credito</option>
                            <option value='pagoCheque'>Cheque (Informacion)</option>
                        </select>
                    </div>
                </div>
                <div class="bg-w-table">
                    <div class="table-responsive">
                        <table class="table-pag-hist table">
                            <thead>
                                <tr>
                                    <th>Año Lectivo</th>
                                    <th>Quimestral</th>
                                    <th>Descripcion</th>
                                    <th>Valor</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PERIODO 2016 - 2017</td>
                                    <td>SEGUNDO</td>
                                    <td>Pension de FEBRERO</td>
                                    <td>$80.00</td>
                                    <td class="pago-pendiente">Pendiente</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tarjetaDeCredito">
                    <div class="containerPayment">

                        <h1>Tarjeta de Credito</h1>
                        <form action="">
                            <span class="fieldRow">
                                <input id="name" type="name" placeholder="" / required>
                                <label for="name">First name</label>
                                <i for="name" class="fa fa-user"></i>
                            </span>

                            <span class="fieldRow">
                                <input id="surname" type="name" placeholder="" / required>
                                <label for="surname">Last name</label>
                                <i for="surname" class="fa fa-user"></i>
                            </span>

                            <div class="blank_space">
                                <span class="fieldRow credit_card">
                                    <input id="cc" class="credit_card_number" type="text" placeholder="" / required>
                                    <label for="cc">Credit card number</label>
                                    <i for="cc" class="fa fa-credit-card"></i>
                                    <div class="closeBtn">
                                        <i class="fa fa-times"></i>
                                    </div>
                                </span>
                            </div>
                            <div class="cvvDate">
                                <span class="fieldRow col2">
                                    <input class="cvv" type="number" placeholder="XXX" max="999" required>
                                    <label for="cvv">CVV</label>
                                    <i for="cvv" class="fa fa-lock"></i>
                                </span>

                                <span class="fieldRow col2 last">
                                    <input id="date" type="text" placeholder="mm/yy" / required>
                                    <label for="date">Date</label>
                                    <i for="date" class="fa  fa-calendar"></i>
                                </span>
                            </div>
                            <div class="montoAPagar">
                                <h2 class="text-left">Monto a pagar: $80.00</h2>
                            </div>
                            <button class="buttonPay" type="submit">PAGAR</button>
                        </form>
                    </div>
                    <div class="overlay"></div>
                </div>
                <div id="transferencia">
                    <h1 class="text-center">Deposito - Transferencia</h1>
                    <form action="">
                        <select class="form-control" name="" id="repTransBanco" style="margin-bottom: 1em;">
                            <option value="">Elige un banco</option>
                            <option value="bancoGuayaquil">Banco de Guayaquil</option>
                            <option value="produbanco">Produbanco</option>
                        </select>
                        <div class="repTransInformacion" style="display: none;">
                            <label for="">Numero de cuenta</label>
                            <input class="mt-1" type="number" style="margin-top: 0" value="1234567894563214" disabled="">
                            <input class="mt-1" id="repTransPap" type="number" placeholder="Numero de papeleta" required style="margin-top: 0" placeholder="Numero de papeleta">
                            <div class="totalaPagar valor-cancelado">
                                <select name="" id="transferenciaSelectTotal" class="form-control" disabled>
                                    <option value="">VALOR CANCELADO</option>
                                </select>
                                <span class="input d-f ai-c">
                                    <span>$</span>
                                    <input id="repTransTotal" type="number" min="0.01" step="0.01" max="2500">
                                </span>
                            </div>
                            <div class="filePago">
                                <div class="box">
                                    <input type="file" name="file-7[]" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected"
                                        multiple />
                                    <label for="file-7">
                                        <span></span>
                                        <strong> Escoje un archivo&hellip;</strong>
                                    </label>
                                </div>
                                <input class="repTransEnviar" type="submit" value="Enviar" disabled>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="cheque">
                    <h1 class="text-center">Pago con cheque</h1>
                    <form action="">
                        <!-- <label for="">Numero de cheque</label> -->
                        <input type="text" placeholder="Número de cheque">
                        <select name="" id="chequeSelect" class="form-control mb-1">
                            <option value="" selected>Elige un banco</option>
                            <option value="bancoGuayaquil">Banco de Guayaquil</option>
                            <option value="produbanco">Produbanco</option>
                        </select>
                        <div class="chequeInformacion">
                            <div>
                                <label for="">Numero de cuenta</label>
                                <input id="cheque-numero-cuenta" type="text" class="pagoConCheque" placeholder="Numero de cuenta" value="129573" disabled>
                            </div>
                            <div class="totalaPagar">
                                <select name="" id="chequeSelectTotal" class="form-control">
                                    <option value="">Elegir</option>
                                    <option value="totalapagar">TOTAL A PAGAR</option>
                                    <option id="cheque-totalAPagar" value="abonar">ABONAR</option>
                                </select>
                                <span class="input d-f ai-c">
                                    <span>$</span>
                                    <input id="chequeInp" type="number" min="0.01" step="0.01" max="2500" disabled>
                                </span>
                            </div>
                            <div class="filePago">
                                <!--   <h2>Papeleta</h2>
                            <label for="pagoI">Seleccionar Archivo. . .</label>
                            <input type="file" class="pagoI" id="pagoI" placeholder="Papeleta" required> -->
                                <div class="box">
                                    <input type="file" name="file-7[]" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected"
                                        multiple />
                                    <label for="file-7">
                                        <span></span>
                                        <strong> Escoje un archivo&hellip;</strong>
                                    </label>
                                </div>
                                <input type="submit" class="chequeInpEnviar" value="Enviar" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/theme-js.js"></script>
</body>

</html>