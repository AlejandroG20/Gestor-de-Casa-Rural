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

            <div class="fecha">
                <div class="mb-3">
                    <label for="fecha_entrada" class="form-label">
                        <h3>Fecha de Entrada</h3>
                    </label>
                    <input type="date" class="form-control custom-input" id="fecha_entrada" name="fecha_entrada"
                        required>
                </div>

                <div class="mb-3">
                    <label for="fecha_salida" class="form-label">
                        <h3>Fecha de Salida</h3>
                    </label>
                    <input type="date" class="form-control custom-input" id="fecha_salida" name="fecha_salida" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <h3>Selecciona Habitaciones</h3>
                </label>

                <div class="habitaciones">
                    <div class="habitacion-card p-3">
                        <div class="habitacion-img">
                            <img src="{{ asset('assets/img/Estandar.jpg') }}" alt="Habitación Estándar">
                            <div class="habitacion-info">
                                <h5>Estándar</h5>
                                @php
                                    $habitacionEstandar = $habitaciones->where('tipo', 'estandar')->first();
                                @endphp

                                @if ($habitacionEstandar)
                                    <small>{{ $habitacionEstandar->nombre }} - {{ $habitacionEstandar->precio_noche }}
                                        €</small>
                                @endif
                            </div>
                        </div>
                        @if ($habitacionEstandar)
                            <div class="form-group habitacion-card">
                                <label for="habitacion_estandar" class="form-label">Cantidad de Habitaciones
                                    Estándar</label>
                                <div>
                                    <input type="number" name="habitacion_estandar" id="habitacion_estandar" min="0"
                                        value="0" class="form-control habitacion-input">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="habitacion-card p-3">
                        <div class="habitacion-img">
                            <img src="{{ asset('assets/img/Matrimonio.jpg') }}" alt="Habitación Doble">
                            <div class="habitacion-info">
                                <h5>Doble</h5>
                                @php
                                    $habitacionDoble = $habitaciones->where('tipo', 'doble')->first();
                                @endphp

                                @if ($habitacionDoble)
                                    <small>{{ $habitacionDoble->nombre }} - {{ $habitacionDoble->precio_noche }} €</small>
                                @endif
                            </div>
                        </div>
                        @if ($habitacionDoble)
                            <div class="form-group habitacion-card">
                                <label for="habitacion_doble" class="form-label">Cantidad de Habitaciones Dobles</label>
                                <div>
                                    <input type="number" name="habitacion_doble" id="habitacion_doble" min="0"
                                        value="0" class="form-control habitacion-input">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="habitacion-card p-3">
                        <div class="habitacion-img">
                            <img src="{{ asset('assets/img/Suite.jpg') }}" alt="Habitación Suite">
                            <div class="habitacion-info">
                                <h5>Suite</h5>
                                @php
                                    $habitacionSuite = $habitaciones->where('tipo', 'suite')->first();
                                @endphp

                                @if ($habitacionSuite)
                                    <small>{{ $habitacionSuite->nombre }} - {{ $habitacionSuite->precio_noche }} €</small>
                                @endif
                            </div>
                        </div>

                        @if ($habitacionSuite)
                            <div class="form-group habitacion-card">
                                <label for="habitacion_suite" class="form-label">Cantidad de Suites</label>
                                <div>
                                    <input type="number" name="habitacion_suite" id="habitacion_suite" min="0"
                                        value="0" class="form-control habitacion-input">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="servicios" class="form-label">
                    <h3>Selecciona Servicios Adicionales</h3>
                </label>

                <div class="servicios-container">
                    @foreach ($servicios as $servicio)
                        <label class="servicio-card">
                            <input type="checkbox" name="servicios[]" value="{{ $servicio->id }}"
                                id="servicio{{ $servicio->id }}">
                            <div class="servicio-content">
                                <span class="servicio-nombre">{{ $servicio->nombre }}</span>
                                <span class="servicio-precio">{{ $servicio->precio }} €</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="botones">
                <button type="submit" class="btn btn-primary">Reservar</button>
                <button type="reset" class="btn btn-danger">Limpiar Formulario</button>
            </div>
        </form>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/reservas_styles.css') }}">
@endsection
