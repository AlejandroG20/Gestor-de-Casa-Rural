<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Estancia;
use App\Models\Habitacion;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class CuentaController extends Controller
{
    /**
     * Muestra todas las reservas del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene las reservas del usuario autenticado con sus habitaciones y servicios
        $reservas = Reserva::where('usuario_id', Auth::id())
            ->with(['habitaciones', 'servicios'])
            ->get();

        // Obtiene las estancias del usuario autenticado con sus habitaciones y servicios
        $estancias = Estancia::where('usuario_id', Auth::id())
            ->with(['habitaciones', 'servicios'])
            ->get();

        // Retorna la vista 'auth.cuenta' con las reservas y estancias del usuario
        return view('auth.cuenta', compact('reservas', 'estancias'));
    }

    /**
     * Muestra todas las reservas del usuario actual
     *
     * @return \Illuminate\View\View
     */
    public function mostrarReservas()
    {
        // Obtiene las reservas del usuario autenticado
        $reservas = Reserva::where('usuario_id', Auth::id())->get();

        // Retorna la vista con las reservas obtenidas
        return view('home.reservas', compact('reservas'));
    }
}
