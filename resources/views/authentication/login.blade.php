@extends('layouts.app')
@php
use App\ConfiguracionSistema;
use App\PeriodoLectivo;
@endphp
@section('content')
    <section>
		<!--
        <div class="loginPined animated fadeInRight">
            <figure class="loginPined__logo">
                <img src="img/logo/logo_pinedVertical.svg" alt="">
                <img src="img/logo/logo_pined.svg" alt="">
            </figure>
            <hr>
            <p class="logoPined__copyright">
                PINED 2018. Todos los derechos reservados.
            </p>
        </div>-->
        <div class="loginInstituto animated fadeIn">
            <figure class="loginInstituto__logo">
                <img @if (DB::table('institution')->where('id', '1')->first()->logo == null) src="{{ secure_asset('img/logo/logo.png') }}"
				@else
					src="{{ secure_asset('img/logo/' .DB::table('institution')->where('id', '1')->first()->logo) }}" @endif
                    alt="">
            </figure>
            @if ($errors->has('login_fail'))
                <span class="help-block">
                    <strong>{{ $errors->first('login_fail') }}</strong>
                </span>
            @endif
            <form class="loginInstituto__form" action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <input type="email" name="email" placeholder="Correo" id="inputEmail3" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <div class="mostrarContraseña">
                    <input type="password" name="password" placeholder="Contraseña" id="inputPassword3" required>
                    <a>
                        <i class="fa fa-eye" aria-hidden="true" class="icon__eye"></i>
                    </a>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <input type="submit" value="Ingresar">
            </form>
            @php
                $ModuloAdmisiones = ConfiguracionSistema::admisiones();
                $AdmisionesBuscar = ConfiguracionSistema::AdmisionesBuscar();
                //dd($AdmisionesBuscar);
            @endphp
            <div class="login__footer">
				<style>
					.btn-info-2{
						background-color: #21376D;
						border:none; 
						margin-left: 9%; 
						margin-right: 7%; 
						margin-bottom: 10px;
						border-bottom: none !important;
					}
					.btn-info-2:hover{
						background-color: #597CC2;
					}
				</style>
                @if ($ModuloAdmisiones != null && $AdmisionesBuscar != null)
                    <a href="{{ route('admision') }}" class="btn btn-info btn-info-2">
                        Admisiones
                    </a>
                @elseif($ModuloAdmisiones != null && $ModuloAdmisiones->valor == '1')
                    <a href="{{ route('nuevoEstudiante') }}" class="btn btn-info"
                        style=" margin-left: 9%; margin-right: 7%; border-bottom: none !important">
                        Admisiones
                    </a>
                @endif
                @if ($institution->sitioWeb != null)
                    <a href="http://{{ $institution->sitioWeb }}" target="_blank"
                        class="login__footer__link">{{ $institution->sitioWeb }}</a>
                @else
                    <div></div>
                @endif
                <div class="login__footer__social">
                    @if ($institution->youtube != null)
                        <a href="http://{{ $institution->youtube }}">
                            <svg width="26" height="23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M24.8108 5.57404c-.2835-1.0624-1.1189-1.89912-2.1795-2.18307C20.7089 2.875 13 2.875 13 2.875s-7.70884 0-9.63135.51597c-1.06063.284-1.89597 1.12067-2.17948 2.18307C.674042 7.49971.674042 11.5174.674042 11.5174s0 4.0178.515128 5.9434c.28351 1.0624 1.11885 1.8643 2.17948 2.1482C5.29116 20.125 13 20.125 13 20.125s7.7088 0 9.6313-.516c1.0606-.2839 1.896-1.0858 2.1795-2.1482.5151-1.9256.5151-5.9434.5151-5.9434s0-4.01769-.5151-5.94336zm-14.332 9.59116V7.86964l6.443 3.64786-6.443 3.6477z"
                                    fill="#0099D6" />
                            </svg>
                        </a>
                    @endif
                    @if ($institution->facebook != null)
                        <a href="http://{{ $institution->facebook }}" target="_blank">
                            <svg width="13" height="23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.3401 12.9375l.5776-4.16246H8.30578V6.07389c0-1.13877.50456-2.24879 2.12222-2.24879h1.6421V.281211S10.58 0 9.15524 0C6.18068 0 4.23637 1.99363 4.23637 5.60266v3.17238H.929901v4.16246H4.23637V23h4.06941V12.9375h3.03432z"
                                    fill="#0099D6" />
                            </svg>
                        </a>
                    @endif
                    @if ($institution->twitter != null)
                        <a href="http://{{ $institution->twitter }}" target="_blank">
                            <svg width="23" height="23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.6358 6.81535c.0146.2043.0146.40865.0146.61295 0 6.2316-4.743 13.4118-13.41182 13.4118-2.6707 0-5.15164-.7735-7.23858-2.1161.379455.0438.744266.0584 1.13832.0584 2.20364 0 4.23222-.7443 5.85215-2.014-2.07233-.0438-3.80901-1.401-4.40737-3.269.2919.0437.58376.0729.89026.0729.42321 0 .84646-.0584 1.24047-.1605C2.55394 12.974.933971 11.0768.933971 8.78553v-.05835c.627509.35025 1.357269.56916 2.130689.59831C1.79499 8.47903.96317 7.03425.96317 5.39972c0-.87561.23346-1.67828.64211-2.37879 2.32044 2.8604 5.8084 4.72839 9.71952 4.93274-.0729-.35026-.1167-.71507-.1167-1.07993 0-2.59774 2.1015-4.71383 4.7138-4.71383 1.3572 0 2.5831.56916 3.4441 1.48858 1.0654-.20431 2.0869-.59836 2.9918-1.13832-.3503 1.09456-1.0946 2.01398-2.0723 2.5977.9486-.10211 1.868-.36486 2.7144-.72967-.642.93397-1.4447 1.76579-2.3641 2.43715z"
                                    fill="#0099D6" />
                            </svg>
                        </a>
                    @endif
                    @if ($institution->instagram != null)
                        <a href="http://{{ $institution->instagram }}" target="_blank">
                            <svg width="20" height="23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                    <path
                                        d="M10.0045 6.33397c-2.83933 0-5.12951 2.30449-5.12951 5.16153 0 2.857 2.29018 5.1615 5.12951 5.1615 2.8392 0 5.1294-2.3045 5.1294-5.1615 0-2.85704-2.2902-5.16153-5.1294-5.16153zm0 8.51723c-1.83487 0-3.33487-1.5049-3.33487-3.3557 0-1.85079 1.49554-3.35567 3.33487-3.35567 1.8392 0 3.3348 1.50488 3.3348 3.35567 0 1.8508-1.5 3.3557-3.3348 3.3557zm6.5357-8.72836c0 .66933-.5357 1.20391-1.1965 1.20391-.6651 0-1.1964-.53907-1.1964-1.20391s.5357-1.20391 1.1964-1.20391c.6608 0 1.1965.53907 1.1965 1.20391zm3.3973 1.22187c-.0759-1.61269-.442-3.04121-1.6161-4.21816-1.1696-1.17695-2.5893-1.54531-4.1919-1.62617-1.6518-.09434-6.60272-.09434-8.25451 0-1.59821.07637-3.01786.44472-4.19196 1.62168C.50892 4.29901.147313 5.72753.066955 7.34022c-.09375 1.66211-.09375 6.64398 0 8.30608.075893 1.6127.441965 3.0412 1.616075 4.2181 1.1741 1.177 2.58928 1.5454 4.19196 1.6262 1.65179.0943 6.60271.0943 8.25451 0 1.6026-.0764 3.0223-.4447 4.1919-1.6262 1.1697-1.1769 1.5357-2.6054 1.6161-4.2181.0937-1.6621.0937-6.63948 0-8.30159zM17.8036 17.4297c-.3483.8804-1.0224 1.5588-1.9018 1.9136-1.317.5256-4.442.4043-5.8973.4043-1.4554 0-4.58487.1168-5.89737-.4043-.875-.3503-1.5491-1.0287-1.90178-1.9136-.52232-1.3252-.40179-4.4698-.40179-5.9342 0-1.4645-.11607-4.61348.40179-5.93418.34821-.88047 1.02232-1.55879 1.90178-1.91368 1.31697-.52558 4.44197-.40429 5.89737-.40429 1.4553 0 4.5848-.1168 5.8973.40429.875.35039 1.5491 1.02871 1.9018 1.91368.5223 1.32519.4017 4.46968.4017 5.93418 0 1.4644.1206 4.6135-.4017 5.9342z"
                                        fill="#0099D6" />
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <path fill="#fff" d="M0 0h20v23H0z" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script>
        const inputPass = document.querySelector('.mostrarContraseña input')
        const a = document.querySelector('.mostrarContraseña a');
        const eye = document.querySelector('.mostrarContraseña i');

        a.addEventListener('click', function() {
            if (inputPass.type === "password") {
                inputPass.type = 'text';
                eye.setAttribute('class', 'fa fa-eye-slash');
            } else {
                inputPass.type = 'password';
                eye.setAttribute('class', 'fa fa-eye');
            }
        })
    </script>
@endsection
