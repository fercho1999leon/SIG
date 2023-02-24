@extends('layouts.master')
@section('content')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('layouts.nav_bar_top')
        <div class="col-lg-12">
            <h2 style="margin:0.5em 0">
                <i class="fa fa-bookmark" style="color: #0099D6"></i> {{ $course->grado }} {{ $course->paralelo }}
            </h2>
        </div>
        <div class="row mt-1" style="margin-bottom: 350px">
            <div class="wrapper wrapper-content">
                
               
            </div>
        </div>
    </div>
@endsection

