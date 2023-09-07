@extends('layouts.default')
@section('content')
<div id="main">
    @include('includes.navbar')
    @yield('mainContent')
    @include('includes.responseMessageAlert')
</div>
@endsection
