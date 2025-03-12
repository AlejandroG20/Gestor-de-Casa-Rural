<div class="container d-flex justify-content-center">
    <div class="reservation-container">
        <form method="POST" action="{{ route('calculate-price') }}">
            @csrf
            <div class="reservation-box">
                <span>📅</span>
                <input type="date" class="form-control" name="check_in" placeholder="Entrada" required>
                →
                <input type="date" class="form-control" name="check_out" placeholder="Salida" required>
            </div>
            <div class="reservation-box">
                <span>🏠</span>
                <select class="form-select" name="room_type" required>
                    <option value="Suite">Suite</option>
                    <option value="Doble">Doble</option>
                    <option value="Estandar">Estandar</option>
                </select>
            </div>
            <div class="reservation-box">
                <span>🔒</span>
                <input type="text" class="form-control" disabled placeholder="Precio Estimado"
                    value="{{ $estimatedPrice ?? '0' }} €">
            </div>

            <button type="submit" class="btn-secondary" style="margin-left: 15px;">Calcular</button>
        </form>
    </div>
</div>
