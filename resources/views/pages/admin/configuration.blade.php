@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-section.css') }}">
@endsection
@section('content')
    <div class="admin-section">
        <p class="title">Configuración</p>
        <form action="{{ url('/administracion/productos/actualizar-precios') }}" method="POST">
            @csrf
            <div class="col-4">
                <label class="label" for="priceUpdate">Actualizar precios</label>
                <input class="form-input" type="number" name="priceUpdate" id="priceUpdate">
            </div>
            <button class="btn button-filter w-50" style="max-width: none; margin-top: 1rem;">Aplicar aumento</button>
        </form>
    </div>
    <script type="module">
        import { showSuccess, showErrors } from "{{ asset(mix('js/module/sweetAlert.js')) }}";
    </script>
@endsection
