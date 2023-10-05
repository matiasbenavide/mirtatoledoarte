@extends('layouts.infoSections')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection
@section('mainContent')
<div class="main-container">
    <p class="main-title">Política de Devoluciones</p>
    <div class="text-container">
        <p class="main-text">Los cambios se pueden hacer dentro de los 30 días luego de realizada la compra (el producto sin lavar y sin uso). El costo del envío o reenvío quedará a cargo del comprador.</p>
        <p class="main-text">Para solicitar el cambio deberás comunicarte por Whatsapp. Si es por defectos de fábrica, contactanos dentro de las 72 hs. hábiles después de recibir tu pedido. Pasado ese tiempo, no se aceptarán devoluciones.</p>
    </div>
</div>

<script type="module">

    import { showSuccess, showErrors } from "{{ asset(mix('js/module/sweetAlert.js')) }}";
    import { mainNavbar } from "{{ asset(mix('js/admin/navBar.js')) }}";
    import { mainFooter } from "{{ asset(mix('js/admin/footer.js')) }}";

    let url = {!! json_encode(url('/productos')) !!};

    window.onload = function() {
        mainNavbar({
            url: url
        })
        mainFooter()
    }
</script>
@endsection
