@extends('layouts.infoSections')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection
@section('mainContent')
<div class="main-container contact-main">
    <p class="main-title">Contactanos</p>
    <div class="text-container contact">
        <div class="contact-form">
            {{-- <form class="contact-form" action=""> --}}
                <input class="form-input input" type="text" placeholder="Nombre">
                <div class="email-phone-container">
                    <input class="form-input input" id="email" type="text" placeholder="Correo electrónico">
                    <input class="form-input input" id="phone" type="text" placeholder="Teléfono">
                </div>
                <textarea class="form-textarea input" name="" id="" cols="30" rows="4" placeholder="Mensaje"></textarea>
                <button class="button input">ENVIAR</button>
            {{-- </form> --}}
        </div>

        <div class="info-container">
            <div class="info-container-div">
                <div class="info-div">
                    <p class="info-title">TELÉFONO</p>
                    <p class="info-text">911 6950-4614</p>
                </div>
                <div class="info-div">
                    <p class="info-title">EMAIL</p>
                    <p class="info-text">info@decorelieve.com.ar</p>
                </div>
            </div>
            <div class="info-container-div">
                <div class="info-div">
                    <p class="info-title">DIRECCIÓN</p>
                    <p class="info-text">R. Montarcé 1609, El Palomar</p>
                </div>
                <div>
                    <p class="info-title">NUESTRAS REDES</p>
                    <a href="https://www.instagram.com/decorelieve/?hl=es" target="_blank">
                        <img src="{{ asset('admin/assets/icons/igIconBlue.svg') }}" alt="">
                    </a>
                    <a id="fb-icon" href="https://m.facebook.com/DecoRelieve/" target="_blank">
                        <img src="{{ asset('admin/assets/icons/fbIconBlue.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">

    import { showSuccess, showErrors } from "{{ asset(mix('js/module/sweetAlert.js')) }}";
    import { mainNavbar } from "{{ asset(mix('js/admin/navBar.js')) }}";
    import { mainFooter } from "{{ asset(mix('js/admin/footer.js')) }}";

    let url = {!! json_encode(url('/productos')) !!};
    let baseUrl = {!! json_encode(url('/')) !!};

    window.onload = function() {
        mainNavbar({
            url: url
        })
        mainFooter({
            url: baseUrl
        })
    }
</script>
@endsection
