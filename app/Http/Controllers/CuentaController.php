<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Estancia;
use Illuminate\Support\Facades\Auth;

class CuentaController extends Controller
{
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

    public function mostrarReservas()
    {
        $reservas = Reserva::where('usuario_id', Auth::id())->get();

        return view('home.reservas', compact('reservas'));
    }
}
