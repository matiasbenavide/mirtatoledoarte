@extends('layouts.default')
@section('content')
<div id="main">
    @include('includes.navBar')
    @yield('mainContent')
    @include('includes.responseMessageAlert')
</div>
@endsection
