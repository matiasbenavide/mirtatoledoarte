@extends('layouts.default')
@section('content')
<div id="main">
    @yield('mainContent')
    @include('includes.responseMessageAlert')
</div>
@endsection
