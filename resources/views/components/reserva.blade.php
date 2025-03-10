<div class="reservation-item">
    <div class="reservation-img">
        <!-- Aquí podrías mostrar una imagen de la habitación si la tienes asociada -->
        <img src="{{ $habitacion->imagen_url }}" alt="Imagen de la habitación">
    </div>
    <div class="reservation-info">
        <h4>{{ $tipo }}</h4>
        <p><strong>Check In:</strong> {{ $fecha_entrada }}</p>
        <p><strong>Check Out:</strong> {{ $fecha_salida }}</p>
        <p><strong>Precio Total:</strong> {{ $precio }} €</p>

        <!-- Mostrar los servicios asociados a la reserva -->
        <h5>Servicios:</h5>
        <ul>
            @foreach ($servicios as $servicio)
                <li>{{ $servicio->nombre }}: {{ $servicio->precio }} €</li>
            @endforeach
        </ul>

        <!-- Mostrar habitaciones asociadas a la reserva -->
        <h5>Habitaciones:</h5>
        <ul>
            @foreach ($habitaciones as $habitacion)
                <li>{{ $habitacion->tipo }} - {{ $habitacion->precio }} €</li>
            @endforeach
        </ul>
    </div>

    <!-- Formulario para cancelar la reserva -->
    <form action="{{ route('reservas.cancelar', $reserva->id) }}" method="POST"
        onsubmit="return confirm('¿Estás seguro de que quieres cancelar esta reserva?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="cancel-btn">Cancelar Reserva</button>
    </form>
</div>
