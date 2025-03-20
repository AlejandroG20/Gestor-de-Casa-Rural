<div class="row mb-3" style="margin-top: 30px; width: 80%;">
    <div class="col-md-4">
        <!-- Imagen de la reserva (opcional) -->
        <div class="reservation-img">
            {{ $img }}
        </div>
    </div>
    <div class="col-md-8">
        <div class="reservation-info">
            <p><strong>Entrada:</strong> {{ $entrada }} </p>
            <p><strong>Salida:</strong> {{ $salida }} </p>
            <p><strong>{{ $precio }} €</strong></p>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <button style="width: 45%; font-size: 12px" class="btn btn-secondary mt-2">Más Información</button>
        {{$pagar}}
    </div>

</div>
