@extends('layouts.master') 
@section('content')
@php
$user_data = session('user_data');
@endphp
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper border-bottom white-bg" style="background: #ebebed">
        <div class="row wrapper border-bottom white-bg">
            <div class="repProfileHijo--cont">
                <figure class="repProfileHijo__resumen--img">
                    <img src="{{ $user_data->url_imagen == null ? secure_asset("img/icono_persona.png") : secure_asset("storage/$user_data->url_imagen") }}" class="img-circle circle-border m-b-md" alt="profile">
                </figure>
                <div class="repProfileHijo__resumen--info">
                    <h3 class="repProfileHijo__resumen--name">{{$hijo->nombres}} {{$hijo->apellidos}}</h3>
                    <hr>
                    <div class="repProfileHijo__resumen--curso">
                        <h4>
							<strong>Curso: </strong> {{ $course->grado}} {{ $course->paralelo}} {{$course->especializacion}} </h4>
                        <h4>
                            <strong>DOCENTE: </strong> @if($tutor!=null) {{ $tutor->nombres }} {{ $tutor->apellidos }} @endif</h4>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.representante._agendaIndex', [
			'perfil' => 'estudiante'
		])
    </div>
    <script src="{{secure_asset('js/jquery-2.1.1.js')}}"></script>
    <script>
        // tabbed content
        $(".tab_content").hide();
        $(".tab_content:first").show();

        /* if in tab mode */
        $("ul.tabs li").click(function () {
            $(".tab_content").hide();
            var activeTab = $(this).attr("rel");
            $("#" + activeTab).fadeIn();
            $("ul.tabs li").removeClass("active");
            $(this).addClass("active");
            $(".tab_drawer_heading").removeClass("d_active");
            $(".tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");
            /*$(".tabs").css("margin-top", function(){ 
               return ($(".tab_container").outerHeight() - $(".tabs").outerHeight() ) / 2;
            });*/
        });
        $(".tab_container").css("min-height", function () {
            return $(".tabs").outerHeight() + 50;
        });
        /* if in drawer mode */
        $(".tab_drawer_heading").click(function () {

            $(".tab_content").hide();
            var d_activeTab = $(this).attr("rel");
            $("#" + d_activeTab).fadeIn();

            $(".tab_drawer_heading").removeClass("d_active");
            $(this).addClass("d_active");

            $("ul.tabs li").removeClass("active");
            $("ul.tabs li[rel^='" + d_activeTab + "']").addClass("active");
        });

    </script>
</div>
@endsection