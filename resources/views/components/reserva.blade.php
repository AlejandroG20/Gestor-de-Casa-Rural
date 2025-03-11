<div class="reservation-item">
    <div class="reservation-img"></div>
    <div class="reservation-info">
        <h4 style="text-transform: uppercase">{{ $tipo }}</h4>
        <p><strong>Check In:</strong> {{ $fecha_entrada }}</p>
        <p><strong>Check Out:</strong> {{ $fecha_salida }}</p>
        <p class="price">{{ $precio }}</p>
    </div>
    <button class="btn-danger">Cancelar Reserva</button>
</div>
