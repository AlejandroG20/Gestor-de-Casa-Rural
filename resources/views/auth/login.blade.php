@extends('layouts.landing')

<!-- Títulos -->
@section('title', 'Iniciar Sesión')

@section('content')
    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <!-- Mostrar mensajes de error -->
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de login -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <input type="password" name="contraseña" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Iniciar Sesión">
            </div>
        </form>

        <!-- Enlace para ir al registro -->
        <div class="help-links">
            <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
        </div>
    </div>
@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login_styles.css') }}">
@endsection
