<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Estancia;
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
        $reservas = Reserva::where('usuario_id', Auth::id())
            ->with(['habitaciones', 'servicios'])
            ->get();

        $estancias = Estancia::where('usuario_id', Auth::id())
            ->with(['habitaciones', 'servicios'])
            ->get();

        return view('auth.cuenta', compact('reservas', 'estancias'));
    }

    /**
     * Crea una nueva reserva.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'dias' => 'required|integer|min:1',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'habitaciones' => 'required|array|min:1',
            'habitaciones.*' => 'exists:habitaciones,id',
            'servicios' => 'array',
            'servicios.*' => 'exists:servicios,id'
        ]);

        $reserva = Reserva::create([
            'usuario_id' => $validatedData['usuario_id'],
            'dias' => $validatedData['dias'],
            'fecha_entrada' => $validatedData['fecha_entrada'],
            'fecha_salida' => $validatedData['fecha_salida'],
            'precio_reserva' => 0,
            'en_estancia' => false
        ]);

        $precio_total = 0;
        $habitaciones = Habitacion::whereIn('id', $validatedData['habitaciones'])->get();

        foreach ($habitaciones as $habitacion) {
            $precio_total += $habitacion->precio_noche * $validatedData['dias'];
            $reserva->habitaciones()->attach($habitacion->id);
            $habitacion->ocupar();
        }

        if (!empty($validatedData['servicios'])) {
            $servicios = Servicio::whereIn('id', $validatedData['servicios'])->get();
            foreach ($servicios as $servicio) {
                $precio_total += $servicio->precio;
                $reserva->servicios()->attach($servicio->id);
            }
        }

        $reserva->update(['precio_reserva' => $precio_total]);

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
        $reserva = Reserva::findOrFail($id);

        if ($reserva->usuario_id !== Auth::id()) {
            return response()->json(['message' => 'No tienes permiso para cancelar esta reserva.'], 403);
        }

        foreach ($reserva->habitaciones as $habitacion) {
            $habitacion->liberar();
        }

        $reserva->habitaciones()->detach();
        $reserva->servicios()->detach();
        $reserva->delete();

        return response()->json(['message' => 'Reserva cancelada correctamente.']);
    }

    /**
     * Muestra las reservas del usuario autenticado.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function mostrarReservas()
    {
        $usuario = Auth::user();
        $reservas = $usuario->reservas;

        return view('reservas.index', compact('reservas'));
    }
}
