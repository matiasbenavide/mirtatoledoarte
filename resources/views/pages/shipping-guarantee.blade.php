@extends('layouts.infoSections')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection
@section('mainContent')
<div class="main-container">
    <p class="main-title">Envíos y Garantías</p>
    <div class="text-container">
        <p class="main-text">El comprador indicará la dirección de destino lo más específica posible y con la mayor cantidad de detalles, es responsabilidad de éste la exactitud de los datos para el envío, por tanto, si el producto no llega a su verdadero destino, por error en el suministro de la dirección por parte del comprador, no se realizará ningún cambio o devolución, ni se realizará ninguna gestión administrativa para que se corrija la dirección.</p>
        <p class="main-text">Si el error en los datos del envío es imputable a Jugandotoy, se realizarán todas las acciones necesarias para que el producto llegue al comprador, sin costo adicional alguno.</p>
        <p class="main-text">El costo y tiempos de envío pueden cambiar según la ciudad. Contactarse vía whatsapp o correo electrónico con nosotros para cotizar el mismo.</p>
        <p class="main-text">Los envíos al interior se realizan por transporte de carga, los elementos desarmados, con los tornillos necesarios y un folleto explicativo para el armado.</p>
        <p class="main-text">Nuestros productos cuentan con una garantía de fábrica de 6 meses.</p>
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
