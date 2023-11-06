@extends('layouts.default')
@section('content')
<div id="main">
    @if ($vacations)
        @include('includes.vacations')
    @endif
    @include('includes.navbar')
    @yield('mainContent')
    @include('includes.wpp')
    @include('includes.footer')
    @include('includes.responseMessageAlert')
</div>
@endsection
