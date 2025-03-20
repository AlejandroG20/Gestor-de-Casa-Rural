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

                    <p>En tu <strong>sección</strong> de cuenta, puedes gestionar tu <strong>perfil</strong> y acceder a
                        todas tus <strong>reservas</strong> y <strong>estancias</strong>.
                    </p>

                    <div class="botones">
                        <form action="" method="POST">
                            <button class="btn btn-secondary mt-3">Editar Perfil</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger mt-3">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Reservas / Estancias -->
            <div class="col-md-9 reservas_estancias">
                <h1 style="border: none; color: var(--gold); margin-bottom: 40px;">Bienvenido, <span
                        style="color: var(--light-text);">{{ Auth::user()->nombre }}</span></h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Reservas -->
                            <h4>Estas son tus reservas</h4>

                            @if ($reservas->isNotEmpty())
                                @foreach ($reservas as $reserva)
                                    @if ($reserva->en_estancia == false)
                                        @component('components.reserva')
                                            @slot('img')
                                                <img src="{{ asset('assets/img/Suite.jpg') }}" class="img-fluid rounded"
                                                    alt="Suite">
                                            @endslot

                                            @slot('entrada')
                                                {{ $reserva->fecha_entrada }}
                                            @endslot

                                            @slot('salida')
                                                {{ $reserva->fecha_salida }}
                                            @endslot

                                            @slot('dias_totales')
                                                {{ $reserva->dias }}
                                            @endslot

                                            @slot('precio')
                                                {{ $reserva->precio_reserva }}
                                            @endslot

                                            @slot('cancelar')
                                                <form action="{{ route('reservas.cancelar', $reserva->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style="font-size: 12px" type="submit"
                                                        class="btn btn-danger mt-2">Cancelar Reserva</button>
                                                </form>
                                            @endslot
                                        @endcomponent
                                    @endif
                                @endforeach
                            @else
                                <p>No tienes reservas.</p>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <!-- Estancias -->
                            <h4>Estas son tus estancias</h4>

                            @if ($estancias->isNotEmpty())
                                @foreach ($estancias as $estancia)
                                    @component('components.estancia')
                                        @slot('img')
                                            <img src="{{ asset('assets/img/Suite.jpg') }}" class="img-fluid rounded"
                                                alt="Suite">
                                        @endslot

                                        @slot('entrada')
                                            {{ $estancia->reserva->fecha_entrada }}
                                        @endslot

                                        @slot('salida')
                                            {{ $estancia->reserva->fecha_salida }}
                                        @endslot

                                        @slot('dias_totales')
                                            {{ $estancia->dias }}
                                        @endslot

                                        @slot('precio')
                                            {{ $estancia->precio_final }}
                                        @endslot
                                    @endcomponent
                                @endforeach
                            @else
                                <p>No tienes estancias.</p>
                            @endif

                        </div>
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
