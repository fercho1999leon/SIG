@extends('layouts.master2')
@section('assets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
@endsection

@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg titulo-separacion noBefore">
            <div class="col-xs-12 titulo-separacion">
                <h2 class="title-page text-uppercase">Configuracion de PEAs</h2>
            </div>
        </div>
        <div class="row wrapper">
            <div class="col-xs-12" style="min-width: min-content;">
                <div class="row wrapper">
                    <div class="col-xs-12 p-1 bg-black" style="margin-top:10px ; margin-bottom:10px; border-radius: 15px">
                        <h1 class="text-uppercase text-white" style="text-align: center">PEAS</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row wrapper">
            <div class="col-xs-12 bg-white p-1">
                <table id="tablapeas" class="table table-bordered " style="width:100%;">
                    <thead>
                        <tr class="bg-black text-white">
                            <th>ID</th>
                            <th>Nombre PEA</th>
                            <th>Periodo Electivo</th>
                            <th>Carrera</th>
                            <th>Semestre</th>
                            <th>Curso</th>
                            <th>Materia</th>
                            <th>Docente</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($peas != null)
                            @foreach ($peas as $pea)
                                <tr>
                                    <th style="text-align: center;">{{ $pea->id }}</th>
                                    <th style="text-align: center;">{{ $pea->name }}</th>
                                    <th style="text-align: center;">{{ $pea->nombrePeriodo }}</th>
                                    <th style="text-align: center;">{{ $pea->nombreCarrera }}</th>
                                    <th style="text-align: center;">{{ $pea->nombreSemestre }}</th>
                                    <th style="text-align: center;">{{ $pea->nombreCurso }}</th>
                                    <th style="text-align: center;">{{ $pea->nombreMateria }}</th>
                                    <th style="text-align: center;">{{ $pea->nombresDocente.' '.$pea->apellidosDocente}}</th>
                                    <th style="text-align: center;">
                                        @if ($pea->state == 1)
                                            <span class="text-info text-uppercase">Activo</span>
                                        @else
                                            <span class="text-danger text-uppercase">Inactivo</span>
                                        @endif
                                    </th>
                                    <th style="text-align: center;">
                                        <a class="btn btn-success m-1"
                                            href="#">Modificar</a>
                                        <button class="btn btn-success m-1" onclick="viewPDF({{$pea->id}})">Visualizar</button>
                                        <button class="btn btn-danger m-1"
                                            onclick="eliminarPea({{$pea->idArchivoInfo}})">Eliminar</button>
                                    </th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!--BOTON MODAL CREAR PEA-->
        <div class="row wrapper">
            <div class="col-xs-12 bg-white p-1 text-right">
                <button type="button" class="btn btn-primary btn-lg" id="btnAddPEA" update="{{false}}" idUpdate="{{-1}}">
                    Crear PEA
                </button>
            </div>
        </div>
        
        <!--MODAL CREACION DE PEAS-->
        <div id="show-modal-pea" class="modal fade" role="dialog" >
        </div> 
        <!--MODAL DE ERRORES-->
        @if($errors->any())
            <div id="show-error" class="modal fade in" role="dialog" >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ERROR</h4>
                        </div>

                        @foreach($errors->all() as $value)
                            <div class="alert alert-danger" role="alert">Error {{$value}}</div>
                        @endforeach
                </div>
            </div>  
        @endif
        <!--MODAL VISUALIZAR PDF-->
        <div id="show-pdf" class="modal fade in" role="dialog" >
            
        </div> 
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#show-error').modal();
            $('#tablapeas').DataTable({
                "paging": true,
                "ordering": true,
                "info": false,
                "oLanguage": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
        $(function () {
            $('#carreraId').on('change', onSelectSemestre);
        });

        function onSelectSemestre() {
            var idCarrera = $(this).val();
            let html_datos = '<option value="{{ -1 }}">Seleccione</option>';
            if(idCarrera==-1){
                $('#semestreId').html(html_datos);
                $('#cursoId').html(html_datos);
                $('#asignaturaId').html(html_datos);
            }else{
                $.get('/api/semestresPorCarrera/' + idCarrera + '', function (semestre) {
                    for (var i = 0; i < semestre.length; i++) {
                        html_datos += '<option value="' + semestre[i].id + '">' + semestre[i].nombsemt + '</option>	';
                    }
                    $('#semestreId').html(html_datos);
                })
            }
            
        }

        $(function () {
            $('#semestreId').on('change', onSelectParalelo);
        });
        function onSelectParalelo() {
            idSemestre = $(this).val();
            let html_datos = '<option value="{{ -1 }}">Seleccione</option>';
            if(idSemestre==-1){
                $('#cursoId').html(html_datos);
                $('#asignaturaId').html(html_datos);
            }else{
                $.get('/api/postAccedeParalelos/' + idSemestre + '', function (data) {
                    for (var i = 0; i < data.length; i++) {
                        html_datos += '<option value="' + data[i].id + '">Paralelo ' + data[i].paralelo + '</option>	';
                    }
                    $('#cursoId').html(html_datos);
                })
            }
        }

        $(function () {
            $('#cursoId').on('change', onSelectMateria);
        });
        function onSelectMateria() {
            idMateria = $(this).val();
            let html_datos = '<option value="{{ -1 }}">Seleccione</option>';
            if(idMateria==-1){
                $('#asignaturaId').html(html_datos);
            }else{
                $.get('/api/postAccedeCurso/' + idMateria + '', function (data) {
                    for (var i = 0; i < data.length; i++) {
                        html_datos += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>	';
                    }
                    $('#asignaturaId').html(html_datos);
                })
            }
        }

        function eliminarPea(id) {
            Swal.fire({
                title: 'Seguro desea eliminar este documento?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI',
                cancelButtonText: 'NO'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('setPeaDelect')}}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            id
                        },
                        success: function(response) {
                            Swal.fire(
                                'El PEA se elimino correctamente!',
                                '',
                                'success'
                            );
                            location.reload();
                        },
                        error: function(response) {
                            Swal.fire(
                                'Algo salio mal',
                                '',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function viewPDF(id){
            $.ajax({
                url: "{{route('indexPeaView')}}",
                type: 'POST',
                data: {
                    '_token': $('input[name=_token]').val(),
                    id
                },
                success: function(response) {
                    $('#show-pdf').html(response);
                    $('#show-pdf').modal();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        $(document).ready(function() {
            $('#btnAddPEA').on('click',()=>{
                let update = $('#btnAddPEA').attr('update');
                let idUpdate = $('#btnAddPEA').attr('idUpdate')
                $.ajax({
                    url: "{{route('modalPeaView')}}",
                    type: 'POST',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        update,
                        idUpdate
                    },
                    success: function(response) {
                        $('#show-modal-pea').html(response);
                        $('#show-modal-pea').modal();
                        $("#filePea").fileinput();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
        
    </script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.4/viewer.common.js"
        integrity="sha512-tO8TIHa2E4zvKYXmSk7QTrjyNbJ1vDW5wXeobD0yYTf4qN+q+PRR6D2KBju4EE79eYWMzJzTwWr7LGPBdGTyhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
@endsection