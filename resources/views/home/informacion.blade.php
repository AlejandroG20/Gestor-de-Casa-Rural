@extends('layouts.landing')

@section('title', 'Informacion')

@section('content')

    <div class="container">
        <h1>Detalles de la Reserva</h1>
        <p><strong>Reserva ID:</strong> {{ $reserva->id }}</p>
        <p><strong>Nombre:</strong> {{ $reserva->usuario->nombre }}</p>
        <p><strong>Fecha de Entrada:</strong> {{ $reserva->fecha_entrada }}</p>
        <p><strong>Fecha de Salida:</strong> {{ $reserva->fecha_salida }}</p>
        <p><strong>Total a Pagar:</strong> {{ $reserva->precio_reserva }}</p>
        <p><strong>Estado de la Reserva:</strong> {{ $reserva->en_estancia ? 'En Estancia' : 'Pendiente' }}</p>

        <!-- Aquí puede agregar más detalles según lo que quiera mostrar -->
    </div>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/info_styles.css') }}">
@endsection
