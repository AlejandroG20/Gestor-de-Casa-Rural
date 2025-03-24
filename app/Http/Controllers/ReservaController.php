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
        $fechaEntrada = request('fecha_entrada');
        $fechaSalida = request('fecha_salida');

        $habitaciones = Habitacion::where('disponible', true)
            ->whereDoesntHave('reservas', function ($query) use ($fechaEntrada, $fechaSalida) {
                $query->whereBetween('fecha_entrada', [$fechaEntrada, $fechaSalida])
                    ->orWhereBetween('fecha_salida', [$fechaEntrada, $fechaSalida]);
            })
            ->get();

        $servicios = Servicio::all();
        return view('home.reservas', compact('habitaciones', 'servicios'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:usuario,id',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'habitaciones_estandar' => 'required|integer|min:0',
            'habitaciones_doble' => 'required|integer|min:0',
            'habitaciones_suite' => 'required|integer|min:0',
            'servicios' => 'array',
            'servicios.*' => 'exists:servicios,id'
        ]);

        $fechaEntrada = \Carbon\Carbon::parse($validatedData['fecha_entrada']);
        $fechaSalida = \Carbon\Carbon::parse($validatedData['fecha_salida']);

        if ($fechaSalida <= $fechaEntrada) {
            return response()->json(['message' => 'La fecha de salida debe ser posterior a la de entrada.'], 400);
        }

        $dias = $fechaEntrada->diffInDays($fechaSalida);

        $reserva = Reserva::create([
            'usuario_id' => $validatedData['usuario_id'],
            'dias' => $dias,
            'fecha_entrada' => $validatedData['fecha_entrada'],
            'fecha_salida' => $validatedData['fecha_salida'],
            'precio_reserva' => 0,
        ]);

        $precio_total = 0;

        if ($validatedData['habitaciones_estandar'] > 0) {
            $habitacionesEstandar = Habitacion::where('tipo', 'estandar')
                ->where('disponible', true)
                ->take($validatedData['habitaciones_estandar'])
                ->get();
            foreach ($habitacionesEstandar as $habitacion) {
                $precio_total += 55 * $dias;
                $reserva->habitaciones()->attach($habitacion->id);
            }
        }

        if ($validatedData['habitaciones_doble'] > 0) {
            $habitacionesDoble = Habitacion::where('tipo', 'doble')
                ->where('disponible', true)
                ->take($validatedData['habitaciones_doble'])
                ->get();
            foreach ($habitacionesDoble as $habitacion) {
                $precio_total += 100 * $dias;
                $reserva->habitaciones()->attach($habitacion->id);
            }
        }

        if ($validatedData['habitaciones_suite'] > 0) {
            $habitacionesSuite = Habitacion::where('tipo', 'suite')
                ->where('disponible', true)
                ->take($validatedData['habitaciones_suite'])
                ->get();
            foreach ($habitacionesSuite as $habitacion) {
                $precio_total += 150 * $dias;
                $reserva->habitaciones()->attach($habitacion->id);
            }
        }

        if (!empty($validatedData['servicios'])) {
            $servicios = Servicio::whereIn('id', $validatedData['servicios'])->get();
            foreach ($servicios as $servicio) {
                $precio_total += $servicio->precio;
                $reserva->servicios()->attach($servicio->id);
            }
        }

        $reserva->update(['precio_reserva' => $precio_total]);

        return redirect()->route('cuenta')->with('message', 'Reserva creada exitosamente');
    }

    public function cancel($id)
    {
        $reserva = Reserva::findOrFail($id);

        if ($reserva->usuario_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para cancelar esta reserva.');
        }

        $reserva->habitaciones()->detach();
        $reserva->servicios()->detach();
        $reserva->delete();

        return redirect()->route('cuenta')->with('message', 'Reserva cancelada exitosamente');
    }
}
