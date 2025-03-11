@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Habitaciones')

@section('content')

    <div class="hero-container">
        <div class="hero-text">HABITACIONES</div>
    </div>

    @component('components.previsualizar_reserva')
    @endcomponent
    
    </div>

    <hr>

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

    <hr>
    @component('components.benefits')
    @endcomponent

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/habitaciones_styles.css') }}">
@endsection
