@extends('layouts.default')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <div class="register">
        <div class="welcome">
            <h1 class="title">¡REGISTRATE!</h1>
        </div>

        <div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mt-4">
                    <label for="name" class="label">Nombre de Usuario</label>

                    <div>
                        <input id="name" type="text" class="form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="email" class="label">E-mail</label>

                    <div>
                        <input id="email" type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password" class="label">Contraseña</label>

                    <div class="">
                        <input id="password" type="password" class="form-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="my-4">
                    <label for="password-confirm" class="label">Confirmar Contraseña</label>

                    <div>
                        <input id="password-confirm" type="password" class="form-input" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="register-button-div">
                    <button type="submit" class="register-button button">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
