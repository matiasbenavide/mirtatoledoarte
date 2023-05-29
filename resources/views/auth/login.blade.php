@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-form">
    <div class="login">
        <div class="welcome">
            <h1 class="title">INICIAR SESIÓN</h1>
            <P>¡Te damos la Bienvenida!</P>
        </div>

        <div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="label">Email</label>

                    <div>
                        <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password" class="label">Contraseña</label>

                    <div>
                        <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mt-2 mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Recordarme
                    </label>
                </div>

                <div class="login-button-div">
                    <button type="submit" class="login-button button">
                        Iniciar Sesión
                    </button>

                    @if (Route::has('password.request'))
                        <a class="mt-2" href="{{ route('password.request') }}">
                            ¿Olvidaste tu Contraseña?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
