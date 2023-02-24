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
            <h1 class="title-page">Configuración <small> Matrícula</small> </h1>
            <div class="agregarSeccionCont">
                <a href="{{route('matriculaCrear')}}">
                    <button class="btn btn-primary">Nuevo Estudiante</button>
                </a>
                @if (Sentinel::getUser()->email === 'info@itred.edu.ec')
                    <button class="btn btn-info" data-toggle="modal" data-target="#importar" href="#">Importar Estudiantes</button>
                @endif
            </div>
        </div>
    </div>
    @if($permiso ==null || ($permiso != null && $permiso->imprimir == 1))
    <div class="col-lg-12 matricula__reporteTotalEstudiantesMatriculado-flex">
        @if (Sentinel::getUser()->email === 'soporte@pined.ec')
        <!--
        <div class="micelda p-1">
            <a target="_blank" class="btn btn-info" href="{{route('pasarDePeriodoLectivoAll')}}">Pasar de Año</a>
        </div>-->
        @endif
        <div class="p-1">
            <div class="col-lg-6 matricula__matriculacion__input">
				<!--<label for="matricula-paralelo" class="matricula__matriculacion-label">Paralelo</label>-->
				<select class="form-control input-sm" name="paralelo" id="paralelo">
					@foreach($courses as $cours)
						<option value="{{$cours['id']}}" idCarrer="{{$cours['id_career']}}">{{ $cours ['paralelo'] }}</option>
					@endforeach
				</select>
			</div>
            <a class="btn btn-info" id="export_data">DESCARGAR MATRIZ ESTUDIANTE</i>&nbsp;
            </a>
            <!--<a class="col-lg-3 btn btn-info" href="{{route('excel.index')}}">DESCARGAR EXCEL</i>&nbsp;
            </a>
            <a target="_blank" class="col-lg-3 btn btn-info" href="{{route('reporteEstudiantesConBecas')}}">ESTUDIANTES CON
                BECAS</a>-->
            <!--
                <a target="_blank" class="matricula__reporteTotalEstudiantesMatriculado btn-primary" href="{{route('reporte.matriculados2')}}">REPORTE ESTUDIANTES MATRICULADOS</a>
                <a target="_blank" class="matricula__reporteTotalEstudiantesMatriculado btn-primary" href="{{route('reporteMatriculados')}}">ESTUDIANTES MATRICULADOS</a>-->
        </div>
    </div>
    @endif

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
                    <th>Paralelo</th>
                    <th>F. Matrícula</th>
                    <th>Matrícula</th>
                    <th>Retirado</th>
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
                    <th>Semestre</th>
                    <th>Carrera</th>
                    <th>Paralelo</th>
                    <th>F. Matrícula</th>
                    <th>Matrícula</th>
                    <th>Retirado</th>
                    <th>Bloqueado</th>
                    <th>T Bloqueo</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="modal fade" id="bloqueoEstudiante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
</div>

@if($errors->any() || $errors->import->any())
    <div id="show-error" class="modal fade in" id="importar" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ERROR EN IMPORTACION</h4>
                </div>

                @if($errors->import->any())
                    
                    @foreach($errors->import->getMessages() as $value)
                        <div class="alert alert-danger" role="alert">Error {{var_dump($value)}}</div>
                    @endforeach
                @else
                    @foreach($errors->all() as $value)
                        <div class="alert alert-danger" role="alert">Error {{$value}}</div>
                    @endforeach
                @endif
        </div>
    </div>  
@endif
@if($errors->any())
    <div id="show-error" class="modal fade in" id="importar" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ERROR EN IMPORTACION</h4>
                </div>

                @if($errors->import->any())
                    @foreach($errors->import->getMessages() as $value)
                        <div class="alert alert-danger" role="alert">Error {{$value['msg']}} usuario: {{$value['numeroidentificacion']}} -- {{$value['data']}}</div>
                    @endforeach
                @else
                    @foreach($errors->all() as $value)
                        <div class="alert alert-danger" role="alert">Error {{$value}}</div>
                    @endforeach
                @endif
        </div>
    </div>  
