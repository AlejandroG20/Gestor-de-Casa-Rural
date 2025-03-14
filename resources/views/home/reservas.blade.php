@extends('layouts.landing')

@section('title', 'Reservas')

@section('content')

    <div class="container" style="padding: 5%;">
        <h2>Realizar una Reserva</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservas') }}" method="POST">
            @csrf

            <input type="hidden" name="usuario_id" value="{{ auth()->id() }}">

            <div class="mb-3">
                <label for="fecha_entrada" class="form-label">Fecha de Entrada</label>
                <input type="date" class="form-control" id="fecha_entrada" name="fecha_entrada" required>
            </div>

            <div class="mb-3">
                <label for="fecha_salida" class="form-label">Fecha de Salida</label>
                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Selecciona Habitaciones</label>

                <div class="border p-3 mb-2">
                    <h5>Habitaciones Estándar</h5>
                    @php
                        $habitacionEstandar = $habitaciones->where('tipo', 'estandar')->first();
                    @endphp
                    @if ($habitacionEstandar)
                        <div class="form-group">
                            <label for="habitacion_estandar">Cantidad de Habitaciones Estándar</label>
                            <input type="number" name="habitacion_estandar" id="habitacion_estandar" min="0"
                                value="0" class="form-control">
                            <small>{{ $habitacionEstandar->nombre }} - ${{ $habitacionEstandar->precio_noche }} por
                                noche</small>
                        </div>
                    @endif
                </div>

                <div class="border p-3 mb-2">
                    <h5>Habitaciones Dobles</h5>
                    @php
                        $habitacionDoble = $habitaciones->where('tipo', 'doble')->first();
                    @endphp
                    @if ($habitacionDoble)
                        <div class="form-group">
                            <label for="habitacion_doble">Cantidad de Habitaciones Dobles</label>
                            <input type="number" name="habitacion_doble" id="habitacion_doble" min="0"
                                value="0" class="form-control">
                            <small>{{ $habitacionDoble->nombre }} - ${{ $habitacionDoble->precio_noche }} por noche</small>
                        </div>
                    @endif
                </div>

                <div class="border p-3">
                    <h5>Suites</h5>
                    @php
                        $habitacionSuite = $habitaciones->where('tipo', 'suite')->first();
                    @endphp
                    @if ($habitacionSuite)
                        <div class="form-group">
                            <label for="habitacion_suite">Cantidad de Suites</label>
                            <input type="number" name="habitacion_suite" id="habitacion_suite" min="0"
                                value="0" class="form-control">
                            <small>{{ $habitacionSuite->nombre }} - ${{ $habitacionSuite->precio_noche }} por noche</small>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label for="servicios" class="form-label">Selecciona Servicios Adicionales</label>
                @foreach ($servicios as $servicio)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
                            id="servicio{{ $servicio->id }}">
                        <label class="form-check-label" for="servicio{{ $servicio->id }}">
                            {{ $servicio->nombre }} - ${{ $servicio->precio }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/reservas_styles.css') }}">
@endsection
