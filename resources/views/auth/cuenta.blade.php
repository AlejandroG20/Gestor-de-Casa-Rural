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
                        <form action="{{ route('perfil') }}" method="GET">
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

                                            @slot('masInfo')
                                                <a style="font-size: 12px" href="{{ route('mas-info', ['id' => $reserva->id]) }}"
                                                    class="btn btn-secondary mt-2">Más Información</a>
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

                                        @slot('masInfo')
                                            <a style="font-size: 12px"
                                                href="{{ route('mas-info-estancia', ['id' => $estancia->id]) }}"
                                                class="btn btn-secondary mt-2">Más Información</a>
                                        @endslot

                                        @slot('precio')
                                            {{ $estancia->precio_final }}
                                        @endslot

                                        @slot('pagar')
                                            <form action="{{ route('estancias.pagar', $estancia->id) }}" method="POST"
                                                onsubmit="return confirmarPago()">
                                                @csrf
                                                @method('DELETE')
                                                <button style="font-size: 12px" type="submit" class="btn btn-danger mt-2">Pagar
                                                    Estancia</button>
                                            </form>
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

<!-- Scripts -->
@section('scripts')
    <script>
        function confirmarPago() {
            let tarjeta = prompt("Ingrese su número de tarjeta de crédito (13-19 dígitos):");

            if (!tarjeta || tarjeta.length < 13 || tarjeta.length > 19 || isNaN(tarjeta)) {
                alert("Número de tarjeta inválido. Intente de nuevo.");
                return false;
            }

            let fecha = prompt("Ingrese la fecha de vencimiento (MM/AA):");

            if (!fecha || !/^(0[1-9]|1[0-2])\/\d{2}$/.test(fecha)) {
                alert("Fecha de vencimiento inválida. Use el formato MM/AA.");
                return false;
            }

            let csv = prompt("Ingrese el código de seguridad (CSV, 3 o 4 dígitos):");

            if (!csv || !/^\d{3,4}$/.test(csv)) {
                alert("CSV inválido. Debe tener 3 o 4 dígitos.");
                return false;
            }

            return confirm("¿Confirmas el pago con la tarjeta terminada en " + tarjeta.slice(-4) + "?");
        }
    </script>
@endsection
