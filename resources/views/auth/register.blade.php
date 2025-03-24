@extends('layouts.landing')

@section('title', 'Registro')

@section('content')
    <div class="login-container">
        <h2>Registro</h2>

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

        <!-- Formulario de registro -->
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="nombre" placeholder="Usuario" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <input type="text" name="dni" placeholder="DNI" value="{{ old('dni') }}" required
                    pattern="^\d{8}[A-Za-z]$" title="El DNI debe ser de 8 dígitos seguido de una letra" maxlength="9">
            </div>
            <div class="form-group">
                <input type="tel" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" required
                    pattern="^[0-9]{9}$" title="El teléfono debe tener 9 dígitos" maxlength="9">
            </div>
            <div class="form-group">
                <input type="password" name="contraseña" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <input type="password" name="contraseña_confirmation" placeholder="Confirmar Contraseña" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Registrar">
            </div>
        </form>

        <!-- Enlace para ir al login -->
        <div class="help-links">
            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login_styles.css') }}">
@endsection
