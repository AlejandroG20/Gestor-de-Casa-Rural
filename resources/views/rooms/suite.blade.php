@component('components.rooms')
    @slot('titulo')
        @section('title', 'Suite')
    @endslot

    @slot('nombre', 'Suite')

    @slot('contenido')
        <p>
            <strong>Suite de Lujo:</strong> Nuestra opción más exclusiva, con amplios espacios que incluyen una cama king size,
            zona de estar, baño privado con acabados premium y una terraza con vistas impresionantes. La combinación
            de materiales de alta calidad y tecnología moderna brinda el máximo confort y elegancia.
        </p>

        <ul>
            <li>🛏 Cama king size</li>
            <li>🛋 Zona de estar con sofá</li>
            <li>🛀 Baño premium con jacuzzi</li>
            <li>🏢 Terraza privada con vistas panorámicas</li>
            <li>💎 Decoración de lujo con materiales de alta calidad</li>
            <li>📺 Televisión Smart TV de gran tamaño</li>
            <li>📶 WiFi de alta velocidad</li>
            <li>☕ Minibar y cafetera en la habitación</li>
        </ul>
    @endslot

    @slot('foto2')
        <img src="{{ asset('assets/img/Suite.jpg') }}" alt="Habitación">
    @endslot

    @slot('fondo')
        background: url("/assets/img/Habitaciones.jpg") no-repeat center/cover;
    @endslot
@endcomponent
