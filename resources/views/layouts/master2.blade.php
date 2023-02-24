<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>ISTRED | {{ session('rol')->name }}</title>
	<link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ secure_asset('bootstrap-fileinput/css/fileinput.css') }}" rel="stylesheet">
	<link href="{{ secure_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
	<!-- Toastr style -->
	<link href="{{ secure_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{ secure_asset('bootstrap-sweetalert/dist/sweetalert.css') }}">
	<!-- Gritter -->
	<link href="{{ secure_asset('js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
	<link href="{{ secure_asset('css/animate.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{secure_asset('css/utilities.min.css')}}">
	<link href="{{ secure_asset('css/style.css')}}" rel="stylesheet"> 
	
	<!-- favicon -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!--<link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ secure_asset('favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ secure_asset('favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ secure_asset('favicon/site.webmanifest') }}">
	<link rel="mask-icon" href="{{ secure_asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
	<link rel="shortcut icon" href="{{ secure_asset('favicon/favicon.ico') }}">-->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('favicon/favicon.svg') }}">
    <link rel="icon" type="image/svg" sizes="32x32" href="{{ secure_asset('favicon/favicon.svg') }}">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{ secure_asset('favicon/favicon.svg') }}">
    <link rel="manifest" href="{{ secure_asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ secure_asset('favicon/favicon.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ secure_asset('favicon/favicon.svg') }}">
	@yield('assets')

	
</head>

<body>
	<div id="wrapper">
	@include('layouts.messages')
	@include( session('rol')->slug.'.layouts.nav_bar') 
	@yield('content')
	</div>
	<script type="text/javascript" src="{{ secure_asset('js/jquery-3.3.js') }}"></script>
	<script type="text/javascript" src="{{ secure_asset('js/bootstrap.js') }}"></script>
	<script src="{{ secure_asset('bootstrap-sweetalert/dist/sweetalert.min.js') }}"></script>
	<script src="{{ secure_asset('js/theme-js.js') }}"></script>
	<script src="{{ secure_asset('bootstrap-fileinput/js/fileinput.js') }}"></script>
	<script type="text/javascript">
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	</script>
	@yield('scripts')
	<script>
		$(document).ready(function() {
			//Preloader
			$(window).on("load", function() {
				preloaderFadeOutTime = 500;
				function hidePreloader() {
					var preloader = $('.loader');
					preloader.fadeOut(preloaderFadeOutTime);
				}
				hidePreloader();
			});
		});
	</script>
</body>

</html>