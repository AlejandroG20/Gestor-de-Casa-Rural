<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;

class HabitacionController extends Controller
{
    /**
     * Listar todas las habitaciones
     */
    public function index()
    {
        return response()->json(Habitacion::all());
    }

    /**
     * Crear una nueva habitación (solo admins)
     */
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'numero' => 'required|integer|unique:habitaciones,numero',
            'tipo' => 'required|in:estandar,suite,doble',
            'precio_noche' => 'required|numeric|min:0',
            'disponible' => 'boolean'
        ]);

        // Crear habitación
        $habitacion = Habitacion::create($request->all());

        return response()->json([
            'message' => 'Habitación creada exitosamente',
            'habitacion' => $habitacion
        ]);
    }

    /**
     * Actualizar una habitación (solo admins)
     */
    public function update(Request $request, $id)
    {
        $habitacion = Habitacion::findOrFail($id);

        // Validar datos
        $request->validate([
            'numero' => 'integer|unique:habitaciones,numero,' . $id,
            'tipo' => 'in:estandar,suite,doble',
            'precio_noche' => 'numeric|min:0',
            'disponible' => 'boolean'
        ]);

        // Actualizar habitación
        $habitacion->update($request->all());

        return response()->json([
            'message' => 'Habitación actualizada',
            'habitacion' => $habitacion
        ]);
    }

    /**
     * Eliminar una habitación (solo admins)
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();

        return response()->json(['message' => 'Habitación eliminada']);
    }
}
