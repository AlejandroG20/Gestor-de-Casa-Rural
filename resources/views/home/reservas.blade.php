@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Reservas')

@section('content')

    <section class="reserva-form-container">
        <div class="reserva-form-box">
            <h2>Reserva tu Estancia</h2>
            <form class="reserva-form" method="POST" action="{{ route('reservas') }}">
                @csrf

                <div>
                    <label for="usuario_id">ID Usuario</label>
                    <input type="number" id="usuario_id" name="usuario_id" required>
                </div>

                <div>
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                </div>

                <div>
                    <label for="fecha_fin">Fecha de Fin</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" required>
                </div>

                <div>
                    <label for="habitaciones">Seleccionar Habitaciones</label>
                    <select id="habitaciones" name="habitaciones[]" multiple required>
                        @foreach ($habitaciones as $habitacion)
                            <option value="{{ $habitacion->id }}">{{ $habitacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="submit-btn">Reservar Ahora</button>
            </form>
        </div>
    </section>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/reservas_styles.css') }}">
@endsection
