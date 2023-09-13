@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-section.css') }}">
@endsection
@section('content')
    <div class="admin-section">
        <div>
            <p class="title">Vacaciones</p>
            <p class="sub-title">Acá vas a poder habilitar el modo vacaciones para dejar aviso a tus clientes.</p>
        </div>
        <form action="{{ url('/administracion/vacaciones') }}" method="POST">
            @csrf
            <div class="form-check form-switch" style="display: flex; align-items: center; padding: 0">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="margin: 0; margin-right: 1rem;" name="vacationsSwitch" @if ($vacations == 1) checked @endif>
                <label class="label" for="flexSwitchCheckDefault">Modo vacaciones</label>
            </div>
            <button class="btn button-filter w-50" style="max-width: none; margin-top: 1rem;">Modificar modo vacaciones</button>
        </form>
    </div>
    <script type="module">
        import { showSuccess, showErrors } from "{{ asset(mix('js/module/sweetAlert.js')) }}";
    </script>
@endsection
