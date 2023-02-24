@extends('layouts.master2')
@section('assets')
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs/dt-1.11.4/b-2.2.2/b-html5-2.2.2/r-2.2.9/datatables.min.css" />
    <!--Biblioteca virtual-->
	<link rel="stylesheet" href="{{secure_asset('css/bibliotecavirtual.css')}}">
	<!--Biblioteca virtual-->
@endsection

@php
use App\Bibliotecavirtual;
use App\SeccionBiblioteca;
$virtual = Bibliotecavirtual::getAllConfig();
$seccions = SeccionBiblioteca::getAllConfig();
@endphp

@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="row wrapper white-bg titulo-separacion noBefore">
            <div class="col-xs-12 titulo-separacion">
                <h2 class="title-page text-uppercase">Biblioteca Virtual</h2>
            </div>
        </div>    
        <div class="row wrapper">
            @foreach($seccions as $seccion)
                @if($seccion->is_active)
                    <div class="col-xs-12 p-1 bg-black">
                        <h1 class="text-uppercase text-white" style="text-align: center">{{$seccion->seccion}}</h1>
                    </div>
                    <div class="col-xs-12">
                        <div class="mrAdministrativo" style="margin: 0;">
                            @foreach($virtual->where('id_seccion_biblioteca',$seccion->id) as $biblioteca)
                                @if($biblioteca->is_active == 1)
                                    <div class="card-biblioteca-virtual">
                                        <a onclick="registro('{{$biblioteca->urlbiblioteca}}','{{$biblioteca->id}}')">
                                            <h3 >{{$biblioteca->name}}</h3>
                                            <div style="height: 70%;display: flex;flex-direction: column;justify-content: center;">
                                                <img class="mr-05" src="{{secure_asset('bibliotecavirtual/'.$biblioteca->urlimage)}}" width="90%">
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach  
        </div>
    </div>    
@endsection
@section('scripts')
    <script>
        //let newWin = window.open("https://elibro.net", "Biblioteca", "width=500px,height=500px");
        const registro = (url,id) => {
            const newWin = window.open(url, "Biblioteca", "width=500px,height=500px");
            let contadorTiempo = 0;
            if(newWin.opener && !newWin.opener.closed){
                console.log('Ventana Abierta');
                const time = setInterval(()=>{
                    if (newWin.opener && !newWin.opener.closed) {
                        contadorTiempo++;
                    }else{
                        clearInterval(time);
                        console.log('Ventana cerrada');
                        console.log('Tiempo en segundos: ',contadorTiempo);
                        $.ajax({
                            type: 'POST',
                            url: "{{route('registertimelibrary')}}",
                            dataType: 'json',
                            data: {
                                id,
                                contadorTiempo,
                            },
                            success: function(result) {
                                location.reload();
                            },
                            error: function(result) {
                                var errors = result.responseJSON;
                                if (errors){
                                    $.each(errors, function(i) {
                                        console.error(errors[i]);
                                    });
                                }
                            }
                        });
                    }
                },1000);
            }
        }
    </script>
@endsection
