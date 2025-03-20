@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Cuenta')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Izquierda) -->
            <div class="col-md-3 profile-sidebar">
                <div class="sidebar-content">
                    <img src="{{ asset('assets/icons/profile.png') }}" class="profile-img rounded-circle mb-3" width="120"
                        alt="Foto de perfil">
                    <h3 class="text-light">{{ Auth::user()->nombre }}</h3>

                    <p>
                        Aqui puedes modificar los datos de tu cuenta.
                    </p>

                </div>
            </div>

            <!-- Formulario de edición de perfil -->
            <div class="col-md-9" id="editProfile" style="display: none;">
                <h2>Editar Perfil</h2>
                <form action="{{ route('perfil') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ Auth::user()->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleEditProfile()">Cancelar</button>
                </form>
            </div>
        </div>
    </div>


@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/perfil_styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cuenta_styles.css') }}">
@endsection
