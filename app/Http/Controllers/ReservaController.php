<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{

    /**
     * Mostrar todas las reservas del usuario autenticado.
     */
    public function index()
    {
        // Obtener todas las reservas del usuario autenticado
        $reservas = Reserva::where('usuario_id', Auth::id()) // Usando Auth::id() en lugar de auth()->id()
            ->with(['habitaciones', 'servicios']) // Cargar habitaciones y servicios relacionados
            ->get();

        // Retornar la vista con las reservas
        return view('reservas.index', compact('reservas')); // Pasa la variable reservas a la vista
    }

    /**
     * Crear una nueva reserva
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'dias' => 'required|integer|min:1',
            'habitaciones' => 'required|array|min:1',
            'habitaciones.*' => 'exists:habitaciones,id',
            'servicios' => 'array',
            'servicios.*' => 'exists:servicios,id'
        ]);

        // Crear la reserva
        $reserva = new Reserva();
        $reserva->usuario_id = $request->usuario_id;
        $reserva->dias = $request->dias;
        $reserva->precio_reserva = 0; // Se calculará más adelante
        $reserva->save();

        // Asignar habitaciones y calcular precio total
        $precio_total = 0;
        foreach ($request->habitaciones as $habitacion_id) {
            $habitacion = Habitacion::findOrFail($habitacion_id); // Obtener la habitación
            $precio_total += $habitacion->precio_noche * $request->dias; // Calcular el precio total
            $reserva->habitaciones()->attach($habitacion_id); // Asignar habitación a la reserva
            $habitacion->ocupar(); // Marcar la habitación como ocupada
        }

        // Asignar servicios y sumar su precio
        if ($request->has('servicios')) {
            foreach ($request->servicios as $servicio_id) {
                $servicio = Servicio::findOrFail($servicio_id); // Obtener el servicio
                $precio_total += $servicio->precio; // Sumar el precio del servicio
                $reserva->servicios()->attach($servicio_id); // Asignar servicio a la reserva
            }
        }

        // Actualizar el precio de la reserva
        $reserva->precio_reserva = $precio_total;
        $reserva->save();

        // Retornar un mensaje de éxito
        return response()->json(['message' => 'Reserva creada exitosamente', 'reserva' => $reserva]);
    }

    /**
     * Cancelar una reserva.
     */
    public function cancel($id)
    {
        // Encontrar la reserva
        $reserva = Reserva::findOrFail($id);

        // Verificar si el usuario tiene permiso para cancelar la reserva
        if ($reserva->usuario_id !== Auth::id()) {
            return response()->json(['message' => 'No tienes permiso para cancelar esta reserva.'], 403);
        }

        // Cancelar la reserva
        foreach ($reserva->habitaciones as $habitacion) {
            $habitacion->liberar(); // Liberar la habitación
        }

        // Eliminar las relaciones con las habitaciones y los servicios
        $reserva->habitaciones()->detach();
        $reserva->servicios()->detach();

        // Eliminar la reserva
        $reserva->delete();

        return response()->json(['message' => 'Reserva cancelada correctamente.']);
    }
}