@endif

<div class="modal fade" id="importar" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Importar Estudiantes -DEV-</h4>
            </div>
            <form method="post" action="{{route('importarEstudiantes')}}" enctype="multipart/form-data">
                <div style="min-height: 10vh;">
                    <div class="col-lg-3 matricula__matriculacion__input">
                        <label for="" class="matricula__matriculacion-label">Carrera<span class="valorError">*</span></label>
                        <select class="form-control input-sm" name="carrera" id="matricula-curso" require>
                            <option value="" >Seleccione</option>
                            @foreach($careers as $key => $career)
                            <option value="{{ $career['id']}}" >{{ $career ['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 matricula__matriculacion__input">
                        <label for="matricula-paralelo" class="matricula__matriculacion-label">Paralelo<span class="valorError">*</span></label>
                        <select class="form-control input-sm" name="paralelo" id="matricula-paralelo" require>
                            <option value="" >Seleccione</option>
                            @foreach($courses as $cours)
                                <option value="{{$cours['id']}}" hidden idCarrer="{{$cours['id_career']}}" >{{ $cours ['paralelo'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                {{csrf_field()}}
                <input id="excel" name="excel" type="file" class="file">
            </form>
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
    $('#show-error').modal();
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
        ajax: "{{ route('tablaEstudiantes') }}",
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
                data: 'nameSemester',
            },
            {
                data: 'carrera',
            },
            {
                data: 'paralelo',
            },
            {
                data: 'fecha_matriculacion',
                name: 'students2_profile_per_year.fecha_matriculacion',
                'visible': false
            },
            {
                data: 'matricula',
                name: 'matricula'
            },
            {
                data: 'retirado',
                name: 'retirado'
            },
            {
                data: 'bloqueado',
                name: 'bloqueado',
                'visible': true
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
            'colvis',
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
    $(".boton_ocultar_mostrar").on('click', function() {
        var indice = $(this).index(".boton_ocultar_mostrar");
        $(".boton_ocultar_mostrar").eq(indice).toggleClass("btn-danger");
        var columna = tabla.column(indice);
        columna.visible(!columna.visible());
    });
});

// funcionalidades:::::::::::::::::
$('.obtenerBloqueoEstudiante').click(function() {
    $.ajax({
        type: "GET",
        url: $(this).attr('url'),
        success: function(response) {
            $('#bloqueoEstudiante').html(response)
            $('#bloqueoEstudiante').modal()
        },
        error: function() {
            alert('sucedio un error');
        }
    });
})
var button = $('.eliminarEstudiante')
var url = window.location.origin

function eliminarEstudiante(idEstudiante) {
    Swal.fire({
        title: 'Seguro desea eliminar a este estudiante?',
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
                url: `${url}/student/eliminar/${idEstudiante}`,
                data: {
                    '_token': $('input[name=_token]').val(),
                    '_method': 'DELETE'
                },
                success: function(response) {
                    $(`#${idEstudiante}`).css('display', 'none')
                    Swal.fire(
                        'El estudiante ha sido eliminado!',
                        '',
                        'success'
                    );
                    $('#tablaEstudiantes').DataTable().ajax.reload();
                },
                error: function(response) {
                    alert('Algo salio mal.')
                }
            });
        }
    })
}

$('#export_data').click(function() {
    var link = document.createElement('a');
    link.href = "{{route('export')}}"+'/?idcurso='+$('#paralelo').val();
    link.download = 'Matriz_Matriculados.xls';
    link.dispatchEvent(new MouseEvent('click'));
})

</script>

<script>
    
	$('#matricula-curso').change(function() {
		for(let i = 0 ; i < $('#matricula-paralelo')[0].length ; i++){
			if($(($('#matricula-paralelo')[0])[i]).attr('idcarrer') === $(this).val()){
				$(($('#matricula-paralelo')[0])[i]).prop('hidden', false);
			}else{
				$(($('#matricula-paralelo')[0])[i]).prop('hidden', true);
			}
		}
	});
</script>
@endsection