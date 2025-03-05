@component('components.rooms')
    @slot('titulo')
        @section('title', 'Estandar')
    @endslot

    @slot('nombre', 'ESTANDAR')

    @slot('contenido')
        <p>
            <strong>Habitación Simple:</strong> Ideal para viajeros que buscan tranquilidad y descanso. Cuenta con una sola
            cama,
            escritorio funcional, televisión y baño privado, todo en un espacio bien distribuido con iluminación cálida.
        </p>

        <ul>
            <li>🛏 1 cama individual</li>
            <li>🛀 Baño privado</li>
            <li>💻 Escritorio funcional</li>
            <li>📺 Televisión</li>
            <li>💡 Iluminación cálida</li>
            <li>📶 WiFi gratuito</li>
        </ul>
    @endslot

    @slot('foto2')
        <img src="{{ asset('assets/img/Estandar.jpg') }}" alt="Habitación">
    @endslot

    @slot('fondo')
        background: url("/assets/img/Estandar2.jpg") no-repeat center/cover;
    @endslot
@endcomponent
