@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Habitaciones')

@section('content')

    <div class="hero-container">
        <div class="hero-text">HABITACIONES</div>
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

            <button class="btn-secondary" style="margin-left: 15px;">Reservar</button>
        </div>
    </div>

    <hr>

    <div class="container room-section">
        <div class="row justify-content-center g-4">
            <!-- Habitación 1 -->
            @component('components.rooms_cards')
                @slot('titulo', 'Estandar')

                @slot('ruta')
                    <a href="{{ route(name: 'estandar') }}" class="btn-tertiary">Ver Habitación</a>
                @endslot

                @slot('foto')
                    <img src="{{ asset('assets/img/Estandar.jpg') }}" alt="Doble Executive">
                @endslot
            @endcomponent

            <!-- Habitación 2 -->
            @component('components.rooms_cards')
                @slot('titulo', 'Matrimonial')

                @slot('ruta')
                    <a href="{{ route('matrimonio') }}" class="btn-tertiary">Ver Habitación</a>
                @endslot

                @slot('foto')
                    <img src="{{ asset('assets/img/Matrimonio.jpg') }}" alt="Suite de Lujo">
                @endslot
            @endcomponent

            <!-- Habitación 3 -->
            @component('components.rooms_cards')
                @slot('titulo', 'Suite')

                @slot('ruta')
                    <a href="{{ route('suite') }}" class="btn-tertiary">Ver Habitación</a>
                @endslot

                @slot('foto')
                    <img src="{{ asset('assets/img/Suite.jpg') }}" alt="Doble Premium">
                @endslot
            @endcomponent
        </div>
    </div>

    <hr>
    @component('components.benefits')
    @endcomponent

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/habitaciones_styles.css') }}">
@endsection
