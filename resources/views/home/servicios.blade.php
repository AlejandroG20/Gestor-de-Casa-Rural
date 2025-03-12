@extends('layouts.landing')

<!-- Títulos -->
@section('title', 'Servicios')

@section('content')
    <div class="hero-container">
        <div class="hero-text">Nuestros Servicios</div>
    </div>

    <div class="container py-5" style="width: 70%;">
        <h1 class="text-center mb-4">Servicios Disponibles</h1>
        <p class="text-justify">En nuestra casa rural ofrecemos una variedad de servicios para que tu estancia sea lo más
            cómoda y placentera posible. Disfruta de nuestros desayunos caseros, servicios de limpieza adicionales y
            experiencias como visitas guiadas. Consulta nuestra lista de servicios y elige los que mejor se adapten a tu
            necesidad.</p>
    </div>

    <div class="container">
        <div class="row" style="justify-content: space-evenly;">
            @foreach ($servicios as $index => $servicio)
                <div class="carta" style="padding: 20px; {{ $index % 2 == 0 ? 'margin-top: -15px;' : '' }}">
                    <div class="carta-img">
                        <img src="{{ asset('assets/img/' . strtolower($servicio->nombre) . '2.jpg') }}" alt="{{ $servicio->nombre }}">
                        <div class="overlay">
                            <h4>{{ $servicio->nombre }}</h4>
                            <p>Precio: €{{ number_format($servicio->precio, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
      
    
@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/servicios_styles.css') }}">
@endsection
