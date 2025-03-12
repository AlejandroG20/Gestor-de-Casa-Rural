@extends('layouts.landing')

<!-- Titulos -->
{{ $titulo }}

@section('content')
    <div class="hero-container">
        <div class="hero-text">{{ $nombre }}</div>
    </div>

    <!-- Formulario de Reserva -->
    <div class="container d-flex justify-content-center">
        <div class="reservation-container">
            <form method="POST" action="{{ route('calculate-price') }}">
                @csrf
                <div class="reservation-box">
                    <span>📅</span>
                    <input type="date" class="form-control" name="check_in" placeholder="Entrada" required>
                    →
                    <input type="date" class="form-control" name="check_out" placeholder="Salida" required>
                </div>
                <div class="reservation-box">
                    <span>🏠</span>
                    <select class="form-select" name="room_type" required>
                        <option value="Suite">Suite</option>
                        <option value="Doble">Doble</option>
                        <option value="Estandar">Estandar</option>
                    </select>
                </div>
                <div class="reservation-box">
                    <span>🔒</span>
                    <input type="text" class="form-control" disabled placeholder="Precio Estimado"
                        value="{{ $estimatedPrice ?? '0' }}">
                </div>

                <button type="submit" class="btn-secondary" style="margin-left: 15px;">Calcular</button>
            </form>
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
                        {{ route(name: 'estandar') }}
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
                        {{ route(name: 'matrimonio') }}
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
                        {{ route(name: 'suite') }}
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
