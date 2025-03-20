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

        // Filtra las habitaciones disponibles
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
        // Valida los datos enviados en la solicitud
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:usuario,id', // Debe existir en la tabla usuario
            'fecha_entrada' => 'required|date', // Debe ser una fecha válida
            'fecha_salida' => 'required|date|after:fecha_entrada', // Debe ser posterior a la entrada
            'habitaciones_estandar' => 'required|integer|min:0', // Número de habitaciones estándar
            'habitaciones_doble' => 'required|integer|min:0', // Número de habitaciones dobles
            'habitaciones_suite' => 'required|integer|min:0', // Número de habitaciones suite
            'servicios' => 'array', // Servicios opcionales
            'servicios.*' => 'exists:servicios,id' // Cada servicio debe existir en la BD
        ]);

        // Calcula la cantidad de días entre la fecha de entrada y salida
        $fechaEntrada = \Carbon\Carbon::parse($validatedData['fecha_entrada']);
        $fechaSalida = \Carbon\Carbon::parse($validatedData['fecha_salida']);

        // Verifica que la fecha de salida no sea anterior a la de entrada
        if ($fechaSalida <= $fechaEntrada) {
            return response()->json(['message' => 'La fecha de salida debe ser posterior a la de entrada.'], 400);
        }

        // Calcula la diferencia en días
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

        // Busca las habitaciones disponibles (las primeras)
        if ($validatedData['habitaciones_estandar'] > 0) {
            $habitacionesEstandar = Habitacion::where('tipo', 'estandar')
                ->where('disponible', true)
                ->take($validatedData['habitaciones_estandar']) // Toma las primeras disponibles
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
        return redirect()->route('cuenta')->with('message', 'Reserva creada exitosamente');
    }

    public function cancel($id)
    {
        $reserva = Reserva::findOrFail($id);

        // Verifica si el usuario es el dueño de la reserva
        if ($reserva->usuario_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para cancelar esta reserva.');
        }

        // Elimina relaciones
        $reserva->habitaciones()->detach();
        $reserva->servicios()->detach();

        // Elimina la reserva
        $reserva->delete();

        return redirect()->route('cuenta')->with('message', 'Reserva cancelada exitosamente');
    }
}
