@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Reservas')

@section('content')

    <div class="form-container">
        <h2 class="form-title">Reserva tu Estancia</h2>
        <form action="#" method="POST">
            <div class="mb-3">
                <label for="checkin" class="form-label">Fecha de Check-in</label>
                <input type="date" id="checkin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="checkout" class="form-label">Fecha de Check-out</label>
                <input type="date" id="checkout" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="guests" class="form-label">Número de huéspedes</label>
                <input type="number" id="guests" class="form-control" min="1" required>
            </div>
            <div class="mb-3">
                <label for="services" class="form-label">Servicios Adicionales</label>
                <select id="services" class="form-control">
                    <option value="">Ninguno</option>
                    <option value="desayuno">Desayuno</option>
                    <option value="spa">Acceso al Spa</option>
                    <option value="limpieza">Limpieza Extra</option>
                </select>
            </div>
            <button type="submit" class="button">Reservar Ahora</button>
        </form>
    </div>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/reservas_styles.css') }}">
@endsection
