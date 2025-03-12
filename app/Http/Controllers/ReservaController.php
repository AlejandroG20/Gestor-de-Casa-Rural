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
     * Muestra todas las reservas del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener todas las reservas del usuario autenticado con habitaciones y servicios relacionados
        $reservas = Reserva::where('usuario_id', Auth::id())
            ->with(['habitaciones', 'servicios'])
            ->get();

        // Retornar la vista con las reservas del usuario
        return view('auth.cuenta', compact('reservas'));
    }

    /**
     * Crea una nueva reserva.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'dias' => 'required|integer|min:1',
            'habitaciones' => 'required|array|min:1',
            'habitaciones.*' => 'exists:habitaciones,id',
            'servicios' => 'array',
            'servicios.*' => 'exists:servicios,id'
        ]);

        // Crear una nueva reserva con los datos validados
        $reserva = Reserva::create([
            'usuario_id' => $validatedData['usuario_id'],
            'dias' => $validatedData['dias'],
            'precio_reserva' => 0 // Se calculará posteriormente
        ]);

        // Calcular el precio total y asignar habitaciones
        $precio_total = 0;
        $habitaciones = Habitacion::whereIn('id', $validatedData['habitaciones'])->get();

        foreach ($habitaciones as $habitacion) {
            $precio_total += $habitacion->precio_noche * $validatedData['dias'];
            $reserva->habitaciones()->attach($habitacion->id);
            $habitacion->ocupar(); // Marcar la habitación como ocupada
        }

        // Asignar servicios y calcular el precio adicional
        if (!empty($validatedData['servicios'])) {
            $servicios = Servicio::whereIn('id', $validatedData['servicios'])->get();

            foreach ($servicios as $servicio) {
                $precio_total += $servicio->precio;
                $reserva->servicios()->attach($servicio->id);
            }
        }

        // Actualizar el precio total de la reserva
        $reserva->update(['precio_reserva' => $precio_total]);

        // Retornar respuesta JSON con éxito
        return response()->json(['message' => 'Reserva creada exitosamente', 'reserva' => $reserva]);
    }

    /**
     * Cancela una reserva existente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel($id)
    {
        // Buscar la reserva por ID o lanzar error 404
        $reserva = Reserva::findOrFail($id);

        // Verificar que el usuario autenticado sea el dueño de la reserva
        if ($reserva->usuario_id !== Auth::id()) {
            return response()->json(['message' => 'No tienes permiso para cancelar esta reserva.'], 403);
        }

        // Liberar habitaciones asociadas
        foreach ($reserva->habitaciones as $habitacion) {
            $habitacion->liberar();
        }

        // Eliminar relaciones con habitaciones y servicios
        $reserva->habitaciones()->detach();
        $reserva->servicios()->detach();

        // Eliminar la reserva
        $reserva->delete();

        return response()->json(['message' => 'Reserva cancelada correctamente.']);
    }


    public function mostrarReservas()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Obtener las reservas asociadas al usuario
        $reservas = $usuario->reservas;

        // Pasar las reservas a la vista
        return view('nombre_de_vista', compact('reservas'));
    }
}
