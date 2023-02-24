@extends('layouts.master') @section('content') 
<div id="page-wrapper" class="gray-bg dashbard-1">
    <!-- Incluir el nav_bar_top Cerrar Sesion -->
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-xs-9">
            <h2 class="title-page">Calificaciones
                <small class="text-color7 bold"> Octavo A</small>
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
    <div class="wrapper wrapper-content dir-calificaciones mb350" id="alumnos">
        <div class="row">
            <div class="col-lg-6">
                <div class="formatos">
                    <select class="selectpicker form-control mb-1" id="mySelect" onchange="myFunction()">
                        <optgroup label="Quimestre 1">
                            <option value="parcial1Q1">Q1 - Parcial 1</option>
                            <option value="parcial2Q1">Q1 - Parcial 2</option>
                            <option value="parcial3Q1">Q1 - Parcial 3</option>
                            <option value="exQ1">Q1 - Examen</option>
                            <option value="q1">Quimestre 1</option>
                        </optgroup>

                        <optgroup label="Quimestre 1">
                            <option value="parcial1Q2">Q2 - Parcial 1</option>
                            <option value="parcial2Q2">Q2 - Parcial 2</option>
                            <option value="parcial3Q2">Q2 - Parcial 3</option>
                            <option value="exQ2">Q2 - Examen</option>
                            <option value="q2">Quimestre 2</option>
                        </optgroup>

                        <optgroup label="Año Lectivo">
                            <option value="AL" selected="">Año Lectivo</option>
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
        <!-- Todas Las Materias -->
        <div id="q1Parcial1" style="display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">B</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">B</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">B</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">B</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">B</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q1Parcial2" style=" display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q1Parcial3" style="display: none ">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q1Examen" style="display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q1Final" style="display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q2Parcial1" style="display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q2Parcial2" style="display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q2Parcial3" style="display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q2Examen" style="display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="q2Final" style="display: none">
            <div class="white-bg p-1">
                <div class="pined-table-responsive">
                    <table class="s-calificaciones s-calificaciones--trGris mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                                <!-- <a href="director_calificaciones8AM1.php">
            <i class="fa fa-eye text-color3" ></i>
            </a> -->
                            </td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1 notaMala">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7 notaMala">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
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
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="Final">
            <div class="white-bg p-1">
                <h2 class="text-color3">Año Lectivo 2017 - 2018</h2>
                <div class="pined-table-responsive">
                    <!-- 
    						##########IMPORTANTE########################################
    						############################################################
    
    						Fijarse en las clases, bg_color - text-color - border-lateral
    							Estos se van alternando del 1 al 10. cuando llegan al 10 van al 1 otra vez etc.
    
    						############################################################
    						############################################################
    					 -->
                    <table class="s-calificaciones mt125">
                        <tr>
                            <td colspan="2" class="no-border"></td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Cienc. Naturales
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Comercio
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Computación
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color4">Dibujo Técnico
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color4"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color5">Ed. Cul. y Art.
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color5"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color6">Ed. Fisica
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color6"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color7">Leng. Extranjero
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color7"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color8">Leng. y Literatura
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color8"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color9">Matemáticas
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color9"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color10">Música
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color10"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color1">Proy. Educativos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color1"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color2">Valores Humanos
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color2"></i>
                                    </a>
                                </p>
                            </td>
                            <td class="no-border">
                                <p class="s-calificaciones__materia text-color3">Comportamiento
                                    <a href="" data-toggle="modal" data-target="#modalMat1">
                                        <i class="fa fa-info-circle text-color3"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2" class="text-center table__bgBlue no-border s-calificaciones--title">Estudiantes</td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                            <td class="text-center bg_color4"></td>
                            <td class="text-center bg_color5"></td>
                            <td class="text-center bg_color6"></td>
                            <td class="text-center bg_color7"></td>
                            <td class="text-center bg_color8"></td>
                            <td class="text-center bg_color9"></td>
                            <td class="text-center bg_color10"></td>
                            <td class="text-center bg_color1"></td>
                            <td class="text-center bg_color2"></td>
                            <td class="text-center bg_color3"></td>
                        </tr>
                        <tr>
                            <td class="text-center border-lateral1">
                                <a href="  ">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-latera3">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color3"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral4">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color4"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral5">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color5"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral6">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color6"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral7">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color7"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral8">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color8"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral9">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color9"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral10">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color10"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral1">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color1"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral2">
                                <a href="director_calificaciones8AM1.php">
                                    <i class="fa fa-eye text-color2"></i>
                                </a>
                            </td>
                            <td class="text-center border-lateral3">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Miguel Vinicio Bonifaz Calderon</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">0.00</td>
                            <td class="text-center border-lateral4">0.00</td>
                            <td class="text-center border-lateral5">0.00</td>
                            <td class="text-center border-lateral6">0.00</td>
                            <td class="text-center border-lateral7">0.00</td>
                            <td class="text-center border-lateral8">0.00</td>
                            <td class="text-center border-lateral9">0.00</td>
                            <td class="text-center border-lateral10">0.00</td>
                            <td class="text-center border-lateral1">0.00</td>
                            <td class="text-center border-lateral2">0.00</td>
                            <td class="text-center border-lateral3">A</td>
                        </tr>
                        <tr>
                            <td class="" colspan="2"></td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                            <td class="text-center border-lateral3 bg_color3">0.00</td>
                            <td class="text-center border-lateral4 bg_color4">0.00</td>
                            <td class="text-center border-lateral5 bg_color5">0.00</td>
                            <td class="text-center border-lateral6 bg_color6">0.00</td>
                            <td class="text-center border-lateral7 bg_color7">0.00</td>
                            <td class="text-center border-lateral8 bg_color8">0.00</td>
                            <td class="text-center border-lateral9 bg_color9">0.00</td>
                            <td class="text-center border-lateral1 bg_color10">0.00</td>
                            <td class="text-center border-lateral1 bg_color1">0.00</td>
                            <td class="text-center border-lateral2 bg_color2">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- Script del Select -->
        <script>
            function myFunction() {
                var seleccion = document.getElementById("mySelect").value
                //document.getElementById("mySelect").value = "banana";

                if (seleccion === 'parcial1Q1') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'parcial2Q1') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'parcial3Q1') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'exQ1') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'q1') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'parcial1Q2') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'parcial2Q2') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'parcial3Q2') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'exQ2') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'q2') {
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
                    document.getElementById('Final').style.display = 'none';
                } else if (seleccion === 'AL') {
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
                    document.getElementById('Final').style.display = 'block';
                }
            }
        </script>
    </div>
</div>
@endsection