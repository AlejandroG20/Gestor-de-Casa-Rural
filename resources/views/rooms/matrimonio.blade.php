@component('components.rooms')
    @slot('titulo')
        @section('title', 'Matrimonio')
    @endslot

    @slot('nombre', 'MATRIMONIO')

    @slot('contenido')
        <p>
            <strong>Habitación Matrimonial:</strong> Un espacio diseñado para parejas, con una cama amplia y confortable,
            decoración elegante en madera, vistas al exterior y climatización. Su baño privado y detalles románticos
            garantizan una estancia especial.
        </p>

        <ul>
            <li>🛏 1 cama doble</li>
            <li>🛀 Baño privado con amenities</li>
            <li>🏠 Decoración elegante en madera</li>
            <li>🌎 Vistas exteriores</li>
            <li>🌡 Climatización frío/calor</li>
            <li>📺 Televisión de pantalla plana</li>
            <li>📶 WiFi de alta velocidad</li>
        </ul>
    @endslot

    @slot('foto2')
        <img src="{{ asset('assets/img/Matrimonio.jpg') }}" alt="Habitación">
    @endslot

    @slot('fondo')
        background: url("/assets/img/Matrimonio2.jpg") no-repeat center/cover;
    @endslot
@endcomponent
