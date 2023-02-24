@extends('layouts.master') @section('content') @php use App\Course; @endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-9">
            <h2 style="margin:0.5em 0">Calificaciones
                <small style="color: #0099D6; font-weight: bold"> Octavo A</small>
            </h2>
        </div>
        <div class="col-xs-3" style="padding-top: 10px">
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
    <div class="wrapper wrapper-content dir-calificaciones pb250" id="alumnos">
        <div class="row">
            <div class="col-lg-6">
                <div class="formatos">
                    <select class="selectpicker form-control" id="mySelect" onchange="myFunction()" style="padding-top: 0; margin-top: 0">
                        <optgroup label="Quimestre 1">
                            <option value="q1_p1">Q1 - 1er Parcial</option>
                            <option value="q1_p2">Q1 - 2do Parcial</option>
                            <option value="q1_p3">Q1 - 3er Parcial</option>
                            <option value="q1_ex">Q1 - Examen</option>
                            <option value="q1_final">Q1 - Final</option>
                        </optgroup>
                        <optgroup label="Quimestre 2">
                            <option value="q2_p1">Q2 - 1er Parcial</option>
                            <option value="q2_p2">Q2 - 2do Parcial</option>
                            <option value="q2_p3">Q2 - 3er Parcial</option>
                            <option value="q2_ex">Q2 - Examen</option>
                            <option value="q2_final">Q2 - Final</option>
                        </optgroup>
                        <optgroup label="Año Lectivo">
                            <option value="lectivo" selected="">Año Lectivo</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="formatos">
                    <select class="selectpicker form-control mb-1" onchange="location.href = value">
                        <option value="#" selected="">Todas las materias</option>
                        <option value="profesor_M1.php">Ciencias Naturales </option>
                        <option value="profesor_M2.php">Comercio </option>
                        <option value="profesor_M3.php">Computación </option>
                        <option value="profesor_M4.php">Dibujo Técnico</option>
                        <option value="profesor_M5.php">Educación Cultural y Artística</option>
                        <option value="profesor_M6.php">Educación Física</option>
                        <option value="profesor_M7.php">Estudios Sociales</option>
                        <option value="profesor_M8.php">Lengua Extranjera</option>
                        <option value="profesor_M9.php">Lengua y Literatura</option>
                        <option value="profesor_M10.php">Matemáticas</option>
                        <option value="profesor_M11.php">Música</option>
                        <option value="profesor_M12.php">Proyectos Educativos</option>
                        <option value="profesor_M13.php">Valores Humanos</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Todas Las Materias -->
            <div id="q1Parcial1" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q1Parcial2" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q1Parcial3" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q1Examen" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Examen</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q1Final" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q2Parcial1" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q2Parcial2" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q2Parcial3" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q2Examen" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Examen</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="q2Final" style="display: none">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Final">
                <div class="col-lg-7">
                    <div class="white-bg p-1">
                        <h2 class="text-color3">Año Lectivo 2017 - 2018</h2>
                        <div class="pined-table-responsive">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr>
                                    <td colspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                                    <td class="text-center bg_color1">Tareas</td>
                                    <td class="text-center bg_color2">Actividades Grupales en clase</td>
                                    <td class="text-center bg_color3">Actividades Individuales en clase</td>
                                    <td class="text-center bg_color4">Lección</td>
                                    <td class="text-center bg_color5">Evaluación - Proyecto</td>
                                    <td class="text-center bg_color6">Promedio</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6 notaMala">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1 notaMala">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3 notaMala">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">#</td>
                                    <td>nombre estudiante</td>
                                    <td class="text-center border-lateral1">0.00</td>
                                    <td class="text-center border-lateral2">0.00</td>
                                    <td class="text-center border-lateral3">0.00</td>
                                    <td class="text-center border-lateral4">0.00</td>
                                    <td class="text-center border-lateral5">0.00</td>
                                    <td class="text-center border-lateral6">0.00</td>
                                </tr>
                                <tr>
                                    <td class="" colspan="2"></td>
                                    <td class="text-center border-lateral1 bg_color1">0.00</td>
                                    <td class="text-center border-lateral2 bg_color2">0.00</td>
                                    <td class="text-center border-lateral3 bg_color3">0.00</td>
                                    <td class="text-center border-lateral4 bg_color4">0.00</td>
                                    <td class="text-center border-lateral5 bg_color5">0.00</td>
                                    <td class="text-center border-lateral6 bg_color6">0.00</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <a href="../pdf/Ciencias Naturales-Año Lectivo.pdf" download="Ciencias Naturales-Año Lectivo.pdf" class="pull-right" style="margin: 0;padding: 5px 10px;background: #23B27C;color: #FFFFFF">
                        <i class="fa fa-print btnImpresion" style="padding-right: 5px"></i> Descargar
                    </a>
                    <div class="ibox">
                        <div class="ibox-title" style="background: #307ECC">
                            <h5 style="color: #FFFFFF">RESUMEN</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up" style="color: #FFFFFF"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content" style="background-color: #FFFFFF">
                            <div class="row no-margins">
                                <div class="col-sm-9">
                                    <h4 style="margin-bottom:0;padding-bottom: 0;padding-left: 0;margin-left: 0">
                                        <strong>Promedio del curso:</strong>
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h2 style="margin-bottom:0;padding-bottom: 0;color: #2ECC71">8.62
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="white-bg p-1">
                            <div class="pined-table-responsive">
                                <table class="s-calificaciones s-calificaciones--trGris w100">
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
                                        <tr class="table__bgBlue">
                                            <td class="no-border"></td>
                                            <td class="no-border">Total</td>
                                            <td class="no-border">15</td>
                                            <td class="no-border">100%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Script del Select -->
        <script>
            function myFunction() {
                var seleccion = document.getElementById("mySelect").value;

                if (seleccion === 'q1_p1') {
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
                } else if (seleccion === 'q1_p2') {
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
                } else if (seleccion === 'q1_p3') {
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
                else if (seleccion === 'q1_ex') {
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
                else if (seleccion === 'q1_final') {
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
                else if (seleccion === 'q2_p1') {
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
                else if (seleccion === 'q2_p2') {
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
                else if (seleccion === 'q2_p3') {
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
                else if (seleccion === 'q2_ex') {
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
                else if (seleccion === 'q2_final') {
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
                else if (seleccion === 'lectivo') {
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
    </div>
</div>
@endsection