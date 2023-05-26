<meta charset="utf-8">
<meta http-equiv="Content-Language" content="es">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ config('app.name', 'GridMakers') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset(mix('css/adminApp.css')) }}" rel="stylesheet">
<link href="{{ asset('frontend/css/bootstrap5.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

<link  rel="icon" href="{{asset('admin/assets/icons/favicon.svg')}}" />

@yield('css')

@stack('scripts')

<!-- Scripts from npm -->
<script type="text/javascript" src="{{ asset(mix('js/app-back.js')) }}"></script>
<script src="https://kit.fontawesome.com/505c81edde.js" crossorigin="anonymous"></script>
