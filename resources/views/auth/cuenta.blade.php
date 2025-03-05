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
                    <button class="btn btn-primary mt-3">Editar Perfil</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger mt-3">Cerrar Sesion</button>
                    </form>

                    <h4 class="section-title">Verificación de Identidad</h4>
                    <p class="description">Esta cuenta esta verificada por completo.</p>

                    <h3 class="user-name">{{ Auth::user()->nombre }}</h3>
                    <p class="verification">
                        ✅ Email Confirmado <br>
                        ✅ Mobile Confirmado
                    </p>
                </div>
            </div>

            <!-- Contenido Principal (Derecha) -->
            <div class="col-md-9 profile-content">
                <div class="content-wrapper">
                    <h1 class="fw-bold">Bienvenido, <span class="text-highlight">{{ Auth::user()->nombre }}</span></h1>
                    <p>Aquí puedes gestionar tus reservas y estancias activas.</p>
                    <hr>

                    <!-- Sección de Reservas -->
                    <div class="reservations-container">
                        <div class="tabs">
                            <span class="tab active">Reservas</span>
                        </div>


                        @if ($reservas->isEmpty())
                            <p>No tienes reservas.</p>
                        @else
                            @foreach ($reservas as $reserva)
                                @component('components.reserva')
                                    @slot('tipo', $reserva->habitacion->tipo)
                                    <!-- Asegúrate de tener esta relación en el modelo -->
                                    @slot('fecha_entrada', $reserva->fecha_entrada->format('d-m-Y'))
                                    <!-- Si tienes una fecha de entrada -->
                                    @slot('fecha_salida', $reserva->fecha_salida->format('d-m-Y'))
                                    <!-- Si tienes una fecha de salida -->
                                    @slot('precio', $reserva->precio)
                                    <!-- Asegúrate de tener el precio disponible en el modelo -->
                                @endcomponent
                            @endforeach
                        @endif
                    </div>
                </div>

                <br>

                <!-- Sección de Estancias Activas -->
                <div class="stays-container">
                    <div class="tabs">
                        <span class="tab active">Estancias</span>
                    </div>

                    <div class="stay-item">
                        <div class="stay-img">
                        </div>
                        <div class="stay-info">
                            <h4>Suite de Lujo</h4>
                            <p><strong>Check In:</strong> 5 Marzo 2025</p>
                            <p><strong>Check Out:</strong> 10 Marzo 2025</p>
                            <p><strong>Huespedes:</strong> 2 Adultos</p>
                            <p class="price">200 €</p>
                        </div>
                        <button class="details-btn">Ver Detalles</button>
                    </div>

                    <div class="stay-item">
                        <div class="stay-img"></div>
                        <div class="stay-info">
                            <h4>Suite de Lujo</h4>
                            <p><strong>Check In:</strong> 5 Marzo 2025</p>
                            <p><strong>Check Out:</strong> 10 Marzo 2025</p>
                            <p><strong>Huespedes:</strong> 2 Adultos</p>
                            <p class="price">200 €</p>
                        </div>
                        <button class="details-btn">Ver Detalles</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cuenta_styles.css') }}">
@endsection
