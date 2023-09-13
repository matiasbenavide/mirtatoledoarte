@extends('layouts.infoSections')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection
@section('mainContent')
<div class="main-container">
    <p class="main-title">Preguntas Frecuentes</p>
    <div class="text-container">
        <p class="main-text question">¿De qué material están realizados los elementos de las plazas sin pintar?</p>
        <p class="main-text answer">Se realizan en mdf de 15mm. De espesor y palos de pino de 28mm. De diámetro</p>
        <p class="main-text question">¿De qué material están realizados los elementos de las plazas pintadas?</p>
        <p class="main-text answer">Las plazas pintadas se realizan con laterales enchapados en Roble Kaiserberg de 18mm. De espesro, palos de pino de 28mm. de diámetro. Pintura y barniz al agua.</p>
        <p class="main-text question">¿Cuáles son las terminaciones?</p>
        <p class="main-text answer">Se entrega todo lijado, con los bordes redondeados, sin cantos filosos. Cada pieza encastrada, encolada y atornillada.</p>
        <p class="main-text question">¿Cuánto peso soportan los elementos de las plazas?</p>
        <p class="main-text answer">Están diseñados para soportar aproximadamente 60kg.</p>
        <p class="main-text question">¿Para qué edades están recomendadas las plazas?</p>
        <p class="main-text answer">Algunos de los elementos de las plazas se comiezan a disfrutar  desde antes del año de edad, como por ej. el balancín y hasta los 6/7 años aproximadamente, dependiendo siempre de la contextura y madurez.</p>
    </div>
</div>

<script type="module">

    import { showSuccess, showErrors } from "{{ asset(mix('js/module/sweetAlert.js')) }}";
    import { mainNavbar } from "{{ asset(mix('js/admin/navBar.js')) }}";
    import { mainFooter } from "{{ asset(mix('js/admin/footer.js')) }}";

    window.onload = function() {
        mainNavbar()
        mainFooter()
    }
</script>
@endsection
