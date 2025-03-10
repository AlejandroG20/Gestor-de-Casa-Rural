<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\Servicio; 

class ReservaController extends Controller
{
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
            $habitacion = Habitacion::findOrFail($habitacion_id);
            $precio_total += $habitacion->precio_noche * $request->dias;
            $reserva->habitaciones()->attach($habitacion_id);
            $habitacion->ocupar(); // Marcar como ocupada
        }

        // Asignar servicios y sumar su precio
        if ($request->has('servicios')) {
            foreach ($request->servicios as $servicio_id) {
                $servicio = Servicio::findOrFail($servicio_id);
                $precio_total += $servicio->precio;
                $reserva->servicios()->attach($servicio_id);
            }
        }

        $reserva->precio_reserva = $precio_total;
        $reserva->save();
    
        return response()->json(['message' => 'Reserva creada', 'reserva' => $reserva]);
    }
}
