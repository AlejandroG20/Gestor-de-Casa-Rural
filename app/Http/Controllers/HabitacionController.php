<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;

class HabitacionController extends Controller
{
    public function index()
    {
        return response()->json(Habitacion::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numero' => 'required|integer|unique:habitaciones,numero',
            'tipo' => 'required|in:estandar,suite,doble',
            'precio_noche' => 'required|numeric|min:0',
            'disponible' => 'boolean'
        ]);

        $habitacion = Habitacion::create($validatedData);

        return response()->json([
            'message' => 'Habitación creada exitosamente',
            'habitacion' => $habitacion
        ]);
    }

    public function update(Request $request, $id)
    {
        $habitacion = Habitacion::findOrFail($id);

        $validatedData = $request->validate([
            'numero' => 'integer|unique:habitaciones,numero,' . $id,
            'tipo' => 'in:estandar,suite,doble',
            'precio_noche' => 'numeric|min:0',
            'disponible' => 'boolean'
        ]);

        $habitacion->update($validatedData);

        return response()->json([
            'message' => 'Habitación actualizada exitosamente',
            'habitacion' => $habitacion
        ]);
    }

    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();

        return response()->json(['message' => 'Habitación eliminada exitosamente']);
    }
}
