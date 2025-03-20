@extends('layouts.landing')

@section('title', 'Información')

@section('content')

    <div class="container detalles">
        <h1>Detalles de la Estancia</h1>

        <!-- Información general de la estancia -->
        <table class="table">
            <tr>
                <th>Fecha de Entrada:</th>
                <td>{{ $estancia->reserva->fecha_entrada }}</td>
            </tr>
            <tr>
                <th>Fecha de Salida:</th>
                <td>{{ $estancia->reserva->fecha_salida }}</td>
            </tr>
            <tr>
                <th>Total a Pagar:</th>
                <td>{{ $estancia->precio_final }} €</td>
            </tr>
            <tr>
                <th>Estado de la Reserva:</th>
                <td>{{ $estancia->reserva->en_estancia ? 'En Estancia' : 'Pendiente' }}</td>
            </tr>
        </table>

        <!-- Habitaciones asociadas a la estancia -->
        <h3>Habitaciones Asociadas:</h3>
        @if ($estancia->reserva->habitaciones->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo de Habitación</th>
                        <th>Precio por Noche (€)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estancia->reserva->habitaciones as $habitacion)
                        <tr>
                            <td><strong style="text-transform: uppercase;">{{ $habitacion->tipo }}</strong></td>
                            <td>{{ $habitacion->precio_noche }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay habitaciones asociadas a esta reserva.</p>
        @endif

        <!-- Servicios asociados a la estancia -->
        <h3>Servicios Adicionales:</h3>
        @if ($estancia->reserva->servicios->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre del Servicio</th>
                        <th>Precio (€)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estancia->reserva->servicios as $servicio)
                        <tr>
                            <td><strong>{{ $servicio->nombre }}</strong></td>
                            <td>{{ $servicio->precio }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay servicios asociados a esta reserva.</p>
        @endif

        <div class="d-flex align-items-center">
            <button onclick="window.print()" class="btn btn-secondary mt-3 me-2">Imprimir Reserva</button>

            <form action="{{ route('estancias.pagar', $estancia->id) }}" method="POST" onsubmit="return confirmarPago()">
                @csrf
                @method('DELETE')
                <button style="line-height: 1.4;" type="submit" class="btn btn-danger mt-3">Pagar
                    Estancia</button>
            </form>
        </div>

    </div>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/info_styles.css') }}">
@endsection
