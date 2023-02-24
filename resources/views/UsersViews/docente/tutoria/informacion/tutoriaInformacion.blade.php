@extends('layouts.master') @section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
            <div class="row wrapper white-bg ">
                <div class="col-xs-8">
                    <h2 style="margin:0.5em 0">Tutoría:
                        <small style="color: #0099D6; font-weight: bold"> Octavo A</small>
                    </h2>
                </div>
                <div class="col-xs-4" style="padding-top: 10px">
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary" href="#">
                            <i class="fa fa-download"></i> Descargas</a>
                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
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
            </div>
            <div class="row wrapper" style="margin-bottom: 325px">
                <div class="col-lg-12">
                    <div class="widget widget-tabs">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab-1">GENERAL</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2">ESTUDIANTES</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3">HORARIO</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-4">CLASES</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <table class="table table-bordered" width="75%">
                                        <tbody>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span> Curso </span>
                                                </td>
                                                <td> Octavo A-EGB </td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span> Aula Asignada </span>
                                                </td>
                                                <td> NINGUNA </td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span> N. de Estudiantes </span>
                                                </td>
                                                <td>15</td>
                                            </tr>
                                            <tr>
                                                <td width="25%" class="text-right" style="background: #EDF3F4">
                                                    <span> Observación </span>
                                                </td>
                                                <td>NINGUNA</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="row" style="margin-top: 0">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8" center>
                                            <div class="widget widget-tabs" style="padding-top: 0">
                                                <div class="tabs-container">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a data-toggle="tab" href="#tab-est1">
                                                                <i class="fa fa-sort-alpha-asc"></i>Clasificación por Órden</a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="tab" href="#tab-est2">
                                                                <i class="fa fa-male"></i>Estudiantes </a>
                                                        </li>
                                                        <li>
                                                            <a data-toggle="tab" href="#tab-est3">
                                                                <i class="fa fa-female"></i>Estudiantes </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div id="tab-est1" class="tab-pane active">
                                                            <table class="table table-bordered" width="75%">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="10%" class="text-center" style="background: #5BC0DE"> #</th>
                                                                        <th style="background: #5BC0DE"> E S T U D I A N T E</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 1 </span>
                                                                        </td>
                                                                        <td>Arias Ascencio, Shirley</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 2 </span>
                                                                        </td>
                                                                        <td>Arone Saavedra, Bryan</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 3 </span>
                                                                        </td>
                                                                        <td>Caqueo Villarreal, Araceli</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 4 </span>
                                                                        </td>
                                                                        <td>Chamba Flores, Jessenia Gabriela</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 5 </span>
                                                                        </td>
                                                                        <td>Condori Velásquez, Ítalo Javier</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 6 </span>
                                                                        </td>
                                                                        <td>Cruz Cruz, Sonia</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 7 </span>
                                                                        </td>
                                                                        <td>Dávila Ríos, Nathalie Alexandra</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 8 </span>
                                                                        </td>
                                                                        <td>Elons Carrasco, Lenín Máximo</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 9 </span>
                                                                        </td>
                                                                        <td>Mestanza Rodas, Jahaira Kimberly</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 10 </span>
                                                                        </td>
                                                                        <td>Narváez Asencio, Peter Joseph</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 11 </span>
                                                                        </td>
                                                                        <td>Pacheco Vera, Cristhian Alex</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 12 </span>
                                                                        </td>
                                                                        <td>Reyes Nuñez, Luis Alejandro</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 13 </span>
                                                                        </td>
                                                                        <td>Salazar Salazar, Andrea Nicol</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 14 </span>
                                                                        </td>
                                                                        <td>Santiago Raymondi, Karen Alex</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 15 </span>
                                                                        </td>
                                                                        <td>Sifuentes Córdova, Luis David</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div id="tab-est2" class="tab-pane">
                                                            <table class="table table-bordered" width="75%">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="10%" class="text-center" style="background: #5BC0DE"> #</th>
                                                                        <th style="background: #5BC0DE"> E S T U D I A N T E</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 1 </span>
                                                                        </td>
                                                                        <td>Arone Saavedra, Bryan</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 2 </span>
                                                                        </td>
                                                                        <td>Condori Velásquez, Ítalo Javier</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 3 </span>
                                                                        </td>
                                                                        <td>Elons Carrasco, Lenín Máximo</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 4 </span>
                                                                        </td>
                                                                        <td>Narváez Asencio, Peter Joseph</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 5 </span>
                                                                        </td>
                                                                        <td>Pacheco Vera, Cristhian Alex</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 6 </span>
                                                                        </td>
                                                                        <td>Reyes Nuñez, Luis Alejandro</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 7 </span>
                                                                        </td>
                                                                        <td>Sifuentes Córdova, Luis David</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div id="tab-est3" class="tab-pane">
                                                            <table class="table table-bordered" width="75%">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="10%" class="text-center" style="background: #5BC0DE"> #</th>
                                                                        <th style="background: #5BC0DE"> E S T U D I A N T E</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 1 </span>
                                                                        </td>
                                                                        <td>Arias Ascencio, Shirley</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 2 </span>
                                                                        </td>
                                                                        <td>Caqueo Villarreal, Araceli</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 3 </span>
                                                                        </td>
                                                                        <td>Chamba Flores, Jessenia Gabriela</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 4 </span>
                                                                        </td>
                                                                        <td>Cruz Cruz, Sonia</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 5 </span>
                                                                        </td>
                                                                        <td>Dávila Ríos, Nathalie Alexandra</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 6 </span>
                                                                        </td>
                                                                        <td>Mestanza Rodas, Jahaira Kimberly</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 7 </span>
                                                                        </td>
                                                                        <td>Salazar Salazar, Andrea Nicol</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">
                                                                            <span> 8 </span>
                                                                        </td>
                                                                        <td>Santiago Raymondi, Karen Alex</td>
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
                                <div id="tab-3" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="horario-clases">
                                                    <div class="table-responsive">
                                                        <table class="table ss1">
                                                            <thead class="scheduler ss1">
                                                                <tr>
                                                                    <th class="text-center scheduler">
                                                                        <!-- Hora -->
                                                                    </th>
                                                                    <th class="text-center scheduler" style="font-size: 1.6em;">Lunes</th>
                                                                    <th class="text-center scheduler" style="font-size: 1.6em;">Martes</th>
                                                                    <th class="text-center scheduler" style="font-size: 1.6em;">Miercoles</th>
                                                                    <th class="text-center scheduler" style="font-size: 1.6em;">Jueves</th>
                                                                    <th class="text-center scheduler" style="font-size: 1.6em;">Viernes</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="horario">
                                                                <tr>
                                                                    <td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
                                                                        <span class="c-hour">7:00
                                                                            <br>7:45</span>
                                                                        <span class="hour hour-1">
                                                                            <span>1</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #C0392B;color: #FFFFFF">Computación
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria1" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #9B59B6;color: #FFFFFF">Educación Física
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria2" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #2980B9;color: #FFFFFF">Lengua Extranjera
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria3" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #1ABC9C;color: #FFFFFF">Matemáticas
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria4" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">Lengua y Literatura
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria5" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
                                                                        <span class="c-hour">7:45
                                                                            <br>8:30</span>
                                                                        <span class="hour hour-2">
                                                                            <span>2</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">Lengua y Literatura
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria5" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #2980B9;color: #FFFFFF">Lengua Extranjera
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria3" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #2980B9;color: #FFFFFF">Lengua Extranjera
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria3" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #F1C40F;color: #FFFFFF">Estudios Sociales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria6" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #1ABC9C;color: #FFFFFF">Matemáticas
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria4" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
                                                                        <span class="c-hour">8:30
                                                                            <br>9:15</span>
                                                                        <span class="hour hour-2">
                                                                            <span>3</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #F1C40F;color: #FFFFFF">Estudios Sociales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria6" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #E67E22;color: #FFFFFF">Ciencias Naturales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria7" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #C0392B;color: #FFFFFF">Computación
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria8" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">Lengua y Literatura
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria5" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #2980B9;color: #FFFFFF">Lengua Extranjera
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria3" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
                                                                        <span class="c-hour">9:15
                                                                            <br>10:00</span>
                                                                        <span class="hour hour-2">
                                                                            <span>4</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #E67E22;color: #FFFFFF">Ciencias Naturales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria7" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #1ABC9C;color: #FFFFFF">Matemáticas
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria4" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #E67E22;color: #FFFFFF">Ciencias Naturales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria7" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">Lengua y Literatura
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria5" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #F1C40F;color: #FFFFFF">Estudios Sociales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria6" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
                                                                        <span class="c-hour">10:30
                                                                            <br>11:15</span>
                                                                        <span class="hour hour-2">
                                                                            <span>5</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #95A5A6;color: #FFFFFF">Música
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria8" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #1ABC9C;color: #FFFFFF">Matemáticas
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria4" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #34495E;color: #FFFFFF">Dibujo Técnico
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria9" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #E74C3C;color: #FFFFFF">Comercio
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria10" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #E67E22;color: #FFFFFF">Ciencias Naturales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria7" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
                                                                        <span class="c-hour">11:15
                                                                            <br>12:00</span>
                                                                        <span class="hour hour-2">
                                                                            <span>6</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #1ABC9C;color: #FFFFFF">Matemáticas
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria4" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #F1C40F;color: #FFFFFF">Estudios Sociales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria6" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #F1C40F;color: #FFFFFF">Estudios Sociales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria6" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #E67E22;color: #FFFFFF">Ciencias Naturales
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria7" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #8E44ED;color: #FFFFFF">Valores Humanos
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria11" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
                                                                        <span class="c-hour">12:00
                                                                            <br>12:45</span>
                                                                        <span class="hour hour-2">
                                                                            <span>7</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #2980B9;color: #FFFFFF">Lengua Extranjera
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria3" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">Lengua y Literatura
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria5" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">Lengua y Literatura
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria5" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #27AE60;color: #FFFFFF">Lengua y Literatura
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria5" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #3498DB;color: #FFFFFF">Proyectos Educativos
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria12" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="scheduler horas" style="vertical-align: middle;padding-left: 0">
                                                                        <span class="c-hour">13:15
                                                                            <br>14:00</span>
                                                                        <span class="hour hour-2">
                                                                            <span>8</span>
                                                                        </span>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #34495E;color: #FFFFFF">Dibujo Técnico
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria9" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #E74C3C;color: #FFFFFF">Comercio
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria10" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #1ABC9C;color: #FFFFFF">Matemáticas
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria4" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #9B59B6;color: #FFFFFF">Educación Física
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria2" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                    <td class="subject" style="vertical-align: middle;background: #3498DB;color: #FFFFFF">Proyectos Educativos
                                                                        <i class="fa fa-info dir-hor-inf" data-toggle="modal" data-target="#modalMateria12" onclick="modal(this.id)" id="COMPUTACION_leader1-1"></i>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane">
                                    <div class="row" style="margin-top: 0">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8" center>
                                            <table class="table table-bordered table-striped" width="75%">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #641E16"></i>
                                                            <span style="color: #641E16;font-weight:bold"> Ciencias Naturales </span>
                                                        </td>
                                                        <td class="text-left">SHIRLEY ARIAS ASCENCIO</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #512E5F"></i>
                                                            <span style="color: #512E5F;font-weight:bold"> Comercio </span>
                                                        </td>
                                                        <td class="text-left">BRYAN ARONE SAAVEDRA</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #2471A3"></i>
                                                            <span style="color: #2471A3;font-weight:bold"> Computación </span>
                                                        </td>
                                                        <td class="text-left">ARACELI CAQUEO VILLARREAL</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #0E6251"></i>
                                                            <span style="color: #0E6251;font-weight:bold"> Dibujo Técnico </span>
                                                        </td>
                                                        <td class="text-left">JESSENIA GABRIELA CHAMBA FLORES</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #145A32"></i>
                                                            <span style="color: #145A32;font-weight:bold"> Educación Física </span>
                                                        </td>
                                                        <td class="text-left">ITALO JAVIER CONDORI VELASQUEZ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #7D6608"></i>
                                                            <span style="color: #7D6608;font-weight:bold"> Estudios Sociales </span>
                                                        </td>
                                                        <td class="text-left">SONIA CRUZ CRUZ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #784212"></i>
                                                            <span style="color: #784212;font-weight:bold"> Lengua Extranjera </span>
                                                        </td>
                                                        <td class="text-left">NATHALIE ALEXANDRA DAVILA RIOS</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #7B7D7D"></i>
                                                            <span style="color: #7B7D7D;font-weight:bold"> Lengua y Literatura </span>
                                                        </td>
                                                        <td class="text-left">LENIN MAXIMO ELONS CARRASCO</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #4D5656"></i>
                                                            <span style="color: #4D5656;font-weight:bold"> Matemáticas </span>
                                                        </td>
                                                        <td class="text-left">JAHAIRA KIMBERLY MESTANZA RODAS</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #1B2631"></i>
                                                            <span style="color: #1B2631;font-weight:bold"> Música </span>
                                                        </td>
                                                        <td class="text-left">PETER JOSEPH NARVAEZ ASENCIO</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #78281F"></i>
                                                            <span style="color: #78281F;font-weight:bold"> Proyectos Educativos </span>
                                                        </td>
                                                        <td class="text-left">CRISTHIAN ALEX PACHECO VERA</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-bookmark" style="color: #4A235A"></i>
                                                            <span style="color: #4A235A;font-weight:bold"> Valores Humanos </span>
                                                        </td>
                                                        <td class="text-left">LUIS ALEJANDRO REYES NUÑEZ</td>
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
    </div>
@endsection