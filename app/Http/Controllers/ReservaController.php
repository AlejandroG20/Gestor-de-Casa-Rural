<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all();
        $servicios = Servicio::all();
        return view('home.reservas', compact('habitaciones', 'servicios'));
    }

    /**
     * Crea una nueva reserva.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Valida los datos enviados en la solicitud
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:usuario,id', // Debe existir en la tabla usuario
            'fecha_entrada' => 'required|date', // Debe ser una fecha válida
            'fecha_salida' => 'required|date|after:fecha_entrada', // Debe ser posterior a la entrada
            'habitaciones' => 'required|array|min:1', // Debe haber al menos una habitación
            'habitaciones.*' => 'exists:habitaciones,id', // Cada habitación debe existir en la BD
            'servicios' => 'array', // Servicios opcionales
            'servicios.*' => 'exists:servicios,id' // Cada servicio debe existir en la BD
        ]);

        // Calcula la cantidad de días entre la fecha de entrada y salida
        $fechaEntrada = \Carbon\Carbon::parse($validatedData['fecha_entrada']);
        $fechaSalida = \Carbon\Carbon::parse($validatedData['fecha_salida']);
        $dias = $fechaEntrada->diffInDays($fechaSalida);

        // Crea la reserva con datos iniciales
        $reserva = Reserva::create([
            'usuario_id' => $validatedData['usuario_id'],
            'dias' => $dias, // Se asignan los días calculados
            'fecha_entrada' => $validatedData['fecha_entrada'],
            'fecha_salida' => $validatedData['fecha_salida'],
            'precio_reserva' => 0, // Se actualizará después de calcular el precio total
        ]);

        $precio_total = 0;

        // Busca las habitaciones seleccionadas y las asocia con la reserva
        $habitaciones = Habitacion::whereIn('id', $validatedData['habitaciones'])->get();
        foreach ($habitaciones as $habitacion) {
            $precio_total += $habitacion->precio_noche * $dias;
            $reserva->habitaciones()->attach($habitacion->id);
        }

        // Si hay servicios adicionales, los añade a la reserva
        if (!empty($validatedData['servicios'])) {
            $servicios = Servicio::whereIn('id', $validatedData['servicios'])->get();
            foreach ($servicios as $servicio) {
                $precio_total += $servicio->precio; // Sumar precio de cada servicio a la reserva
                $reserva->servicios()->attach($servicio->id);
            }
        }

        // Actualiza el precio total de la reserva
        $reserva->update(['precio_reserva' => $precio_total]);

        // Devuelve una respuesta JSON confirmando la creación de la reserva
        return response()->json([
            'message' => 'Reserva creada exitosamente',
            'reserva' => $reserva
        ]);
    }

    /**
     * Cancela una reserva existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel($id)
    {
        // Busca la reserva por ID
        $reserva = Reserva::findOrFail($id);

        // Verifica si el usuario tiene permiso para cancelar la reserva
        if ($reserva->usuario_id !== Auth::id()) {
            return response()->json(['message' => 'No tienes permiso para cancelar esta reserva.'], 403);
        }

        // Libera las habitaciones asociadas a la reserva
        foreach ($reserva->habitaciones as $habitacion) {
            $habitacion->liberar();
        }

        // Elimina las relaciones de la reserva con las habitaciones y servicios
        $reserva->habitaciones()->detach();
        $reserva->servicios()->detach();

        // Elimina la reserva
        $reserva->delete();

        return response()->json(['message' => 'Reserva cancelada exitosamente.']);
    }

    /**
     * Muestra el formulario de creación de una nueva reserva.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Obtiene todas las habitaciones y servicios disponibles
        $habitaciones = Habitacion::all();
        $servicios = Servicio::all();

        // Retorna la vista del formulario de reserva con las habitaciones y servicios disponibles
        return view('reservas.create', compact('habitaciones', 'servicios'));
    }
}
