<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $user = Sentinel::getUser();
        $user = App\Administrative::where('userid', $user->id)->first();
    @endphp
    <title>ISTRED | {{ $user->rolPivot->rol->name }}</title>
    {{-- datatable --}}
    <link rel="stylesheet" href=" {{ secure_asset('css/datatables.css') }} ">
    @yield('css')
    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('bootstrap-fileinput/css/fileinput.css') }}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{ secure_asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <!-- Gritter -->
    <link href="{{ secure_asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/utilities.min.css') }}">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('favicon/favicon.svg') }}">
    <link rel="icon" type="image/svg" sizes="32x32" href="{{ secure_asset('favicon/favicon.svg') }}">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{ secure_asset('favicon/favicon.svg') }}">
    <link rel="manifest" href="{{ secure_asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ secure_asset('favicon/favicon.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ secure_asset('favicon/favicon.svg') }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-47893174-12"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-47893174-12');
    </script>
    @yield('styles')
</head>

<body>
    <div id="wrapper">
        @include('layouts.messages')
        @include( $user->rolPivot->rol->slug.'.layouts.nav_bar')
        @yield('content')
    </div>
    <script src="{{ secure_asset('js/theme-js.js') }}"></script>
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
