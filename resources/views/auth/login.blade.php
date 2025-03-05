@extends('layouts.landing')

<!-- Titulos -->
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
                <input type="text" name="username" placeholder="Usuario" value="{{ old('username') }}" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Iniciar Sesión">
            </div>
        </form>
    </div>
@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login_styles.css') }}">
@endsection
