@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
@endsection

@section('mainContent')
<div>
</div>

<script type="module">

    import { mainNavbar } from "{{ asset(mix('js/navbar.js')) }}";

    window.onload = function() {
        mainNavbar()
    }
</script>
@endsection
