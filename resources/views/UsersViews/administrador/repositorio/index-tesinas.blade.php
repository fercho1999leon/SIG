@extends('layouts.master2')
@section('assets')
@include('partials.loader.loader')
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
.my-swal {
  z-index: X!impotant;
}
#tablaEstudiantes {
    text-align: center;
}
</style>
</head>
@endsection

@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Repositorio Tesinas Instituto Superior Técnico Rey David</h2>
            <div class="agregarSeccionCont">
                <a href="{{ route('newRepositorio') }}">
                    <button class="btn btn-primary">Agregar Tesina</button>
                </a>
            </div>
        </div>    
    </div>
    <div class="row wrapper" style="overflow-x: auto !important;">
        <table id="tablaEstudiantes" class="table table-striped table-hover table-bordered white-bg">
            <thead>
                <tr>
                    <th>N° #</th>
                    <th>Tipo de Documento</th>
                    <th>Titulo</th>
                    <th>Autores</th>
                    <th>Fecha de Publicación</th>
                    <th>Tutor(es)</th>
                    <th>Carrera</th>
                    <th>Estado</th>
                    
                    <th>Acción</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Tipo de Documento</th>
                    <th>Titulo</th>
                    <th>Autores</th>
                    <th>Fecha de Publicación</th>
                    <th>Tutor(es)</th>
                    <th>Carrera</th>
                    <th>Estado</th>
                    
                    <th></th>
                </tr>
            </tfoot>
            <tbody>    
              
                <tr>
                    
                    <td>
                            
                            
                    
                         
                    </td>        
                </tr>
              
              </tbody>
        </table>
    </div>   
        <div class="agregarSeccionCont">
		<a class="button-br" href="{{ route('home') }}">
		    <button>
			    <img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		    </button>
	    </a>
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

    $(document).ready(function() {
                    
                    $('#tablaEstudiantes tfoot th').each(function() {
                        var title = $(this).text();
                        if (title != '') {
                            $(this).html(
                                '<input style="width: 100% !important; text-align: center;" type="text" placeholder="Buscar" />'
                            );
                        }
                    });
                
                var tabla = $('#tablaEstudiantes').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    responsive: true,
                    ajax: "{{ route('tablaTesinas')}}",
                    columns: [{
                        data: 'id_document',
                            
                        },
                        {
                            data: 'type_document_name'
                        },
                        {
                            data: 'title_document'
                        },
                        {
                            data: 'authores'
                        },
                        {
                            data: 'fecha_publicacion',
                            
                        },
                        {
                            data: 'tutor',
                            
                        },
                        {
                            data: 'carrera',
                            
                        },
                        {
                            data: 'estado',
                            
                        },                 
                        {
                            data: 'btn',
                        },
                    ],
                    dom: 'Blfrtip',
                    buttons: [
                       
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

</script>
@endsection
