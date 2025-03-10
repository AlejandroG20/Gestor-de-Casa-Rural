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
                                <div class="reservation-item">
                                    <div class="reservation-img">
                                        <img src="{{ $reserva->habitaciones->first()->imagen_url }}"
                                            alt="Imagen de la habitación">
                                    </div>
                                    <div class="reservation-info">
                                        <h4>{{ $reserva->habitaciones->first()->tipo }}</h4>
                                        <p><strong>Check In:</strong>
                                            {{ \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d-m-Y') }}</p>
                                        <p><strong>Check Out:</strong>
                                            {{ \Carbon\Carbon::parse($reserva->fecha_fin)->format('d-m-Y') }}</p>
                                        <p><strong>Precio Total:</strong> {{ $reserva->precio_total }} €</p>

                                        <h5>Servicios:</h5>
                                        <ul>
                                            @foreach ($reserva->servicios as $servicio)
                                                <li>{{ $servicio->nombre }}: {{ $servicio->precio }} €</li>
                                            @endforeach
                                        </ul>

                                        <h5>Habitaciones:</h5>
                                        <ul>
                                            @foreach ($reserva->habitaciones as $habitacion)
                                                <li>{{ $habitacion->tipo }} - {{ $habitacion->precio }} €</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- Formulario para cancelar la reserva -->
                                    <form action="{{ route('reservas.cancelar', $reserva->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que quieres cancelar esta reserva?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cancel-btn">Cancelar Reserva</button>
                                    </form>
                                </div>
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
