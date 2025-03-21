@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Administrador')

@section('content')

    <div class="container" style="padding: 20px;">
        <h1>Panel de Administración</h1>
        <br>
        <h3>Reservas Activas</h3>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>DNI</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservas_activas as $reserva)
                    <tr>
                        <td>{{ $reserva->id }}</td>
                        <td>{{ $reserva->usuario->nombre }}</td>
                        <td>{{ $reserva->usuario->dni }}</td>
                        <td>{{ $reserva->fecha_entrada }}</td>
                        <td>{{ $reserva->fecha_salida }}</td>
                        <td>{{ $reserva->precio_reserva }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Reservas Pasadas</h3>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>DNI</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservas_pasadas as $reserva)
                    <tr>
                        <td>{{ $reserva->id }}</td>
                        <td>{{ $reserva->usuario->nombre }}</td>
                        <td>{{ $reserva->usuario->dni }}</td>
                        <td>{{ $reserva->fecha_entrada }}</td>
                        <td>{{ $reserva->fecha_salida }}</td>
                        <td>{{ $reserva->precio_reserva }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin_styles.css') }}">
@endsection
