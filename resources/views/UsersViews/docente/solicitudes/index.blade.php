@extends('layouts.master') 
@section('css')
<link href="{{ secure_asset('css/solicitudes.css') }}" rel="stylesheet">
<link href="{{secure_asset('bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
     <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>


<style type="text/css">
    tfoot {
        display: table-header-group;
    }
    div.micelda{
        text-align: left !important;
        width: 800px !important;
    }
    
</style>

@endsection
@php
$rol = Sentinel::getUser()->roles()->first()->name;
$user_data = session('user_data');
$estudiante = session('estudiante'); 
	$tMessages = session('tMessages');
	use App\Student2;
	use App\ConfiguracionSistema;
	use Carbon\Carbon;
	use App\Institution;
    $institution = Institution::first();
@endphp


@section('content')
@include('partials.loader.loader')
{{$i=0}}
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('barra.administrador')
    <div class="row wrapper white-bg titulo-separacion noBefore">
        <div class="col-xs-12 titulo-separacion">
            <h2 class="title-page">Solicitudes Recibidas </h2>
          
        </a>
        </div>

        <div class="agregarSeccionCont">
        
    </div>
    </div>
    <hr class="dirConfiguraciones__instituto--hr">
    <div class="table-responsive">
        <input type="hidden" name="idProfile" id="idProfile" value="{{$user_data->id}}">
    <table style="width:100%" class="table table-hover white-bg" id="solicitud">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">TITULO SOLICITUD</th>
            <th scope="col">CEDULA </th>
            <th scope="col">NOMBRE</th>
            <th scope="col">CARRERA</th>
            <th scope="col">DESCRRIPCION</th>
            <th scope="col">FECHA DE CREACION</th>
            <th scope="col">ACCIONES</th>
          </tr>
        </thead>
      <tbody>    
        
       
      </tbody>
    </table>
    </div>
   
    
</div>
@endsection
@section('scripts')

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js">
</script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js" type="text/javascript"></script>

<script >
var url = "solicitudesPorDestinatario/"+$('#idProfile').val();


var tabla = $('#solicitud').DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        ajax: url,
        columns: [
           
                { data: 'id'}, 
                {data: 'title_transact'},
                {data: 'ci_student'},
                {data: 'name_student'},
                {data: 'career_student'},
                {data: 'detail_transact'},
                {data: 'date_creation'},
                {data: 'btn'},
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


</script>
<script>


var button = $('.eliminarSolicitud')
    var url = window.location.origin


    
    function eliminarSolicitud(id) {
        Swal.fire({
            title: 'Seguro desea eliminar a la Solicitud?',
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
                        url: `${url}/solicitudesEstudiantesDelete/${id}`,
                        data: {
                            '_token': $('input[name=_token]').val(),
                            '_method': 'DELETE'
                        },
                        success: function (response) {
                            $(`#${id}`).css('display', 'none')
                            Swal.fire(
                                'La Solicituda ha sido eliminado!',
                                '',
                                'success'
                                
                            )
                            location.reload();
                        }, error: function(response) {
                            alert('Algo salio mal.')
                        }
                       
                    });
                   

            }
            
        })
        
    }
</script>
    
});
</script>
@endsection
