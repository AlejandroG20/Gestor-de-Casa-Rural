@extends('layouts.landing')

<!-- Titulos -->
{{ $titulo }}

@section('content')
    <div class="hero-container">
        <div class="hero-text">{{ $nombre }}</div>
    </div>

    <div class="container d-flex justify-content-center">
        <div class="reservation-container">
            <div class="reservation-box">
                <span>📅</span>
                <input type="date" class="form-control" placeholder="Entrada">
                →
                <input type="date" class="form-control" placeholder="Salida">
            </div>
            <div class="reservation-box">
                <span>🏠</span>
                <select class="form-select">
                    <option>Suite</option>
                    <option>Doble</option>
                    <option>Estandar</option>
                </select>
            </div>
            <div class="reservation-box">
                <span>🔒</span>
                <input type="text" class="form-control" disabled placeholder="Precio Estimado">
            </div>
            <button class="btn-secondary">RESERVAR</button>
        </div>
    </div>

    <div class="room-section">
        <div class="room-container">
            <!-- Imagen de la habitación -->
            <div class="room-image">
                {{ $foto2 }}
            </div>

            <!-- Descripción de la habitación -->
            <div class="room-description">
                <h2>{{ $nombre }}</h2>
                <p>
                    <strong>Las habitaciones de nuestra casa rural</strong> están diseñadas para ofrecer una experiencia
                    acogedora y cómoda,
                    adaptándose a las diferentes necesidades de nuestros huéspedes.
                </p>
                {{ $contenido }}
            </div>
        </div>
    </div>

    <hr>
    @component('components.benefits')
    @endcomponent
    <hr>

    <div class="container room-section">
        <div class="row justify-content-center g-4">
            <!-- Habitación 1 -->
            @if (Route::currentRouteName() !== 'estandar')
                @component('components.rooms_cards')
                    @slot('titulo', 'Estandar')

                    @slot('ruta')
                        <a href="{{ route(name: 'estandar') }}" class="btn-tertiary">Ver Habitación</a>
                    @endslot

                    @slot('foto')
                        <img src="{{ asset('assets/img/Estandar.jpg') }}" alt="Doble Executive">
                    @endslot
                @endcomponent
            @endif

            <!-- Habitación 2 -->
            @if (Route::currentRouteName() !== 'matrimonio')
                @component('components.rooms_cards')
                    @slot('titulo', 'Matrimonial')

                    @slot('ruta')
                        <a href="{{ route('matrimonio') }}" class="btn-tertiary">Ver Habitación</a>
                    @endslot

                    @slot('foto')
                        <img src="{{ asset('assets/img/Matrimonio.jpg') }}" alt="Suite de Lujo">
                    @endslot
                @endcomponent
            @endif

            <!-- Habitación 3 -->
            @if (Route::currentRouteName() !== 'suite')
                @component('components.rooms_cards')
                    @slot('titulo', 'Suite')

                    @slot('ruta')
                        <a href="{{ route('suite') }}" class="btn-tertiary">Ver Habitación</a>
                    @endslot

                    @slot('foto')
                        <img src="{{ asset('assets/img/Suite.jpg') }}" alt="Doble Premium">
                    @endslot
                @endcomponent
            @endif
        </div>
    </div>
@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/habitaciones_styles.css') }}">
    <style>
        .hero-container {
            {{ $fondo }}
        }
    </style>
@endsection
