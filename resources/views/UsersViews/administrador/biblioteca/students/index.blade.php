@extends('layouts.master2')
@section('assets')
@include('partials.loader.loader')
@php
use App\Permiso;
$permiso = Permiso::desbloqueo('matricula');
$usuario = session('user_data')->correo;
@endphp
<link href="{{secure_asset('bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.min.js">
</script>
<script
    src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.2.0/js/buttons.html5.styles.templates.min.js">
</script>


<style type="text/css">
tfoot {
    display: table-header-group;
}

div.micelda {
    text-align: left !important;
    width: 800px !important;
}

#tablaEstudiantes {
    text-align: center;
}
</style>
</head>
@endsection
@section('content')




<div id="page-wrapper" class="gray-bg">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
    <div class="col-lg-12 titulo-separacion">
        <h1 class="title-page">Sección <small> Biblioteca</small> </h1>
        <div class="agregarSeccionCont">
            <a href="{{route('reportePDFGeneral')}}" Target="_blank">
                <button class="btn btn-primary" >Reporte General PDF LIBROS</button>
            </a>
            {{--<a href="{{route('reporteExcelGeneral')}}" Target="_blank">
                <button class="btn btn-primary">Reporte General EXCEL</button>
            </a>--}}
        </div>
    </div>
</div>
   
    <div class="row wrapper" style="overflow-x: auto !important;">
        <table id="tablaEstudiantes" class="table table-striped table-hover table-bordered white-bg">
            <thead>
                <tr>
                    <th>Num</th>
                    <th>Cédula</th>
                    <th>N°Matrícula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Semestre</th>
                    <th>Carrera</th>
                    
                    <th>Bloqueado</th>
                    <th>T Bloqueo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Cédula</th>
                    <th>N°Matrícula</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Curso</th>
                    <th>Carrera</th>
                    
                    <th>Bloqueado</th>
                    <th>T Bloqueo</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="datosEstudiante" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title" style="font-weight: bold">Reporte de Estudiante</h2>
            </div>
            <form method="post" action="{{route('importarEstudiantes')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td>C.I. Estudiante:</td>
                          <td id="celCedula"></td>
                        </tr>
                        <tr>
                          <td>Nombres del Estudiante:</td>
                          <td id="celNombre"></td>
                        </tr>
                        <tr>
                          <td>Apellidos del Estudiante:</td>
                          <td id="celApellido">Jacob</td>
                        </tr>
                        <tr>
                            <td>Carrera</td>
                            <td id="celCarrera">Larry</td>
                          </tr>
                        <tr>
                          <td>Numero de Matricula</td>
                          <td id="celMatricula">Larry</td>
                        </tr>
                        <tr>
                          <td>Nivel / Semestre</td>
                          <td id="celSemestre">Larry</td>
                        </tr>
                        
                      </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td>Fecha de Ingreso a la Biblioteca:</td>
                            <td id="celFechaIngreso">17-02-2020</td>
                          </tr>
                          <tr>
                            <td>Cantidad de Libros Leidos o Descargados</td>
                            <td id="celCantidad">5</td>
                          </tr>
                          <tr>
                            <td>Tiempo de lectura en Biblioteca</td>
                            <td id="celTiempoLectura">90 minutos</td>
                          </tr>                          
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td>Fecha de Ultimo Ingreso a la Biblioteca Virtual:</td>
                            <td id="celFechaIngresovirtual">17-02-2020</td>
                          </tr>
                          <tr>
                            <td>Tiempo de lectura en Biblioteca Minutos</td>
                            <td id="celTiempoLecturavirtual">90 </td>
                          </tr>                          
                        </tbody>
                    </table>
                </div>
                
            </form>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('reportePDFindividual')}}" method="post" target="_blank">
                            {{csrf_field()}}
                            <input type="hidden" name="idEstudiante" class="idEstudiante" id="idEstudiante">
                            <button class="btn btn-info" id="reportePDFindividual" type="submit"><i class="fa fa-download " aria-hidden="true"></i> Descargar Reporte De Biblioteca Individual PDF</button>
                        </form>
                    </div>
                    {{--<div class="col-md-6">
                        <form action="{{route('reporteExcelindividual')}}" method="post" target="_blank">
                            {{csrf_field()}}
                            <input type="hidden" name="idEstudianteExcel" class="idEstudianteExcel" id="idEstudianteExcel">
                            <button class="btn btn-info" id="reporteExcelindividual" type="submit"><i class="fa fa-download " aria-hidden="true"></i> Descargar Reporte De Biblioteca Individual EXCEL</button>
                        </form>        
                    </div>--}}
                </div>
                
                        
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
</script>
<script type="text/javascript" language="javascript"
    src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js">
