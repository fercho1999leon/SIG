@extends('layouts.master')
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- Incluir el nav_bar_top Cerrar Sesion -->
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg ">
            <div class="col-xs-12 seleccion-curso">
                <h2 class="title-page">
                   curso - grado
                    <small>CREAR ASISTENCIA
                    </small>
                </h2>
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                <!-- Enlace a Crear Asistencia -->
                <div class="white-bg p-1">
                    <div class="pined-table-responsive">
                        <div class="d-f">
                            <table class="s-calificaciones s-calificaciones--trGris">
                                <tr class="table__bgBlue">
                                    <td class="text-center no-border" height="59"> # </td>
                                    <td  class="no-border text-center no-border fz2">Estudiantes</td>
                                    <td class="text-center no-border" height="59">
                                        <a href="">
                                            <i class="fz19 fa fa-pencil color-white"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>nombre del estudiante</td>
                                    <td>
                                        <select class="form-control" name="" id="">
                                            <option value="">A</option>
                                            <option value="">F</option>
                                            <option value="">F.J.</option>
                                            <option value="">F.I.</option>
                                            <option value="">A</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="" class="btn btn-success">
                        G U A R D A R
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection