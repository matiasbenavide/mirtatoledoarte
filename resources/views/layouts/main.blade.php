@extends('layouts.default')
@section('content')
<div id="main">
    @if ($vacations == 1)
        @include('includes.vacations')
    @endif
    @include('includes.navbar')
    @yield('mainContent')
    @include('includes.wpp')
    @include('includes.footer')
    @include('includes.responseMessageAlert')
</div>
@endsection
