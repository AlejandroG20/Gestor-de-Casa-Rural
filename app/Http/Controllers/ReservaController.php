<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'habitaciones' => 'required|array', // Debe ser un array de IDs
            'habitaciones.*' => 'exists:habitaciones,id', // Cada elemento debe existir en la tabla habitaciones
        ]);

        // Crear la reserva
        $reserva = Reserva::create([
            'usuario_id' => $request->usuario_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'precio_total' => 0, // Se calculará después
            'estado' => 'pendiente',
        ]);

        // Asociar habitaciones a la reserva
        $reserva->habitaciones()->attach($request->habitaciones);

        return response()->json(['message' => 'Reserva creada con éxito', 'reserva' => $reserva], 201);
    }

    public function show($id)
    {
        $reserva = Reserva::with('habitaciones')->findOrFail($id);
        return response()->json($reserva);
    }

    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return response()->json(['message' => 'Reserva eliminada']);
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);

        // Validar los datos
        $request->validate([
            'habitaciones' => 'required|array',
            'habitaciones.*' => 'exists:habitaciones,id',
        ]);

        // Actualizar las habitaciones asociadas
        $reserva->habitaciones()->sync($request->habitaciones);

        return response()->json(['message' => 'Habitaciones actualizadas']);
    }
}
