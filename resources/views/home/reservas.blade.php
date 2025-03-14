@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Reservas')

@section('content')

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf

        <label for="habitaciones">Selecciona las habitaciones:</label>
        <select name="habitaciones[]" id="habitaciones" multiple required>
            @foreach ($habitaciones as $habitacion)
                <option value="{{ $habitacion->id }}">{{ $habitacion->nombre }} - {{ $habitacion->precio_noche }}€/noche
                </option>
            @endforeach
        </select>

        <label for="servicios">Selecciona servicios adicionales:</label>
        <select name="servicios[]" id="servicios" multiple>
            @foreach ($servicios as $servicio)
                <option value="{{ $servicio->id }}">{{ $servicio->nombre }} - {{ $servicio->precio }}€</option>
            @endforeach
        </select>

        <label for="fecha_entrada">Fecha de entrada:</label>
        <input type="date" name="fecha_entrada" id="fecha_entrada" required>

        <label for="fecha_salida">Fecha de salida:</label>
        <input type="date" name="fecha_salida" id="fecha_salida" required>

        <button type="submit">Reservar</button>
    </form>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/reservas_styles.css') }}">
@endsection