</script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js" type="text/javascript"></script>
<script type="text/javascript">



//tabla masterestudiantes:::::::::::::::::::::::::
$(document).ready(function() {
    $("#menu-desplegable").click();
    $('#tablaEstudiantes tfoot th').each(function() {
        var title = $(this).text();
        if (title != '') {
            $(this).html(
                '<input style="width: 100% !important; text-align: center;" type="text" placeholder="Buscar" />'
            );
        }
    });
    var idPeriodo = document.getElementById("cambioDePeriodo").value;
    var tabla = $('#tablaEstudiantes').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        ajax: "{{ route('tablaEstudiantesBiblioteca')}}",
        columns: [{
                data: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'ci'
            },
            {
                data: 'numeroMatricula'
            },
            {
                data: 'nombres'
            },
            {
                data: 'apellidos'
            },
            {
                data: 'grado',
                name: 'courses.grado'
            },
            {
                data: 'carrera',
                name: 'carrera'
            },
        
            {
                data: 'bloqueado',
                name: 'students2.bloqueado',
                'visible': false
            },
            {
                data: 'nombreBloqueo',
                name: 'TBN.nombre',
                'visible': false
            },
            {
                data: 'btn'
            },
        ],
        dom: 'Blfrtip',
        buttons: [
           
            {
                extend: "excel",
                titleAttr: 'Exportar Excel',
                text: 'Excel',
            },
            {
                extend: 'pdfHtml5',
                titleAttr: 'Exportar PDF',
                text: 'PDF',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'copyHtml5',
                titleAttr: 'Copiar Datos',
                text: 'Copiar',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                titleAttr: 'Imprimir Listado',
                exportOptions: {
                    columns: ':visible'
                }
            },
        ],
        language: {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Mostrar Columnas"
            }
        },
        initComplete: function() {
            this.api().columns().every(function() {
                var that = this;
                $('input', this.footer()).on('keyup change clear', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
       
    });
    
});


function verEstudiante(idEstudiante) {
    //var idEstudiante = 1;
    var url = window.location.origin
    console.log(idEstudiante);
    $.ajax({
        url: `${url}/datosEstudiante/${idEstudiante}`,
        type: 'GET',
        success: function(respuesta) {
            //console.log(respuesta);
            var id = respuesta.idStudent;
            //console.log(id);
            //document.querySelector('#idEstudiante').value = id;
            $("#idEstudiante").val(idEstudiante);
            $("#idEstudianteExcel").val(idEstudiante);
            //document.getElementById(idEstudiante).setAttribute('value', respuesta.id);
            //document.getElementById(idEstudianteExcel).setAttribute('value', respuesta.id);
            //document.querySelector('#idEstudianteExcel').value = respuesta.id;
            
            document.querySelector("#celCedula").innerHTML = respuesta.ci;
            document.querySelector("#celNombre").innerHTML = respuesta.nombres;
            document.querySelector("#celApellido").innerHTML = respuesta.apellidos;
            document.querySelector("#celMatricula").innerHTML = respuesta.numero_matriculacion;
            document.querySelector("#celSemestre").innerHTML = respuesta.grado;
            document.querySelector("#celCarrera").innerHTML = respuesta.nombreCarrera;
            document.querySelector("#celTiempoLectura").innerHTML = respuesta.tiempo +' Minutos';
            document.querySelector("#celCantidad").innerHTML = respuesta.cantidadLibros +' Libros';
            document.querySelector("#celFechaIngreso").innerHTML = respuesta.last_entry ;

            document.querySelector("#celTiempoLecturavirtual").innerHTML = respuesta.library_time_virtual ;
            document.querySelector("#celFechaIngresovirtual").innerHTML = respuesta.last_entry_virtual;
            //console.log(respuesta.last_entry);
            //console.log(document.getElementById('#idEstudiante'));
            $('#datosEstudiante').modal();
        },
        error: function() {
            console.error("No es posible completar la operación");
        }
    });
    
      
    }

</script>
@endsection
