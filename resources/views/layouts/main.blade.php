@extends('layouts.default')
@section('content')
<div id="main">
    @include('includes.mainNavbar')
    @yield('mainContent')
    @include('includes.footer')
    @include('includes.responseMessageAlert')
</div>
<script type="module">
    import { main } from "{{ asset(mix('js/admin/navBar.js')) }}";
    window.onload = function () {
        main();
    }
</script>
@endsection
