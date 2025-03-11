@extends('layouts.landing')

@section('title', 'Inicio')

@section('content')

    <!-- Slider -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            @component('components.slider')
                @slot('numFoto', '1')
                @slot('foto')
                    <img src="{{ asset('assets/img/Salon.jpg') }}" class="d-block w-100" alt="Imagen 1">
                @endslot
                @slot('titulo', 'Acogedor Salón')
                @slot('contenido', 'Relájate en un ambiente cálido y confortable.')
            @endcomponent

            @component('components.slider')
                @slot('numFoto', '2')
                @slot('foto')
                    <img src="{{ asset('assets/img/Jardin.jpg') }}" class="d-block w-100" alt="Imagen 2">
                @endslot
                @slot('titulo', 'Hermoso Jardín')
                @slot('contenido', 'Disfruta de la naturaleza en nuestro amplio jardín.')
            @endcomponent

            @component('components.slider')
                @slot('numFoto', '3')
                @slot('foto')
                    <img src="{{ asset('assets/img/Piscina.jpg') }}" class="d-block w-100" alt="Imagen 3">
                @endslot
                @slot('titulo', 'Piscina Relajante')
                @slot('contenido', 'Sumérgete en nuestras refrescantes aguas.')
            @endcomponent

            @component('components.slider')
                @slot('numFoto', '4')
                @slot('foto')
                    <img src="{{ asset('assets/img/Desayuno.jpg') }}" class="d-block w-100" alt="Imagen 4">
                @endslot
                @slot('titulo', 'Desayuno Casero')
                @slot('contenido', 'Disfruta de un desayuno con productos locales.')
            @endcomponent

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
        <div class="carousel-indicator" id="carouselPosition">1 / 4</div>
    </div>

    <!-- Descanso Visual 1-->
    @component('components.benefits')
    @endcomponent

    <!-- Descripción con imagen -->
    <div class="container my-5">
        <hr>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('assets/img/Fachada.jpg') }}" class="img-fluid rounded" alt="Fachada de la casa rural">
            </div>
            <div class="col-md-6">
                <h2><b>Bienvenido a Nuestra Casa Rural</b></h2>
                <p>
                    Descubre un refugio de paz en plena naturaleza, un lugar donde el sonido del viento entre los
                    árboles
                    y el canto de los pájaros crean una melodía perfecta para la relajación. Aquí, la tranquilidad y el
                    confort se combinan en un entorno acogedor, pensado para desconectar del estrés diario y sumergirse
                    en una experiencia única. Disfruta de habitaciones diseñadas para tu máximo bienestar, con vistas
                    panorámicas, detalles rústicos y todas las comodidades modernas. Ya sea que busques un fin de semana
                    de descanso, una escapada romántica o una aventura en contacto con la naturaleza, cada rincón de
                    este paraíso ha sido creado para ofrecerte una estancia inolvidable.
                </p>
                <a href="{{ route('casa') }}" class="btn btn-primary">Saber más</a>
            </div>
        </div>
        <hr>
    </div>

    <!-- Descanso Visual 2-->
    <div class="room-section">
        <div class="room-container">
            <!-- Imagen de la habitación -->
            <div class="room-image">
                <img src="{{ asset('assets/img/Habitacion.jpg') }}" alt="Habitación">
            </div>

            <!-- Descripción de la habitación -->
            <div class="room-description">
                <h2>HABITACIONES</h2>
                <p>
                    <strong>Las habitaciones de nuestra casa rural</strong> están diseñadas para brindar
                    <strong>elegancia y confort.</strong> Espacios armoniosos, con un diseño que combina
                    la calidez de la madera con detalles modernos.
                </p>

                <p>
                    Suelos de parquet, iluminación cálida y <strong>vistas privilegiadas</strong> garantizan
                    una estancia única. Todas las habitaciones cuentan con <strong>camas confortables</strong>,
                    televisión, baño privado y climatización.
                </p>

                <button class="btn btn-primary" onclick="window.location.href='{{ route('habitaciones') }}'">Más Información</button>
            </div>
        </div>
    </div>

@endsection

<!-- Scripts -->
@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('#carouselExample');
            const indicator = document.querySelector('#carouselPosition');
            const items = carousel.querySelectorAll('.carousel-item');

            carousel.addEventListener('slid.bs.carousel', function() {
                let activeIndex = [...items].findIndex(item => item.classList.contains('active'));
                indicator.textContent = `${activeIndex + 1} / ${items.length}`;
            });
        });
    </script>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/index_styles.css') }}">
@endsection
