<div class="row mb-3" style="margin-top: 30px; width: 80%;">
    <div class="col-md-4">
        <!-- Imagen de la reserva (opcional) -->
        <div class="reservation-img">
            {{$img}}
        </div>
    </div>
    <div class="col-md-8">
        <div class="reservation-info">
            <h5 class="text-uppercase">{{ $fecha_entrada }}</h5>
            <p><strong>Días de Estancia:</strong> {{ $dias_totales }} días</p>
            <p style="text-align: right"><strong>{{ $precio }} €</strong></p>
        </div>
        <button class="btn btn-danger mt-2">Cancelar Reserva</button>
    </div>
</div>
