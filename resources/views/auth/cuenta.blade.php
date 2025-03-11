@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Cuenta')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Izquierda) -->
            <div class="col-md-3 profile-sidebar">
                <div class="sidebar-content">
                    <img src="{{ asset('assets/icons/profile.png') }}" class="profile-img rounded-circle mb-3" width="120"
                        alt="Foto de perfil">
                    <h3 class="text-light">{{ Auth::user()->nombre }}</h3>

                    <div class="botones">
                        <form action="" method="POST">
                            <button class="btn btn-secondary mt-3">Editar Perfil</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger mt-3">Cerrar Sesion</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contenido Principal (Derecha) -->
            <div class="col-md-9 profile-content">
                <div class="content-wrapper">
                    <h1 class="fw-bold">Bienvenido, <span class="text-highlight">{{ Auth::user()->nombre }}</span></h1>
                    <p>Aquí puedes gestionar tus reservas y estancias activas.</p>
                    <hr>

                    <!-- Sección de Reservas -->
                    <div class="reservations-container">
                        <div class="tabs">
                            <span class="tab active">Reservas</span>
                        </div>


                        @if ($reservas->isEmpty())
                            <p>No tienes reservas.</p>
                        @else
                            @foreach ($reservas as $reserva)
                                @foreach ($reserva->habitaciones as $habitacion)
                                    @component('components.reserva')
                                        @slot('tipo', $habitacion->tipo)
                                        @slot('fecha_entrada', \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d-m-Y'))
                                        @slot('fecha_salida', \Carbon\Carbon::parse($reserva->fecha_fin)->format('d-m-Y'))
                                        @slot('precio')
                                            {{ $reserva->precio_reserva }} €
                                        @endslot
                                    @endcomponent
                                @endforeach
                            @endforeach
                        @endif

                    </div>
                </div>

                <br>

                <!-- Sección de Estancias Activas -->
                <div class="stays-container">
                    <div class="tabs">
                        <span class="tab active">Estancias</span>
                    </div>

                    @if ($reservas->isEmpty())
                        <p>No tienes reservas.</p>
                    @else
                        @foreach ($reservas as $reserva)
                            @foreach ($reserva->habitaciones as $habitacion)
                                @component('components.reserva')
                                    @slot('tipo', $habitacion->tipo)
                                    @slot('fecha_entrada', \Carbon\Carbon::parse($reserva->fecha_inicio)->format('d-m-Y'))
                                    @slot('fecha_salida', \Carbon\Carbon::parse($reserva->fecha_fin)->format('d-m-Y'))
                                    @slot('precio')
                                        {{ $reserva->precio_reserva }} €
                                    @endslot
                                @endcomponent
                            @endforeach
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cuenta_styles.css') }}">
@endsection
