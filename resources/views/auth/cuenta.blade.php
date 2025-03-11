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

                    <div class="botones">
                        <form action="" method="POST">
                            <button class="btn btn-secondary mt-3">Editar Perfil</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger mt-3">Cerrar Sesion</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div>

        </div>

    </div>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cuenta_styles.css') }}">
@endsection
