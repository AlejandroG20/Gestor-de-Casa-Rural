@extends('layouts.landing')

<!-- Títulos -->
@section('title', 'Habitaciones')

@section('content')

    <div class="hero-container">
        <div class="hero-text">HABITACIONES</div>
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
                    <span>💲</span>
                    <input type="text" class="form-control" disabled placeholder="Precio Estimado"
                        value="Precio Estimado: {{ $estimatedPrice ?? '0' }} €">
                </div>

                <button type="submit" class="btn-secondary" style="margin-left: 15px;">Calcular</button>
            </form>
        </div>
    </div>

    <div class="container room-section">
        <div class="row justify-content-center g-4">
            <!-- Habitación 1 -->
            @component('components.rooms_cards')
                @slot('titulo', 'Estandar')
                @slot('ruta')
                    {{ route(name: 'matrimonio') }}
                @endslot

                @slot('foto')
                    <img src="{{ asset('assets/img/Estandar.jpg') }}" alt="Doble Executive">
                @endslot
            @endcomponent

            <!-- Habitación 2 -->
            @component('components.rooms_cards')
                @slot('titulo', 'Matrimonial')

                @slot('ruta')
                    {{ route(name: 'matrimonio') }}
                @endslot

                @slot('foto')
                    <img src="{{ asset('assets/img/Matrimonio.jpg') }}" alt="Suite de Lujo">
                @endslot
            @endcomponent

            <!-- Habitación 3 -->
            @component('components.rooms_cards')
                @slot('titulo', 'Suite')

                @slot('ruta')
                    {{ route(name: 'matrimonio') }}
                @endslot

                @slot('foto')
                    <img src="{{ asset('assets/img/Suite.jpg') }}" alt="Doble Premium">
                @endslot
            @endcomponent
        </div>
    </div>

    @component('components.benefits')
    @endcomponent

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/habitaciones_styles.css') }}">
@endsection
