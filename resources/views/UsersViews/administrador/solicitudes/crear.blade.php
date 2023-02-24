@extends('layouts.master')
@section('content')
	<a class="button-br" href=" {{route('solicitudes') }} ">
		<button>
			<img src="{{secure_asset('img/return.png')}}" alt="" width="17"> Regresar
		</button>
	</a>

    <div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
        @include('partials.solicitudes.solicitudTramiteCrear')
    </div>
        
</div>
@endsection


@section('scripts')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
$(document).ready(function(){
	$("#name_addressee").hide();
$('#NuevoEmail').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
        var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocompleteEmail') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#listaCorreos').show();

                    $('#listaCorreos').html(data);
          }
         });
        }
    });
});

function agregarEmail($id,$correo,$nombres,$apellidos){
    //alert($id);
	console.log($nombres);
    console.log($id);

    $('#listaCorreos').hide();
	
	$("#name_addressee").show();
	$("#name_addressee").val($nombres+' '+$apellidos);
    $("#id_destinatarrio").val($id);
	//document.querySelector("").value = ;
    }
</script>
@endsection
