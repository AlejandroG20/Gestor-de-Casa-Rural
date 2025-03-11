<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;

class HabitacionController extends Controller
{
    /**
     * Listar todas las habitaciones disponibles.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Obtener todas las habitaciones y devolverlas en formato JSON
        return response()->json(Habitacion::all());
    }

    /**
     * Crear una nueva habitación (requiere permisos de administrador).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos en la solicitud
        $validatedData = $request->validate([
            'numero' => 'required|integer|unique:habitaciones,numero',
            'tipo' => 'required|in:estandar,suite,doble',
            'precio_noche' => 'required|numeric|min:0',
            'disponible' => 'boolean'
        ]);

        // Crear la nueva habitación con los datos validados
        $habitacion = Habitacion::create($validatedData);

        // Retornar respuesta JSON con éxito
        return response()->json([
            'message' => 'Habitación creada exitosamente',
            'habitacion' => $habitacion
        ]);
    }

    /**
     * Actualizar una habitación existente (requiere permisos de administrador).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Buscar la habitación por ID o lanzar error 404 si no existe
        $habitacion = Habitacion::findOrFail($id);

        // Validar los datos recibidos en la solicitud
        $validatedData = $request->validate([
            'numero' => 'integer|unique:habitaciones,numero,' . $id,
            'tipo' => 'in:estandar,suite,doble',
            'precio_noche' => 'numeric|min:0',
            'disponible' => 'boolean'
        ]);

        // Actualizar la habitación con los datos validados
        $habitacion->update($validatedData);

        // Retornar respuesta JSON con éxito
        return response()->json([
            'message' => 'Habitación actualizada exitosamente',
            'habitacion' => $habitacion
        ]);
    }

    /**
     * Eliminar una habitación existente (requiere permisos de administrador).
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Buscar la habitación por ID o lanzar error 404 si no existe
        $habitacion = Habitacion::findOrFail($id);

        // Eliminar la habitación
        $habitacion->delete();

        // Retornar respuesta JSON con éxito
        return response()->json(['message' => 'Habitación eliminada exitosamente']);
    }
}
