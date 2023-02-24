@extends('layouts.master') 
@section('content')
<div id="page-wrapper" class="gray-bg dashbard-1">
    @include('layouts.nav_bar_top')
    <div class="row wrapper white-bg ">
        <div class="col-lg-12 titulo-separacion">
            <h2 class="title-page">
                <i class="fa fa-clock-o text-color7"></i> 
                {{ $course->grado }} {{ $course->paralelo }}
            </h2>
        </div>
    </div>
    @include('partials.horarioCurso')
</div>
@endsection
